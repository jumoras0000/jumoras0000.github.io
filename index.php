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
  
 
</head>
<body>

<!-- header section starts  -->

<header>

<div class="header-1">

    <a href="index.php" class="logo" > <img src="website/all/logof.png" alt="Logo image" class="hidden-xs">  </a>
                               
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
<a id="pr" href="#"> Prix ​​total du panier: FCFA <?php totalPrice(); ?>,Articles au total <?php item(); ?></a>
</div>
  
</div>

<div class="header-2">
   

<nav class="navbar"> 


     <ul >
        <li>
            
            <li><a class="active" href="index.php">ACCEUIL</a></li>
             
            <li><a href="trimer.php">BOUTIQUE</a></li>
            <li><a href="contactus.php">CONTACT</a></li>
            <li><a href="#footer">A PROPOS</a></li>
 
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
                      <span><?php item(); ?>articles dans le panier</span>
                        </a>
                </li>
                   

                   <li>
                   <a  href="customer_registration.php"><i class="fa fa-user-plus"></i>s'enregistrer</a></li>
                   <li>
                    <?php

                    if (!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php'>Mon Compte</a>";

                         } else{
                    
                    echo "<a href='customer/my_account.php?my_order'>Mon Compte</a>";
                
                         }

                    ?>
                   </li> 

                   <li>
                   <a href="cart.php"><i class="fa fa-shopping-cart"></i>Aller au panier
</a></li>
                    
                   <li>
                     <?php

                    if (!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php'>Connexion</a>";

                         } else{
                    
                    echo "<a href='logout.php'>Logout</a>";
                
                         }

                    ?></li>
             </ul>
       </div>
</ul>
         
<section class="home" id="home">

<h1 class="heading"> <span>MEILLEURES OFFRES POUR VOUS</span> </h1>

<div class="slideshow-container">


<?php
$get_slider="select * from slider LIMIT 0,1";
$run_slider= mysqli_query($con,$get_slider);
while ($row= mysqli_fetch_array($run_slider)) {
  $slider_name= $row['slider_name'];
  $slider_image= $row['slider_image'];
   $slider_url= $row['slider_url'];

  echo "<div class='mySlides fade'>
  <a href='#'><img src='admin_area/slider_images/$slider_image'  width='1400' height='400'></a>

</div>
  ";
}

    ?>
<?php
$get_slider="select * from slider LIMIT 1,10";
$run_slider= mysqli_query($con,$get_slider);
while ($row= mysqli_fetch_array($run_slider)) {
  $slider_name= $row['slider_name'];
  $slider_image= $row['slider_image'];
   $slider_url= $row['slider_url'];
  echo "<div class='mySlides fade '>
  <a href='$slider_url'><img src='admin_area/slider_images/$slider_image' width='1400' height='400'></a>
        </div>";
}

    ?>


<!-- dynamic hairstyle images section End  -->

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<div  style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
  

</div>



</section>

<div class="hot">    
    <div class="box">
        <div class="container">
            <div class="col-md-121">
                <h2>Meilleur offre cette semaine</h2>
           
          <!-- dynamic latest this week images section start  -->
          <div class=" col-sm-4" >
          <div class="row">
                   <?php

                   getPro();


                     ?>
 </div>
</div><!-- hot End -->
 </div>
         </div>
    </div>
</div>
          <!-- dynamic latest this week images section End  -->


                   
      


<!-- new this week section End -->


<!--saloon product section starts  -->

<!-- Trimer Start  
<section class="arrival" id="arrival">

<h1 class="heading"> <span>PRODUIT</span> </h1>

<div class="box-container">

    <div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=28"> <img src="website/all/th (2).jpg"  alt="" width="150"></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=28"><h3>Toil</h3></a>
            
        </div>
        <div class="overlay">
          
        </div>
    </div>
 Trimer End  -->
   
<!--

     <div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=27"> <img src="website/all/blad.svg"  alt=""></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=27"><h3>Lame</h3></a>
            
        </div>
        <div class="overlay">
          
        </div>
    </div>

    
           <div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=31"> <img src="website/all/scissor.svg"  alt=""></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=31"><h3>Ciseaux</h3></a>
            
        </div>
        <div class="overlay">
          
        </div>
    </div>

     
    

    </div>
</section>

 saloon products section ends -->
<!-- parlor products section starts -->
<!--

<section class="parlor" id="parlor">

<h1 class="heading"> <span>NETTOYAGE</span> </h1>

<div class="box-container">
<div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=49"> <img src="website/all/detergent.jpg"  alt="" width="200"></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=49"><h3>Detergent</h3></a>
            
        </div>
        <div class="overlay">
          
        </div>
    </div>
 Trimer End  -->
 <!--
    
    <div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=50">  <img src="website/all/deo.jpg" alt="" width="200"></a>
        </div>
        <div class="info">
          <a href="trimer.php?p_cat=50">  <h3>Deodorant</h3></a>
           
        </div>
        <div class="overlay">
        
        </div>
    </div>

    <div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=51"> <img src="website/all/face.jpg" alt="" width="200"></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=51"> <h3>Lavage du visage</h3></a>
           
        </div>
        <div class="overlay">
    </div>



</div>


<div class="box">
       
<div class="box">

        <div class="image">
           <a href="trimer.php?p_cat=53"> <img src="website/all/harp.jpg"  alt="" width="200"></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=53"><h3>Harpique</h3></a>
            
        </div>
        <div class="overlay">
          
        </div>
    </div>


    <div class="box">
         <div class="image">
             <a href="trimer.php?p_cat=57"> <img src="website/all/soap.jpg"  alt="" width="250"></a>
          </div>
          <div class="info">
              <a href="trimer.php?p_cat=57"><h3>Savon de Bain</h3></a>
         </div>
          <div class="overlay">
          
        </div>
    </div>

     <div class="box">
        <div class="image">
           <a href="trimer.php?p_cat=58"> <img src="website/all/toth.jpg"  alt="" width="250"></a>
        </div>
        <div class="info">
            <a href="trimer.php?p_cat=58"><h3>Dentifrice</h3></a>
            
        </div>
        <div class="overlay">
          
        </div>
    </div>


    </div>
</section>


<section class="deal" id="deal">

<h1 class="heading"> <span> Meilleure Offre </span> </h1>


<div class="icons-container"> 
    --

<?php

$get_boxes="select * from boxes_section";
$run_box=mysqli_query($con,$get_boxes);
while ($row=mysqli_fetch_array($run_box)) {
    $box_id=$row['box_id'];
    $box_title=$row['box_title'];
    $box_desc=$row['box_desc'];
    $box_icon=$row['box_icon'];
    


  ?>

    <div class="icons">
        <i class="<?php echo $box_icon; ?>"></i>
        <h3><?php echo $box_title ?></h3>
        <p><?php echo $box_desc ?></p>

    </div>

    
    <?php } ?>
</div>

</section>

>

<section class="newsletter" id="newsletter">

    <h1>Nouveauté</h1>
    <p>les dernières réductions et mises à jour</p>
    <form action="contactus.php" method="post">

                  
                        <input type="text" placeholder="Entrer Votre Nom" ><br>
                   
                    
        <input type="email" placeholder="Entrer Votre Email">

                        <textarea type="txt" placeholder="Entrer Votre Message"></textarea>
                  
        <input type="submit" class="btn" >
    </form>
-->
</section>

  <footer class="footer" id="footer">
     <div class="cuntainer">
        <div class="wolf">
           
            <div class="footer-ol">
                <h4>Djom's</h4>
                <ul>
                    <li><a href="#">à propos</a></li><br><br>
                    <li><a href="#">Nos services</a></li><br><br>
                                   
                </ul>
            </div>
            <div class="footer-ol">
                <h4>Aide</h4>
                <ul>
                    
                    <li><a href="#">expédition</a></li><br><br>
                    <li><a href="#">Retour</a></li><br><br>
                    <li><a href="#">statut de la commande</a></li><br><br>
                    <li><a href="#">options de paiement
</a></li><br><br>
                </ul>
            </div>
            <div class="footer-ol">
                <h4>magasin en ligne
</h4>
                <ul>
                    
                                    <li><a href="trimer.php?cat_id=11">Autres</a></li><br><br>
                </ul>
            </div>
            <div class="footer-ol">
                <h4>Nous Suivre</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f fa-x" style="color: #3b5998;"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-x" style="color: #0084b4;"></i></a>
                    <a href="#"><i class="fab fa-instagram fa-x" style="color:   #E1306C;"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in fa-x" style="color:  #0077B5 ;"></i></a>

                </div>
            </div>
            <div class="pal">
                
            </div>
            <p class="credit">Copyright &copy; <span>2024</span> | tous droits réservés.
 |<span>3IL3</span></p>
        </div>
     </div>
  </footer>

  </nav></div></header>  


<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- owl carousel js file cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- custom js file link  -->
<script src="main/js.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";

}
</script>



</body>
</html>

