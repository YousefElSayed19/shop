<?php 
    include("./connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];

        $uploadDir = '../uploads/'; 
        $fileName = time() . '_' . basename($_FILES['image']['name']); 
        $uploadFile = $uploadDir . $fileName;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

        $sql = "INSERT INTO users (full_name, username, password, email, age, phone, image) VALUES ('$full_name', '$username', '$password', '$email', '$age', '$phone', '$uploadFile')";

        $conn->query($sql);
        header("Location: login.php");

    }
?>
<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <title> Register Page</title>
        <link rel="stylesheet" href="../style/registerStyle.css">
    </head>
    <body>
    <div class="register-container">
        <form action="register.php" method="post" enctype="multipart/form-data" class="register-form" id="myForm">
            <h2>Register</h2>

            <div class="form-fields">
                <div class="left-side">
                    <div class="input-field">
                        <label for="full-name">Full Name</label>
                        <input type="text" name="full_name" id="full-name" placeholder="Full Name" required>
                    </div>

                    <div class="input-field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username" required>
                    </div>

                    <div class="input-field">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <span class="eye-icon" id="password1" onclick="togglePassword('password')">👁️</span>
                    </div>

                    <div class="input-field">   
                        <label for="confirmPassword">Confirm Password</label><br>
                        <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" required>
                        <span class="eye-icon" id="confirmPassword1" onclick="togglePassword('confirmPassword')">👁️</span>
                    </div>
                </div>
                
                <div class="right-side">
                    <div class="input-field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </div>
                    
                    <div class="input-field">
                        <label for="age">Age</label>
                        <input type="number"  name="age" id="age" placeholder="Age" required>
                    </div>

                    <div class="input-field">
                        <label for="img">Profile Image</label>
                        <input type="file" name="image" id="img" accept="image/*" required>
                    </div>
                </div>
            </div>

            <br>
            <button type="submit" class="submit-btn">Register</button>
            <br>
            <br>
            <a href="login.php">U have already Account ?</a>
        </form>
    </div>
    <script src="../script/registetForm.js"></script>
    </body>
</html>