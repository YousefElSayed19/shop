<?php
    include("./connection.php");
    session_start();
    $state = $_SESSION['state'];
    $full_name = $_SESSION['full_name'];
    $admin = isset($_SESSION["admin"]) ? $_SESSION["admin"] : "";


    $parts = explode(" ", $full_name); 
    if(count($parts) > 2){
        $full_name = $parts[0] . '.' . strtoupper((strtolower($parts[1]) == 'el' && isset($parts[2])) ? $parts[2][0] : $parts[1][0]);
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if (isset($_POST['logout'])) {
        $_SESSION['state']=false;
        $_SESSION['image']=false;
        header("Location: ../index.php");
    }

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link  rel ="stylesheet" href="../style/style.css">
    <link  rel ="stylesheet" href="../style/user.css">
    <link  rel ="stylesheet" href="../style/profileStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <header>
        <nav>
            <div class="container">
                <div class="left">
                    <a href="../index.php" class="active">
                        <h1 class="logo">PlASHOE</h1>
                    </a>
                    <ul class="links">
                        <li>
                            <a href="../pages/men.php">MEN</a>
                        </li>
                        <li>
                            <a href="../pages/women.php">WOMEN</a>
                        </li>
                        <li>
                            <a href="../pages/collection.php">COLLECTION</a>
                        </li>
                        <li>
                            <a href="../pages/lookbook.php">LOOKBOOK</a>
                        </li>
                        <li>
                            <a href="../pages/sale.php">SALE</a>
                        </li>
                    </ul>
                </div>
                <?php echo ($state) ? "<div class='center username' style='width: max; padding:0 10px'>Hello $full_name</div>" : ""; ?>
                <ul class="right">
                    <li>
                        <a href="../pages/story.php">OUR STORY</a>
                    </li>
                    <li>
                        <a href="../pages/contact.php">CONTACT</a>
                    </li>
                    <li class="cartIcon">
                        <div class='icon'><span class='numberOfProduct'>5</span><i class='fa-solid fa-bag-shopping'></i></div>
                    </li>
                    <li>
                        <?php echo (!$admin) ?  
                            ""
                            :"<a href='dashboard.php'><i class='fa-solid fa-gear'></i></a>";
                        ?>
                    </li>
                    <li class="log">
                        <form method="POST" class="logout">
                            <?php echo ($state) ? "<button name='logout' style='background: red;color: white;border-radius: 10px;padding: 10px 15px;font-weight: bold;'>out</button>" : ""; ?>
                        </form>
                    </li>
                    <li>
                        <span class="state <?php echo ($state) ? 'isLogin' : 'isLogout'; ?>"></span>
                    </li>
                    <?php 
                        echo ($user['image']) ? "<img src='".$user['image']."' style='width: 50px; border-radius: 50%; height: 50px;'>" : '';
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <div class="back">
        <div class="card">
            <img class="profile-pic" src="<?php echo $user['image']; ?>" alt="">
            <h2>Hello , <?php echo $user['full_name']; ?></h2>
            <p><span class="label">User Name:</span> <?php echo $user['username']; ?></p>
            <p><span class="label">Password:</span> <?php echo $user['password']; ?> </p>
            <p><span class="label">Email:</span> <?php echo $user['email']; ?></p>
            <p><span class="label">Age:</span> <?php echo $user['age']; ?></p>
        </div>
    </div>
    <script src="../script/item.js"></script>
</body>
</html>
