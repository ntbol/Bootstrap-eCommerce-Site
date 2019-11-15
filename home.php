<?php

$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 3');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$yes = 'yes';

$stmtfeatured = $pdo->prepare("SELECT * FROM products WHERE featured='$yes'");
$stmtfeatured->execute();
$featured = $stmtfeatured->fetchAll(PDO::FETCH_ASSOC);

?>
<?=template_header('Home')?>
<div class="hero">
    <div class="container" style="padding-top: 250px;">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="header">Race Cycles for the Street.</h1>
                <p class="white-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales vitae nibh at rhoncus. Nulla feugiat leo erat. Fusce venenatis consequat condimentum. Donec viverra malesuada hendrerit.
                </p>
                <div class="row">
                    <div class="col-lg-4" align="center">
                        <a href="index.php?page=products" class="theme-btn btn-block">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="featured" style="padding-bottom: 100px">
    <div class="container" style="margin-top: -110px;">
        <div class="themeline"></div>
        <div class="row">
            <h1 class="huge-title" style="margin-bottom: 0px;">FEATURED&nbsp;</h1>
        </div>
    </div>
    <div class="container" style="margin-top: -55px">
        <?php foreach ($featured as $product): ?>
        <div class="row" style="padding: 0px 0px 80px 0px">
            <div class="col-lg-5" style="z-index: -9">
                <img src="imgs/<?=$product['img']?>" width="100%;">
            </div>
            <div class="col-lg-7" style="padding-top: 75px;">
                <p class="tagline"><i><?=$product['tagline']?></i></p>
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
                    <div class="col-lg-4" align="center">
                        <a href="index.php?page=product&id=<?=$product['id']?>" class="theme-btn btn-block btn-thin">View</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="about" style="padding-bottom: 100px">
    <div class="container" style="padding-top: 50px;">
        <div class="themeline"></div>
        <div class="row">
            <h1 class="huge-title" style="margin-bottom: 0px; z-index: 90">OUR STORY&nbsp;</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="padding-bottom: 150px">
                <h2 class="product-title">Born From Speed</h2>
                <p class="black-text">
                    Vestibulum quis enim quis lectus posuere hendrerit at at magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed magna sit amet nisl auctor tristique nec nec neque. Praesent condimentum erat et vehicula rhoncus. Fusce egestas neque quis turpis dictum efficitur. Vivamus enim nisl, interdum non euismod et, suscipit non sem. Duis facilisis dolor ac consectetur lobortis. Sed nec dolor aliquam, finibus purus eget, blandit velit. In lacinia ligula dui, eu iaculis massa ullamcorper in. Quisque malesuada tempus semper.
                </p>
                <div class="row">
                    <div class="col-lg-4" align="center">
                        <a href="index.php?page=about" class="theme-btn btn-block btn-thin">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="imgs/about.png" style="margin-top: -120px; z-index: -9" width="100%">
            </div>
        </div>
    </div>
</div>

<div class="about" style="padding-bottom: 100px;">
    <div class="container" style="padding-top: 50px;">
        <div class="themeline"></div>
        <div class="row">
            <h1 class="huge-title" style="margin-bottom: 0px; z-index: 90">Bicycles&nbsp;</h1>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <?php foreach ($recently_added_products as $product): ?>
            <div class="col-md-4" style="padding-bottom: 45px">
                <img src="imgs/<?=$product['img']?>" width="100%">
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
                    <div class="col-md-12" align="center">
                        <a href="index.php?page=product&id=<?=$product['id']?>" class="theme-btn btn-block btn-thin">View</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?=template_footer()?>
