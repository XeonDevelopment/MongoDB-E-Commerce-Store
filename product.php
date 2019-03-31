<?php 
require_once 'init/core.php';

$collection = $db->product;

if(!isset($_GET['prod_id'])){
  #redirectTo('shop.php');
}

$product = getProduct($_GET['prod_id']);
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

<div class="subhead">
  <h1><?php echo $product['product_name']; ?></h1>
</div>



<section>



        <div class="grid-containert">
          <div class="grid-item-right">
             <div class="product">
              <div class="productimg">
                <div class="prodimgblur">
                  
                  <img src="<?php echo $product['img_url']; ?>" alt="">
              </div>

              <div class="float-btns">
                <div>
                    <a href="basket.php?action=add&prod_id=<?php echo $product['_id']; ?>" class="product-button">Buy Now</a>
                </div>
            </div>

        </div>
    </div>
        </div>
        <?php 


        ?>
        <div class="grid-item-left" style="text-align:center;">
          <br>
          <h1><?php echo $product['product_name']; ?></h1>
          <br>

          <h3 style="text-align:left;"> Description </h3>

          <p style="text-align:left;"><?php echo $product['product_description']; ?></p>

          <br>
          <a href="basket.php?action=add&prod_id=<?php echo $product['_id']; ?>"><button class="button white active"><span>Buy Now <?php echo $product['product_price']; ?>$</span></button></a>

        </div>
 
    </div>

                   
</section>


<section calltoaction="">

    <div align="center" class="ctasignup">
        <h1 style="font-size:25px;">Related Products</h1>

        <div class="grid-containertrelated">
          <?php 
          $prod_name = $product['product_name'];
          $prod_name = explode(" ", $prod_name);
          $search = search($prod_name[0], 3);
          $num = 0;
          foreach($search as $res){
            if($num>=3){
                break;
              }
            $num+=1;
          ?>
          <div class="grid-item">
             <div class="product">
              <div class="productimg">
                <div class="prodimgblur">
                  <img src="<?php echo $res['img_url']; ?>" alt="">
              </div>

              <div class="float-btns">
                <div class="demo-info">
                    <a href="product.php?prod_id=<?php echo $res['_id']; ?>" class="product-button">View</a>
                </div>
            </div>

            </div>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>


        <a href="shop.php"><button class="button white active" style="font-size:30px;box-shadow: 0px 0px 25.5px 9px rgba(0, 0, 0, 0.1);"><span>Back To Shop</span></button></a>
    </div>
</section>


<footer>
  <p><b>Group Project © 2019</b></p>
</footer>



</body></html>