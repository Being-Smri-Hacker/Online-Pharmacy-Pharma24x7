<style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
    .prod-box {
  position: relative;
  top: 0;
  transition: top 0.2s ease-in-out;

}
.prod-box:hover {
  top: -8px;
}


/* Add background color to product box body */
.prod-body {
  background-color: #fff;
  padding: 20px;
}
.prod-box {
  height: 350px;
}

/* Adjust product box image and text styles */
.prod-img {
  width: 100%;
  height: 230px;
  object-fit: cover;
}
.prod-name {
  margin-top: 10px;
  font-size: 13px;
  font-weight: bold; !important
  font-family: 'Montserrat', sans-serif;
}
.prod-price {
  margin-top: 5px;
  font-size: 16px;
  color: #033B4A;
  font-family: 'Montserrat', sans-serif;
}
    </style>
    <?php include 'includes/session.php'; ?>
<?php
    $slug = $_GET['category'];

    $conn = $pdo->open();

    try{
        $stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $cat = $stmt->fetch();
        $catid = $cat['id'];
    }
    catch(PDOException $e){
        echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

      <div class="content-wrapper">
        <div class="container">

          <!-- Main content -->
          <section class="content">
            <div class="row">
                <div class="col-sm-9">
                    <h1 class="page-header"style="font-family: 'Montserrat', sans-serif;
      color: #033B4A; font-size: 2.5rem; margin-top:4rem; font-weight: 600;"><?php echo $cat['name']; ?></h1>
                    <?php

                        $conn = $pdo->open();

                        try{
                            $inc = 3;
                            $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
                            $stmt->execute(['catid' => $catid]);
                            foreach ($stmt as $row) {
                                $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                $inc = ($inc == 3) ? 1 : $inc + 1;
                                if($inc == 1) echo "<div class='row'>";
                                echo "
                                    <div class='col-sm-4'>
                                        <div class='box box-solid prod-box'>
                                            <div class='box-body prod-body'>
                                                <img src='".$image."' width='100%' height='230px' class='prod-img'>
                                                <h5><a href='product.php?product=".$row['slug']."'style='color: #033B4A;font-weight:bold;'>".$row['name']."</a></h5>
                                            </div>
                                            <div class='box-footer'>
                                                <b>&#8377; ".number_format($row['price'], 2)."</b>
                                            </div>
                                        </div>
                                    </div>
                                ";
                                if($inc == 3) echo "</div>";
                            }
                            if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>";
                            if($inc == 2) echo "<div class='col-sm-4'></div></div>";
                        }
                        catch(PDOException $e){
                            echo "There is some problem in connection: " . $e->getMessage();
                        }

                        $pdo->close();

                    ?>
                </div>
                <div class="col-sm-3">
                    <?php include 'includes/sidebar.php'; ?>
                </div>
            </div>
          </section>

        </div>
      </div>

    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
