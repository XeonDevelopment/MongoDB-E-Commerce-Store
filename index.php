<?php 
require_once 'init/core.php';

$collection = $db->product;

$products = $collection->find()->sort(array('bought'=>-1))->limit(3);


 ?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Link Font Awesome for Icons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <title>Game Website</title>

</head>


<body>
    <section header="">
        <header>
            <div class="container">
              <img src="img/logo.png" class="logo">

                    <?php include 'sidebar.php';
?>
    </div>
</header>
</section>

<div class="mainhead">
  <h1>Welcome to .....</h1>
  <p>Feel Free to sign up to take part in multiplayer</p>
  <button class="button white active"><span>Get Started</span></button>
</div>



<section>

<div class="feautured">


        <div class="title center">
            <h6>Best Sellers</h6>
            <h2>Check out the best selling addons.</h2>
        </div>


        <div class="grid-container">
          <?php
          foreach($products as $product){
          ?>
          <div class="grid-item">
             <div class="product">
              <div class="productimg">
                <div class="prodimgblur">
                  <img src="<?php echo $product['img_url']; ?>" alt="">
              </div>

              <div class="float-btns">
                <div class="demo-info">
                    <a href="product.php?prod_id=<?php echo $product['_id']; ?>" class="product-button">Buy <?php echo $product['product_price']; ?>$</a>
                </div>
            </div>

        </div>
    </div>
        </div>  
        <?php 
        }
        ?>   
    </div>


</div>                    
</section>


<section calltoaction="">

    <div align="center" class="ctasignup">
        <h1>What are you waiting for?</h1>
        <button class="button white active"><span>Register</span></button>
    </div>
</section>

<section stats="">
<br>

<h2 class="statstxt">Website Stats</h2>
        <div class="grid-container">
          <div class="grid-item">

            <i class="fa fa-diamond" style="font-size:50px;color: #8982f7"></i>
            <h3>500+</h3>
            <p>Sold Upgrades</p>
         </div>
         <div class="grid-item">

            <i class="fa fa-child" style="font-size:50px;color: #8982f7"></i>
            <h3>500+</h3>
            <p>Happy Customers</p>
         </div>
<div class="grid-item">

            <i class="fa fa-coffee" style="font-size:50px;color: #8982f7"></i>
            <h3>500+</h3>
            <p>Coffee's Drank</p>
         </div>



        </div>
    </div>
</section>

<footer>
  <p><b>Group Project © 2019</b></p>
</footer>



</body></html>