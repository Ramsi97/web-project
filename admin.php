<?php

$dsn = "mysql:host=localhost;dbname=contact_form_db";
$dbusername = "root";
$dbpwd = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("
    SELECT name, email, message, MAX(submitted_at) AS last_sent
    FROM submissions 
    GROUP BY email 
    ORDER BY last_sent DESC
;");

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inbox</title>
    <link rel="stylesheet" href="./styleadmin.css">
</head>
<body>
    <div class = "home">
        <div class = "left">
            <div class="inbox">
                <h2 style="padding: 20px; border-bottom: 1px solid #ccc;">📥 Inbox</h2>

                <?php foreach ($messages as $msg): ?>
                    
                    <div class="email-card" data-email="<?= urlencode($msg['email']) ?>">
                        <div class="profile">
                            <div class="avatar">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($msg['name']) ?>&background=0D8ABC&color=fff" alt="avatar">
                            </div>
                            <div class="sender-info">
                                <div class="sender-name"><?= htmlspecialchars($msg['name']) ?></div>
                                <div class="sender-email"><?= htmlspecialchars($msg['email']) ?></div>
                            </div>
                        </div>
                        <div class="message-content">
                            <!-- <div class="message-preview"><?= htmlspecialchars(substr($msg['message'], 0, 60)) ?>...</div> -->
                            <div class="message-time"><?= date("M d, H:i", strtotime($msg['last_sent'])) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="right" >
                        
        </div>
    </div>
<script src="./admin.js"></script>
</body>
</html>
