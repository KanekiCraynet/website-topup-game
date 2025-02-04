<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Payment extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Pembayaran',
            'methods' => $this->M_Base->all_data('method'),
    	]);

        return view('Admin/Payment/index', $data);
    }

    public function add() {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'name' => $this->request->getPost('name'),
                'provider' => $this->request->getPost('provider'),
                'code' => $this->request->getPost('code'),
            ];

            if (empty($data_post['name']) OR empty($data_post['provider']) OR empty($data_post['code'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
            //  $this->M_Base->data_insert('method', $data_post);
                $images = $this->M_Base->images($this->request->getFiles()['images'], 'assets/images/pembayaran/');
                
                if ($images) {
                    $this->M_Base->data_insert('method', array_merge($data_post, [
                        
                        'images' => $images,
                    ]));

                    $this->session->setFlashdata('success', ' Metode pembayaran baru berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }             

              //  $this->session->setFlashdata('success', 'Metode pembayaran berhasil ditambahkan');
              //  return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Pembayaran',
        ]);

        return view('Admin/Payment/add', $data);
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
                $data_edit = $this->M_Base->data_where('method', 'id', $id);

                if (count($data_edit) === 1) {

                    if ($this->request->getPost('tombol')) {
                        $data_post = [
                            'images' => $this->request->getPost('images'),
                            'name' => $this->request->getPost('name'),
                            'provider' => $this->request->getPost('provider'),
                            'code' => $this->request->getPost('code'),
                        ];

                         if (empty($data_post['name']) OR empty($data_post['provider']) OR empty($data_post['code'])) {
                            $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                        
                                $images = $this->M_Base->images($this->request->getFiles()['images'], 'assets/images/pembayaran/');
                                if ($images) {
                                    $data_post['images'] = $images;
                                } else {
                                    $data_post['images'] = $data_edit[0]['images'];
                                }

                                $this->M_Base->data_update('method', $data_post, $id);

                                $this->session->setFlashdata('success', 'Metode pembayaran berhasil disimpan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            } 
                        //    $this->M_Base->data_update('method', $data_post, $id);

                          //  $this->session->setFlashdata('success', 'Metode pembayaran berhasil disimpan');
                         //   return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        
                    }

                    $data = array_merge($this->base_data, [
                        'title' => 'Edit Pembayaran',
                        'method' => $data_edit[0],
                    ]);

                    return view('Admin/Payment/edit', $data);

                } else {
                    $this->session->setFlashdata('error', 'Data pengguna tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/payment');
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
                $data_delete = $this->M_Base->data_where('method', 'id', $id);

                if (count($data_delete) === 1) {
                    $this->M_Base->data_delete('method', $id);

                    $this->session->setFlashdata('success', 'Data pengguna berhasil dihapus');
                    return redirect()->to(base_url() . '/admin/payment');
                } else {
                    $this->session->setFlashdata('error', 'Data pengguna tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/payment');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
