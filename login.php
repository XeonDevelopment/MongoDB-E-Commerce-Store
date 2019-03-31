<?php 
require_once 'init/core.php';
if(isLoggedIn()){
  redirectTo("index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  global $db;
  $collection = $db->customer;
  $info = array(
  'email' => $_POST['email'],
  'password' => $_POST['password']
  );
  $res = $collection->findOne($info);
  if($res){
    $_SESSION['user_id'] = $res['_id'];
    redirectTo("myaccount.php");
  }else{

  }
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

  <div class="fullpagelog ">

    <div class="regpg">
      <div class="regimg">
        <p style="text-align: Center;">Log In</p>
        <div class="reginp">
          <form action="" class="reginp" method="POST">
          <input class="reginp" placeholder="Email" name="email">
          <input class="reginp" placeholder="Password" name="password">
          <br>
          <button class="button reg"><span>Log In</span></button>
          </form>
          <a href="register.php"><button class="button reg"><span>Register</span></button></a>
          <br><br>
        </div>


      </div>
    </div>





  </div>



  <section>


    <footer>
      <p><b>Group Project © 2019</b></p>
    </footer>



  </body></html>