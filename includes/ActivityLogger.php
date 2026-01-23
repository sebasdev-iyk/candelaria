<?php
/**
 * Activity Logger Utility
 * Logs user actions to database
 */
require_once __DIR__ . '/../src/Config/Database.php';

use Config\Database;

class ActivityLogger {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect('mipuno_candelaria');
    }

    /**
     * Log user activity
     * @param int $userId User ID
     * @param string $action Action type (login, logout, profile_update, etc.)
     * @param string $description Optional description
     * @param array $metadata Optional additional data
     */
    public function log($userId, $action, $description = null, $metadata = null) {
        try {
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
            $metadataJson = $metadata ? json_encode($metadata) : null;

            $stmt = $this->db->prepare("
                INSERT INTO user_activity (user_id, action, description, ip_address, user_agent, metadata)
                VALUES (:user_id, :action, :description, :ip_address, :user_agent, :metadata)
            ");

            $stmt->execute([
                ':user_id' => $userId,
                ':action' => $action,
                ':description' => $description,
                ':ip_address' => $ipAddress,
                ':user_agent' => $userAgent,
                ':metadata' => $metadataJson
            ]);

            return true;
        } catch (Exception $e) {
            error_log("Activity Log Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get user activity history
     * @param int $userId User ID
     * @param int $limit Number of records to return
     * @return array Activity records
     */
    public function getActivity($userId, $limit = 50) {
        try {
            $stmt = $this->db->prepare("
                SELECT action, description, ip_address, created_at
                FROM user_activity
                WHERE user_id = :user_id
                ORDER BY created_at DESC
                LIMIT :limit
            ");

            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Get Activity Error: " . $e->getMessage());
            return [];
        }
    }
}
?>
