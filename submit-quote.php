<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Load dependencies
require_once 'config.php';
require_once 'Database.php';
require_once 'EmailService.php';

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // 1. Get and decode JSON input
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (!$input) {
        throw new Exception("Invalid JSON data received");
    }

    // 2. Validate Required Fields
    $requiredFields = ['fullName', 'phone', 'email']; // Added email as required
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        throw new Exception("Missing required fields: " . implode(', ', $missingFields));
    }

    // 3. Prepare Data for Database
    $data = [
        'fullName' => filter_var($input['fullName'], FILTER_SANITIZE_STRING),
        'phone' => filter_var($input['phone'], FILTER_SANITIZE_STRING),
        'email' => filter_var($input['email'] ?? '', FILTER_SANITIZE_EMAIL),
        'notes' => filter_var($input['message'] ?? '', FILTER_SANITIZE_STRING), // 'message' from form -> 'notes' in DB
        
        // Optional fields (set to NULL if not present)
        'serviceType' => isset($input['serviceType']) ? filter_var($input['serviceType'], FILTER_SANITIZE_STRING) : null,
        'coverageType' => isset($input['coverageType']) ? filter_var($input['coverageType'], FILTER_SANITIZE_STRING) : null,
        'location' => isset($input['location']) ? filter_var($input['location'], FILTER_SANITIZE_STRING) : null,
        
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT']
    ];

    // 4. Insert into Database
    $db = new Database();
    $quoteId = $db->insertQuoteRequest($data);

    // 5. Send Email Notification
    $emailService = new EmailService();
    $emailSent = false;
    
    try {
        $emailService->sendQuoteNotification($data, $quoteId);
        $emailSent = true;
        
        // Log successful email
        $db->logEmail($quoteId, ADMIN_EMAIL, "New Quote Request #$quoteId", 'sent');
        
    } catch (Exception $e) {
        // Log failed email but don't fail the request
        error_log("Email sending failed: " . $e->getMessage());
        $db->logEmail($quoteId, ADMIN_EMAIL, "New Quote Request #$quoteId", 'failed', $e->getMessage());
    }

    // 6. Return Success Response
    echo json_encode([
        'success' => true,
        'message' => 'Request submitted successfully',
        'quoteId' => $quoteId,
        'emailSent' => $emailSent
    ]);

} catch (Exception $e) {
    http_response_code(400); // Bad Request
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
