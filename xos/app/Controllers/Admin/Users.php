<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Users extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Pengguna',
            'userss' => $this->M_Base->all_data('users'),
    	]);

        return view('Admin/Users/index', $data);
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
                $data_edit = $this->M_Base->data_where('users', 'id', $id);

                if (count($data_edit) == 1) {

                    if ($this->request->getPost('tombol')) {
                        $data_post = [
                            'username' => $this->request->getPost('username'),
                            'balance' => $this->request->getPost('balance'),
                            'whatsapp' => $this->request->getPost('whatsapp'),
                            'level' => $this->request->getPost('level'),
                            'status' => $this->request->getPost('status'),
                        ];

                        if (empty($data_post['username']) OR empty($data_post['whatsapp']) OR empty($data_post['level']) OR empty($data_post['status'])) {
                            $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $this->M_Base->data_update('users', $data_post, $id);

                            $this->session->setFlashdata('success', 'Data berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }

                    $data = array_merge($this->base_data, [
                        'title' => 'Edit Pengguna',
                        'user' => $data_edit[0],
                    ]);

                    return view('Admin/Users/edit', $data);
                } else {
                    $this->session->setFlashdata('error', 'Data tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/users');
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
                $data_delete = $this->M_Base->data_where('users', 'id', $id);

                if (count($data_delete) === 1) {
                    $this->M_Base->data_delete('users', $id);

                    $this->session->setFlashdata('success', 'Data pengguna berhasil dihapus');
                    return redirect()->to(base_url() . '/admin/users');
                } else {
                    $this->session->setFlashdata('error', 'Data pengguna tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/users');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
