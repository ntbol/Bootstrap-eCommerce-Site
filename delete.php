<?=template_header('Product Deleted')?>

<?php
	

	$hostname='localhost:3308';
	$username='root';
	$password='';

	try {
	$dbh = new PDO("mysql:host=$hostname;dbname=cart",$username,$password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$id = $_GET['id'];

	$sql = "DELETE FROM `products` WHERE `id` = $id";

	$dbh->exec($sql);
	echo "Record deleted successfully";
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

    $dbh = null;

	header('Location: index.php?page=admin');

?>

<?=template_footer()?>