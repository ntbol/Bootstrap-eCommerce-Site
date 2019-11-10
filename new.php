<?=template_header('Add New Product')?>

<div class="content-wrapper">
<h2 style="font-size:40px; margin-bottom: 0px;">Hello, Admin</h2>
<hr>
<p><b>Add New Product</b></p>
<form action="" method="post">
	<div>
		<input type="text" name="name" placeholder="Product Name"><br><br>
		<textarea rows="2" cols="25" name="desc" placeholder="Product Description"></textarea><br><br>
		<input type="text" name="price" placeholder="Product Price"><br><br>
		<input type="text" name="img" placeholder="Image Or URL To Image"><br><br>
		<input type="submit" name="submit" value="Upload Product">
	</div>
</form>
</div>
<?php
if(isset($_POST["submit"])){
	$hostname='localhost:3308';
	$username='root';
	$password='';

	try {
	$dbh = new PDO("mysql:host=$hostname;dbname=cart",$username,$password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
	$sql = "INSERT INTO products (name, description, price, img)
	VALUES ('".$_POST["name"]."','".$_POST["desc"]."','".$_POST["price"]."','".$_POST["img"]."')";
		if ($dbh->query($sql)) {
		echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
		}
		else{
		echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
		}			
	$dbh = null;
	}
	catch(PDOException $e)
	{
	echo $e->getMessage();
	}
}

?>

<script type="text/javascript">
	document.getElementById('textboxid').style.height="200px";
</script>
<?=template_footer()?>