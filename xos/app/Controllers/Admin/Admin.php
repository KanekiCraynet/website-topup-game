<?php

namespace App\Controllers\Admin;

use App\Models\OrderModel;

use App\Controllers\BaseController;

class Admin extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

        $grafik = [];
        for ($i=0; $i < 7; $i++) { 
            $grafik[] = [
                'tanggal' => date('Y-m-d', time()-60*60*24*$i),
                'transaksi' => count($this->M_Base->data_like('orders', 'date_create', date('Y-m-d', time()-60*60*24*$i))),
            ];
        }
        
        $total_trx = $this->db->table('orders')->selectSum('price')->get()->getRow()->price;
        $data['price'] = $total_trx;
        
        
        $orderModel = new OrderModel();
        $completedOrders = $orderModel->where('status', 'Completed')->findAll();
        $totalProfit = 0;
        foreach ($completedOrders as $order) {
            $totalProfit += $order['profit'];
        }
        
       // var_dump($totalProfit); // Menampilkan nilai 
      //  die(); // Menghentikan eksekusi agar hanya var_dump yang ditampilkan
        

    	$data = array_merge($this->base_data, [
    		'title' => 'Dashboard',
            'total' => [
                'users' => $this->M_Base->data_count('users'),
                'orders' => $this->M_Base->data_count('orders'),               
                'games' => $this->M_Base->data_count('games'),
                'trxsukses' => $this->M_Base->CountOrderSukses(),
                'trxpending' => $this->M_Base->CountOrderPending(),
                'trxbatal' => $this->M_Base->CountOrderBatal(),
              //  'profit' => $this->M_Base->get_profit(),
                
               ],
            'grafik' => $grafik,
            'total_trx' => $total_trx,
            'totalProfit' => $totalProfit,
            ]);                                                                      

        return view('Admin/Admin/index', $data);
    }
    
}
