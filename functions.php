<?php

function pdo_connect_mysql() {
	$DATABASE_HOST = 'localhost:3308';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'cart';
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	} catch (PDOException $exception) {
		die ('Failed to connect :(');
	}
}

// Template header
function template_header($title) {
    // Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<title>$title</title>
		<link href="css/styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <nav class="navbar navbar-expand-lg themenav navbar-dark">
            <div class="container">
              <a class="navbar-brand" href="index.php">FAST AF CYCLES</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav">
                  <li class="nav-item nav-expand"><a class="nav-link" href="index.php">HOME</a></li>
                  <li class="nav-item nav-expand"><a class="nav-link" href="index.php?page=products">BICYCLES</a></li>
                  <li class="nav-item nav-expand"><a class="nav-link" href="index.php?page=about">ABOUT</a></li>
                  <li class="nav-item nav-expand"style="padding-top: 6px"><a class="fas fa-user" href="index.php?page=admin"></a></li>
                  <li class="nav-item nav-expand" style="padding-top: 6px"><a href="index.php?page=cart"><i class="fas fa-shopping-cart"></i><span>$num_items_in_cart</span></a></li>
                </ul>
              </div>
            </div>
        </nav>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
            <footer class="themefooter">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="product-title" style="color:white">Fast AF Cycles</h2>
                            <p class="white-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mattis luctus mi vel pulvinar. Morbi suscipit faucibus erat, in ultricies nunc interdum rhoncus. Proin rhoncus orci at lectus eleifend dapibus. Ut vel risus vitae ante aliquam commodo a non massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam est urna, ultrices ut pulvinar quis, suscipit ac ligula. Maecenas sit amet purus eget tellus consectetur blandit. 
                            </p>
                        </div>
                        <div class="col-lg-3">
                            <h4 class="price" style="color:white; margin-bottom: 0px;">SITE MAP</h4>
                            <p class="white-text">
                                Home<br>
                                Products<br>
                                About<br>
                                Contact<br>
                                Admin
                            </p>
                        </div>
                        <div class="col-lg-3">
                            <h4 class="price" style="color:white; margin-bottom: 0px;">CONNECT</h4>
                            <p class="white-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mattis luctus mi vel pulvinar.
                            </p>
                            <i class="fab fa-twitter fa-2x icon"></i><i class="fab fa-instagram fa-2x icon"></i><i class="fab fa-facebook fa-2x icon"></i>
                        </div>
                    </div>
                </div>
            </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>