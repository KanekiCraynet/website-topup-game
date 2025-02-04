<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderModel extends Model
{
    protected $table = 'PROVIDER';
    protected $primaryKey = 'id';
    protected $allowedFields = ['provider', 'saldo', 'api_id', 'api_key', 'status'];

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'provider' => 'required',
        'saldo' => 'required|numeric',
        'api_id' => 'required',
        'api_key' => 'required',
        'status' => 'required|in_list[ON,OFF]'
    ];

    protected $validationMessages = [
        'status' => [
            'in_list' => 'Status must be either ON or OFF.'
        ]
    ];
}