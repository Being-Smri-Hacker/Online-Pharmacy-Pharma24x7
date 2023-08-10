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
  font-weight: bold;
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
                <?php

                    $conn = $pdo->open();

                    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE name LIKE :keyword");
                    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
                    $row = $stmt->fetch();
                    if($row['numrows'] < 1){
                        echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
                    }
                    else{
                        echo '<h1 class="page-header" style="font-family: Montserrat, sans-serif;
                           color: #033B4A; font-size: 2.5rem; margin-top:4rem; font-weight: 600;">Search results for <i>'.$_POST['keyword'].'</i></h1>';
                        try{
                            $inc = 3;
                            $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :keyword");
                            $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);

                            foreach ($stmt as $row) {
                                $highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['name']);
                                $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                $inc = ($inc == 3) ? 1 : $inc + 1;
                                if($inc == 1) echo "<div class='row'>";
                                echo "
                                    <div class='col-sm-4'>
                                        <div class='box box-solid prod-box'>
                                            <div class='box-body prod-body'>
                                                <img src='".$image."' width='100%' height='230px' class='prod-img'>
                                                <h5><a href='product.php?product=".$row['slug']."'style='color: #033B4A;'>".$highlighted."</a></h5>
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
