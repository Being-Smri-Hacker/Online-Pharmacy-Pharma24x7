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
	        		<h1 class="page-header" style='font-family: Montserrat, sans-serif; font-weight: 600;'>YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        				echo "
									<div class='row' style='color:white'>
				    			<div class='col-xs-4' style='color:#9DABAF;''>
	        					<button type='submit'  style='background-color:#033B4A;width:20rem'><a id='paymentLink' style='color:white;' href='#'>Proceed to Payment</a></button>
										</div>
										</div>
									";
	        			}
	        			else{
	        				echo "
	        					<h4 style='font-family: Montserrat, sans-serif; '>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>
	        	</div>
	        	<div class="col-sm-3" style="margin-top:-3.3rem;">
				<div class="row">
	<div class="box box-solid" style="font-family: 'Montserrat', sans-serif;
      color: #033B4A; margin-top: 9.7rem; height: 35rem; ">
	  	<div class="box-header with-border">
	    	<h3 class="box-title" style="font-family: 'Montserrat', sans-serif;
      color: #033B4A; font-size: 2rem; "><b>Most Viewed Today</b></h3>
	  	</div>
	  	<div class="box-body" style="height: 230px; overflow-y: auto;">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
	    	<ul>
	  	</div>
	</div>
</div>
	        	</div>
	        </div>
	      </section>

	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>=1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		var stock=$(this).data('value');
		if (qty<stock){
		qty++;
	}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}

// Use AJAX to fetch the total amount
function fetchTotalAmount() {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'cart_total.php', true);
    xhr.onload = () => {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        const totalAmount = response.totalAmount;
        resolve(totalAmount);
      } else {
        reject(new Error('Failed to fetch total amount'));
      }
    };
    xhr.onerror = () => {
      reject(new Error('Failed to fetch total amount'));
    };
    xhr.send();
  });
}

// Call the fetchTotalAmount function
fetchTotalAmount()
  .then(totalAmount => {
    // Pass the total amount to the payment.php page
    const paymentLink = document.getElementById('paymentLink');
    paymentLink.href = `payment.php?totalAmount=${totalAmount}`;
  })
  .catch(error => {
    console.error(error);
  });





</script>

</body>
</html>
