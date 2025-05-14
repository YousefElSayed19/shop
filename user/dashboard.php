<?php 
    include("./connection.php");
    session_start();
    $admin = $_SESSION['admin'];
    $image = $_SESSION['image'];
    $state = isset($_SESSION["state"]) ? $_SESSION["state"] : "";
    $full_name = isset($_SESSION["full_name"]) ? $_SESSION["full_name"] : "";
    $parts = explode(" ", $full_name); 
    $full_name = $parts[0];

    if (isset($_POST['logout'])) {
        $state = false;
        $image = false;
        $admin = false;
        $_SESSION['state']=false;
        $_SESSION['image']=false;
        $_SESSION['admin']=false;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $description = $_POST["description"];
        $original_price = $_POST["original_price"];
        $discounted_price = $_POST["discounted_price"];
        $rating = $_POST["rating"];
        $on_offer = $_POST["on_offer"];
        
        $uploadDir = '../images/products/'; 
        $fileName = time() . '_' . basename($_FILES['image']['name']); 
        $uploadFile = $uploadDir . $fileName;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

        $sql = "INSERT INTO products (name, description, original_price, discounted_price, rating, on_offer, image) VALUES ('$name', '$description', '$original_price', '$discounted_price', '$rating', '$on_offer', '$uploadFile')";

        $conn->query($sql);
        header("Location: ../pages/collection.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Product</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/nav.css">
        <link  rel ="stylesheet" href="../style/user.css">
        <link  rel ="stylesheet" href="../style/table.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    </head>
    <body>
        <nav style="padding: 10px; background: rgb(241, 240, 240);">
            <div class="container" style="align-items: center;">
                <div class="left">
                    <a href="../index.php">
                        <h1 class="logo">PlASHOE</h1>
                    </a>
                    <ul class="links">
                        <li>
                            <a href="../pages/men.php" >MEN</a>
                        </li>
                        <li>
                            <a href="../pages/women.php" >WOMEN</a>
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
                <?php 
                    echo ($state && $admin) 
                        ? "<div class='center username' style='width: max-content; padding: 0 10px; background: rgb(255, 69, 69);'>Hello {$full_name} </div>" 
                        : ($state 
                            ? "<div class='center username' style='width: max-content; padding: 0 10px; background: rgb(69, 255, 69);'>Hello {$full_name} (user)</div>" 
                            : ""
                        ); 
                ?>
                <ul class="right">
                    <li>
                        <a href="../pages/story.php">OUR STORY</a>
                    </li>
                    <li>
                        <a href="../pages/contact.php">CONTACT</a>
                    </li>

                    <li>
                        <?php echo (!$admin) ?  
                            ""
                            :"<a href='' class='active'><i class='fa-solid fa-gear'></i></a>";
                        ?>
                    </li>
                    <li class="log">
                        <form method="POST" class="logout">
                            <?php echo ($state) ? "<button name='logout' style='background: red;color: white;border-radius: 10px;padding: 10px 15px;font-weight: bold;'>out</button>" : ""; ?>
                        </form>
                    </li>
                    <li>
                        <span class="state <?php echo ($state) ? 'isLogin' : 'isLogout'; ?>"></span>
                        <a href="<?php echo ($state) ? '../user/profile.php' : '../user/login.php'; ?>">
                        <?php 
                            if ($image) {
                                echo '<img src="' . $image . '" style="width: 50px;border-radius: 50%;height: 50px;" alt="User Image">';
                            }else{
                                echo '<i class="fa-regular fa-user"></i>';
                            }
                        ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

    <form action="" method="POST" enctype="multipart/form-data" class='add'>
        <h2>Add New Product</h2>

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <div class="price">
            <div class="">
                <label for="original_price">Original Price ($):</label>
                <input type="number" id="original_price" name="original_price" step="0.01" required>
            </div>
            <div class="">
                <label for="discounted_price">Discounted Price ($):</label>
                <input type="number" id="discounted_price" name="discounted_price" step="0.01" required>
            </div>
        </div>
        <div class="select">
            <div class="">
                <label for="rating">Stars (1 to 5):</label>
                <select id="rating" name="rating" required>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <div class="">
                <label for="on_offer">On Offer:</label>
                <select id="on_offer" name="on_offer" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit" >Submit Product</button>
    </form>
    <div class="container">
        <?php 
            include("../user/connection.php");
            include("../user/tableproducts.php");
        ?>
    </div>
</body>
</html>
