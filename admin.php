<?php
	$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id');
	$stmt->execute();
	$editProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Admin Panel')?>

<div class="container" style="padding: 150px 0px 50px 0px">
	<h2 class="product-title">Hello, Admin</h2>
	<hr>
	<p class="black-text">Delete, Modify, or Add Products Below</p>
	<div class="row" style="padding-bottom: 15px">
		<div class="col-lg-3" align="center">
			<a href="index.php?page=new" class="theme-btn btn-block">Add Product</a>
		</div>
	</div>
	<table border="1" cellpadding="10" width="100%" class="table table-bordered">
		<tr>
			<th></th>
			<th>Product Name</th>
			<th>Product Description</th>
			<th>Price</th>
			<th>Featured</th>
			<th>Date Added</th>
			<th></th>
			<th></th>
		</tr>
		<?php foreach ($editProducts as $product): ?>
		<tr>
			<td style="width: 100px"><img src="imgs/<?=$product['img']?>" width="150"></td>
			<td style="width: 150px"><?=$product['name']?></td>
			<td style="width: 300px"><?=$product['description']?></td>
			<td style="width: 50px">$<?=$product['price']?></td>
			<td style="width: 25px"><?=$product['featured']?></td>
			<td style="width: 50px"><?=$product['date_added']?></td>
			<td><a href="index.php?page=edit&id=<?=$product['id']?>"><p class="black-text"><span class="fas fa-edit"></span> Edit</p></a></td>
			<td><a href="index.php?page=delete&id=<?=$product['id']?>"><p class="black-text"><span class="fas fa-trash"></span> Delete</p></a></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<?=template_footer()?>