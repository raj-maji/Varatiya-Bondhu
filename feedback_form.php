<?php
include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $name = $_POST['name'];
   $rating = floatval($_POST['rating']);
   $feedback = $_POST['feedback'];

   $insert_review = $conn->prepare("INSERT INTO reviews (name, rating, feedback) VALUES (?, ?, ?)");
   $insert_review->execute([$name, $rating, $feedback]);

   $success = "Feedback submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Submit Feedback</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Submit Your Feedback</h3>
      <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
      <input type="text" name="name" required placeholder="Your Name" class="box">
      <select name="rating" required class="box">
         <option value="">Select Rating</option>
         <option value="5">5 - Excellent</option>
         <option value="4.5">4.5 - Very Good</option>
         <option value="4">4 - Good</option>
         <option value="3.5">3.5 - Average</option>
         <option value="3">3 - Below Average</option>
      </select>
      <textarea name="feedback" required placeholder="Your feedback..." class="box" rows="5"></textarea>
      <input type="submit" value="Submit Feedback" class="btn">
   </form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>
