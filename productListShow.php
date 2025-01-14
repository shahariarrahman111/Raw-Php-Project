<?php
include 'productList.php';
include 'mainlayout.php';
include 'sideber.php';  
include 'header.php';
?>

<div class="d-flex">
    <div class="list">
        <form action="productList.php" method="GET">
            <input type="search" name="search" id="search" placeholder="Search products..." />
            <button type="submit" class="search_btn">Search</button>
        </form>
        <h1>Product List</h1>
    
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Operation</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $counter = 1;
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['price']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($product['product_img']) . "' alt='" . htmlspecialchars($product['name']) . "' width='50' height='50'></td>";
                    echo "<td>" . htmlspecialchars($product['description']) . "</td>";
                    echo "<td>
                            <a href= 'editProduct/" . $product['id'] . "'><button class= 'edit_btn'>Edit</button></a>
                            <a href= 'productListShow.php?id=" . $product['id'] . "'><button class= 'delete_btn'>Delete</button></a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
