<?php 
require_once 'init/core.php';
if(!isLoggedIn()){
  redirectTo("login.php");
}
$user_id = $_SESSION['user_id'];

$user_products = getProducts($user_id)['product_id'];
if(strlen($user_products)<5){
  $no_products = 1;
}else{
  $no_products = 0;
}
$user_products = explode("|", $user_products);
$user_products = array_filter($user_products);

$prod_info = array();


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
    <h1>Basket</h1>
  </div>



  <section>


      <div class="grid-containerbas">
          <div class="grid-item-right">
            <?php 
            if($no_products){
              echo '<div class="basketitem"><p style="text-align:left;">No products</p></div>';
			  
			  
			  
            }else{
            foreach($user_products as $product){
            $x = getProduct($product); 
            array_push($prod_info, array("product_price" => $x['product_price'], "product_name" => $x['product_name']));
            
            ?>

            <div class="basketitem">
             <p style="text-align:left;"><?php echo $x['product_name']; ?></p>
             <p style="text-align:left;">Item Desc</p>
             <p style="text-align:left;"><?php echo $x['product_description']; ?> </p>
             <p style="text-align:right;font-size:25px;">Price <?php echo $x['product_price']; ?>$</p>
             <a href="basket.php?action=del&prod_id=<?php echo $x['_id']; ?>"><button class="button white active">Remove From Basket <i class="fa fa-shopping-basket"></i></button></a>
           </div>

           <?php 
            }}
           ?>

            </div>
          



        
        <div class="grid-item-leftcheck" style="text-align:center;">
          <br>
          <h1> Checkout </h1>
          <br>

          <h3 style="text-align:left;"> Price </h3>

          <p style="text-align:left;">
            <?php
              $total = 0;
              foreach($prod_info as $product){
                $total += $product['product_price'];
                echo "{$product['product_name']} - {$product['product_price']}$<br>";
              }
            ?>
          </p>

          <br>
          <h2>Total <?php echo $total; ?>$</h2>
          <a href="basket.php?action=checkout"><button class="button white active">Pay Now</button></a>
          <br>
          <br>

        </div>
 
    </div>



</div>

</section>




<footer>
  <p><b>Group Project © 2019</b></p>
</footer>



</body></html>