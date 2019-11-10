<?php
	$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id');
	$stmt->execute();
	$editProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Admin Panel')?>

<div class="content-wrapper">
	<h2 style="font-size:40px; margin-bottom: 0px;">Hello, Admin</h2>
	<hr>
	<p>Delete, Modify, or Add Products Below</p>
	<a href="index.php?page=new"><button style="margin-bottom: 15px">Add New Product</button></a>
	
	<?php foreach ($editProducts as $product): ?>
	<table border="1" cellpadding="10" width="100%">
		<tr>
			<th></th>
			<th>ID</th>
			<th>Product Name</th>
			<th>Product Desc</th>
			<th>Price</th>
			<th>Amount Bought</th>
			<th>Date Added</th>
			<th></th>
			<th></th>
		</tr>
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
	</table>

	<?php endforeach; ?>
</div>

<?=template_footer()?>