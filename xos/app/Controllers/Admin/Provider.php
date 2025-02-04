<?php

namespace App\Controllers;

use App\Models\ProviderModel;
use CodeIgniter\HTTP\ResponseInterface;

class DataProvider extends BaseController
{
    public function index()
    {
        $model = new ProviderModel();
        $data['providers'] = $model->findAll();
        
        return view('admin/provider/index', $data);
    }
    
    public function create()
    {
        return view('admin/provider/create');
    }
    
    public function store()
    {
        $model = new ProviderModel();
        
        $data = [
            'provider' => $this->request->getPost('provider'),
            'saldo' => $this->request->getPost('saldo'),
            'api_id' => $this->request->getPost('api_id'),
            'api_key' => $this->request->getPost('api_key'),
            'status' => $this->request->getPost('status')
        ];
        
        $model->insert($data);
        
        return redirect()->to('admin/provider');
    }
    
    public function edit($id)
    {
        $model = new ProviderModel();
        $data['provider'] = $model->find($id);
        
        return view('admin/provider/edit', $data);
    }
    
    public function update($id)
    {
        $model = new ProviderModel();
        
        $data = [
            'provider' => $this->request->getPost('provider'),
            'saldo' => $this->request->getPost('saldo'),
            'api_id' => $this->request->getPost('api_id'),
            'api_key' => $this->request->getPost('api_key'),
            'status' => $this->request->getPost('status')
        ];
        
        $model->update($id, $data);
        
        return redirect()->to('admin/provider');
    }
    
    public function delete($id)
    {
        $model = new ProviderModel();
        $model->delete($id);
        
        return redirect()->to('admin/provider');
    }
}