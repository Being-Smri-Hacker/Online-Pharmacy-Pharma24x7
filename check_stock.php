<?php
// Assuming you have a function to check stock status based on the product ID

$productId = $_POST['productId'];

// Function to check stock status based on $productId
$isOutOfStock = checkStockStatus($productId);

if ($isOutOfStock) {
  echo 'out_of_stock';
} else {
  // Perform additional stock validation to ensure adding the item won't empty the stock
  $quantityInCart = getQuantityInCart($productId);  // Assuming you have a function to get the quantity of the product already in the cart

  $availableStock = getAvailableStock($productId);  // Assuming you have a function to get the available stock for the product

  if ($quantityInCart >= $availableStock) {
    echo 'out_of_stock';  // Indicate that adding the item would empty the stock
  } else {
    echo 'stock_available';  // Indicate that the item can be added to the cart
  }
}
?>

<?php
// Function to get the quantity of the product already in the cart
function getQuantityInCart($productId) {
    // Perform a query to retrieve the quantity from the cart for the specific product
    $query = "SELECT SUM(quantity) AS total_quantity FROM cart WHERE product_id = :productId";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':productId', $productId);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result['total_quantity'] ?? 0;
}

function checkStockStatus($productId) {
  $stock = getAvailableStock($productId);

  if ($stock <= 0) {
    return true; // Out of stock
  } else {
    return false; // In stock
  }
}


function getAvailableStock($productId) {
  // Perform a query to retrieve the available stock for the product
  // Implement your own logic to fetch the available stock from the database

  // Example: Assuming you have a 'products' table with 'stock' column
  $query = "SELECT stock FROM products WHERE product_id = :productId";
  $statement = $pdo->prepare($query);
  $statement->bindValue(':productId', $productId);
  $statement->execute();

  // Fetch the stock value
  $stock = $statement->fetchColumn();

  return $stock;
}
?>
