<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'faqTable';
    protected $primaryKey = 'id';
    protected $allowedFields = ['question', 'answer'];
}