<?php
session_start();
header('Content-Type: application/json');
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (
    !isset($input['action']) ||
    $input['action'] !== 'update_attendance' ||
    !isset($input['user_id'], $input['status'])
) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$user_id = (int)$input['user_id'];
$status  = $input['status'];

try {
    // هل يوجد سجل اليوم؟
    $check = $db->prepare(
        "SELECT id FROM attendance WHERE user_id = ? AND date = CURDATE()"
    );
    $check->execute([$user_id]);

    if ($check->rowCount() > 0) {
        $stmt = $db->prepare(
            "UPDATE attendance SET status=? WHERE user_id=? AND date=CURDATE()"
        );
        $stmt->execute([$status, $user_id]);
    } else {
        $stmt = $db->prepare(
            "INSERT INTO attendance (user_id, status, date) VALUES (?, ?, CURDATE())"
        );
        $stmt->execute([$user_id, $status]);
    }

    echo json_encode(['success' => true]);
    exit;

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'DB error']);
    exit;
}
