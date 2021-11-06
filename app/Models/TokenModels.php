<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModels extends Model
{
    protected $table      = 'token';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = "object";
    protected $allowedFields = ['id', 'email', 'token', 'date_created'];
}
