<?php

if(isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {

	$product_id = (int)$_POST['product_id'];
	$quantity = (int)$_POST['quantity'];

	$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
	$stmt->execute([$_POST['product_id']]);

	$product = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($product && $quantity > 0) {
		if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
			if (array_key_exists($product_id, $_SESSION['cart'])) {
				$_SESSION['cart'][$product_id] += $quantity;
			} else {
				$_SESSION['cart'][$product_id] = $quantity;
			}
		} else {
			$_SESSION['cart'] = array($product_id => $quantity);
		}
	}
}

//remove from cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
	unset($_SESSION['cart'][$_GET['remove']]);
}

//update product quantities in cart
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
}

//handling place order
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
	header('Location: index.php?page=placeorder');
	exit;
}

//check for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
?>

<?=template_header('Cart')?>

<div class="container" style="padding: 150px 0px 150px 0px">
    <h2 style="font-size:40px; margin-bottom: 15px;">Shopping Cart</h2>
    <form action="index.php?page=cart" method="post">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="imgs/<?=$product['img']?>" width="120" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><p class="black-text"><?=$product['name']?></p></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove"><p class="black-text">Remove</p></a>
                    </td>
                    <td class="price">&dollar;<?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal" align="right">
            <h4>
            <span class="text">Subtotal</span>
            <span class="price">&dollar;<?=$subtotal?></span>
        </h4>
        </div>
        <div class="buttons" align="right">
            <input type="submit" value="Update" name="update" class="btn btn-secondary">
            <input type="submit" value="Place Order" name="placeorder" class="btn btn-danger">
        </div>
    </form>
</div>

<?=template_footer()?>