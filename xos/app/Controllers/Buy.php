<?php

namespace App\Controllers;

class Buy extends BaseController {

    public function games($slug) {

        // foreach ($this->M_Base->all_data('product') as $loop) {
        //     $this->M_Base->data_update('product', [
        //         'product' => str_replace('MOBILELEGEND - ', '', $loop['product']),
        //     ], $loop['id']);
        // }
        
        // dd('sudah');

    	$data_games = $this->M_Base->data_where('games', 'slug', $slug);
    	$nama_games = $this->M_Base->data_where('games', 'name', $name);

    	if (count($data_games) === 1) {

            if ($this->request->getPost('tombol')) {
                $data_post = [
                    'product' => htmlspecialchars(trim(addslashes($this->request->getPost('product')))),
                    'method' => htmlspecialchars(trim(addslashes($this->request->getPost('method')))),
                    'target' => htmlspecialchars(trim(addslashes(implode('', $this->request->getPost('target'))))),
                    'whatsapp' => htmlspecialchars(trim(addslashes(implode('', $this->request->getPost('whatsapp'))))),
                ];
                
             
                

                if (empty($data_post['product']) OR empty($data_post['method']) OR empty($data_post['whatsapp']) OR empty($data_post['target'])) {
                    $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    if (!is_numeric($data_post['product'])) {
                        $this->session->setFlashdata('error', 'Produk tidak ditemukan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (!is_numeric($data_post['method'])) {
                        $this->session->setFlashdata('error', 'Metode tidak ditemukan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        if (empty($data_post['whatsapp'])) {
                            $data_post['whatsapp'] = '6285718017762';
                        } else {
                            if (!filter_var($data_post['whatsapp'], FILTER_VALIDATE_INT)) {
                                $this->session->setFlashdata('error', 'WhatsApp tidak sesuai');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        }

                       $data_product = $this->M_Base->data_where('product', 'id', $data_post['product']);
                       $data_product_name = $this->M_Base->data_where('product', 'product', $data_post_name['product']);
                       
                       
                        if (count($data_product) === 1) {
                            
                            if ($data_post['method'] == 123) {
                                $data_method = [
                                    'sistem' => 'Saldo',
                                ];
                            } else {
                                $data_method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                            }

                            if (count($data_method) === 1) {
                                if (strlen($data_post['target']) < 5 OR strlen($data_post['target']) > 24) {
                                    $this->session->setFlashdata('error', 'Target tidak sesuai');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                } else {

                                    $query_price = $this->M_Base->data_where_array('price', [
                                        'method_id' => $data_post['method'],
                                        'product_id' => $data_post['product'],
                                    ]);

                                    if (count($query_price) === 1) {
                                        $price = $query_price[0]['price'];
                                    } else {
                                        $price = $data_product[0]['price'];
                                    }

                                    $order_id = $this->M_Base->random_string(8, 'num');

                                    $apiKey       = $this->M_Base->u_get('tripay_api');
                                    $privateKey   = $this->M_Base->u_get('tripay_private');
                                    $merchantCode = $this->M_Base->u_get('tripay_merchant');

                                    if ($this->base_data['users'] === false) {
                                        $wa = [
                                            'account' => $data_post['whatsapp'],
                                            'invoice' => $data_post['whatsapp'],
                                        ];
                                        $customer = [
                                            'username' => 'Pengguna',
                                            'whatsapp' => $data_post['whatsapp'],
                                        ];
                                    } else {
                                        $wa = [
                                            'account' => $this->base_data['username']['whatsapp'],
                                            'invoice' => $data_post['whatsapp'],
                                        ];
                                        $customer = [
                                            'username' => $this->base_data['users']['username'],
                                            'whatsapp' => $this->base_data['users']['whatsapp'],
                                        ];
                                    }

                                    $status = 'Pending';
                                    $note = 'Menunggu Pembayaran';

                                    if ($data_post['method'] == 123) {
                                        if ($this->base_data['users'] == false) {
                                            $this->session->setFlashdata('error', 'Silahkan login dahulu untuk menggunakan metode saldo');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        } else {
                                            if ($this->base_data['users']['balance'] < $price) {
                                                $this->session->setFlashdata('error', 'Saldo kamu tidak mencukupi');
                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                            } else {

                                                $status = 'Processing';

                                                $this->M_Base->data_update('users', [
                                                    'balance' => $this->base_data['users']['balance'] - $price,
                                                ], $this->base_data['users']['id']);

                                                $result = [
                                                    'success' => true,
                                                    'data' => [
                                                        'pay_code' => '',
                                                        'checkout_url' => base_url() . '/status/?order_id=' . $order_id,
                                                    ],
                                                ];
                                                
    $curl = curl_init();

    $data = [
    'target' => $data_post['whatsapp'], // Ganti ini dengan nomor telepon yang sesuai
   'message' => "Pembelian Anda Sedang Di Proses\n\n*Detail Pembelian*\n(_cek pada link invoice di bawah ini_)\n\n" . esc($result['data']['checkout_url'])
];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: vZH!EsLB4CMjh4mD!rUh'
        ),
    ));

    $api_response = curl_exec($curl);

    curl_close($curl);

    // Cetak respons API cURL
    echo $api_response;
    

                                                if ($data_product[0]['provider'] == 'DF') {

                                                    $post_data = json_encode([
                                                        'username' => $this->M_Base->u_get('digi_user'),
                                                        'buyer_sku_code' => $data_product[0]['sku'],
                                                        'customer_no' => $data_post['target'],
                                                        'ref_id' => $order_id,
                                                        'sign' => md5($this->M_Base->u_get('digi_user').$this->M_Base->u_get('digi_key').$order_id),
                                                    ]);

                                                    $ch = curl_init();
                                                    curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                                    curl_setopt($ch, CURLOPT_POST, 1);
                                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                                    $response = curl_exec($ch);
                                                    $response = json_decode($response, true);
                                                    
                                                    if (isset($response['data'])) {
                                                        if ($response['data']['status'] == 'Gagal') {
                                                            $note = $response['data']['message'];
                                                        } else {
                                                            $note = $response['data']['sn'] !== '' ? $response['data']['sn'] : $response['data']['message'];
                                                        }
                                                    } else {
                                                        $note = 'Failed Order';
                                                    }
                                                } else {
                                                    $note = 'Provider tidak ditemukan';
                                                }
                                            }
                                        }
                                    } else if ($data_method[0]['provider'] == 'Tripay') {
                                        $data = [
                                            'method'         => $data_method[0]['code'],
                                            'merchant_ref'   => $order_id,
                                            'amount'         => $price,
                                            'customer_name'  => $customer['username'],
                                            'customer_email' => 'xos@gmail.com',
                                            'customer_phone' => $customer['whatsapp'],
                                            'order_items'    => [
                                                [
                                                    'name'        => $data_product[0]['product'],
                                                    'price'       => $price,
                                                    'quantity'    => 1,
                                                ]
                                            ],
                                            'return_url'   => base_url(),
                                            'expired_time' => (time() + (24 * 60 * 60)),
                                            'signature'    => hash_hmac('sha256', $merchantCode.$order_id.$price, $privateKey)
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
                                        
                                        $curl = curl_init();

    $data = [
    'target' => $data_post['whatsapp'], // Ganti ini dengan nomor telepon yang sesuai
   'message' => "Pembelian Anda Sedang Menunggu Pembayaran\n\n*Kode Pembayaran*\n(_klik pada link pembayaran di bawah untuk melihat kode pembayaran anda_)\n\n" . esc($result['data']['checkout_url'])
];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: b+GWs5CvVMrNfywyqWi9'
        ),
    ));

    $api_response = curl_exec($curl);

    curl_close($curl);

    // Cetak respons API cURL
    echo $api_response;

                                    } else {
                                        $this->session->setFlashdata('error', 'System Payment Maintenance');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                    if ($result['success'] === true) {                                                                  

                                        if (empty($result['data']['pay_code'])) {
                                            $result['data']['pay_code'] = '';
                                        }

                                        $this->M_Base->data_insert('orders', [
                                            'order_id' => $order_id,
                                            'whatsapp' => $data_post['whatsapp'],
                                            'games_id' => $data_product[0]['games_id'],
                                            'games_img' => $data_games[0]['images'],
                                            'product' => $data_product[0]['product'],
                                            'sku' => $data_product[0]['sku'],
                                            'note' => $note,
                                            'price' => $price,
                                            'profit' => $data_product[0]['profit'],
                                            'target' => $data_post['target'],
                                            'method_id' => $data_post['method'],
                                            'payment_code' => $result['data']['pay_code'],
                                            'payment_url' => $result['data']['checkout_url'],
                                            'status' => $status,
                                            'ip' => $this->ip,
                                            'provider' => $data_product[0]['provider'],
                                            'date_create' => date('Y-m-d G:i:s'),
                                            'date_update' => date('Y-m-d G:i:s'),
                                        ]);

                                        return redirect()->to($result['data']['checkout_url']);
                                    } else {
                                        $this->session->setFlashdata('error', 'Tripay : ' . $result['message']);
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Metode tidak ditemukan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Produk tidak ditemukan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }
            }

	    	$data = array_merge($this->base_data, [
	    		'title' => $data_games[0]['name'],
	    		'games' => $data_games[0],
                        'pay_saldo' => $this->M_Base->u_get('pay-saldo'),
	    		'methods' => $this->M_Base->all_data('method'),
	    		'products' => array_reverse($this->M_Base->data_where('product', 'games_id', $data_games[0]['id'], 'price')),
	    	]);

	        return view('Buy/index', $data);
    	} else {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}
    }

    public function price() { 
    	if ($this->request->getPost('product')) {
    		if (is_numeric($this->request->getPost('product'))) {

    			$id = $this->request->getPost('product');

    			$data_product = $this->M_Base->data_where('product', 'id', $id);

    			if (count($data_product) === 1) {
    				$data_methods = $this->M_Base->all_data('method');

    				if (count($data_methods) == 0) {
    					echo json_encode([
    						'status' => false,
    					]);
    				} else {
    					$price = [];
    					foreach ($data_methods as $data_loop) {
    						$custome = $this->M_Base->data_where_array('price', [
    							'method_id' => $data_loop['id'],
    							'product_id' => $id,
    						]);

    						if (count($custome) === 1) {
    							$custome_price = $custome[0]['price'];
    						} else {
    							$custome_price = $data_product[0]['price'];
    						}

    						$price[] = [
    							'method' => $data_loop['id'],
    							'price' => number_format($custome_price,0,',','.'),
    						];
    					}

                        if ($this->M_Base->u_get('pay-saldo') == 'On') {
                            $price[] = [
                                'method' => 123,
                                'price' => number_format($data_product[0]['price'],0,',','.'),
                            ];
                        }

    					echo json_encode([
    						'status' => true,
    						'price' => $price,
    					]);
    				}
    			} else {
    				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    			}
    		} else {
    			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    		}
    	} else {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}
    }

    public function get($page = null, $games = null) {
        if ($page === 'user-detail') {
            
            $key = 'W7Tei96PIcxtfOFpbuad1Boh5zLZjK4vsXYmrlqGSCknHMDy3VwUANQ28JEg';
            
            $api_key      = $key;
            $game         = $games;
            $user_id      = $this->request->getPost('id');
            $zone_id      = $this->request->getPost('server');
            
            $params = [
                'api_key' => $api_key,
                'game'    => $game,
                'user_id' => $user_id,
                'zone_id' => $zone_id
            ];
            
            $ch = curl_init();
            
            curl_setopt($ch,CURLOPT_URL,'https://api.mentaristore.id/api/v1/check-game');
            curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type: application/x-www-form-urlencoded']);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($params));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
            
            $response = curl_exec($ch);
            
            curl_close($ch);
            
            $data = json_decode($response);
            
            echo json_encode($data);
                                                   
                   
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}