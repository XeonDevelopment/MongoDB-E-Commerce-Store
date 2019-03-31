<?php
require_once 'init/core.php';
if(!isset($_REQUEST['string'])){
  $_REQUEST['string'] = '';
}

if(!isset($_REQUEST['sort'])){
  $_REQUEST['sort'] = -1;
}
?>

<style>
.ser {
display: block; */
    height: 25;
    width: 150px;
    margin: 14px auto 5px;
    padding: 5px 15px 0;
    /* width: 100%; */
    background-color: transparent;
    text-decoration: none;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    transition: all .5s ease;
    text-align: center;
    color: white;
}

.ehbutton {
        background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden; 
}


#srch { 
  display: inline-block;
    margin-left: 1px;
    padding-top: 23px;
    position: relative;;
}


</style>


<nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="cart.php">Cart</a></li>
            




 <li ><form  action="search.php" method="POST">
                

                <input class="ser" type="text" style="color:black" name="string" value="<?php echo $_REQUEST['string']; ?>">

                <input type="hidden" name="category" value="<?php if(isset($_REQUEST['category'])){echo $_REQUEST['category'];} ?>"></li>


<li id="srch"><button class="ehbutton" type="submit" name="submit" style="font-size: 21px; color: #8982f7 ; "><i class="fa fa-search"></i></button>


               
              </form></li>










            <li class="nav-item">
                <?php 

if(isLoggedIn()){
        echo '<a class="nav-link nav-btn" href="myaccount.php">My Account</a>';
      } else {
        echo '<a class="nav-link nav-btn" href="login.php">Login</a>';
      }

                ?>
              
            </li>
          </ul>
        </nav>