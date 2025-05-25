<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $id = create_unique_id();
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $c_pass = sha1($_POST['c_pass']);
    $upi_id = filter_var($_POST['upi_id'], FILTER_SANITIZE_STRING);

    $upload_dir = 'uploaded_images/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $image1 = $_FILES['image1']['name'];
    $image1_tmp_name = $_FILES['image1']['tmp_name'];
    $image1_folder = $upload_dir . $image1;

    $image2 = $_FILES['image2']['name'];
    $image2_tmp_name = $_FILES['image2']['tmp_name'];
    $image2_folder = $upload_dir . $image2;

    $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_users->execute([$email]);

    if ($select_users->rowCount() > 0) {
        $warning_msg[] = 'Email already taken!';
    } else {
        if ($pass != $c_pass) {
            $warning_msg[] = 'Passwords do not match!';
        } else {
            if (move_uploaded_file($image1_tmp_name, $image1_folder) && move_uploaded_file($image2_tmp_name, $image2_folder)) {
                $insert_user = $conn->prepare("INSERT INTO `users` (id, name, number, email, password, image1, image2, upi_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_user->execute([$id, $name, $number, $email, $c_pass, $image1, $image2, $upi_id]);

                if ($insert_user) {
                    $verify_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
                    $verify_users->execute([$email, $pass]);
                    $row = $verify_users->fetch(PDO::FETCH_ASSOC);

                    if ($verify_users->rowCount() > 0) {
                        setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
                        header('location:login.php');
                        exit;
                    } else {
                        $error_msg[] = 'Something went wrong!';
                    }
                }
            } else {
                $error_msg[] = 'Failed to upload images!';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- register section starts  -->

<section class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>create an account!</h3>
      <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="number" name="number" required min="0" max="9999999999" maxlength="10" placeholder="enter your number" class="box">
      <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
      <input type="password" name="c_pass" required maxlength="20" placeholder="confirm your password" class="box">
      <input type="text" name="upi_id" required maxlength="100" placeholder="enter your UPI ID (e.g., name@bank)" class="box">

      <label for="name" style="font-size:18px;">Aadhar Card</label>
      <input type="file" name="image1" required accept="image/*" class="box">

      <label for="name" style="font-size:18px;">Pan Card</label>
      <input type="file" name="image2" required accept="image/*" class="box">

      <p>already have an account? <a href="login.php">login now</a></p>
      <input type="submit" value="register now" name="submit" class="btn">
   </form>
</section>

<!-- register section ends -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
<?php include 'components/message.php'; ?>

</body>
</html>
