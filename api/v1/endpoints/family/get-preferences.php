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

try {
    $db = Database::getInstance($config)->getConnection();

    $stmt = $db->prepare("SELECT preference_key, preference_value FROM family_preferences WHERE family_id = :family_id");
    $stmt->execute(['family_id' => $familyId]);
    $preferences = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    // Set default values for any preferences that are not in the database yet
    $defaults = [
        'num_adults' => 2,
        'num_children' => 0,
        'preferred_diets' => '[]', // JSON array
        'cooking_styles' => '[]', // JSON array
        'disliked_ingredients' => '',
        'ai_notes' => ''
    ];

    // Merge fetched preferences with defaults
    $result = array_merge($defaults, $preferences);

    // Decode JSON strings back to arrays for the frontend
    $result['preferred_diets'] = json_decode($result['preferred_diets'], true);
    $result['cooking_styles'] = json_decode($result['cooking_styles'], true);

    http_response_code(200);
    echo json_encode($result);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to fetch preferences: ' . $e->getMessage()]);
}
