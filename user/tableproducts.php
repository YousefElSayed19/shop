<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <table class="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Discounted Price</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
                <th>Rating</th>
                <th>On Offer</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = $result->fetch_assoc()) {
        echo '<tr class="'. ($row["on_offer"] == "yes" ? 'sale-row' : '') .'" style="height: 75px;">';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td><img src="' . $row["image"] . '" alt="' . $row["name"] . '" class="product-image" style="height: 50px; width:50px;"  ></td>';
        echo '<td>' . $row["name"] . '</td>';
        echo '<td>' . $row["description"] . '</td>';
        echo '<td><s>$' . $row["original_price"] . '</s></td>';
        echo '<td>$' . $row["discounted_price"] . '</td>';
        
        // Stars
        echo '<td>';
        $rating = intval($row["rating"]);
        for ($i = 0; $i < 5; $i++) {
            echo ($i < $rating) ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        echo '</td>';
        
        echo 
        '<td>
            <a href="edit_product.php?id=' . $row["id"] . '" class="action-btn edit">Edit</a>
            <a href="delete_product.php?id=' . $row["id"] . '" class="action-btn delete" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>
        </td>';
        echo '</tr>';
    }

    echo '
        </tbody>
    </table>';
} else {
    echo "<p class='no-products'>No products found.</p>";
}
?>