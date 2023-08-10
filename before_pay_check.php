<?php
	include 'includes/session.php';
	$conn = $pdo->open();

  if (isset($_SESSION['user']))
  {
    $stmt = $conn->prepare("SELECT *, cart.id AS cartid,cart.quantity AS qty,products.stock as stk,products.name as name FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user");
    $stmt->execute(['user'=>$user['id']]);
    foreach ($stmt as $row)
		{
			if ($row['qty']>$row['stk'])
			{
				$output="Only $row['stk'] units of $row['name'] available";
				$_SESSION['error']=$output;
			}
		}
  }

	else {
		if(count($_SESSION['cart']) != 0){
			foreach($_SESSION['cart'] as $row){
				$stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id=:id");
				$stmt->execute(['id'=>$row['productid']]);
				$product = $stmt->fetch();
				if ($product['stock']<$row['qty'])
				{
					$output="Only $product['stock'] units of $product['prodname'] available";
					$_SESSION['error']=$output;
				}
			}
		}
	}
