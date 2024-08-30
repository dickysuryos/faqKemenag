<?php

namespace App\Controllers;
use App\Models\UserActivityModel;

class UserActivityController extends BaseController {

    public function index() {
        $activityModel = new UserActivityModel();
        
        // Fetch the most recent 5 activities
        $data['activities'] = $activityModel->getRecentActivity(5);

        // Load the view and pass the activities data
        return view('admin_view', $data);
    }

    public function create_activity($activity) {
        $session = session();
        if ($session->get('logged_in')) {
        $activityModel = new UserActivityModel();
        $data = [
            'user_id' => $session->get('id'),
            'activity' => $activity,
        ];
        } 
        $activityModel->insert($data);
    }
}