<?php
require_once 'Models/NotificationModel.php';
require_once 'BaseController.php';

class NotificationController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new NotificationModel();
    }

    /**
     * Get all notifications and unread count
     * Used by AJAX to populate the notification panel
     */
    public function getNotifications() {
        // Set response type to JSON
        header('Content-Type: application/json');
        
        // Get notifications and unread count
        $notifications = $this->model->getAllNotifications();
        $unreadCount = $this->model->getUnreadCount();
        
        // Format timestamps for display
        foreach ($notifications as &$notification) {
            $notification['time_ago'] = $this->getTimeAgo($notification['created_at']);
        }
        
        // Return JSON response
        echo json_encode([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }

    /**
     * Mark a notification as read
     * Used by AJAX when a user clicks on a notification
     */
    public function markAsRead() {
        // Set response type to JSON
        header('Content-Type: application/json');
        
        // Check if ID is provided
        if (!isset($_POST['id'])) {
            echo json_encode(['success' => false, 'message' => 'Notification ID is required']);
            return;
        }
        
        // Mark notification as read
        $id = $_POST['id'];
        $success = $this->model->markAsRead($id);
        
        // Return JSON response
        echo json_encode(['success' => $success]);
    }

    /**
     * Mark all notifications as read
     * Used by AJAX when a user clicks "Mark all as read"
     */
    public function markAllAsRead() {
        // Set response type to JSON
        header('Content-Type: application/json');
        
        // Mark all notifications as read
        $success = $this->model->markAllAsRead();
        
        // Return JSON response
        echo json_encode(['success' => $success]);
    }
    
    /**
     * Helper function to format time ago
     * 
     * @param string $datetime MySQL datetime string
     * @return string Formatted time ago string (e.g., "2 hours ago")
     */
    private function getTimeAgo($datetime) {
        $time = strtotime($datetime);
        $now = time();
        $diff = $now - $time;
        
        if ($diff < 60) {
            return 'just now';
        } elseif ($diff < 3600) {
            $mins = floor($diff / 60);
            return $mins == 1 ? '1 minute ago' : $mins . ' minutes ago';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours == 1 ? '1 hour ago' : $hours . ' hours ago';
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return $days == 1 ? '1 day ago' : $days . ' days ago';
        } elseif ($diff < 2592000) {
            $weeks = floor($diff / 604800);
            return $weeks == 1 ? '1 week ago' : $weeks . ' weeks ago';
        } elseif ($diff < 31536000) {
            $months = floor($diff / 2592000);
            return $months == 1 ? '1 month ago' : $months . ' months ago';
        } else {
            $years = floor($diff / 31536000);
            return $years == 1 ? '1 year ago' : $years . ' years ago';
        }
    }
}