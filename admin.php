<?php
$secretcode = $_GET["srt"];
if($secretcode !== "azbycx1928"){
    http_response_code(403);
    die("Access denied");
}
$dsn = "mysql:host=sql302.infinityfree.com;dbname=if0_38899145_contact_form_db";
$dbusername = "if0_38899145";
$dbpwd = "Ty4iyn6vg2x";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['email'])) {
        $email = urldecode($_GET['email']);
        $stmt = $pdo->prepare("
            SELECT name, email, message, submitted_at 
            FROM submissions 
            WHERE email = :email 
            ORDER BY submitted_at DESC
            LIMIT 1
        ");
        $stmt->execute([':email' => $email]);
        $selectedMessage = $stmt->fetch(PDO::FETCH_ASSOC);
    }

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
    <link rel="stylesheet" href="styleadmin.css">
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
            <?php if (!empty($selectedMessage)): ?>
                <div class="email-detail">
                    <div class="email-header">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($selectedMessage['name']) ?>&background=0D8ABC&color=fff" alt="avatar">
                        </div>
                        <div class="sender-info">
                            <h3><?= htmlspecialchars($selectedMessage['name']) ?></h3>
                            <div class="sender-email"><?= htmlspecialchars($selectedMessage['email']) ?></div>
                            <div class="message-time"><?= date("M d, Y H:i", strtotime($selectedMessage['submitted_at'])) ?></div>
                        </div>
                    </div>
                    <div class="email-body">
                        <p><?= nl2br(htmlspecialchars($selectedMessage['message'])) ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Select an email to view its contents</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<script src="./admin.js"></script>
</body>
</html>
