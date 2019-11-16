<?=template_header('Add New Product')?>

<div class="container" style="padding-bottom: 100px">
<nav style="padding-top: 150px">
	<a href="index.php?page=admin"><p class="black-text"><span class="fas fa-arrow-left"></span> <b>Back to Panel<b></p></a>
</nav>
<h2 style="font-size:40px; margin-bottom: 0px;">Hello, Admin</h2>
<hr>
<p><b>Add New Product</b></p>
<form action="" method="post">
	<div class="form-group">
		<input type="text" name="name" placeholder="Product Name" class="form-control"><br>
		<textarea rows="2" cols="25" name="desc" placeholder="Product Description" class="form-control"></textarea><br>
		<input type="text" name="tagline" placeholder="Product Tagline" class="form-control"><br>
		<input type="text" name="price" placeholder="Product Price" class="form-control"><br>
		<input type="text" name="rrp" placeholder="Before Price" class="form-control"><br>
		<input type="text" name="img" placeholder="Image Or URL To Image" class="form-control"><br>
		<input type="submit" name="submit" value="Upload Product" class="form-control btn btn-danger">
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
	$sql = "INSERT INTO products (name, description, price, img, rrp, tagline)
	VALUES ('".$_POST["name"]."','".$_POST["desc"]."','".$_POST["price"]."','".$_POST["img"]."','".$_POST["rrp"]."','".$_POST["tagline"]."')";
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