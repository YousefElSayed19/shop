<?php
    session_start();
    include("./connection.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($_SERVER["CONTENT_TYPE"], "application/xml") !== false) {
        header("Content-Type: application/xml");

        $xml = file_get_contents("php://input");
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $username = $dom->getElementsByTagName("username")[0]->nodeValue;
        $password = $dom->getElementsByTagName("password")[0]->nodeValue;

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['state'] = true;
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['image'] = $user['image'];

                if ($user['role'] == "admin") {
                    $_SESSION['admin'] = true;
                }

                echo "<response><status>success</status><message>تم تسجيل الدخول بنجاح ✅</message></response>";
            } else {
                echo "<response><status>fail</status><message>كلمة المرور غير صحيحة ❌</message></response>";
            }
        } else {
            echo "<response><status>fail</status><message>اسم المستخدم غير موجود ❌</message></response>";
        }
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="../style/loginStyle.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm">
        <label for="username">User Name</label>
        <input type="text" id="username" placeholder="Username" required>
        <br>
        <div class="input-field">   
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" required>
            <span class="eye-icon" onclick="togglePassword('password')">👁️</span>
        </div>
        <br>
        <button type="submit">Login</button>
        </form>
        <br>
        <a href="register.php">U dont have account !</a>
        <div id="result"></div>
    </div>

    <script src="../script/ajax.js" ></script>
</body>
</html>
