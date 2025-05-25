<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- about section starts  -->

<section class="about">

   <div class="row">
      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>
      <div class="content">
         <h3>why choose us?</h3>
         <p>Welcome to Varatiya Bondhu! We make finding your perfect room simple, affordable, and stress-free. With a wide variety of options, transparent pricing, and reliable service, we’re here to help you find the best rental that fits your needs. Choose us for convenience, trust, and quality.</p>
         <a href="contact.php" class="inline-btn">contact us</a>
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="heading">3 simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>search property</h3>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>contact agents</h3>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy property</h3>
      </div>

   </div>

</section>

<!-- steps section ends -->


<!-- review section starts  -->

<section class="reviews">

   <h1 class="heading">client's reviews</h1>

   <div class="box-container">
      <?php
         $select_reviews = $conn->prepare("SELECT * FROM reviews ORDER BY created_at DESC");
         $select_reviews->execute();

         if($select_reviews->rowCount() > 0){
            while($review = $select_reviews->fetch(PDO::FETCH_ASSOC)){
               $full_stars = floor($review['rating']);
               $half_star = ($review['rating'] - $full_stars >= 0.5);
      ?>
      <div class="box">
         <div class="user">
            <div>
               <h3><?= htmlspecialchars($review['name']) ?></h3>
               <div class="stars">
                  <?php for($i = 0; $i < $full_stars; $i++): ?>
                     <i class="fas fa-star"></i>
                  <?php endfor; ?>
                  <?php if($half_star): ?>
                     <i class="fas fa-star-half-alt"></i>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <p><?= htmlspecialchars($review['feedback']) ?></p>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No reviews yet.</p>';
         }
      ?>
   </div>

</section>


<!-- review section ends -->
<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>