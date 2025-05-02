<?php
$email = filter_var($_GET['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$email) die("No email provided.");

try {
    $db = new PDO("mysql:host=localhost;dbname=contact_form_db", "root", "");
    $stmt = $db->prepare("SELECT message, submitted_at FROM messages WHERE email = ? ORDER BY submitted_at DESC");
    $stmt->execute([$email]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($messages)) {
        echo "<p>No messages yet.</p>";
    } else {
        foreach ($messages as $msg) {
            echo "<div class='message'>";
            echo "<p>" . htmlspecialchars($msg['message']) . "</p>";
            echo "<small>" . date('M j, Y H:i', strtotime($msg['submitted_at'])) . "</small>";
            echo "</div>";
        }
    }
} catch (PDOException $e) {
    echo "Error loading messages.";
}
?>