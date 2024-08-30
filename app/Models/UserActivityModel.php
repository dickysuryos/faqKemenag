<?php
namespace App\Models;
use App\Controllers\UserActivityController;
use CodeIgniter\Model;

class UserActivityModel extends Model {
    protected $table = 'user_activities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'activity', 'created_at'];

    public function getRecentActivity($limit = 5) {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    public function create_activitys($activity) {
        $controller = new UserActivityController();
       $result =  $controller->create_activity($activity);
       return $result;
    }
}