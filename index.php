
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

    <?php include 'includes/searchbar.php';?>

		<?php
		if (isset($_SESSION['user']))
		{
			$uid=$user['id'];
			$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM subs_user WHERE user_id =:user_id");
			$stmt->execute(['user_id'=>$uid]);
    	$result = $stmt->fetch();
			if ($result['numrows'] > 0) {
        // User is subscribed
        include 'includes/updates.php';
    }
		}
		?>

      <div class="content-wrapper">
        <div class="container">

          <!-- Main content -->
          <section class="content">
            <div class="row" slide-in>

                <div class="col-sm-8">
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "
                                <div class='alert alert-danger'>
                                    ".$_SESSION['error']."
                                </div>
                            ";
                            unset($_SESSION['error']);
                        }
                    ?>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="images/banneropen.jpeg" class="d-block w-100" style="width:100%;height:240px;"alt="First slide">
                          </div>
                          <div class="item">
                            <img src="images/bannermiddle.jpeg" class="d-block w-100" style="width:100%;height:240px;" alt="Second slide">
                          </div>
                          <div class="item">
                            <img src="images/bannerend1.jpeg"  class="d-block w-100" style="width:100%;height:240px;" alt="Third slide">
                          </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                          <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                          <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                </div>
<div class="col-md-4">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title" style="color:#033B4A; font-size: 17px; font-family:'Montserrat', sans-serif; font-weight: bold;"><b>Most Viewed Today</b></h3>
        </div>
        <div class="box-body" style="height: 200px; overflow-y: auto;">
            <ul id="trending">
            <?php
                $now = date('Y-m-d');
                $conn = $pdo->open();

                $stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
                $stmt->execute(['now'=>$now]);
                foreach($stmt as $row){
                    echo "<li><a href='product.php?product=".$row['slug']."'style='color:#033B4A;opacity:0.7' onmouseover='this.style.opacity=1' onmouseout='this.style.opacity=0.8'>".$row['name']."</a></li>";
                }

                $pdo->close();
            ?>
            <ul>
        </div>
    </div>
</div>
            </div>
                    <div class="row slide-in">
                        <div class="col-md-12">
                    <h1 style="color:#033B4A; font-size: 25px; font-family:'Montserrat', sans-serif; font-weight: bold;" class="slide-in">HOT SELLERS </h1>
                    <?php
    $month = date('m');
    $conn = $pdo->open();

    try{
        $inc = 4;
        $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 8");
        $stmt->execute();
        foreach ($stmt as $row) {
            $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
            $inc = ($inc == 4) ? 1 : $inc + 1;
            if($inc == 1) echo "<div class='row'>";
            echo "
                <div class='col-sm-3'>
                    <div class='box box-solid prod-box' >
                        <div class='box-body prod-body' >
                            <img src='".$image."' class='prod-img'>
                            <h5 class='prod-name' ><a href='product.php?product=".$row['slug']."' style='color: #033B4A';>".$row['name']."</a></h5>
                            <div class='prod-price'>&#8377; ".number_format($row['price'], 2)."</div>
                        </div>
                    </div>
                </div>
            ";
            if($inc == 4) echo "</div>";
        }
        if($inc == 1) echo "<div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div></div>";
        if($inc == 2) echo "<div class='col-sm-3'></div><div class='col-sm-3'></div></div>";
        if($inc == 3) echo "<div class='col-sm-3'></div></div>";
    }
    catch(PDOException $e){
        echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();
?>
                </div>
            </div>
            <div class="row slide-in">
                        <div class="col-md-12">
                    <h1 style="color:#033B4A; font-size: 25px; font-family:'Montserrat', sans-serif; font-weight: bold;">100RS Store </h1>
                    <?php
    $month = date('m');
    $conn = $pdo->open();

    try{
        $inc = 4;
        $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 8");
        $stmt->execute();
        foreach ($stmt as $row) {
            $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
            $inc = ($inc == 4) ? 1 : $inc + 1;
            if($inc == 1) echo "<div class='row'>";
            echo "
                <div class='col-sm-3'>
                    <div class='box box-solid prod-box' >
                        <div class='box-body prod-body'>
                            <img src='".$image."' class='prod-img'>
                            <h5 class='prod-name' ><a href='product.php?product=".$row['slug']."' style='color: #033B4A';>".$row['name']."</a></h5>
                            <div class='prod-price'>&#8377; ".number_format($row['price'], 2)."</div>
                        </div>
                    </div>
                </div>
            ";
            if($inc == 4) echo "</div>";
        }
        if($inc == 1) echo "<div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div></div>";
        if($inc == 2) echo "<div class='col-sm-3'></div><div class='col-sm-3'></div></div>";
        if($inc == 3) echo "<div class='col-sm-3'></div></div>";
    }
    catch(PDOException $e){
        echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();
?>
                </div>
            </div>
<section id="aboutus">
            <div class="responsive-container-block bigContainer" style="margin-bottom:5rem;">
  <div class="responsive-container-block Container">
    <div class="responsive-container-block textSide">
      <p class="text-blk heading">
        About Us
      </p>
      <p class="text-blk subHeading slide-in">
     Pharma 24/7 is your go-to online pharmacy store for all your medicine needs. We also have a range of products in the personal care, baby care, health and nutrition, wellness, and lifestyle categories. Come explore ‘everything under the sun’ related to healthcare at Pharma 24/7.
      Because ordering medicines online need not be complicated but rather a cakewalk. And at Pharma 24/7 we ensure that. All you need to do is:

Browse through our wide variety of products
Add products to your cart and complete the payment. Voila!
Your order will be on its way to you.   </p>
<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/3209/3209134.png" class="fa fa-prescription-bottle-alt" alt="Pharmacy Icon">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
Largest Online Pharmacy In India
		</p>
		<p class="text-blk cardSubHeading">
		Our pharmacy chain has been operational and been providing quality healthcare products for more than 32 years. Our wide range of products ensures that everything you need related to healthcare.      </div>
</div>
<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/5637/5637217.png">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
Fastest Home Delivery Of Your Order
		</p>
		<p class="text-blk cardSubHeading">
		We deliver the medicines to you without you having to step out or wait in the queue to buy medicines. And we give you the option to browse through a variety of non-pharma products to choose from.        </div>
</div>
<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/862/862032.png">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
100% Genuine Medicine From Pharma24/7
		</p>
		<p class="text-blk cardSubHeading">
		All medicines/healthcare products sold on Pharma 24/7 are procured from our sister company -  Pharma 24/7, with a reputation of selling only 100% genuine products.        </div>
</div>
<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/256/1489/1489589.png" class="fa fa-prescription-bottle-alt" alt="Pharmacy Icon">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
Most Trusted Online Medical Store
		</p>
		<p class="text-blk cardSubHeading">
		We ensure that every product sold through our offline/online stores are checked for their authenticity, quality, and compliance with the Central Drugs Standard Control Organization,        </div>
</div>

<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/3860/3860516.png" class="fa fa-prescription-bottle-alt" alt="Pharmacy Icon">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
		Over 4,500 Pharmacy Stores In India          </p>
		<p class="text-blk cardSubHeading">
		We have more than 4,500 pharmacy stores in India catering to all your medicine needs. Our network is so vast that you may find an Pharma24/7 at every 1 km.</p>
	</div>
</div>

<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/10705/10705677.png" class="fa fa-prescription-bottle-alt" alt="Pharmacy Icon">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
		Extra Benefits Of Online Orders          </p>
		<p class="text-blk cardSubHeading">
		You can use these Health Credits to make more purchases on our platform. And not to forget the discounts and exclusive offers we bring out from time to time.        </div>
</div>

<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/3446/3446887.png" class="fa fa-prescription-bottle-alt" alt="Pharmacy Icon">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
Our mission          </p>
		<p class="text-blk cardSubHeading">
		Our mission is to bring healthcare of International standards within the reach of every individual. We are committed to the achievement and  excellence in education, research for the benefit of humanity.</p>      </div>
</div>

<div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
	<div class="cardImgContainer">
		<img class="cardImg" src="https://cdn-icons-png.flaticon.com/512/31/31792.png" class="fa fa-prescription-bottle-alt" alt="Pharmacy Icon">
	</div>
	<div class="cardText">
		<p class="text-blk cardHeading">
Our vision
		</p>
		<p class="text-blk cardSubHeading">
		We are committed to the achievement and maintenance of excellence in education, research and healthcare for the benefit of humanity”.
</p>   </div>
</div>

    </div>
  </div>

</div>
</section>


        </div>
      </div>


</div>

<?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>

<style>

body
{
  animation:fadeIn 4s;
}
@keyFrames fadeIn
{
  from
  {
    opacity:0;
    transform:rotateX(-10deg);
  }
  to
  {
    opacity:1;
    transform:rotateX(0);
  }
}




html {
  scroll-behavior: smooth;
}

 body {
      font-family: 'Montserrat', sans-serif;
    }

/* Add lifting effect to product box */

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
/* Add custom styles for the About Us section */

* {
    font-family: 'Montserrat', sans-serif;
}

.text-blk {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  line-height: 25px;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
}

.responsive-cell-block {
  min-height: 75px;
}

.responsive-container-block {
  min-height: 75px;
  height: fit-content;
  width: 100%;
  padding-top: 5px;
  padding-right: 5px;
  padding-bottom: 5px;
  padding-left: 5px;
  display: flex;
  flex-wrap: wrap;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 0px;
  margin-left: auto;
  justify-content: flex-start;
}

.responsive-container-block.bigContainer {
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
}

.responsive-container-block.Container {
  justify-content: space-evenly;
  align-items: center;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 0px;
  padding-left: 10px;
  position: relative;
  overflow-x: hidden;
  overflow-y: hidden;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 0px;
  margin-left: auto;
}

.mainImg {
  width: 100%;
  height: 800px;
  object-fit: cover;
}

.blueDots {
  position: absolute;
  top: 150px;
  right: 15%;
  z-index: -1;
  left: auto;
  width: 80%;
  height: 500px;
  object-fit: cover;
}

.imgContainer {
  position: relative;
  width: 48%;
}

.responsive-container-block.textSide {
  width: 100%;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  z-index: 100;
}

.text-blk.heading {
  font-size: 36px;
  line-height: 40px;
  font-weight: 700;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 20px;
  margin-left: 0px;
}

.text-blk.subHeading {
  font-size: 15px;
  line-height: 26px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 20px;
  margin-left: 0px;
}

.cardImg {
  width: 31px;
  height: 31px;
}

.cardImgContainer {
  padding-top: 20px;
  padding-right: 20px;
  padding-bottom: 20px;
  padding-left: 20px;
  border-top-width: 1px;
  border-right-width: 1px;
  border-bottom-width: 1px;
  border-left-width: 1px;
  border-top-style: solid;
  border-right-style: solid;
  border-bottom-style: solid;
  border-left-style: solid;
  border-top-color: rgb(229, 229, 229);
  border-right-color: rgb(229, 229, 229);
  border-bottom-color: rgb(229, 229, 229);
  border-left-color: rgb(229, 229, 229);
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  margin-top: 0px;
  margin-right: 10px;
  margin-bottom: 0px;
  margin-left: 0px;
}

.responsive-cell-block.wk-desk-6.wk-ipadp-6.wk-tab-12.wk-mobile-12 {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 10px;
  padding-right: 15px;
  padding-bottom: 10px;
  padding-left: 0px;
}

.text-blk.cardHeading {
  font-size: 18px;
  line-height: 28px;
  font-weight: 700;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 10px;
  margin-left: 0px;
}

.text-blk.cardSubHeading {
  color: rgb(153, 153, 153);
  line-height: 22px;
}

.explore {
  font-size: 18px;
  line-height: 20px;
  font-weight: 700;
  color: white;
  text-align: center;
  justify-content: center;
  display:block; margin:0 auto;
  background-color: #033B4A;
  box-shadow: rgba(244, 152, 146, 0.25) 0px 10px 20px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  cursor: pointer;
  border-top-width: 0px;
  border-right-width: 0px;
  border-bottom-width: 0px;
  border-left-width: 0px;
  border-top-style: initial;
  border-right-style: initial;
  border-bottom-style: initial;
  border-left-style: initial;
  border-top-color: initial;
  border-right-color: initial;
  border-bottom-color: initial;
  border-left-color: initial;
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
  padding-top: 17px;
  padding-right: 40px;
  padding-bottom: 17px;
  padding-left: 40px;
}

.explore:hover {
  background-image: initial;
  background-position-x: initial;
  background-position-y: initial;
  background-size: initial;
  background-repeat-x: initial;
  background-repeat-y: initial;
  background-attachment: initial;
  background-origin: initial;
  background-clip: initial;
  background-color: #2DA95C;
}

#ixvck {
  margin-top: 60px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
}

.redDots {
  position: absolute;
  bottom: -350px;
  right: -100px;
  height: 500px;
  width: 400px;
  object-fit: cover;
  top: auto;
}

@media (max-width: 1024px) {
  .responsive-container-block.Container {
    position: relative;
    align-items: flex-start;
    justify-content: center;
  }

  .mainImg {
    bottom: 0px;
  }

  .imgContainer {
    position: absolute;
    bottom: 0px;
    left: 0px;
    height: auto;
    width: 60%;
  }

  .responsive-container-block.textSide {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: auto;
    width: 70%;
  }

  .responsive-container-block.Container {
    flex-direction: column-reverse;
  }

  .imgContainer {
    position: relative;
    width: auto;
    margin-top: 0px;
    margin-right: auto;
    margin-bottom: 0px;
    margin-left: auto;
  }

  .responsive-container-block.textSide {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 20px;
    margin-left: 0px;
    width: 100%;
  }

  .responsive-container-block.Container {
    flex-direction: row-reverse;
  }

  .responsive-container-block.Container {
    flex-direction: column-reverse;
  }
}

@media (max-width: 768px) {
  .responsive-container-block.textSide {
    width: 100%;
    align-items: center;
    flex-direction: column;
    justify-content: center;
  }

  .text-blk.subHeading {
    text-align: center;
    font-size: 12px;
  }

  .text-blk.heading {
    text-align: left;
  }
	.imgContainer {
    opacity: 0.8;
  }

  .imgContainer {
    height: 500px;
  }

  .imgContainer {
    width: 30px;
  }

  .responsive-container-block.Container {
    flex-direction: column-reverse;
  }

  .responsive-container-block.Container {
    flex-wrap: nowrap;
  }

  .responsive-container-block.textSide {
    width: 100%;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 20px;
    margin-left: 0px;
  }

  .imgContainer {
    width: 90%;
  }

  .imgContainer {
    height: 450px;
    margin-top: 5px;
    margin-right: 33.9062px;
    margin-bottom: 0px;
    margin-left: 33.9062px;
  }

  .redDots {
    display: none;
  }

  .explore {
    font-size: 16px;
    line-height: 14px;
  }
}

@media (max-width: 500px) {
  .imgContainer {
    position: static;
    height: 450px;
  }

  .mainImg {
    height: 100%;
  }

  .blueDots {
    width: 100%;
    left: 0px;
    top: 0px;
    bottom: auto;
    right: auto;
  }

  .imgContainer {
    width: 100%;
  }

  .responsive-container-block.textSide {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .responsive-container-block.Container {
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    overflow-x: visible;
    overflow-y: visible;
  }

  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding: 0 30px 0 30px;
    margin-bottom: 30rem;
  }

  .redDots {
    display: none;
  }

  .text-blk.subHeading {
    font-size: 12px;
    line-height: 23px;
  }

  .text-blk.heading {
    font-size: 20px;
    line-height: 28px;
  }

  .responsive-container-block.textSide {
    margin-top: 40px;
    margin-right: 0px;
    margin-bottom: 50px;
    margin-left: 0px;
  }

  .imgContainer {
    text-align: left;
    margin-top: 5px;
    margin-right: 30px;
    margin-bottom: 0px;
    margin-left: -20px;
    width: 100%;
    position: relative;
  }

  .explore {
    padding-top: 17px;
    padding-right: 0px;
    padding-bottom: 17px;
    padding-left: 0px;
    width: 100%;

  display: block;
  margin: 0 auto;
}

  }

  #ixvck {
    width: 90%;
    margin-top: 40px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    font-size: 15px;
  }



  .text-blk.cardHeading {
    font-size: 16px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 8px;
    margin-left: 0px;
    line-height: 25px;
  }

  .responsive-cell-block.wk-desk-6.wk-ipadp-6.wk-tab-12.wk-mobile-12 {
    padding-top: 10px;
    padding-right: 0px;
    padding-bottom: 10px;
    padding-left: 0px;
  }
}
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800&amp;display=swap');

*,
*:before,
*:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  margin: 0;
}

.wk-desk-1 {
  width: 8.333333%;
}

.wk-desk-2 {
  width: 16.666667%;
}

.wk-desk-3 {
  width: 25%;
}

.wk-desk-4 {
  width: 33.333333%;
}

.wk-desk-5 {
  width: 41.666667%;
}

.wk-desk-6 {
  width: 50%;
}

.wk-desk-7 {
  width: 58.333333%;
}

.wk-desk-8 {
  width: 66.666667%;
}

.wk-desk-9 {
  width: 75%;
}

.wk-desk-10 {
  width: 83.333333%;
}

.wk-desk-11 {
  width: 91.666667%;
}

.wk-desk-12 {
  width: 100%;
}

@media (max-width: 1024px) {
  .wk-ipadp-1 {
    width: 8.333333%;
  }

  .wk-ipadp-2 {
    width: 16.666667%;
  }

  .wk-ipadp-3 {
    width: 25%;
  }

  .wk-ipadp-4 {
    width: 33.333333%;
  }

  .wk-ipadp-5 {
    width: 41.666667%;
  }

  .wk-ipadp-6 {
    width: 50%;
  }

  .wk-ipadp-7 {
    width: 58.333333%;
  }

  .wk-ipadp-8 {
    width: 66.666667%;
  }

  .wk-ipadp-9 {
    width: 75%;
  }

  .wk-ipadp-10 {
    width: 83.333333%;
  }

  .wk-ipadp-11 {
    width: 91.666667%;
  }

  .wk-ipadp-12 {
    width: 100%;
  }
}

@media (max-width: 768px) {
  .wk-tab-1 {
    width: 8.333333%;
  }

  .wk-tab-2 {
    width: 16.666667%;
  }

  .wk-tab-3 {
    width: 25%;
  }

  .wk-tab-4 {
    width: 33.333333%;
  }

  .wk-tab-5 {
    width: 41.666667%;
  }

  .wk-tab-6 {
    width: 50%;
  }

  .wk-tab-7 {
    width: 58.333333%;
  }

  .wk-tab-8 {
    width: 66.666667%;
  }

  .wk-tab-9 {
    width: 75%;
  }

  .wk-tab-10 {
    width: 83.333333%;
  }

  .wk-tab-11 {
    width: 91.666667%;
  }

  .wk-tab-12 {
    width: 100%;
  }
}

@media (max-width: 500px) {
  .wk-mobile-1 {
    width: 8.333333%;
  }

  .wk-mobile-2 {
    width: 16.666667%;
  }

  .wk-mobile-3 {
    width: 25%;
  }

  .wk-mobile-4 {
    width: 33.333333%;
  }

  .wk-mobile-5 {
    width: 41.666667%;
  }

  .wk-mobile-6 {
    width: 50%;
  }

  .wk-mobile-7 {
    width: 58.333333%;
  }

  .wk-mobile-8 {
    width: 66.666667%;
  }

  .wk-mobile-9 {
    width: 75%;
  }

  .wk-mobile-10 {
    width: 83.333333%;
  }

  .wk-mobile-11 {
    width: 91.666667%;
  }

  .wk-mobile-12 {
    width: 100%;
  }
}
</style>
<script>
$(document).on("scroll", function() {
  var pageTop = $(document).scrollTop();
  var pageBottom = pageTop + $(window).height();
  var tags = $(".tag");

  for (var i = 0; i < tags.length; i++) {
    var tag = tags[i];

    if ($(tag).position().top < pageBottom) {
      $(tag).addClass("visible");
    } else {
      $(tag).removeClass("visible");
    }
  }
});</script>
