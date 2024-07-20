<?php 
session_start();
include("includes/db.php");  
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Djom's</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
  <style>


  </style>
 
</head>
<body>

<!-- header section starts  -->

<header>

<div class="header-1">

    <a href="index.php" class="logo" > <img src="website/all/logoff.png" alt="Logo image" class="hidden-xs">  </a>
                               
<div class="col-md-6 offer">
    <a href="#" class="btn btn-sucess btn-sm">
           <?php

        if (!isset($_SESSION['customer_email'])){
        echo "Bienvenue  ";
      }else{
      echo "Welcome: " .$_SESSION['customer_email'] . "";
    }


        ?>
    </a>
<a id="pr" href="#"> Prix ​​total du panier : FCFA <?php totalPrice(); ?>,Articles au total <?php item(); ?></a>
</div>
  
</div>

<div class="header-2">
   

<nav class="navbar"> 


     <ul >
       
            <li><a  href="index.php">ACCEUIL</a></li>
            <li><a href="trimer.php">BOUTIQUE</a></li>
             <li><a href="contactus.php">CONTACT</a></li>
          
       <div class="col-md-6">
        <ul class="menu">
            <li>
                         <div class="collapse clearfix" id="search">
                             <form class="navbar-form" method="get" action="result.php">
                                 <div class="input-group">
                                     <input type="text" name="user_query" placeholder="search" class="form-control" required="">
                                     <button type="submit" value="search" name="search" class="btn btn-primary">
                                         <i class="fa fa-search"></i>
                                     </button>
                                 </div>
                             </form>
                         </div>
                   </li>



                <li>
                  <a href="cart.php" class="">
                    <i class="fa fa-shopping-cart"></i>
                      <span><?php item(); ?> articles dans le paniert</span>
                        </a>
                </li>
                   

                   <li>
                   <a  href="customer_registration.php"><i class="fa fa-user-plus"></i>s'enregistrer</a></li>
                   <li>
                   <?php

                    if (!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php'>Mon compte</a>";

                         } else{
                    
                    echo "<a href='customer/my_account.php?my_order'>Mon compte</a>";
                
                         }

                    ?></li> 
                     
                   <li>
                   <a class="active" href="cart.php"><i class="fa fa-shopping-cart"></i>Aller au panier</a></li>
                    
                   <li>
                     <?php

                    if (!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php'>Connexion</a>";

                         } else{
                    
                    echo "<a href='logout.php'>Déconnexion</a>";
                
                         }

                    ?></li>
             </ul>
       </div>
</ul>



</nav></div></header>
<section class="content" id="content">
  <div class="container">
    <div class="col-md-12">
      <ul class="breadcrumb">
     
        <li><span>Panier</span></li>
        

      </ul>

    </div>
</div></section>  

 
 <div class="col-md-9" id="cart">
   <div class="box">
     <form action="cart.php" method="post" enctype="multipart-form-data">
       <h1>Panier</h1>
       <?php
       $ip_add=getUserIp();
       $select_cart="select * from cart where ip_add='$ip_add'";
       $run_cart=mysqli_query($con,$select_cart);
       $count=mysqli_num_rows($run_cart);



        ?>
       <p class="text-muted">Actuellement vous avez <?php echo $count ?>Articles dans votre panier</p>
       <div class="table-respon"></div>
       <table class="table">
         <thead>
           <tr>
             <th colspan="2">Produit</th>
             <th>Quantité</th>
             <th>Prix ​​unitaire</th>
             <th>Size</th>
             <th colspan="1">Supprimer</th>
             <th colspan="1">Sous-total</th>
           </tr>
         </thead>
         <tbody>
          <?php
          $total=0;
          while ($row=mysqli_fetch_array($run_cart)) {
            $pro_id=$row['p_id'];
            $pro_size=$row['size'];
            $pro_qty=$row['qty'];
            $get_product="select * from products where product_id='$pro_id'";
            $run_pro=mysqli_query($con,$get_product);
            while ($row=mysqli_fetch_array($run_pro)) {
              $p_title=$row['product_title'];
              $p_img1=$row['product_img1'];
              $p_price=$row['product_price'];
              $sub_total=$row['product_price']*$pro_qty;
              $total += $sub_total; 

           

            ?>
           <tr>
             <td><img src="admin_area/product_images/<?php echo $p_img1 ?>"></td>
             <td><?php echo $p_title ?></td>
             <td><?php echo $pro_qty ?></td>
             <td>FCFA <?php echo $p_price ?></td>
             <td><?php echo $pro_size ?></td>
             <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
             <td>FCFA <?php echo $sub_total ?></td>
           </tr>
           <?php } } ?>
        </tfoot>
       </table>
<div class="box-footer">
         <div class="pull-left">
          <h4>Prix Total</h4>
         </div>
         <div class="pull-right">
           <h4>FCFA <?php echo $total; ?></h4>
         </div>
       </div>


       <div class="box-footer">
         <div class="pull-left">
           <a href="index.php" class="btn btn-default">
             <i class="fa fa-chevron-left"></i>Continuer vos achats
           </a>
         </div>
         <div class="pull-right">
           <button class="btn btn-default" type="submit" name="update" value="update cart">
             <i class="fa fa-refresh">Mise à jour panier</i>
           </button>
           <a href="checkout.php" class="btn btn-primary">
           Traité à la caisse<i class="fa fa-chevron-right"></i>
           </a>
         </div>
       </div>
     </form>
   </div>

<?php

function update_cart(){
  global $con;
  if (isset($_POST['update'])){
    foreach ($_POST['remove'] as $remove_id) {
      $delete_product="delete from cart where p_id='$remove_id'";
      $run_del=mysqli_query($con,$delete_product);
      if ($run_del) {
        echo "<script>window.open('cart.php','_self')</script>";
      }

    }
  }
}
echo @$up_cart=update_cart();
  ?>

 </div>
 <div class="col-m-3">
   <div class="box" id="order-summary">
     <div class="box-header">
       <h3>Récapitulatif de la commande</h3>
     </div>
     <p class="text-muted">
     Les frais d'expédition et supplémentaires sont calculés en fonction des valeurs que vous avez saisies
     </p>
     <div class="table-responsive">
       <table class="table">
         <tr>
           <td>Sous-total de la commande</td>
           <th>FCFA <?php echo $total ?></th>
         </tr>
         <tr>
           <td>Expédition et manutention</td>
           <td>FCFA 0</td>
           <tr>
             <td>Tax</td>
             <td>FCFA 0</td>
           </tr>
           <tr class="Total">
            <td>Total</td>
            <th>FCFA <?php echo $total ?></th>
             
           </tr>
         </tr>
       </table>
     </div>
   </div>
 </div> 
 
 <!--
<div id="row same-height-row">
  <div class="col-md-3 col-sm-6">
    <div class="box same-height headlin">
      <h3 class="text-center">Vous aimeriez aussi ces produits</h3>
    </div>
  </div>
  
  <div class="d-3">
    <div class="product same-height">
      <a href="">
        <img src="admin_area\product_images\fer a beton1.jpeg" class="img-responsive">
      </a>
      <div class="tet">
        <h3><a href="details.php?">Fer</a></h3>
        <p class="price">FCFA</i>1000</p>
      </div>
    </div>
  </div>
 
  <div class="d-3">
    <div class="product same-height">
      <a href="">
        <img src="admin_area\product_images\parpin3.jpeg" class="img-responsive">
      </a>
      <div class="tet">
        <h3><a href="details.php">Parpin</a></h3>
        <p class="price">FCFA</i>350</p>
      </div>
    </div>
  </div>
  <div class="d-3">
    <div class="product same-height">
      <a href="">
        <img src="website/all/scissor.svg" class="img-responsive">
      </a>
      <div class="tet">
        <h3><a href="details.php">Cisceaux</a></a></h3>
        <p class="price">FCFA</i>500</p>
      </div>
    </div>
  </div>
  <div class="d-3">
   <div class="product same-height">
      <a href="">
        <img src="admin_area\product_images\ciment3.jpeg" class="img-responsive">
      </a>
      <div class="tet">
        <h3><a href="details.php">Ciment</a></h3>
        <p class="price">FCFA</i>6500</p>
      </div>
    </div>
  </div>
   <div class="d-3">
    <div class="product same-height">
      <a href="">
        <img src="website/all/blad.svg" class="img-responsive">
      </a>
      <div class="tet">
        <h3><a href="details.php">Lame</a></h3>
        <p class="price">FCFA</i>1000</p>
      </div>
    </div>
  </div>
   <div class="d-3">
    <div class="product same-height">
      <a href="">
        <img src="website/all/napkin.svg" class="img-responsive">
      </a>
      <div class="tet">
        <h3><a href="details.php">Calculatrice</a></h3>
        <p class="price">FCFA</i>2000</p>
      </div>
    </div>
  </div>
</div> -->

</body>
     <!-- footer section starts  -->
   <?php
      include("includes/footer.php");  
      ?>
<!-- footer section   -->
