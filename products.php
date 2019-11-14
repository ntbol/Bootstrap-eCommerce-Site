<?php
$num_of_products_on_each_page = 6;

$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');

$stmt->bindValue(1, ($current_page - 1) * $num_of_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_of_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>

<?=template_header('Products')?>

<div class="about" style="padding-bottom: 50px;">
    <div class="container" style="padding-top: 50px;">
    	<p class="tagline" style="color: black; padding-bottom: 10px"><i><?=$total_products?> Products</i></p>
        <div class="themeline"></div>
        <div class="row">
            <h1 class="huge-title" style="margin-bottom: 0px; z-index: 90">Bicycles&nbsp;</h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-4" style="padding-bottom: 45px">
                <img src="imgs/<?=$product['img']?>" width="100%">
                <h2 class="product-title"><?=$product['name']?></h2>
                <p class="black-text">
                    <?=$product['description']?>
                </p>
                <h3 class="price">&dollar;<?=$product['price']?></h3>
                <div class="row">
                    <div class="col-md-12" align="center">
                        <a href="index.php?page=product&id=<?=$product['id']?>" class="theme-btn btn-block btn-thin">View</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="container" style="padding-bottom: 100px">
	<div class="row">
		<div class="col-lg-4" align="center">
			<div class="">
				<?php if($current_page > 1): ?>
				<a href="index.php?page=products&p=<?=$current_page-1?>" class="theme-btn btn-block">Prev</a>
				<?php endif ?>
				<?php if($total_products > ($current_page * $num_of_products_on_each_page) - $num_of_products_on_each_page + count($products)): ?>
				<a href="index.php?page=products&p=<?=$current_page+1?>" class="theme-btn btn-block">More</a>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?=template_footer()?>