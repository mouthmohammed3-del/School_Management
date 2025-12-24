<?php

header('Content-Type: application/json');
require_once 'config/database.php';

try {
    $sql = "SELECT userID, username, fullname, grade FROM users WHERE role = 'student' ORDER BY fullname";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($students);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>