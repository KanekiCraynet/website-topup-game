<?php

namespace App\Controllers;

class Sistem extends BaseController {

    public function scrape($action = null) {
    	if ($action) {
    		if ($action === 'product') {

    			$digi_user = $this->M_Base->u_get('digi_user');
    			$digi_key = $this->M_Base->u_get('digi_key');
    			
    			$profit = $this->M_Base->u_get('profit');    			   			

    			$post_data = json_encode([
			        'cmd' => 'prepaid',
			        'username' => $digi_user,
			        'sign' => md5($digi_user.$digi_key."pricelist"),
			    ]);

			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/price-list');
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			    curl_setopt($ch, CURLOPT_POST, 1);
			    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			    $result = curl_exec($ch);
			    $result = json_decode($result, true);

			    if (array_key_exists('data', $result)) {

			    	$game_failed = [];

			    	$this->M_Base->data_truncate('product');

			    	foreach ($result['data'] as $data) {
			    	
			    		if ($data['category'] === 'Games' || 'Pulsa' || 'Pascabayar') {
			    		
			    			if ($data['buyer_product_status'] === true && $data['seller_product_status'] === true) {
			    				$games = str_replace(':', '', $data['brand']);

				    			$product = $data['product_name'];
				    			$price = $data['price'];
				    			$profit = $profit;
				    			$sku = $data['buyer_sku_code'];

				    			$data_games = $this->M_Base->data_where('games', 'brand', $games);

				    			if (count($data_games) === 1) {
				    				$this->M_Base->data_insert('product', [
				    					'games_id' => $data_games[0]['id'],
				    					'product' => $product,
				    					'price' => $price * (1 + ($profit / 100)),
				    					'profit' => $profit,
				    					'provider' => 'DF'
				    				]);
				    			} else {
				    				$game_failed[] = $games;
				    			}
			    			}
			    		} 
			    	}
			    	echo "<pre>";
			    	print_r(array_unique($game_failed));
			    	echo "</pre>";
			    }
			    
    		} else {
    			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    		}
    	} else {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}
    }
    
    public function CekSaldoDigiflazz() {

    			$digi_user = $this->M_Base->u_get('digi_user');
    			$digi_key = $this->M_Base->u_get('digi_key');
    			
    			$profit = $this->M_Base->u_get('profit');    			   			

    			$post_data = json_encode([
			        'cmd' => 'deposit',
			        'username' => $digi_user,
			        'sign' => md5($digi_user.$digi_key."depo"),
			    ]);

			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/cek-saldo');
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			    curl_setopt($ch, CURLOPT_POST, 1);
			    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			    $result = curl_exec($ch);
			    $result = json_decode($result, true);
			    
			    return view('Admin/Config/index', ['resultsaldodf' => $result]);
			    
	    echo "<pre>";
            echo print_r($result);
            echo "</pre>";    
	    
    }

    public function status() {
        foreach($this->M_Base->data_where('orders', 'status', 'Processing') as $order) {
            
            $df_user = $this->M_Base->u_get('digi_user');
            $df_key = $this->M_Base->u_get('digi_key');
            
            $post_data = json_encode([
                'username' => $df_user,
                'buyer_sku_code' => $order['sku'],
                'customer_no' => $order['target'],
                'ref_id' => $order['order_id'],
                'sign' => md5($df_user.$df_key.$order['order_id']),
            ]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            
            if (isset($result['data'])) {
                
                if ($result['data']['status'] == 'Gagal') {
                	$this->M_Base->data_update('orders', [
						'note' => $result['data']['message'],
						'status' => 'Canceled',
					], $order['id']);
					
$curl = curl_init();

    $data = [
    'target' => $order['no_wa'], // Ganti ini dengan nomor telepon yang sesuai
    'message' => "Pembelian " . esc($order['product']) . " Gagal"
];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 2T9ziu#n#St-Dn+2KjfF'
        ),
    ));

    $api_response = curl_exec($curl);

    curl_close($curl);

    // Cetak respons API cURL
    echo $api_response; 							
					
                } else {
                    
                    if ($result['data']['status'] == 'Sukses') {
                        $note = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
    
                        $this->M_Base->data_update('orders', [
    						'status' => 'Completed',
    						'note' => $note,
    					], $order['id']);
    					
   $curl = curl_init();

    $data = [
    'target' => $order['no_wa'], // Ganti ini dengan nomor telepon yang sesuai
    'message' => "Pembelian " . esc($order['product']) . " Berhasil"
];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 2T9ziu#n#St-Dn+2KjfF'
        ),
    ));

    $api_response = curl_exec($curl);

    curl_close($curl);

    // Cetak respons API cURL
    echo $api_response; 					
    					
    					$this->M_Base->email_invoice($order['email_invoice'], $order['order_id'], $order['product'], $order['target'], 'Rp ' . number_format($order['price'],0,',','.'));
                    }
                }
            }
        }
    }
    
    
    public function profile_vip()
    {
        
    $apiId = 'zshRILQk';
    $apiKey = 'qy7gd0Q1Pox2wMiWA11nl8S13NofHJAsCOwZAYPDUOGrX59XehQ4fM3fhbDjcFds';
    $sign = md5($apiId.$apiKey);

    $data = [
        'key' => $apiKey,
        'sign' => $sign,
    ];
    
    $url = 'https://vip-reseller.co.id/api/profile';
    
    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://vip-reseller.co.id/api/profile');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            
            echo "<pre>";
            echo print_r($result);
            echo "</pre>";    
    
    }
    
    public function get_services_vip()
    {
        
    $apiId = 'zshRILQk';
    $apiKey = 'qy7gd0Q1Pox2wMiWA11nl8S13NofHJAsCOwZAYPDUOGrX59XehQ4fM3fhbDjcFds';
    $sign = md5($apiId.$apiKey);

    $data = [
        'key' => $apiKey,
        'sign' => $sign,
        'type' => 'services',
        
    ];
    
    $url = 'https://vip-reseller.co.id/api/game-feature';
    
    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://vip-reseller.co.id/api/game-feature');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            
			    if (array_key_exists('data', $result)) {

			    	$game_failed = [];

			    //	$this->M_Base->data_truncate('product');

			    	foreach ($result['data'] as $data) {
			    	
			    	var_dump($data);
			    	die();
			    	
			    	$data_games = $this->M_Base->data_where('games', 'brand', $games);

			    	
			    	                       if (count($data_games) === 1) {
				    				$this->M_Base->data_insert('product', [
				    					'games_id' => $data_games[0]['id'],
				    					'product' => $name,
				    					'price' => $price + $profit,
				    					'profit' => $profit,
				    					'sku' => $code,
				    					'provider' => 'VIP'
				    				]);
				    			} else {
				    				$game_failed[] = $games;
				    			}
				    			
				    			
			    		
			    	}
			    }
            
            echo "<pre>";
            echo print_r($result);
            echo "</pre>";    
    
    }

    public function tripay($action = null) {
    	if ($action) {
    		if ($action === 'callback') {

    			$json = file_get_contents('php://input');

				$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

				if ($callbackSignature !== hash_hmac('sha256', $json, $this->M_Base->u_get('tripay_private'))) {
				    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				} else {
					if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
					    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
					} else {
						$data = json_decode($json, true);

						if ($data['status'] === 'PAID') {						
						
							$data_order = $this->M_Base->data_where_array('orders', [
								'status' => 'Pending',
								'order_id' => $data['merchant_ref'],
							]);

							if (count($data_order) === 1) {

								$df_user = $this->M_Base->u_get('digi_user');
								$df_key = $this->M_Base->u_get('digi_key');

								$post_data = json_encode([
		                            'username' => $df_user,
		                            'buyer_sku_code' => $data_order[0]['sku'],
		                            'customer_no' => $data_order[0]['target'],
		                            'ref_id' => $data_order[0]['order_id'],
		                            'sign' => md5($df_user.$df_key.$data_order[0]['order_id']),
		                        ]);
		        
		                        $ch = curl_init();
		                        curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
		                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		                        curl_setopt($ch, CURLOPT_POST, 1);
		                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		                        $result = curl_exec($ch);
		                        $result = json_decode($result, true);
		                        
		                        if (isset($result['data'])) {
		                            if ($result['data']['status'] == 'Gagal') {
		                            	$this->M_Base->data_update('orders', [
											'note' => $result['data']['message'],
										], $data_order[0]['id']);
		                            } else {

		                                $note = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];

		                                $this->M_Base->data_update('orders', [
											'status' => 'Processing',
											'note' => $note,
										], $data_order[0]['id']);

										echo json_encode(['success' => true]);
		                            }
		                        } else {
		                            $this->M_Base->data_update('orders', [
										'note' => 'Failed Order',
									], $data_order[0]['id']);
		                        }
							} else {

							    $topup = $this->M_Base->data_where_array('topup', [
							        'topup_id' => $data['merchant_ref'],
							        'status' => 'Pending',
							    ]);
							    
							    if (count($topup) == 1) {
							        $this->M_Base->data_update('topup', [
							            'status' => 'Success',
							        ], $topup[0]['id']);
							        
							        $users = $this->M_Base->data_where('users', 'email', $topup[0]['email']);
							        
							        if (count($users) == 1) {
							            $this->M_Base->data_update('users', [
							                'balance' => $users[0]['balance'] + $topup[0]['balance'],
							            ], $users[0]['id']);
							        }
							    }
							}
						}
					}
				}
    		} else {
    			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    		}
    	} else {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}
    }
}
