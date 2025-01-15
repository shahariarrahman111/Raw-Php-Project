<?php

include 'database.php';

$searchQuery = '';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
}

// Corrected SQL query with WHERE clause
$sql = "SELECT p.id, p.product_name, p.price, p.product_img, p.description, c.name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.product_name LIKE '%" . $searchQuery . "%' 
        OR p.id LIKE '%" . $searchQuery . "%' 
        OR c.name LIKE '%" . $searchQuery . "%'";


$searchResult = mysqli_query($conn, $sql);
$products = [];

if ($searchResult->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($searchResult)) {
        $products[] = $row;
    }
}

if (empty($products)) {
    echo "<tr><td colspan='6'>No products found</td></tr>";
}

?>
