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
<?=template_header('Product')?>


<div class="about" style="padding: 50px 0px 200px 0px;">
    <div class="container" style="padding-top: 100px;">

    </div>
    <div class="container" >
        <div class="row">
            <div class="col-lg-6" >
                <img src="imgs/<?=$product['img']?>" width="100%">
            </div>
            <div class="col-lg-6" style="padding-top: 60px">
                <h2 class="product-title"><?=$product['name']?></h2>
                <p class="black-text">
                    <?=$product['description']?>
                </p>
                <h3 class="price">
                    &dollar;<?=$product['price']?>
                    <?php if ($product['rrp'] > 0): ?>
                    <span class="rrp">&dollar;<?=$product['rrp']?></span>
                    <?php endif; ?>
                </h3>
                <div class="row">
                    <div class="col-md-6" align="left">
                        <form action="index.php?page=cart" method="post" class="form-horizontal">
                            <div class="form-group">
                                <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                            </div>
                                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                            <div class="form-group">
                                <button type="submit" class="theme-btn btn-block btn-thin">Add To Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=template_footer()?>