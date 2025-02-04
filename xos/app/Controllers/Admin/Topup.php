<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Topup extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Topup',
            'topup' => $this->M_Base->all_data('topup'),
    	]);

        return view('Admin/Topup/index', $data);
    }
    
    public function edit($id = null) {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else if (!is_numeric($id)) {
    	    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else {
    	    $topup = $this->M_Base->data_where('topup', 'id', $id);
    	    
    	    if (count($topup) == 1) {
    	        
    	        if ($this->request->getPost('tombol')) {
    	            $this->M_Base->data_update('topup', [
    	                'email' => $this->request->getPost('email'),
                        'metode' => $this->request->getPost('metode'),
                        'quantity' => $this->request->getPost('quantity'),
                        'balance' => $this->request->getPost('balance'),
                        'status' => $this->request->getPost('status'),
    	            ], $id);
    	            
    	            $this->session->setFlashdata('success', 'Data topup berhasil disimpan');
    	            return redirect()->to(base_url() . '/admin/topup');
    	        }
    	        
    	        $data = array_merge($this->base_data, [
            		'title' => 'Edit Topup',
                    'topup' => $topup[0],
            	]);
        
                return view('Admin/Topup/edit', $data);
                
    	    } else {
    	        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	    }
    	}
    }
    
    public function accept($id = null) {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else if (!is_numeric($id)) {
    	    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else {
    	    $topup = $this->M_Base->data_where('topup', 'id', $id);
    	    
    	    if (count($topup) == 1) {
    	        
    	        if ($topup[0]['status'] == 'Pending') {
    	            
    	            $this->M_Base->data_update('topup', [
    	                'status' => 'Success'
    	            ], $id);
    	            
    	            $email = $this->M_Base->data_where('users', 'email', $topup[0]['email']);
    	            
    	            if (count($email) == 1) {
    	                $this->M_Base->data_update('users', [
    	                    'balance' => $email[0]['balance'] + $topup[0]['balance'],
    	                ], $email[0]['id']);
    	            }
    	            
    	            $this->session->setFlashdata('success', 'Data topup berhasil diterima');
    	            return redirect()->to(base_url() . '/admin/topup');
    	        } else {
    	            $this->session->setFlashdata('error', 'Topup sudah berstatus : ' . $topup[0]['status']);
    	            return redirect()->to(base_url() . '/admin/topup');
    	        }
    	    } else {
    	        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	    }
    	}
    }
    
    public function reject($id = null) {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else if (!is_numeric($id)) {
    	    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else {
    	    $topup = $this->M_Base->data_where('topup', 'id', $id);
    	    
    	    if (count($topup) == 1) {
    	        
    	        if ($topup[0]['status'] == 'Pending') {
    	            $this->M_Base->data_update('topup', [
    	                'status' => 'Canceled'
    	            ], $id);
    	            
    	            $this->session->setFlashdata('success', 'Data topup berhasil ditolak');
    	            return redirect()->to(base_url() . '/admin/topup');
    	        } else {
    	            $this->session->setFlashdata('error', 'Topup sudah berstatus : ' . $topup[0]['status']);
    	            return redirect()->to(base_url() . '/admin/topup');
    	        }
    	    } else {
    	        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	    }
    	}
    }
    
    public function delete($id = null) {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else if (!is_numeric($id)) {
    	    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	} else {
    	    $topup = $this->M_Base->data_where('topup', 'id', $id);
    	    
    	    if (count($topup) == 1) {
    	        $this->M_Base->data_delete('topup', $id);
    	        
    	        $this->session->setFlashdata('success', 'Data topup berhasil dihapus');
    	        return redirect()->to(base_url() . '/admin/topup');
    	    } else {
    	        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	    }
    	}
    }
}