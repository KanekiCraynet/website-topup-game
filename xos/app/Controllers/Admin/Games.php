<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Games extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

        $gamess = [];
        foreach (array_reverse($this->M_Base->all_data('games', 'sort')) as $data_loop) {

            $data_category = $this->M_Base->data_where('category', 'id', $data_loop['category']);

            if (count($data_category) === 1) {
                $category_name = $data_category[0]['category'];
            } else {
                $category_name = '-';
            }

            $gamess[] = array_merge($data_loop, [
                'category_name' => $category_name,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Games',
            'gamess' => $gamess,
    	]);

        return view('Admin/Games/index', $data);
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
                'brand' => $this->request->getPost('brand'),
                'slug' => $this->request->getPost('slug'),
                'category' => $this->request->getPost('category'),
                'content' => $this->request->getPost('content'),
                'target' => $this->request->getPost('target'),
                'validasi_status' => $this->request->getPost('validasi_status'),
                'validasi_kode' => $this->request->getPost('validasi_kode'),
            ];

            if (empty($data_post['name']) OR empty($data_post['brand']) OR empty($data_post['slug']) OR empty($data_post['category']) OR empty($data_post['target']) OR empty($data_post['validasi_status'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $images = $this->M_Base->images($this->request->getFiles()['images'], 'assets/images/games/');

                if ($images) {
                    $this->M_Base->data_insert('games', array_merge($data_post, [
                        'sort' => 1,
                        'images' => $images,
                    ]));

                    $this->session->setFlashdata('success', 'Games baru berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar tidak boleh kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Games',
            'categorys' => array_reverse($this->M_Base->all_data('category', 'sort')),
        ]);

        return view('Admin/Games/add', $data);
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
                $data_edit = $this->M_Base->data_where('games', 'id', $id);

                if (count($data_edit) === 1) {

                    if ($this->request->getPost('tombol')) {
                        $data_post = [
                            'images' => $this->request->getPost('images'),
                            'name' => $this->request->getPost('name'),
                            'brand' => $this->request->getPost('brand'),
                            'slug' => $this->request->getPost('slug'),
                            'category' => $this->request->getPost('category'),
                            'content' => $this->request->getPost('content'),
                            'target' => $this->request->getPost('target'),
                            'validasi_status' => $this->request->getPost('validasi_status'),
                            'validasi_kode' => $this->request->getPost('validasi_kode'),
                        ];

                        if (empty($data_post['name']) OR empty($data_post['slug']) OR empty($data_post['category'])) {
                            $this->session->setFlashdata('error', 'Tidak boleh ada data yang kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $query_slug = $this->M_Base->data_where_array('games', [
                                'slug' => $data_post['slug'],
                            ]);

                            if (count($query_slug) === 1) {
                                if ($query_slug[0]['id'] === $id) {
                                    $next = true;
                                } else {
                                    $next = false;
                                }
                            } else {
                                $next = true;
                            }

                            if ($next === true) {

                                $images = $this->M_Base->images($this->request->getFiles()['images'], 'assets/images/games/');
                                if ($images) {
                                    $data_post['images'] = $images;
                                } else {
                                    $data_post['images'] = $data_edit[0]['images'];
                                }

                                $this->M_Base->data_update('games', $data_post, $id);

                                $this->session->setFlashdata('success', 'Data games berhasil disimpan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            } else {
                                $this->session->setFlashdata('error', 'Slug sudah ada, slug tidak boleh sama');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        }
                    }

                    $data = array_merge($this->base_data, [
                        'title' => 'Kelola Games',
                        'games' => $data_edit[0],
                        'categorys' => array_reverse($this->M_Base->all_data('category', 'sort')),
                    ]);

                    return view('Admin/Games/edit', $data);
                } else {
                    $this->session->setFlashdata('error', 'Games tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/games');
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

                $data_delete = $this->M_Base->data_where('games', 'id', $id);

                if (count($data_delete) === 1) {
                    $this->M_Base->data_delete('games', $id);

                    $this->session->setFlashdata('success', 'Data berhasil dihapus');
                    return redirect()->to(base_url() . '/admin/games');
                } else {
                    $this->session->setFlashdata('error', 'Daga tidak ditemukan');
                    return redirect()->to(base_url() . '/admin/games');
                }

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($field = null, $value = null, $id = null) {
        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!empty($field) AND !empty($value) AND !empty($id)) {
            $this->M_Base->data_update('games', [
                $field => $value,
            ], $id);

            echo "True";
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
