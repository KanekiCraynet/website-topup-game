<?php

namespace App\Controllers;

class Pulsa extends BaseController {

    public function index() {

        if ($this->request->getGet('tripay_merchant_ref')) {
            return redirect()->to(base_url() . '/status/?order_id=' . $this->request->getGet('tripay_merchant_ref'));
        }

    	if ($this->request->getPost('tombol')) {
    		if ($this->request->getPost('tombol') === 'daftar') {
    		    
    			$data_post = [
    				'name' => $this->request->getPost('name'),
    				'email' => $this->request->getPost('email'),
    				'password' => $this->request->getPost('password'),
    			];

    			if (empty($data_post['name']) OR empty($data_post['email']) OR empty($data_post['password'])) {
    				$this->session->setFlashdata('auth_error', 'Lengkapi semua data');
    				return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    			} else if (filter_var($data_post['email'], FILTER_VALIDATE_EMAIL)) {
    				if (strlen($data_post['email']) < 7 OR strlen($data_post['email']) > 55) {
    					$this->session->setFlashdata('auth_error', 'Email tidak sesuai');
    					return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    				} else if (strlen($data_post['password']) < 6) {
    					$this->session->setFlashdata('auth_error', 'Password terlalu pendek');
    					return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    				} else if (strlen($data_post['password']) > 24) {
    					$this->session->setFlashdata('auth_error', 'Password terlalu panjang');
    					return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    				} else if (strlen($data_post['name']) < 3) {
    					$this->session->setFlashdata('auth_error', 'Nama tidak sesuai');
    					return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    				} else if (strlen($data_post['name']) > 55) {
    					$this->session->setFlashdata('auth_error', 'Nama tidak sesuai');
    					return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    				} else {
    					$data_email = $this->M_Base->data_where('users', 'email', $data_post['email']);

    					if (count($data_email) === 0) {
    						$data_ip = $this->M_Base->data_where('users', 'ip', $this->ip);

    						if (count($data_ip) < 3) {

    							$this->M_Base->data_insert('users', [
    								'name' => $data_post['name'],
    								'email' => $data_post['email'],
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
    						$this->session->setFlashdata('auth_error', 'Email sudah terdaftar');
    						return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    					}
    				}
    			} else {
    				$this->session->setFlashdata('auth_error', 'Email tidak sesuai');
    				return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    			}
    		} else if ($this->request->getPost('tombol') === 'masuk') {
    			$data_post = [
    				'email' => $this->request->getPost('email'),
    				'password' => $this->request->getPost('password'),
    			];

    			if (empty($data_post['email']) OR empty($data_post['password'])) {
    				$this->session->setFlashdata('auth_error', 'Lengkapi semua data');
    				return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    			} else {
    				$data_email = $this->M_Base->data_where('users', 'email', $data_post['email']);

    				if (count($data_email) === 1) {
    					if ($data_email[0]['status'] === 'On') {
    						if (password_verify($data_post['password'], $data_email[0]['password'])) {
    							$this->session->set('email', $data_email[0]['email']);

    							$this->M_Base->data_update('users', [
    								'last_ip' => $this->ip,
    								'last_login' => date('Y-m-d G:i:s'),
    							], $data_email[0]['id']);

    							$this->session->setFlashdata('auth_success', 'Login berhasil');
    							return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    						} else {
    							$this->session->setFlashdata('auth_error', 'Email / password salah');
    							return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    						}
    					} else {
    						$this->session->setFlashdata('auth_error', 'Akun tersuspend');
    						return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    					}
    				} else {
    					$this->session->setFlashdata('auth_error', 'Email / password salah');
    					return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
    				}
    			}
    		}
    	}

        $games_list = [];
        foreach (array_reverse($this->M_Base->data_where('category', 'category', 'pulsa')) as $data_loop) {
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
    	]);

        return view('Pulsa/index', $data);
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}
