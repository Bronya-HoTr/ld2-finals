<?php

session_start();


$email = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['em-auth']);
    $password = trim($_POST['pass-auth']);

    if(empty($email) || empty($password)){
        $error = "Email and/or Password is required.";
    } else{
        include "tools/db.php";
        $dbConnection = getDBConnection();
     
        $statement = $dbConnection->prepare(
            "SELECT id, first_name, last_name, password, createdAt FROM users WHERE email = ?"
        );

        $statement->bind_param('s',$email);
        $statement->execute();

        $statement->bind_result($id, $first_name, $last_name, $stored_password, $createdAt);
        
        if($statement->fetch()){
            if(password_verify($password,$stored_password)){
                $_SESSION["id"] = $id;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["email"] = $email;
                $_SESSION["createdAt"] = $createdAt;
                
                header("location: ./menu.php");
                exit;
            } else {
                $error = "Email or Password Invalid";
            }
        } else {
            $error = "Email or Password Invalid";
        }
        
        $statement->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="email" name="em-auth" value="<?= htmlspecialchars($email) ?>" placeholder="Email Address">
            <input type="password" name="pass-auth" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <p style="margin-top: 20px;">Don't have an account? <a href="index.php" style="color: #00FFFF;">Register here</a>.</p>
    </div>
</body>
</html>
