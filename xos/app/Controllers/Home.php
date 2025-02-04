<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        if ($this->request->getGet('tripay_merchant_ref')) {
            return redirect()->to(base_url() . '/status/?order_id=' . $this->request->getGet('tripay_merchant_ref'));
        }
        
        if ($this->request->getPost('tombol')) {
    if ($this->request->getPost('tombol') === 'daftar') {
        $data_post = [
            'username' => $this->request->getPost('username'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'password' => $this->request->getPost('password'),
        ];

        if (empty($data_post['username']) || empty($data_post['whatsapp']) || empty($data_post['password'])) {
            $this->session->setFlashdata('auth_error', 'Lengkapi semua data');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        } elseif (filter_var($data_post['whatsapp'], FILTER_VALIDATE_INT)) {
            if (strlen($data_post['whatsapp']) < 7 || strlen($data_post['whatsapp']) > 15) {
                $this->session->setFlashdata('auth_error', 'Nomor tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } elseif (strlen($data_post['password']) < 6) {
                $this->session->setFlashdata('auth_error', 'Password terlalu pendek');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } elseif (strlen($data_post['password']) > 24) {
                $this->session->setFlashdata('auth_error', 'Password terlalu panjang');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } elseif (strlen($data_post['username']) < 3 || strlen($data_post['username']) > 55) {
                $this->session->setFlashdata('auth_error', 'Username tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $data_wa = $this->M_Base->data_where('users', 'whatsapp', $data_post['whatsapp']);

                if (count($data_wa) === 0) {
                    $data_ip = $this->M_Base->data_where('users', 'ip', $this->ip);

                    if (count($data_ip) < 3) {
                        $this->M_Base->data_insert('users', [
                            'username' => $data_post['username'],
                            'whatsapp' => $data_post['whatsapp'],
                            'balance' => 0,
                            'password' => password_hash($data_post['password'], PASSWORD_DEFAULT),
                            'level' => 'Member',
                            'status' => 'On',
                            'date_create' => date('Y-m-d G:i:s'),
                            'last_ip' => '',
                            'last_login' => '',
                        ]);

                        $this->session->setFlashdata('auth_success', 'Pendaftaran berhasil');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->session->setFlashdata('auth_error', 'Anda sudah mendaftar');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('auth_error', 'Nomor sudah terdaftar');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        } else {
            $this->session->setFlashdata('auth_error', 'Nomor tidak sesuai');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }
    } else if ($this->request->getPost('tombol') === 'masuk') {
        $data_post = [
            'whatsapp' => $this->request->getPost('whatsapp'),
            'password' => $this->request->getPost('password'),
        ];

        if (empty($data_post['whatsapp']) || empty($data_post['password'])) {
            $this->session->setFlashdata('auth_error', 'Lengkapi semua data');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        } else {
            $data_user = $this->M_Base->data_where('users', 'whatsapp', $data_post['whatsapp']);

            if (count($data_user) === 1) {
                if ($data_user[0]['status'] === 'On') {
                    if (password_verify($data_post['password'], $data_user[0]['password'])) {
                        $this->session->set('whatsapp', $data_user[0]['whatsapp']);

                        $this->M_Base->data_update('users', [
                            'last_ip' => $this->ip,
                            'last_login' => date('Y-m-d G:i:s'),
                        ], $data_user[0]['id']);

                        $this->session->setFlashdata('auth_success', 'Login berhasil');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->session->setFlashdata('auth_error', 'Nomor / password salah');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('auth_error', 'Akun tersuspend');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            } else {
                $this->session->setFlashdata('auth_error', 'Nomor / password salah');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }
    } else if ($this->request->getPost('tombol') === 'reset') {
        $data_post = [
    'whatsapp' => $this->request->getPost('whatsapp'),
];

if (empty($data_post['whatsapp'])) {
    $this->session->setFlashdata('auth_error', 'Masukkan Nomor WhatsApp');
    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
} else {
    $data_wa = $this->M_Base->data_where('users', 'whatsapp', $data_post['whatsapp']);

    if (count($data_wa) === 1) {
        $randomPassword = bin2hex(random_bytes(6));
        $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);

        // Update password dalam database
        $result = $this->M_Base->data_update('users', ['password' => $hashedPassword], ['whatsapp' => $data_post['whatsapp']]);

        if ($result) {
            // Password berhasil diubah
            $this->session->setFlashdata('reset_success', 'Ubah password berhasil, cek pesan yang sudah kami kirim ke WhatsApp anda');
            echo 'Password berhasil diubah!';
        } else {
            // Gagal mengubah password
            $this->session->setFlashdata('reset_error', 'Gagal mengubah password');
            echo 'Gagal mengubah password!';
        }

        // Kirim pesan melalui API
        $curl = curl_init();
        $data = [
            'target' => $data_post['whatsapp'], // Nomor WhatsApp pengguna
            'message' => "Reset Password Berhasil\n\nPassword Baru Anda Adalah " . esc($randomPassword)
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: vZH!EsLB4CMjh4mD!rUh' // Ganti dengan token atau kunci otentikasi Anda
            ),
        ));

        // Eksekusi cURL untuk mengirim pesan
        $api_response = curl_exec($curl);

        // Tutup koneksi cURL
        curl_close($curl);

        // Cek jika ada kesalahan dalam respons API cURL
        if ($api_response === false) {
            // Handle kesalahan jika diperlukan
            echo 'Error: ' . curl_error($curl);
        } else {
            // Pesan berhasil dikirim
            echo 'Message sent successfully.';
            // Anda dapat menambahkan log atau penanganan lainnya di sini
        }

        // Redirect atau kembalikan respons untuk memberi tahu pengguna
        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    }
}
}
 }

        

        $games_list = [];
        foreach (array_reverse($this->M_Base->all_data('category', 'sort')) as $data_loop) {
            $games_list[] = [
                'name' => $data_loop['category'],
                'games' => array_reverse($this->M_Base->data_where('games', 'category', $data_loop['id'], 'sort')),
            ];
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tempatnya Top Up Termurah & Tercepat #1 Indonesia',
            'games' => $games_list,
            'slide' => [
                '1' => $this->M_Base->u_get('slide-1'),
                '2' => $this->M_Base->u_get('slide-2'),
                '3' => $this->M_Base->u_get('slide-3'),
            ],
            'orders' => $this->M_Base->data_where('orders', 'whatsapp', $this->base_data['users']['whatsapp']),
        ]);

        return view('Home/index', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}