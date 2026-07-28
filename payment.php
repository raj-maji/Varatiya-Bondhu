<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

include 'components/save_send.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- payment section starts  -->

<section class="contact">

   <div class="row" id="t">
    <P ID="p">
      PAYMENT
    </P>
   </div>
   <div id="t2">
      
   <img src="./images/pay.jpg" alt="pay" width="400" height="500">

   </div>


</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

<style>
   #t{
      justify-content: center;
   }

   #t2{
      display: flex;
      justify-content: center;
   }
   
   #p{
      font-size: 60px;
      font-family: 'Montserrat', sans-serif;
      text-align:center;
   }
</style>


</body>
</html>