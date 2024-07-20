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
            <li><a  href="trimer.php">BOUTIQUE</a></li>
           
            <li><a class="active" href="contactus.php">CONTACT</a></li>
          
 
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
                      <span><?php item(); ?> Articles dans le panier</span>
                        </a>
                </li>
                   

                   <li>
                   <a  href="customer_registration.php"><i class="fa fa-user-plus"></i>S'enregistrer</a></li>
                   <li>
                   <?php

                    if (!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php'>Mon Compte</a>";

                         } else{
                    
                    echo "<a href='customer/my_account.php?my_order'>Mon Compte</a>";
                
                         }

                    ?></li> 
                     
                   <li>
                   <a href="cart.php"><i class="fa fa-shopping-cart"></i>Aller au panier</a></li>
                    
                   <li>
                     <?php

                    if (!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php'>Se Connecter</a>";

                         } else{
                    
                    echo "<a href='logout.php'>Se Déconnecter </a>";
                
                         }

                    ?></li>
             </ul>
       </div>
</ul>



</nav></div></header>

<!-- header section End  -->

<section class="content" id="content">
  <div class="container">
    <div class="col-md-12">
      <ul class="breadcrumb">
     
        <li><span>Nous Joindre</span></li>
        

      </ul>

    </div>
</div></section>  
    
  <div class="c-9">
    <div class="rx">
      <div class="box-header">
        <center>
          <h2>Contactez-nous</h2>
          <p>Veillez  payez via  le mode qui  vous convients et nous Contacter</p>
          <p>Si vous avez des questions, n'hésitez pas à nous contacter, notre centre de service client travaille pour vous 24h/24 et 7j/7.</p>
        </center>
      </div>
      <div>
        <form action="contactus.php" method="post">
          <div class="roup">
            <label>Nom</label>
            <input type="text" name="name" required="" class="form-control">
          </div>
          <div class="roup">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required="">
            
          </div>
          <div class="roup">
            <label>Sujet</label>
            <input type="text" name="submit" class="form-control" required="">
          </div>
          <div class="roup">
            <label>Message</label>
            <textarea class="form-control" name="massage"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary">
              
              <i class="fa fa-user-md"></i> Envoyer le message
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  

     <!-- footer section starts  -->
   <?php
      include("includes/footer.php");  
      ?>
<!-- footer section   -->

</body></html>

<?php
if(isset($_POST['submit'])){
$senderName=$_POST['name'];
$senderEmail=$_POST['email'];
$senderSubject=$_POST['subject'];

$receiverEmail="jumoras.sarl@gmail.com";
mail($receiverEmail,$senderName,$senderSubject,$senderMassage,$senderEmail);
//customer mail
$email=$_POST['email'];
$subject="Bienvenue sur notre site";
$msg="Je vous reçois bientôt, merci pour l'envoi d'e-mail";
$from="jumoras.sarl@gmailcom@gmail.com";
mail($email, $subject, $msg, $from);
echo "<h2 align='center'>Votre courrier envoyé</h2>";

}
  ?>