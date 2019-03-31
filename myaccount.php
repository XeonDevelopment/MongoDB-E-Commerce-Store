<?php 
require_once 'init/core.php';
if(!isLoggedIn()){
  redirectTo("login.php");
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  global $db;
  $collection = $db->customer;
  $info = array(
  'name' => $_POST['name'],
  'email' => $_POST['email'],
  'password' => $_POST['password']
  );
  $collection->update(array('_id' => $_SESSION['user_id']), $info);
}

$user = findUser($user_id);
$history = getHistory($user_id);

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
    <h1>My Account</h1>
  </div>



  <section>


      <div class="grid-containerbas">
          <div class="grid-item-right">

          <div class="basketitem">
          <form action="" method="POST">
          <div class="reginp">
          Name
          <input type="text" value="<?php echo $user['name']; ?>" placeholder="Name" name="name" style='color: black'>
          Email
          <input type="text" value="<?php echo $user['email']; ?>" placeholder="Email" name="email" style='color: black'>
          Password
          <input type="password" value="<?php echo $user['password']; ?>" placeholder="Password" name="password" style='color: black'>
          <br>
          <button class="button reg" style="text-align:left;"><span>Change Details</span></button>
          </form>
          <br><br>
        </div>
           </div>
              
<h1 style="text-align:center;"> Order History </h1>
<h5 style="text-align:center;">Only Last Two Recent Orders</h5>

             <?php 
             $num = 0;
             foreach($history as $order){
              if($num>=2){
                break;
              }
              $prod_info = array();
              $products = explode("|", $order['items']['product_id']);
              $products = array_filter($products);
              foreach($products as $product){
                $x = getProduct($product);
                array_push($prod_info, array("product_price" => $x['product_price'], "product_name" => $x['product_name']));
              }
              $num+=1;


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
          <a href="order_history.php"><button class="button white active">Order History</button></a><br><br>
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