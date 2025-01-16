<?php

include 'database.php';

$searchQuery = '';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    // var_dump($_GET);
    // die;
    $searchQuery = mysqli_escape_string($conn, $_GET['search']);
    // var_dump($searchQuery);
    // die;
}

// Corrected SQL query with WHERE clause
$sql = "SELECT p.id, p.product_name, p.price, p.product_img, p.description, c.name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.product_name LIKE '%" . $searchQuery . "%' 
        OR p.id LIKE '%" . $searchQuery . "%' 
        OR c.name LIKE '%" . $searchQuery . "%'";

        // var_dump($sql);
        // die;


$searchResult = mysqli_query($conn, $sql);
// var_dump($searchQuery);
// die;
$productss = [];

if ($searchResult->num_rows > 0) {
    // var_dump($searchResult);
    // die;
    while ($row = mysqli_fetch_assoc($searchResult)) {
        // var_dump($row);
        // die;
        $productss[] = $row;
    }
}

if (empty($productss)) {
    echo "<tr><td colspan='6'>No products found</td></tr>";
}

// var_dump($products);
// die;

?>
