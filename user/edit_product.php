<?php
    include 'connection.php';
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    
    $product = $result->fetch_assoc();


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

        <form action="edit_product.php?id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
            <h2>Edit Product</h2>

            <label>Product Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

            <label>Description:</label>
            <textarea name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>

            <div class="price">
                <div class="">
                    <label>Original Price ($):</label>
                    <input type="number" name="original_price" value="<?= $product['original_price'] ?>" step="0.01" required>
                </div>

                <div class="">
                    <label>Discounted Price ($):</label>
                    <input type="number" name="discounted_price" value="<?= $product['discounted_price'] ?>" step="0.01" required>
                </div>
            </div>

            <div class="select">
                <div class="">
                    <label>Rating (1-5):</label>
                    <select name="rating" required>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $selected = $product['rating'] == $i ? 'selected' : '';
                            echo "<option value='$i' $selected>$i Star</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="">
                    <label>On Offer:</label>
                    <select name="on_offer" required>
                        <option value="yes" <?= $product['on_offer'] == 'yes' ? 'selected' : '' ?>>Yes</option>
                        <option value="no" <?= $product['on_offer'] == 'no' ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            </div>

            <label>Change Image (optional):</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit" name="update">Update Product</button>
        </form>
    </body>
</html>

<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];
    $rating = $_POST['rating'];
    $on_offer = $_POST['on_offer'];

    if (!empty($_FILES['image']['name'])) {
        
        $image_name = time() . "_" . $_FILES['image']['name'];
        $target_path = "../uploads/" . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

        $sql = "UPDATE products SET 
                    name='$name',
                    description='$description',
                    original_price='$original_price',
                    discounted_price='$discounted_price',
                    rating='$rating',
                    on_offer='$on_offer',
                    image='$target_path'
                WHERE id=$id";
    } else {
        $sql = "UPDATE products SET 
                    name='$name',
                    description='$description',
                    original_price='$original_price',
                    discounted_price='$discounted_price',
                    rating='$rating',
                    on_offer='$on_offer'
                WHERE id=$id";
    }

    if ($conn->query($sql)) {
        echo "<script>alert('Product updated successfully'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>
