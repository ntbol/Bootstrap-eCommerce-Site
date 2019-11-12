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

<div class="content-wrapper">
<nav style="padding-top: 20px">
	<a href="index.php?page=admin">Back to Panel</a>
</nav>
<h2 style="font-size:40px; margin-bottom: 0px;">Hello, Admin</h2>
<hr>
<p><b>Edit Product</b></p>
<form action="" method="post">
	<div>
		<input type="text" name="name" value="<?=$product['name']?>"><br><br>
		<textarea rows="15" cols="50" name="description"><?=$product['description']?></textarea><br><br>
		<input type="text" name="price" value="<?=$product['price']?>"><br><br>
		<input type="text" name="img" value="<?=$product['img']?>"><br><br>
		<input type="submit" name="submit" >
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

	$sql = "UPDATE products SET name='$name', description='$description', price='$price', img='$img' WHERE id='$id'";
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