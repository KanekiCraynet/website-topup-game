<?php

namespace App\Controllers;

class Pages extends BaseController {

    public function profile() {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'passwordl' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordl')))),
                'passwordb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordb')))),
                'passwordbb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordbb')))),
            ];

            if (empty($data_post['passwordl']) OR empty($data_post['passwordb']) OR empty($data_post['passwordbb'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($data_post['passwordb'] !== $data_post['passwordbb']) {
                $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['passwordb']) < 6) {
                $this->session->setFlashdata('error', 'Password minimal 6 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['passwordb']) > 24) {
                $this->session->setFlashdata('error', 'Password maksimal 24 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (!password_verify($data_post['passwordl'], $this->base_data['users']['password'])) {
                $this->session->setFlashdata('error', 'Password lama tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $this->M_Base->data_update('users', [
                    'password' => password_hash($data_post['passwordb'], PASSWORD_DEFAULT)
                ], $this->base_data['users']['id']);

                $this->session->setFlashdata('success', 'Password berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }
        
        if ($this->request->getPost('isi_saldo')) {
            $data_post = [
                'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                'quantity' => addslashes(trim(htmlspecialchars($this->request->getPost('quantity')))),
            ];
            
            if (empty($data_post['method']) OR empty($data_post['quantity'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (!is_numeric($data_post['method']) OR !is_numeric($data_post['quantity'])) {
                $this->session->setFlashdata('error', 'Isi saldo gagal');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($data_post['quantity'] < 10000) {
                $this->session->setFlashdata('error', 'Minimal pengisian saldo Rp 10.000');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $data_method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                
                if (count($data_method) == 0) {
                    $this->session->setFlashdata('error', 'Metode tidak ditemukan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    
                    $result = [
                        'success' => false,
                        'data' => [
                            'checkout_url' => null,
                        ],
                    ];
                    
                    $topup_id = rand(000000,99999);
                    
                    if ($data_method[0]['provider'] == 'Tripay') {
                        
                        $apiKey       = $this->M_Base->u_get('tripay_api');
                        $privateKey   = $this->M_Base->u_get('tripay_private');
                        $merchantCode = $this->M_Base->u_get('tripay_merchant');
                        
                        $data = [
                            'method'         => $data_method[0]['code'],
                            'merchant_ref'   => $topup_id,
                            'amount'         => $data_post['quantity'],
                            'customer_name'  => $this->base_data['users']['username'],
                            'customer_email' => 'xos@gmail.com',
                            'order_items'    => [
                                [
                                    'name'        => 'Topup Saldo - Akun',
                                    'price'       => $data_post['quantity'],
                                    'quantity'    => 1,
                                ]
                            ],
                            'return_url'   => base_url(),
                            'expired_time' => (time() + (24 * 60 * 60)),
                            'signature'    => hash_hmac('sha256', $merchantCode.$topup_id.$data_post['quantity'], $privateKey)
                        ];

                        $curl = curl_init();

                        curl_setopt_array($curl, [
                            CURLOPT_FRESH_CONNECT  => true,
                            CURLOPT_URL            => 'https://tripay.co.id/api/transaction/create',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HEADER         => false,
                            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                            CURLOPT_FAILONERROR    => false,
                            CURLOPT_POST           => true,
                            CURLOPT_POSTFIELDS     => http_build_query($data)
                        ]);

                        $result = curl_exec($curl);
                        $result = json_decode($result, true);
                        
                    } else if ($data_method[0]['provider'] == 'Manual') {
                        
                        $result['success'] = true;
                        $result['data']['checkout_url'] = $data_method[0]['code'];
                        
                    } else {
                        $this->session->setFlashdata('error', 'Metode sedang gangguan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                    
                    if ($result['success'] === true) {
                        
                        $topup = $this->M_Base->data_insert('topup', [
                            'topup_id' => $topup_id,
                         //   'email' => $this->base_data['users']['email'],
                            'metode' => $data_method[0]['name'],
                            'metode_id' => $data_method[0]['id'],
                            'quantity' => $data_post['quantity'],
                            'balance' => $data_post['quantity'],
                            'target' => $result['data']['checkout_url'],
                            'status' => 'Pending',
                            'date_create' => date('Y-m-d G:i:s'),
                        ]);
                        
                        if (filter_var($result['data']['checkout_url'], FILTER_VALIDATE_URL)) {
                            return redirect()->to($result['data']['checkout_url']);
                        } else {
                            $this->session->setFlashdata('success', 'Silahkan transfer sebesar Rp ' . number_format($data_post['quantity'],0,',','.') . ' ke ' . $result['data']['checkout_url'] . ' melalui ' . $data_method[0]['name'] . ' sebelum 1x24 jam.');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else {
                        $this->session->setFlashdata('error', $result['message']);
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Profile',
            'methods' => $this->M_Base->all_data('method'),
            'orders' => $this->M_Base->data_where('orders', 'whatsapp', $this->base_data['users']['whatsapp']),
        ]);

        return view('Pages/profile', $data);
    }

    public function cara_membeli() {

        $data = array_merge($this->base_data, [
            'title' => 'Cara Membeli',
            'tutor' => $this->M_Base->u_get('doc_tutor'),
        ]);

        return view('Pages/cara_membeli', $data);
    }

    public function status() {

        if ($this->request->getGet('order_id')) {
            $order_id = addslashes(trim(htmlspecialchars($this->request->getGet('order_id'))));

            if (is_numeric($order_id)) {
                $data_order = $this->M_Base->data_where('orders', 'order_id', $order_id);

                if (count($data_order) === 1) {
                    $this->session->setFlashdata('detail', $data_order[0]);
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Order ID tidak ditemukan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            } else {
                $this->session->setFlashdata('error', 'Order ID tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Status Pembelian',
        ]);

        return view('Pages/status', $data);
    }

    public function terms() {

        $data = array_merge($this->base_data, [
            'title' => 'Syarat & Ketentuan',
            'terms' => $this->M_Base->u_get('doc_terms'),
        ]);

        return view('Pages/terms', $data);
    }

    public function faq() {

        $data = array_merge($this->base_data, [
            'title' => 'Pertanyaan Umum',
            'faqs' => $this->M_Base->all_data('faq'),
        ]);

        return view('Pages/faq', $data);
    }

    public function help() {

        $data = array_merge($this->base_data, [
            'title' => 'Bantuan',
            'help' => [
                'email' => $this->M_Base->u_get('help_email'),
                'telpon' => $this->M_Base->u_get('help_telpon'),
            ],
        ]);

        return view('Pages/help', $data);
    }
}
