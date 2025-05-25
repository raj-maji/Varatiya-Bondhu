<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Form</title>

     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">


</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="container">
  <div style="text-align:center">
    <h2>Information of User for payment</h2>
  </div>
  <div class="row">
    <div class="column">
      <form action="payment.php">
      <label for="name">Name</label>
      <input type="tel" name="name" required maxlength="50" placeholder="enter your name" class="box">
      
      <label for="email">Email</label>
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">

      <label for="upi">UPI ID</label>
      <input type="text" id="upi" name="upi" required maxlength="50" 
       placeholder="Enter your UPI ID" class="box"
       pattern="[a-zA-Z0-9.\-_]+@[a-zA-Z]+" 
       title="Please enter a valid UPI ID (e.g., yourname@bank)">

       
      <label for="number">Enter your phone number:</label>
      <input type="tel" name="telphone"  pattern="[0-9]{10}"  title="Ten digits code" required/>    

        <input type="submit" value="Pay now">
      </form>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    color: #333;
    line-height: 1.6;
}

/* Container Styling */
.container {
    max-width: 600px;
    margin: 50px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Header Styles */
.container h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-size: 28px;
}

/* Form Labels */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    font-size:16px;
    color: #555;
}

/* Form Inputs */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

/* Input Focus Effects */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="number"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.2);
}

/* Textarea */
textarea {
    resize: vertical;
    height: 100px;
}

/* Submit Button */
input[type="submit"] {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    input[type="submit"] {
        font-size: 14px;
    }
}

</style>



</body>
</html>