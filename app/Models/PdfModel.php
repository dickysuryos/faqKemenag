<?php
namespace App\Models;

use CodeIgniter\Model;

class PdfModel extends Model
{
    protected $table = 'pdf_files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file_name', 'file_path','created_by','category','title','description'];
}