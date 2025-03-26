<?php
require_once 'Models/NotificationModel.php';
require_once 'BaseController.php';

class NotificationController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new NotificationModel();
    }

    public function getNotifications() {
        // This method will be called via AJAX to get notifications
        header('Content-Type: application/json');
        
        $notifications = $this->model->getAllNotifications();
        $unreadCount = $this->model->getUnreadCount();
        
        echo json_encode([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }

    public function markAsRead() {
        // This method will be called via AJAX to mark a notification as read
        header('Content-Type: application/json');
        
        if (!isset($_POST['id'])) {
            echo json_encode(['success' => false, 'message' => 'Notification ID is required']);
            return;
        }
        
        $id = $_POST['id'];
        $success = $this->model->markAsRead($id);
        
        echo json_encode(['success' => $success]);
    }

    public function markAllAsRead() {
        // This method will be called via AJAX to mark all notifications as read
        header('Content-Type: application/json');
        
        $success = $this->model->markAllAsRead();
        
        echo json_encode(['success' => $success]);
    }
}

