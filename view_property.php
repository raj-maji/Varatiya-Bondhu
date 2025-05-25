<?php  
include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:home.php');
}

include 'components/save_send.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Property</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="view-property">
   <h1 class="heading">property details</h1>

   <?php
   $select_properties = $conn->prepare("SELECT * FROM `property` WHERE id = ? ORDER BY date DESC LIMIT 1");
   $select_properties->execute([$get_id]);
   if($select_properties->rowCount() > 0){
      while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){

         $property_id = $fetch_property['id'];

         $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_user->execute([$fetch_property['user_id']]);
         $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

         $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
         $select_saved->execute([$fetch_property['id'], $user_id]);
   ?>
   <div class="details">
      <div class="swiper images-container">
         <div class="swiper-wrapper">
            <?php
            // Loop through image_01 to image_05
            for($i = 2; $i <= 5; $i++) {
               $image_field = 'image_0' . $i;
               if(!empty($fetch_property[$image_field])) {
                  $image_path = 'uploaded_files/' . $fetch_property[$image_field];
                  if(file_exists($image_path)) {
                     echo '<div class="swiper-slide"><img src="' . $image_path . '" alt=""></div>';
                  }
               }
            }
            ?>
         </div>
         <div class="swiper-pagination"></div>
      </div>

      <?php if(!empty($fetch_property['video_01'])){ ?>
         <div class="video-container" style="margin-top: 1rem; text-align: center;">
            <video controls style="max-width: 100%; border-radius: 1rem; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
               <source src="uploaded_files/<?= $fetch_property['video_01']; ?>" type="video/mp4">
               Your browser does not support the video tag.
            </video>
         </div>
      <?php } ?>

      <h3 class="name"><?= $fetch_property['property_name']; ?></h3>
      <p class="location">
         <i class="fas fa-map-marker-alt" style="color: #e74c3c;"></i>
         <span><?= $fetch_property['address']; ?></span>
         <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($fetch_property['address']); ?>" target="_blank" title="View on Google Maps" class="map-icon-link">
            <i class="fas fa-location-arrow"></i>
         </a>
      </p>

      <div class="info">
         <p><i class="fas fa-indian-rupee-sign"></i><span><?= $fetch_property['price']; ?></span></p>
         <p><i class="fas fa-user"></i><span><?= $fetch_user['name']; ?></span></p>
         <p><i class="fas fa-phone"></i><a href="tel:<?= $fetch_user['number']; ?>"><?= $fetch_user['number']; ?></a></p>
         <p><i class="fas fa-building"></i><span><?= $fetch_property['type']; ?></span></p>
         <p><i class="fas fa-calendar"></i><span><?= $fetch_property['date']; ?></span></p>
      </div>

      <h3 class="title">details</h3>
      <div class="flex">
         <div class="box">
            <p><i>rooms :</i><span><?= $fetch_property['bhk']; ?> BHK</span></p>
            <p><i>deposit amount : </i><span><i class="fas fa-indian-rupee-sign"></i><?= $fetch_property['deposite']; ?></span></p>
            <p><i>status :</i><span><?= $fetch_property['status']; ?></span></p>
            <p><i>bedroom :</i><span><?= $fetch_property['bedroom']; ?></span></p>
            <p><i>bathroom :</i><span><?= $fetch_property['bathroom']; ?></span></p>
            <p><i>balcony :</i><span><?= $fetch_property['balcony']; ?></span></p>
         </div>
         <div class="box">
            <p><i>carpet area :</i><span><?= $fetch_property['carpet']; ?> sqft</span></p>
            <p><i>age :</i><span><?= $fetch_property['age']; ?> years</span></p>
            <p><i>total floors :</i><span><?= $fetch_property['total_floors']; ?></span></p>
            <p><i>room floor :</i><span><?= $fetch_property['room_floor']; ?></span></p>
            <p><i>furnished :</i><span><?= $fetch_property['furnished']; ?></span></p>
         </div>
      </div>

      <h3 class="title">description</h3>
      <p class="description"><?= $fetch_property['description']; ?></p>

      <form action="" method="post" class="flex-btn">
         <input type="hidden" name="property_id" value="<?= $property_id; ?>">
         <?php if($select_saved->rowCount() > 0){ ?>
            <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>saved</span></button>
         <?php } else { ?>
            <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>save</span></button>
         <?php } ?>
         <input type="submit" value="send enquiry" name="send" class="btn">
      </form>

<div id="pay-d">
   <button type="button" class="btn" id="pay">Pay Now</button>
</div>

<div id="upi-section" style="display: none; text-align: center; margin-top: 2rem; border: 2px dashed #4CAF50; padding: 20px;">
   <h3>Pay via UPI</h3>
   <p><strong>Owner Name:</strong> <?= htmlspecialchars($fetch_user['name']); ?></p>
   <p><strong>UPI ID:</strong> <?= htmlspecialchars($fetch_user['upi_id']); ?></p>
   <p><strong>Amount:</strong> ₹<?= $fetch_property['price']; ?></p>

   <?php
   // Generate UPI Payment URL
   $upi_id = $fetch_user['upi_id'];
   $owner_name = urlencode($fetch_user['name']);
   $amount = $fetch_property['price'];
   $note = urlencode("Rent for " . $fetch_property['property_name']);
   $upi_url = "upi://pay?pa={$upi_id}&pn={$owner_name}&am={$amount}&cu=INR&tn={$note}";
   $qr_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($upi_url);
   ?>
   
   <p style="margin-top: 1rem;">Open any UPI app (PhonePe, GPay, Paytm)</p>
</div>


   <?php
      }
   } else {
      echo '<p class="empty">property not found! <a href="post_property.php" style="margin-top:1.5rem;" class="btn">add new</a></p>';
   }
   ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
<?php include 'components/message.php'; ?>

<script>
var swiper = new Swiper(".images-container", {
   effect: "coverflow",
   grabCursor: true,
   centeredSlides: true,
   slidesPerView: 2,
   loop: true,
   coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 100,
      modifier: 2,
      slideShadows: true,
   },
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
   },
});

</script>

<style>
#pay-d {
   max-width: 1200px;
   display: flex;
   justify-content: center;
   margin-top: 1rem;
}
#pay {
   width: 200px;
}
.video-container video {
   width: 50%;
   max-height: 300px;
   object-fit: cover;
}
.map-icon-link:hover {
   background-color: rgb(244, 239, 239);
}
.map-icon-link i {
   font-size: 20px;
}
</style>
<script>
document.getElementById("pay").addEventListener("click", function() {
   document.getElementById("upi-section").style.display = "block";
   this.style.display = "none"; // Hide Pay button
});
</script>

</body>
</html>
