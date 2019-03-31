<?php 
require_once 'init/core.php';
if(!isLoggedIn()){
  redirectTo("login.php");
}
$user_id = $_SESSION['user_id'];

$user_history = getHistory($user_id);



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
    <h1>Order History</h1>
  </div>



  <section>


      <div class="grid-containerbas">
          <div class="grid-item-right">

            <?php 

            foreach($user_history as $order){
              $prod_info = array();
              $products = explode("|", $order['items']['product_id']);
              $products = array_filter($products);
              foreach($products as $product){
                $x = getProduct($product);
            array_push($prod_info, array("product_price" => $x['product_price'], "product_name" => $x['product_name']));
              }
            ?>

            <div class="basketitem">
             <p style="text-align:left;">Order ID: <?php echo $order['_id']; ?></p>
             <p style="text-align:left;">Date: <?php echo $order['date']; ?></p>
             <p style="text-align:left;">Items: <br><?php
              foreach($prod_info as $product){
                echo "{$product['product_name']} - {$product['product_price']}$<br>";
              }
            ?></p>
             <p style="text-align:left;">Total: <?php echo $order['total']; ?>$</p>
           </div>

            <?php
            }

            ?>

            </div>
          



        
        <div class="grid-item-leftcheck" style="text-align:center;    height: 180;">
          <br><br>
          <a href="myaccount.php"><button class="button white active">My Account</button><br><br></a>
          <a href="logout.php"><button class="button white active">Log Out</button></a>
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