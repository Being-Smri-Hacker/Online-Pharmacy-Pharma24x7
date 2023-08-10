<?php

  $conn = $pdo->open();
  try{
    $stmt = $conn->prepare("SELECT * FROM category");
    $stmt->execute();
    foreach($stmt as $row){
      echo "
        <li><a href='category.php?category=".$row['cat_slug']."'>".$row['name']."</a></li>
      ";
    }
  }
  catch(PDOException $e){
    echo "There is some problem in connection: " . $e->getMessage();
  }

  $pdo->close();

  ?>
