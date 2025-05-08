<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= htmlspecialchars($_SESSION["first_name"]) ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .dashboard {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        .section {
            background-color: #0F3460;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #00FFFF33;
        }
        .section h3 {
            margin-bottom: 10px;
            color: #00FFFF;
        }
        .user-info p,
        .activity-log li {
            margin: 5px 0;
        }
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
        }
        .tool {
            background-color: #1A1A2E;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #00FFFF33;
            transition: background 0.3s;
        }
        .tool:hover {
            background-color: #16213E;
        }
        form.logout {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($_SESSION["first_name"]) ?> 👋</h2>

        <div class="dashboard">

            <div class="section user-info">
                <h3>Your Account Info</h3>
                <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION["first_name"] . " " . $_SESSION["last_name"]) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["email"]) ?></p>
                <p><strong>Member Since:</strong> <?= htmlspecialchars($_SESSION["created_at"]) ?></p>
            </div>

            <div class="section">
                <h3>User Tools</h3>
                <div class="tools-grid">
                    <div class="tool">📄 Profile Settings</div>
                    <div class="tool">📬 Messages</div>
                    <div class="tool">🔒 Security</div>
                    <div class="tool">📈 Analytics</div>
                    <div class="tool">🛠️ Preferences</div>
                </div>
            </div>

            <div class="section">
                <h3>Recent Activity</h3>
                <ul class="activity-log">
                    <li>✅ Logged in successfully</li>
                    <li>📧 Email verified</li>
                    <li>🔐 Password updated</li>
                    <li>🕒 Session started at <?= date("Y-m-d H:i:s") ?></li>
                </ul>
            </div>

        </div>

        <form action="logout.php" method="post" class="logout">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
