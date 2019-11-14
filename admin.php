<?php
	$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id');
	$stmt->execute();
	$editProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Admin Panel')?>

<div class="container" style="padding: 50px 0px 50px 0px">
	<h2 class="product-title">Hello, Admin</h2>
	<hr>
	<p class="black-text">Delete, Modify, or Add Products Below</p>
	
	<table border="1" cellpadding="10" width="100%" class="table table-bordered">
		<tr>
			<th><a href="index.php?page=new" class="theme-btn btn-block">Add Product</a></th>
			<th>ID</th>
			<th>Product Name</th>
			<th>Product Desc</th>
			<th>Price</th>
			<th>Bought</th>
			<th>Date Added</th>
			<th></th>
			<th></th>
		</tr>
		<?php foreach ($editProducts as $product): ?>
		<tr>
			<td style="width: 100px"><img src="imgs/<?=$product['img']?>" width="150"></td>
			<td style="width: 25px"><?=$product['id']?></td>
			<td style="width: 150px"><?=$product['name']?></td>
			<td style="width: 300px"><?=$product['description']?></td>
			<td style="width: 50px">$<?=$product['price']?></td>
			<td style="width: 25px"><?=$product['quantity']?></td>
			<td><?=$product['date_added']?></td>
			<td><a href="index.php?page=edit&id=<?=$product['id']?>">Edit</a></td>
			<td><a href="index.php?page=delete&id=<?=$product['id']?>">Delete</a></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<?=template_footer()?>