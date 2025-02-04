<?php

namespace App\Controllers;

class Deposit extends BaseController {

    public function deposit() {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
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
                            'customer_name'  => $this->base_data['users']['name'],
                            'customer_email' => $this->base_data['users']['email'],
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
                            'email' => $this->base_data['users']['email'],
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
            'orders' => $this->M_Base->data_where('orders', 'email_account', $this->base_data['users']['email']),
            'deposit' => $this->M_Base->data_where('topup', 'email', $this->base_data['users']['email']),
        ]);

        return view('Deposit/index', $data);
    }

}
