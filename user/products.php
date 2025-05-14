<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="products">';
    
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="product '. ($row["on_offer"] == "yes" ? 'sale' : '') .'" onclick="getProducts('.$row["id"].')" id="'.$row["id"].'" >
            <div class="img buy" style="height: 350px;">
                <img src="' . $row["image"] . '" alt="' . $row["name"] . '" style="height: 100%;">
            </div>
            <div class="text">
                <p class="product-name">' . $row["name"] . '</p>
                <p class="product-price">';
        
            echo   '$<s>' . $row["original_price"] . '</s>
                    $<span class="discounted-price">' . $row["discounted_price"] . '</span>';
        
        echo '</p>
            <div class="stars">';
        
        $rating = intval($row["rating"]);
        for ($i = 0; $i < 5; $i++) {
            echo ($i < $rating) ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        
        echo '
            </div>
            </div>
        </div> ';
    }
    
    echo '</div>';
} else {
    echo "<p class='no-products'>No products found.</p>";
}
?>
