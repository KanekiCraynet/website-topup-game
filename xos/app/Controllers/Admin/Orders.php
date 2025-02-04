<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Orders extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Pembelian',
            'orders' => $this->M_Base->all_data('orders'),
    	]);

        return view('Admin/Orders/index', $data);
    }

    public function edit($id = null) {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($id) {
            if (is_numeric($id)) {
                $data_edit = $this->M_Base->data_where('orders', 'id', $id);

                if (count($data_edit) === 1) {

                    if ($this->request->getPost('tombol')) {
                        $status = $this->request->getPost('status');

                        if (empty($status)) {
                            $this->session->setFlashdata('error', 'Pesanan gagal disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $this->M_Base->data_update('orders', [
                                'status' => $status,
                            ], $id);

                            $this->session->setFlashdata('success', 'Pesanan berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }

                    $data = array_merge($this->base_data, [
                        'title' => 'Edit Pembelian',
                        'order' => $data_edit[0],
                    ]);

                    return view('Admin/Orders/edit', $data);
                } else {
                    $this->session->setFlashdata('error', 'Data tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/orders');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detail($id = null) {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($id) {
            if (is_numeric($id)) {
                $data_detail = $this->M_Base->data_where('orders', 'id', $id);

                if (count($data_detail) === 1) {

                    $data = array_merge($this->base_data, [
                        'title' => 'Detail Pembelian',
                        'order' => $data_detail[0],
                    ]);

                    return view('Admin/Orders/detail', $data);
                } else {
                    $this->session->setFlashdata('error', 'Data tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/orders');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete($id = null) {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($id) {
            if (is_numeric($id)) {
                $data_delete = $this->M_Base->data_where('orders', 'id', $id);

                if (count($data_delete) === 1) {
                    $this->M_Base->data_delete('orders', $id);

                    $this->session->setFlashdata('success', 'Data berhasil dihapus');
                    return redirect()->to(base_url() . '/admin/orders');
                } else {
                    $this->session->setFlashdata('error', 'Data tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/orders');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
