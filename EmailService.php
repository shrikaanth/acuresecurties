<?php
require_once 'config.php';
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mailer;
    
    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->configureSMTP();
    }
    
    private function configureSMTP() {
        $this->mailer->isSMTP();
        $this->mailer->Host = SMTP_HOST;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = SMTP_USERNAME;
        $this->mailer->Password = SMTP_PASSWORD;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL for port 465
        $this->mailer->Port = SMTP_PORT;
        $this->mailer->CharSet = 'UTF-8';
        
        // Enable verbose debug output (comment out in production)
        $this->mailer->SMTPDebug = 0; // Set to 2 for detailed debugging
        $this->mailer->Debugoutput = function($str, $level) {
            error_log("SMTP Debug level $level: $str");
        };
        
        // Additional options for better compatibility
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $this->mailer->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    }
    
    public function sendQuoteNotification($quoteData) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress(ADMIN_EMAIL); // Primary recipient
            
            // Add CC recipient if defined
            if (defined('ADMIN_EMAIL_CC') && !empty(ADMIN_EMAIL_CC)) {
                $this->mailer->addCC(ADMIN_EMAIL_CC);
            }
            
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'New Quote Request - AccureSecurity';
            
            $emailBody = $this->buildEmailTemplate($quoteData);
            $this->mailer->Body = $emailBody;
            $this->mailer->AltBody = $this->buildPlainTextEmail($quoteData);
            
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Email sending failed: " . $this->mailer->ErrorInfo);
            throw new Exception("Email could not be sent: " . $this->mailer->ErrorInfo);
        }
    }
    
    private function buildEmailTemplate($data) {
        $email = isset($data['email']) && !empty($data['email']) ? $data['email'] : 'Not provided';
        $notes = isset($data['notes']) && !empty($data['notes']) ? nl2br(htmlspecialchars($data['notes'])) : 'No additional notes';
        
        $serviceTypeLabels = [
            'commercial' => 'Commercial',
            'residential' => 'Residential',
            'both' => 'Both Commercial & Residential'
        ];
        
        $coverageTypeLabels = [
            'day' => 'Day Coverage',
            'night' => 'Night Coverage',
            '24x7' => '24×7 Coverage',
            'mobile-patrol' => 'Mobile Patrol'
        ];
        
        $serviceType = $serviceTypeLabels[$data['serviceType']] ?? $data['serviceType'];
        $coverageType = $coverageTypeLabels[$data['coverageType']] ?? $data['coverageType'];
        
        $html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .field { margin-bottom: 20px; }
        .label { font-weight: bold; color: #667eea; margin-bottom: 5px; }
        .value { background: white; padding: 12px; border-radius: 6px; border: 1px solid #e5e7eb; }
        .footer { background: #1f2937; color: #9ca3af; padding: 20px; text-align: center; border-radius: 0 0 8px 8px; font-size: 12px; }
        .badge { display: inline-block; background: #667eea; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛡️ New Quote Request</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">AccureSecurity - Quote Management</p>
        </div>
        
        <div class="content">
            <p style="font-size: 16px; margin-top: 0;"><strong>You have received a new quote request from your website.</strong></p>
            
            <div class="field">
                <div class="label">👤 Full Name</div>
                <div class="value">' . htmlspecialchars($data['fullName']) . '</div>
            </div>
            
            <div class="field">
                <div class="label">📞 Phone Number</div>
                <div class="value"><a href="tel:' . htmlspecialchars($data['phone']) . '" style="color: #667eea; text-decoration: none;">' . htmlspecialchars($data['phone']) . '</a></div>
            </div>
            
            <div class="field">
                <div class="label">📧 Email</div>
                <div class="value"><a href="mailto:' . htmlspecialchars($email) . '" style="color: #667eea; text-decoration: none;">' . htmlspecialchars($email) . '</a></div>
            </div>';

        // Optional fields
        if (!empty($data['serviceType'])) {
            $html .= '
            <div class="field">
                <div class="label">🏢 Service Type</div>
                <div class="value">' . htmlspecialchars($data['serviceType']) . '</div>
            </div>';
        }

        if (!empty($data['coverageType'])) {
            $html .= '
            <div class="field">
                <div class="label">🕐 Coverage Type</div>
                <div class="value">' . htmlspecialchars($data['coverageType']) . '</div>
            </div>';
        }

        if (!empty($data['location'])) {
            $html .= '
            <div class="field">
                <div class="label">📍 Location</div>
                <div class="value">' . htmlspecialchars($data['location']) . '</div>
            </div>';
        }
        
        $html .= '
            
            <div class="field">
                <div class="label">📝 Additional Notes</div>
                <div class="value">' . $notes . '</div>
            </div>
            
            <div style="margin-top: 30px; padding: 15px; background: #eff6ff; border-left: 4px solid #667eea; border-radius: 4px;">
                <strong>⏰ Submitted:</strong> ' . date('F j, Y \a\t g:i A T') . '<br>
                <strong>🌐 IP Address:</strong> ' . htmlspecialchars($data['ip_address']) . '
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">AccureSecurity - Commercial & Residential Security Services</p>
            <p style="margin: 5px 0 0 0;">Toronto & GTA | +1 (905) 399-9333</p>
        </div>
    </div>
</body>
</html>';
        
        return $html;
    }
    
    private function buildPlainTextEmail($data) {
        $email = isset($data['email']) && !empty($data['email']) ? $data['email'] : 'Not provided';
        $notes = isset($data['notes']) && !empty($data['notes']) ? $data['notes'] : 'No additional notes';
        
        $text = "NEW QUOTE REQUEST - AccureSecurity\n\n";
        $text .= "Full Name: " . $data['fullName'] . "\n";
        $text .= "Phone: " . $data['phone'] . "\n";
        $text .= "Email: " . $email . "\n";
        
        if (!empty($data['serviceType'])) $text .= "Service Type: " . $data['serviceType'] . "\n";
        if (!empty($data['coverageType'])) $text .= "Coverage Type: " . $data['coverageType'] . "\n";
        if (!empty($data['location'])) $text .= "Location: " . $data['location'] . "\n";
        $text .= "Notes: " . $notes . "\n\n";
        $text .= "Submitted: " . date('F j, Y \a\t g:i A T') . "\n";
        $text .= "IP Address: " . $data['ip_address'] . "\n";
        
        return $text;
    }
}
?>
