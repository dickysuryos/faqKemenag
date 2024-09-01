<?php
namespace App\Models;
use CodeIgniter\Model;
class MessagingModel extends Model {
    protected $table = 'messaging';
    protected $primaryKey = 'id';

    protected $allowedFields = ['created_by','message','sending_to'];
    
    protected $useTimestamps = true;

    public function getBy() {
        $session = session();
        $data = $this->where('created_by',$session->get('id'))
                    ->orWhere('sending_to',$session->get('id'))->findAll();
        return $data;
    }
}
