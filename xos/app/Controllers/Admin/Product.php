<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Product extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

        $products = [];
        foreach ($this->M_Base->all_data('product') as $data_loop) {

            $data_games = $this->M_Base->data_where('games', 'id', $data_loop['games_id']);

            if (count($data_games) === 1) {
                $games = [
                    'img' => $data_games[0]['images'],
                    'name' => $data_games[0]['name'],
                ];
            } else {
                $games = [
                    'img' => '-',
                    'name' => '-',
                ];
            }

            $products[] = array_merge($data_loop, $games);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Produk',
            'products' => $products,
    	]);

        return view('Admin/Product/index', $data);
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
                'games_id' => $this->request->getPost('games_id'),
                'price' => $this->request->getPost('price'),
                'profit' => $this->request->getPost('profit'),
                'product' => $this->request->getPost('product'),
                'provider' => $this->request->getPost('provider'),
                'sku' => $this->request->getPost('sku'),
            ];

            if (empty($data_post['games_id']) OR empty($data_post['price']) OR empty($data_post['product']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $c_price = $this->request->getPost('c_price');

                $this->M_Base->data_insert('product', $data_post);

                $data_product = $this->M_Base->data_where_array('product', $data_post);

                if (count($c_price) !== 0) {
                    for ($i = 0; $i < count($c_price); $i++) { 

                        $costum = [
                            'price' => $this->request->getPost('c_price')[$i],
                            'method' => $this->request->getPost('c_method_id')[$i],
                        ];

                        if (!empty($costum['price']) AND !empty($costum['method'])) {
                            $this->M_Base->data_insert('price', [
                                'method_id' => $costum['method'],
                                'product_id' => $data_product[0]['id'],
                                'price' => $costum['price'],
                            ]);
                        }
                    }
                }

                $this->session->setFlashdata('success', 'Produk baru berhasil ditambahkan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }
        
 

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Produk',
            'gamess' => $this->M_Base->all_data('games'),
            'methods' => $this->M_Base->all_data('method'),
            'providers' => $this->M_Base->all_data('provider'),
        ]);

        return view('Admin/Product/add', $data);
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
                $data_delete = $this->M_Base->data_where('product', 'id', $id);

                if (count($data_delete) === 1) {
                    $this->M_Base->data_delete('product', $id);

                    $this->session->setFlashdata('success', 'Data berhasil dihapus');
                    return redirect()->to(base_url() . '/admin/product');
                } else {
                    $this->session->setFlashdata('error', 'Data tidak digumakan');
                    return redirect()->to(base_url() . '/admin/product');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
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
                $data_detail = $this->M_Base->data_where('product', 'id', $id);

                if (count($data_detail) === 1) {

                    if ($this->request->getPost('tombol')) {
                        $data_post = [
                            'games_id' => $this->request->getPost('games_id'),
                            'price' => $this->request->getPost('price'),
                            'profit' => $this->request->getPost('profit'),
                            'product' => $this->request->getPost('product'),
                            'provider' => $this->request->getPost('provider'),
                            'sku' => $this->request->getPost('sku'),
                        ];

                        if (empty($data_post['games_id']) OR empty($data_post['price']) OR empty($data_post['product']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                            $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {

                            $custom_price_before = $this->M_Base->data_where('price', 'product_id', $id);

                            if (count($custom_price_before) !== 0) {
                                foreach ($custom_price_before as $custom_price_loop) {
                                    $this->M_Base->data_delete('price', $custom_price_loop['id']);
                                }
                            }

                            $c_price = $this->request->getPost('c_price');

                            $this->M_Base->data_update('product', $data_post, $id);

                            $data_product = $this->M_Base->data_where_array('product', $data_post);

                            if (count($c_price) !== 0) {
                                for ($i = 0; $i < count($c_price); $i++) { 

                                    $costum = [
                                        'price' => $this->request->getPost('c_price')[$i],
                                        'method' => $this->request->getPost('c_method_id')[$i],
                                    ];

                                    if (!empty($costum['price']) AND !empty($costum['method'])) {
                                        $this->M_Base->data_insert('price', [
                                            'method_id' => $costum['method'],
                                            'product_id' => $id,
                                            'price' => $costum['price'],
                                        ]);
                                    }
                                }
                            }

                            $this->session->setFlashdata('success', 'Produk baru berhasil simpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }

                    $check_custom_price = $this->M_Base->data_where('price', 'product_id', $id);

                    $methods = [];
                    foreach ($this->M_Base->all_data('method') as $data_loop) {

                        $custom_price = $this->M_Base->data_where_array('price', [
                            'product_id' => $id,
                            'method_id' => $data_loop['id'],
                        ]);

                        if (count($custom_price) === 1) {
                            $price = $custom_price[0]['price'];
                        } else {
                            $price = 0;
                        }

                        $methods[] = array_merge($data_loop, [
                            'price' => $price,
                        ]);
                    }

                    $data = array_merge($this->base_data, [
                        'title' => 'Detail Produk',
                        'product' => $data_detail[0],
                        'methods' => $methods,
                        'gamess' => $this->M_Base->all_data('games'),
                        'providers' => $this->M_Base->all_data('provider'),
                        'custom_price' => count($check_custom_price),
                    ]);

                    return view('Admin/Product/edit', $data);
                } else {
                    $this->session->setFlashdata('error', 'Data tidak digumakan');
                    return redirect()->to(base_url() . '/admin/product');
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
                $data_detail = $this->M_Base->data_where('product', 'id', $id);

                if (count($data_detail) === 1) {

                    $data_games = $this->M_Base->data_where('games', 'id', $data_detail[0]['games_id']);

                    if (count($data_games) === 1) {
                        $games = [
                            'name' => $data_games[0]['name'],
                            'images' => $data_games[0]['images'],
                        ];
                    } else {
                        $games = [
                            'name' => '-',
                            'images' => '-',
                        ];
                    }

                    $methods = [];
                    foreach ($this->M_Base->all_data('method') as $data_loop) {

                        $custom_price = $this->M_Base->data_where_array('price', [
                            'product_id' => $id,
                            'method_id' => $data_loop['id'],
                        ]);

                        if (count($custom_price) === 1) {
                            $price = $custom_price[0]['price'];
                        } else {
                            $price = 0;
                        }

                        $methods[] = array_merge($data_loop, [
                            'price' => $price,
                        ]);
                    }

                    $data = array_merge($this->base_data, [
                        'title' => 'Detail Produk',
                        'product' => $data_detail[0],
                        'methods' => $methods,
                        'games' => $games,
                    ]);

                    return view('Admin/Product/detail', $data);
                } else {
                    $this->session->setFlashdata('error', 'Data tidak digumakan');
                    return redirect()->to(base_url() . '/admin/product');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // Kategori
    public function category($action = null, $id = null, $field = null, $value = null) {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($action) {
            if ($action === 'delete') {
                if ($id) {
                    if (is_numeric($id)) {
                        $data_delete = $this->M_Base->data_where('category', 'id', $id);

                        if (count($data_delete) === 1) {
                            $this->M_Base->data_delete('category', $id);

                            $this->session->setFlashdata('success', 'Data berhasil dihapus');
                            return redirect()->to(base_url() . '/admin/product/category');
                        } else {
                            $this->session->setFlashdata('error', 'Data tidak ditemukan');
                            return redirect()->to(base_url() . '/admin/product/category');
                        }
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else if ($action === 'edit') {
                if ($id) {
                    if (is_numeric($id)) {
                        $data_edit = $this->M_Base->data_where('category', 'id', $id);

                        if (count($data_edit) === 1) {
                            if ($this->request->getPost('tombol')) {
                                $data_post = [
                                    'category' => $this->request->getPost('category'),
                                    'sort' => $this->request->getPost('sort'),
                                ];

                                if (empty($data_post['category']) OR empty($data_post['sort'])) {
                                    $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                } else {
                                    $this->M_Base->data_update('category', $data_post, $id);

                                    $this->session->setFlashdata('success', 'Kategori berhasil disimpan');
                                    return redirect()->to(base_url() . '/admin/product/category');
                                }
                            }

                            $data = array_merge($this->base_data, [
                                'title' => 'Edit Kategori',
                                'category' => $data_edit[0],
                            ]);

                            return view('Admin/Product/Category/edit', $data);
                        } else {
                            $this->session->setFlashdata('error', 'Data tidak ditemukan');
                            return redirect()->to(base_url() . '/admin/product/category');
                        }
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else if ($action === 'add') {
                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'category' => $this->request->getPost('category'),
                        'sort' => $this->request->getPost('sort'),
                    ];

                    if (empty($data_post['category']) OR empty($data_post['sort'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_insert('category', $data_post);

                        $this->session->setFlashdata('success', 'Kategori berhasil ditambahkan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Tambah Kategori',
                ]);

                return view('Admin/Product/Category/add', $data);
            } else if ($action === 'update') {
                if (!empty($field) AND !empty($value) AND !empty($id)) {
                    $this->M_Base->data_update('category', [
                        $field => $value,
                    ], $id);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {

            $categorys = [];
            foreach ($this->M_Base->all_data('category') as $data_loop) {
                $categorys[] = array_merge($data_loop, [
                    'total' => count($this->M_Base->data_where('games', 'category', $data_loop['id'])),
                ]);
            }

            $data = array_merge($this->base_data, [
                'title' => 'Kelola Kategori',
                'categorys' => $categorys,
            ]);

            return view('Admin/Product/Category/index', $data);
        }
    }
}