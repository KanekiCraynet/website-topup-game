<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Base extends Model {

        
	public function random_string($length = 24, $tipe = 'all') {
		if ($tipe == 'all') {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		} else if ($tipe == 'num') {
			$characters = '0123456789';
		} else {
			$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}
		
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	public function tanggal_indo($tanggal) {

		$tanggal_explode = explode('-', $tanggal);

		$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

		return $tanggal_explode[2] . ' ' . $bulan[str_replace('0', '', $tanggal_explode[1])-1] . ' ' . $tanggal_explode[0];


	}

	// CRUD Table
	public function select_distinct($table, $field) {
		return $this->db->table($table)->select($field)->distinct()->orderBy($field, 'ASC')->get()->getResultArray();
	}
	public function all_data($table, $order = null) {
		if ($order) {
			return $this->db->table($table)->orderBy($order, 'DESC')->get()->getResultArray();
		} else {
			return $this->db->table($table)->orderBy('id', 'DESC')->get()->getResultArray();
		}
	}
	public function data_insert($table, $data) {
		return $this->db->table($table)->insert($data);
	}
	public function data_where($table, $field, $value, $sort = null) {
		if ($sort) {
			return $this->db->table($table)->where($field, $value)->orderBy($sort, 'DESC')->get()->getResultArray();
		} else {
			return $this->db->table($table)->where($field, $value)->orderBy('id', 'DESC')->get()->getResultArray();
		}
	}
	public function data_where_array($table, $data) {
		return $this->db->table($table)->where($data)->orderBy('id', 'DESC')->get()->getResultArray();
	}
	public function data_update($table, $data, $id) {
		return $this->db->table($table)->set($data)->where('id', $id)->update();
	}
	public function data_delete($table, $id) {
		return $this->db->table($table)->delete(['id' => $id]);
	}
	public function data_like($table, $filed, $data) {
		return $this->db->table($table)->like($filed, $data)->orderBy('id', 'DESC')->get()->getResultArray();
	}
	public function data_count($table, $where = null) {
		if ($where) {
			return $this->db->table($table)->where($where)->countAllResults();
		} else {
			return $this->db->table($table)->countAllResults();
		}
	}
	public function data_truncate($table) {
		return $this->db->table($table)->truncate();
	}
	public function data_avg($table, $filed, $data, $distinct = false) {
		if ($distinct === true) {
			return $this->db->table($table)->select('date')->where($filed . ' >=', $data[0])->where($filed . ' <=', $data[1])->distinct()->get()->getResultArray();
		} else {
			return $this->db->table($table)->where($filed . ' >=', $data[0])->where($filed . ' <=', $data[1])->get()->getResultArray();
		}
	}
	
	public function get_profit(){
        return $this->db->query("SELECT sum(profit) AS total_profit from orders")->getResultArray();
   }
	function CountOrderSukses() {
        return $this->db->table('orders')->where('status', 'completed')->get()->getNumRows();
        }
	function CountOrderPending() {
        return $this->db->table('orders')->where('status', 'pending')->get()->getNumRows();
        }
	function CountOrderBatal() {
        return $this->db->table('orders')->where('status', 'canceled')->get()->getNumRows();
        }
	
	
	public function webconfig() {
		return json_encode([
		    'status' => true,
		]);
	}
	public function u_get($key) {
	    $utility = $this->db->table('utility')->where('u_key', $key)->get()->getResultArray();
	    
	    if (count($utility) == 1) {
	        return $utility[0]['u_value'];
	    } else {
	        var_dump($key); die;
	    }
	}
	public function u_update($key, $value) {
		return $this->db->table('utility')->set(['u_value' => $value])->where('u_key', $key)->update();
	}
	public function post($link, $data) {
	    $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL             => $link,
            CURLOPT_HTTPHEADER => 'Content-Type: application/x-www-form-urlencoded',
            CURLOPT_POST            => true,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_IPRESOLVE        => CURL_IPRESOLVE_V4,
        ));
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        
        return $result; 
	}
	public function images($file, $path = null) {
		if ($file->getError() == 0) {
			if (in_array(strtolower($file->getClientExtension()), ['jpg', 'jpeg', 'png'])) {
				$name = $file->getRandomName();

				$file->move($path, $name);

				return $name;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function email_invoice($to, $a, $b, $c, $d) {
	    
	    $email = \Config\Services::email();

		$email->initialize([
			'SMTPHost' => $this->M_Base->u_get('s_host'),
			'SMTPUser' => $this->M_Base->u_get('s_user'),
			'SMTPPass' => $this->M_Base->u_get('s_pass'),
			'SMTPPort' => $this->M_Base->u_get('s_port'),
			'mailType' => 'html',
		]);

    	$email->setFrom('noreply@' . str_replace('https://', '', base_url()), $this->u_get('web-title'));
		$email->setTo($to);

		$email->setSubject('Terima Kasih atas Pesanan Anda');
		$email->setMessage('
		<div style="background: #f6f6f6;padding: 20px 10px;">
            <div style="max-width: 480px;background: #fff;margin: auto;margin-top: 50px;padding: 40px;border-radius: 8px;">
                <img src="'.$this->u_get('web-logo').'" alt="" width="150" style="margin-bottom: 10px;">
                <p>Terimakasih telah melakukan pesanan di '.$this->u_get('web-title').', berikut ini terlampir detail dari pesanan kamu.</p>
                <h4>Detail Pesanan</h4>
                <table style="width: 100%;">
                    <tr>
                		<th align="left" style="padding-bottom: 6px;">Tanggal</th>
                		<td>'.date('Y-m-d G:i:s').'</td>
                	</tr>
                	<tr>
                		<th align="left" style="padding-bottom: 6px;">No Pesanan</th>
                		<td>'.$a.'</td>
                	</tr>
                	<tr>
                		<th align="left" style="padding-bottom: 6px;">Nominal Produk</th>
                		<td>'.$b.'</td>
                	</tr>
                	<tr>
                		<th align="left" style="padding-bottom: 6px;">ID Player</th>
                		<td>'.$c.'</td>
                	</tr>
                	<tr>
                		<th align="left" style="padding-bottom: 6px;">Harga</th>
                		<td>'.$d.'</td>
                	</tr>
                </table>
            </div>
            <div style="text-align: center;">
                <p style="font-size: 13px;display: block;margin-top: 10px;color: #b7b7b7;">Copyright &copy; 2022 '.$this->u_get('web-title').' - All Right Reserved</p>
            </div>
        </div>
		');

		$email->send();
	}
}