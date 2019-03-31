<?php
require_once 'init/core.php';
$collection = $db->product;
if(!isset($_GET['category'])){
  $_GET['category'] = 'featured';
}


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
  <h1>Store</h1>
</div>



<section>



<div class="cat-nav">
            <ul class="list-inline go-center">
              <a href="shop.php?category=featured"><li class="list-inline-item <?php echo $_GET['category']=='featured'?'active':''; ?>">Featured</li></a>
              <a href="shop.php?category=all"><li class="list-inline-item <?php echo $_GET['category']=='all'?'active':''; ?>">All</li></a>
              <a href="shop.php?category=skip"><li class="list-inline-item <?php echo $_GET['category']=='skip'?'active':''; ?>">Skips</li></a>
              <a href="shop.php?category=addon"><li class="list-inline-item <?php echo $_GET['category']=='addon'?'active':''; ?>">Addons</li></a>
              <a href="shop.php?category=restart"><li class="list-inline-item <?php echo $_GET['category']=='restart'?'active':''; ?>">Restarts</li></a>
              
              <br><br>
              Price:
              <form action="" method="GET">
                <select name="sort">
                <option value="1">Ascending</option>
                <option value="-1">Descending</option>
                </select> 
                <input type="hidden" name="category" value="<?php echo $_GET['category']; ?>">
                <input type="submit" name="submit" value="Filter">
              </form>
            </ul>
          </div>

        <div class="grid-container">
          <?php 

          switch ($_GET['category']) {
            case 'all':
              $products = $collection->find();
              break;
            
            case 'skip':
              $products = $collection->find(array('category' => 'skip'));
              break;

            case 'addon':
              $products = $collection->find(array('category' => 'addon'));
              break;

            case 'restart':
              $products = $collection->find(array('category' => 'restarts'));
              break;

            case 'featured':
              $products = $collection->find()->sort(array('bought'=>-1))->limit(3);
              break;

            default:
              $products = $collection->find();
              break;
          }
          $ordered_products = [];
          foreach($products as $product){
            array_push($ordered_products, $product);
          }

          if(!isset($_GET['sort'])){
            $_GET['sort']=-1;
          }
          $price_sort = (int) $_GET['sort'];
          switch ($price_sort) {
            case '1':
              asort($ordered_products);
              break;
            
            case '-1':
              arsort($ordered_products);
              break;

            default:
              break;
          }
          foreach($ordered_products as $product){
      ?>

          <div class="grid-item">
             <div class="product">
              <div class="productimg">
                <div class="prodimgblur">
                  <img src="<?php echo $product['img_url']; ?>" alt="">
              </div>

              <div class="float-btns">
                <div >
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

                   
</section>




<footer>
  <p><b>Group Project © 2019</b></p>
</footer>



</body></html>