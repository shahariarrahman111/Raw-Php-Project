<?php
include 'database.php';

// Number of items per page
$perPage = 3;

// Get the current page from the URL or set default to 1
if (isset($_GET['page']) && $_GET['page'] > 0) {

    $page = (int)$_GET['page'];
}else{
    $page = 1;
}

// Start page calculation
$startPage = ($page - 1) * $perPage;

// Search logic
$searchQuery = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = mysqli_escape_string($conn, $_GET['search']);
}

// Construct the SQL query with the search filter
$sql = "SELECT p.id, p.product_name, p.price, p.product_img, p.description, c.name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.product_name LIKE '%" . $searchQuery . "%' 
        OR p.id LIKE '%" . $searchQuery . "%' 
        OR c.name LIKE '%" . $searchQuery . "%'
        LIMIT $startPage, $perPage";

// Query to count total rows in the products table matching the search query
$countQuery = "SELECT COUNT(*) AS total FROM products p 
               LEFT JOIN categories c ON p.category_id = c.id
               WHERE p.product_name LIKE '%" . $searchQuery . "%' 
               OR p.id LIKE '%" . $searchQuery . "%' 
               OR c.name LIKE '%" . $searchQuery . "%'";
$queryResult = $conn->query($countQuery);

if ($queryResult) {
    $rowResult = $queryResult->fetch_assoc();
    $totalData = $rowResult['total'];
} else {
    // Handle query failure
    die("Error counting data: " . $conn->error);
}

// Calculate total number of pages
$totalPage = ceil($totalData / $perPage);

// Execute the search query
$searchResult = mysqli_query($conn, $sql);
$productss = [];

if ($searchResult && mysqli_num_rows($searchResult) > 0) {
    while ($row = mysqli_fetch_assoc($searchResult)) {
        $productss[] = $row;
    }
}

?>