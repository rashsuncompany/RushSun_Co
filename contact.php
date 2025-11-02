<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Please fill all fields']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }
    
    // Here you can add email sending functionality
    // For now, we'll just save to a file or database
    $contact_data = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'date' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ];
    
    // Save to file (you can modify this to save to database)
    $contacts_file = __DIR__ . '/contacts/' . date('Y-m') . '.json';
    if (!is_dir(__DIR__ . '/contacts')) {
        mkdir(__DIR__ . '/contacts', 0755, true);
    }
    
    $contacts = [];
    if (file_exists($contacts_file)) {
        $contacts = json_decode(file_get_contents($contacts_file), true) ?: [];
    }
    
    $contacts[] = $contact_data;
    file_put_contents($contacts_file, json_encode($contacts, JSON_PRETTY_PRINT));
    
    echo json_encode(['success' => true, 'message' => t('contact_success', 'Message sent successfully!')]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>

