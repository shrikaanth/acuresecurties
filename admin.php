<?php
require_once 'config.php';
require_once 'Database.php';

// Simple authentication (you should improve this for production)
session_start();
$adminPassword = 'admin123'; // Change this!

if (!isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === $adminPassword) {
            $_SESSION['admin_logged_in'] = true;
        } else {
            $loginError = 'Invalid password';
        }
    }
    
    if (!isset($_SESSION['admin_logged_in'])) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Login - AccureSecurity</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { 
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .login-box {
                    background: white;
                    padding: 40px;
                    border-radius: 12px;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                    width: 100%;
                    max-width: 400px;
                }
                h1 { color: #667eea; margin-bottom: 30px; text-align: center; }
                input {
                    width: 100%;
                    padding: 12px;
                    border: 2px solid #e5e7eb;
                    border-radius: 8px;
                    font-size: 16px;
                    margin-bottom: 20px;
                }
                button {
                    width: 100%;
                    padding: 14px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    border: none;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: 600;
                    cursor: pointer;
                }
                .error { color: #dc2626; margin-bottom: 15px; text-align: center; }
            </style>
        </head>
        <body>
            <div class="login-box">
                <h1>🛡️ Admin Login</h1>
                <?php if (isset($loginError)): ?>
                    <div class="error"><?php echo $loginError; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <input type="password" name="password" placeholder="Enter admin password" required autofocus>
                    <button type="submit">Login</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Fetch quotes
try {
    $db = new Database();
    $conn = $db->getConnection();
    
    $result = $conn->query("SELECT * FROM quote_requests ORDER BY created_at DESC");
    $quotes = $result->fetch_all(MYSQLI_ASSOC);
    
} catch (Exception $e) {
    $error = "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Requests - AccureSecurity Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 28px; }
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .stat-number { font-size: 32px; font-weight: 700; color: #667eea; }
        .stat-label { color: #666; margin-top: 5px; }
        .quotes-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .quote-card {
            padding: 25px;
            border-bottom: 1px solid #e5e7eb;
        }
        .quote-card:last-child { border-bottom: none; }
        .quote-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }
        .quote-name { font-size: 20px; font-weight: 600; color: #333; }
        .quote-date { color: #666; font-size: 14px; }
        .quote-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .detail-item {
            display: flex;
            align-items: start;
            gap: 10px;
        }
        .detail-label {
            font-weight: 600;
            color: #667eea;
            min-width: 120px;
        }
        .detail-value { color: #333; }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge.commercial { background: #dbeafe; color: #1e40af; }
        .badge.residential { background: #fce7f3; color: #9f1239; }
        .badge.both { background: #f3e8ff; color: #6b21a8; }
        .notes {
            background: #f9fafb;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
            border-left: 4px solid #667eea;
        }
        .no-quotes {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        a { color: #667eea; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🛡️ AccureSecurity - Quote Requests</h1>
        <a href="?logout=1" class="logout-btn">Logout</a>
    </div>

    <?php if (isset($error)): ?>
        <div style="background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-number"><?php echo count($quotes); ?></div>
            <div class="stat-label">Total Quotes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo count(array_filter($quotes, fn($q) => date('Y-m-d', strtotime($q['created_at'])) === date('Y-m-d'))); ?></div>
            <div class="stat-label">Today</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo count(array_filter($quotes, fn($q) => date('Y-W', strtotime($q['created_at'])) === date('Y-W'))); ?></div>
            <div class="stat-label">This Week</div>
        </div>
    </div>

    <div class="quotes-container">
        <?php if (empty($quotes)): ?>
            <div class="no-quotes">
                <h2>No quote requests yet</h2>
                <p style="margin-top: 10px;">Quote submissions will appear here.</p>
            </div>
        <?php else: ?>
            <?php foreach ($quotes as $quote): ?>
                <div class="quote-card">
                    <div class="quote-header">
                        <div>
                            <div class="quote-name"><?php echo htmlspecialchars($quote['full_name']); ?></div>
                            <span class="badge <?php echo $quote['service_type']; ?>">
                                <?php echo ucfirst($quote['service_type']); ?>
                            </span>
                        </div>
                        <div class="quote-date">
                            <?php echo date('M j, Y g:i A', strtotime($quote['created_at'])); ?>
                        </div>
                    </div>
                    
                    <div class="quote-details">
                        <div class="detail-item">
                            <span class="detail-label">📞 Phone:</span>
                            <span class="detail-value">
                                <a href="tel:<?php echo htmlspecialchars($quote['phone']); ?>">
                                    <?php echo htmlspecialchars($quote['phone']); ?>
                                </a>
                            </span>
                        </div>
                        
                        <?php if (!empty($quote['email'])): ?>
                        <div class="detail-item">
                            <span class="detail-label">📧 Email:</span>
                            <span class="detail-value">
                                <a href="mailto:<?php echo htmlspecialchars($quote['email']); ?>">
                                    <?php echo htmlspecialchars($quote['email']); ?>
                                </a>
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="detail-item">
                            <span class="detail-label">🕐 Coverage:</span>
                            <span class="detail-value"><?php echo ucfirst(str_replace('-', ' ', $quote['coverage_type'])); ?></span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">📍 Location:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($quote['location']); ?></span>
                        </div>
                    </div>
                    
                    <?php if (!empty($quote['notes'])): ?>
                    <div class="notes">
                        <strong>📝 Notes:</strong><br>
                        <?php echo nl2br(htmlspecialchars($quote['notes'])); ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
