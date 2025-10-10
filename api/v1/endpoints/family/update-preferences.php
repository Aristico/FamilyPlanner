<?php

$config = require_once __DIR__ . '/../../core/config.php';
require_once __DIR__ . '/../../core/database.php';

header("Content-Type: application/json");

session_start();

if (!isset($_SESSION['family_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized: No family context']);
    exit();
}

$familyId = $_SESSION['family_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid input.']);
    exit();
}

// Define allowed keys to prevent arbitrary writes
$allowedKeys = [
    'num_adults',
    'num_children',
    'preferred_diets',
    'cooking_styles',
    'disliked_ingredients',
    'ai_notes'
];

try {
    $db = Database::getInstance($config)->getConnection();
    $db->beginTransaction();

    $stmt = $db->prepare("
        INSERT INTO family_preferences (family_id, preference_key, preference_value)
        VALUES (:family_id, :preference_key, :preference_value)
        ON DUPLICATE KEY UPDATE preference_value = VALUES(preference_value)
    ");

    foreach ($data as $key => $value) {
        if (in_array($key, $allowedKeys)) {
            // Convert array values to JSON strings for storage
            $dbValue = is_array($value) ? json_encode($value) : $value;
            
            $stmt->execute([
                'family_id' => $familyId,
                'preference_key' => $key,
                'preference_value' => $dbValue
            ]);
        }
    }

    $db->commit();

    http_response_code(200);
    echo json_encode(['message' => 'Preferences updated successfully.']);

} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    http_response_code(500);
    echo json_encode(['message' => 'Failed to update preferences: ' . $e->getMessage()]);
}
