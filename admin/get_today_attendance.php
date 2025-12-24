<?php
header('Content-Type: application/json');
require_once 'config/database.php';

try {
    
    $sql = "SELECT user_id, status FROM attendance WHERE date = CURDATE()";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($attendance);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>