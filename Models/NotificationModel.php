<?php
require_once 'Databases/Database.php';

class NotificationModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createNotification($message, $relatedId = null, $relatedType = null) {
        try {
            $query = "INSERT INTO notifications (message, related_id, related_type) 
                      VALUES (:message, :related_id, :related_type)";
            
            $params = [
                'message' => $message,
                'related_id' => $relatedId,
                'related_type' => $relatedType
            ];
            
            $this->db->query($query, $params);
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            error_log("Error creating notification: " . $e->getMessage());
            return false;
        }
    }

    public function getUnreadNotifications($limit = 10) {
        try {
            $query = "SELECT n.*, p.name as product_name 
                      FROM notifications n 
                      LEFT JOIN products p ON n.related_id = p.id AND n.related_type = 'product'
                      WHERE n.is_read = 0 
                      ORDER BY n.created_at DESC 
                      LIMIT :limit";
            
            $result = $this->db->query($query, ['limit' => $limit]);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log("Error getting unread notifications: " . $e->getMessage());
            return [];
        }
    }

    public function getAllNotifications($limit = 20) {
        try {
            $query = "SELECT n.*, p.name as product_name 
                      FROM notifications n 
                      LEFT JOIN products p ON n.related_id = p.id AND n.related_type = 'product'
                      ORDER BY n.created_at DESC 
                      LIMIT :limit";
            
            $result = $this->db->query($query, ['limit' => $limit]);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log("Error getting all notifications: " . $e->getMessage());
            return [];
        }
    }

    public function markAsRead($id) {
        try {
            $query = "UPDATE notifications SET is_read = 1 WHERE id = :id";
            $this->db->query($query, ['id' => $id]);
            return true;
        } catch (Exception $e) {
            error_log("Error marking notification as read: " . $e->getMessage());
            return false;
        }
    }

    public function markAllAsRead() {
        try {
            $query = "UPDATE notifications SET is_read = 1 WHERE is_read = 0";
            $this->db->query($query, []);
            return true;
        } catch (Exception $e) {
            error_log("Error marking all notifications as read: " . $e->getMessage());
            return false;
        }
    }

    public function getUnreadCount() {
        try {
            $query = "SELECT COUNT(*) as count FROM notifications WHERE is_read = 0";
            $result = $this->db->query($query);
            $data = $result->fetch();
            return $data['count'] ?? 0;
        } catch (Exception $e) {
            error_log("Error getting unread count: " . $e->getMessage());
            return 0;
        }
    }
}

