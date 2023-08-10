<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id LEFT JOIN sales ON sales.id=details.sales_id WHERE details.sales_id=:id");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
		$output['transaction'] = $row['pay_id'];
		$output['date'] = date('M d, Y', strtotime($row['sales_date']));
		$subtotal = $row['price']*$row['quantity'];
		$total += $subtotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>&#8377; ".number_format($row['price'], 2)."</td>
				<td>".$row['quantity']."</td>
				<td>&#8377; ".number_format($subtotal, 2)."</td>
			</tr>
		";
	}

	$output['total'] = '<b>&#8377; '.number_format($total, 2).'<b>';
	$newstmt=$conn->prepare("SELECT count(*) as numrows from subs_user where user_id=:user_id");
	$newstmt->execute(['user_id'=>$user['id']]);
	$newrow=$newstmt->fetch();

	if ($newrow['numrows']){
		$newstmt=$conn->prepare("SELECT subs_amt from subs_user where user_id=:user_id");
		$newstmt->execute(['user_id'=>$user['id']]);
		$newrow1=$newstmt->fetch();

		$newstmt2=$conn->prepare("SELECT subs_date from subs_user where user_id=:user_id");
		$newstmt2->execute(['user_id'=>$user['id']]);
		$newrow2=$newstmt2->fetch();

		$newstmt3=$conn->prepare("SELECT sales_date from sales where id=:id");
		$newstmt3->execute(['id'=>$row['id']]);
		$newrow3=$newstmt3->fetch();

	if ($newrow1['subs_amt']==199 && $newrow2['subs_date']<=$newrow3['sales_date'])
	{
		$total=$total-0.2*$total;
		$output['offer'] = '<b>&#8377; '.number_format($total, 2).'<b>';

	}
	else if ($newrow1['subs_amt']==299 && $newrow2['subs_date']<=$newrow3['sales_date'])
	{
		$total=$total-0.3*$total;
		$output['offer'] = '<b>&#8377; '.number_format($total, 2).'<b>';
	}
	else {
		$output['offer'] = '<b>&#8377; '.number_format($total, 2).'<b>';
	}

}
else {
	$output['offer'] = '<b>&#8377; '.number_format($total, 2).'<b>';
}
	$pdo->close();
	echo json_encode($output);

?>
