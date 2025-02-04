<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Page extends BaseController {

    public function index() {

    	if ($this->base_data['users'] == false) {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	if ($this->base_data['users']['level'] !== 'Admin') {
    		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    	}

    	$data = array_merge($this->base_data, [
    		'title' => 'Kelola Halaman',
    	]);

        return view('Admin/Page/index', $data);
    }

    public function tutor() {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $this->M_Base->u_update('doc_tutor', $this->request->getPost('tutor'));

            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

        $data = array_merge($this->base_data, [
            'title' => 'Cara Membeli',
            'tutor' => $this->M_Base->u_get('doc_tutor'),
        ]);

        return view('Admin/Page/tutor', $data);
    }

    public function terms() {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $this->M_Base->u_update('doc_terms', $this->request->getPost('terms'));

            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

        $data = array_merge($this->base_data, [
            'title' => 'Syarat & Ketentuan',
            'terms' => $this->M_Base->u_get('doc_terms'),
        ]);

        return view('Admin/Page/terms', $data);
    }

    public function faq($page = null, $id = null) {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($page === null) {

            if ($this->request->getPost('tombol')) {
                $data_post = [
                    'title' => $this->request->getPost('title'),
                    'content' => $this->request->getPost('content'),
                ];

                if (empty($data_post['title']) OR empty($data_post['content'])) {
                    $this->session->setFlashdata('error', 'Data pertanyaan umum masih ada yang kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->M_Base->data_insert('faq', $data_post);

                    $this->session->setFlashdata('success', 'Data pertanyaan umum berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }

            if ($this->request->getPost('edit')) {
                $data_post = [
                    'title' => $this->request->getPost('title'),
                    'content' => $this->request->getPost('content'),
                ];

                if (empty($data_post['title']) OR empty($data_post['content'])) {
                    $this->session->setFlashdata('error', 'Data pertanyaan umum masih ada yang kosong');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->M_Base->data_update('faq', $data_post, $this->request->getPost('id'));

                    $this->session->setFlashdata('success', 'Data pertanyaan umum berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }

            $data = array_merge($this->base_data, [
                'title' => 'Pertanyaan Umum',
                'faqs' => $this->M_Base->all_data('faq'),
            ]);

            return view('Admin/Page/faq', $data);

        } else if ($page === 'delete') {
            if (is_numeric($id)) {
                $faq = $this->M_Base->data_where('faq', 'id', $id);

                if (count($faq) === 1) {
                    $this->M_Base->data_delete('faq', $id);

                    $this->session->setFlashdata('success', 'Data berhasil dihapus');
                    return redirect()->to(base_url() . '/admin/page/faq');
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else if ($page === 'get-data') {
            if (is_numeric($id)) {
                $faq = $this->M_Base->data_where('faq', 'id', $id);

                if (count($faq) === 1) {
                    echo $faq[0]['title'] . '##000###' . $faq[0]['content'];
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

    public function help() {

        if ($this->base_data['users'] == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->base_data['users']['level'] !== 'Admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $this->M_Base->u_update('help_email', $this->request->getPost('email'));
            $this->M_Base->u_update('help_telpon', $this->request->getPost('telpon'));

            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
        }

        $data = array_merge($this->base_data, [
            'title' => 'Bantuan',
            'help' => [
                'email' => $this->M_Base->u_get('help_email'),
                'telpon' => $this->M_Base->u_get('help_telpon'),
            ],
        ]);

        return view('Admin/Page/help', $data);
    }
}