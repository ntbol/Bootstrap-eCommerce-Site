<?php

if (isset($_GET['id'])) {
	$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
	$stmt->execute([$_GET['id']]);

	$product = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$product) {
		die ('Product does not exist :(');
	}
} else {
	die ('Product does not exist :(');
}
?>

<?=template_header('Edit a Product')?>

<div class="container" style="padding-bottom: 100px">
	<nav style="padding-top: 150px">
		<a href="index.php?page=admin"><p class="black-text"><span class="fas fa-arrow-left"></span> <b>Back to Panel</b></p></a>
	</nav>
	<h2 style="font-size:40px; margin-bottom: 0px;">Hello, Admin</h2>
	<hr>
	<h4><b>Edit Product</b></h4>
	<form action="" method="post">
		<div class="form-group">
			<p>Product Name:</p>
			<input type="text" name="name" value="<?=$product['name']?>" class="form-control"><br>
			<p>Product Description:</p>
			<textarea rows="7" cols="25" name="description" class="form-control"><?=$product['description']?></textarea><br>
			<p>Product Tagline:</p>
			<input type="text" name="tagline" value="<?=$product['tagline']?>" class="form-control"><br>
			<p>On Sale Price:</p>
			<input type="text" name="price" value="<?=$product['price']?>" class="form-control"><br>
			<p>Regular Price:</p>
			<input type="text" name="rrp" value="<?=$product['rrp']?>" class="form-control"><br>
			<p>Featured?:</p>
			<input type="checkbox" name="featured" value="yes"> : Yes<br><br>
			<p>Product Image:</p>
			<input type="text" name="img" value="<?=$product['img']?>" class="form-control"><br>
			<input type="submit" name="submit" class="form-control btn btn-danger" value="Add Product">
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

	$id = $_GET['id'];
	$name = htmlspecialchars($_POST['name']);
	$description = htmlspecialchars($_POST['description']);
	$price = htmlspecialchars($_POST['price']);
	$img = htmlspecialchars($_POST['img']);
	$rrp = htmlspecialchars($_POST['rrp']);
	$tagline = htmlspecialchars($_POST['tagline']);

	if (isset($_POST['featured']) && ($_POST['featured'] == "yes")) {
		 $query .= "yes";
		} else {
		 $query .= "no";
		}

	$sql = "UPDATE products SET name='$name', description='$description', price='$price', img='$img', rrp='$rrp', tagline='$tagline', featured='$query' WHERE id='$id'";
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

	header('Location: index.php?page=admin');
}

?>

<script type="text/javascript">
	document.getElementById('textboxid').style.height="200px";
</script>

<?=template_footer()?>