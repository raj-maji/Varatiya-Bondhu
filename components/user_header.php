<!-- header section starts  -->

<header class="header">

   <nav class="navbar nav-1">
      <section class="flex">
         <a href="home.php" class="logo"><i class="fa-solid fa-people-roof"></i>Varatiya Bondhu</a>

         <ul>
            <li><a class="nav-post" href="post_property.php">post property<i class="fas fa-paper-plane" ></i></a></li>
         </ul>
      </section>
   </nav>

   <nav class="navbar nav-2">
      <section class="flex">
         <div id="menu-btn" class="fas fa-bars"></div>

         <div class="menu">
            <ul>
               <li><a href="#">my listings<i class="fas fa-angle-down"></i></a>
                  <ul>
                     <li><a href="dashboard.php">dashboard</a></li>
                     <li><a href="post_property.php">post property</a></li>
                     <li><a href="my_listings.php">my listings</a></li>
                  </ul>
               </li>
               <li><a href="#">options<i class="fas fa-angle-down"></i></a>
                  <ul>
                     <li><a href="search.php">filter search</a></li>
                     <li><a href="listings.php">all listings</a></li>
                  </ul>
               </li>
              <li><a href="#">help<i class="fas fa-angle-down"></i></a>
   <ul>
      <li><a href="about.php">about us</a></li>
      <li><a href="contact.php">contact us</a></li>
      <li><a href="feedback_form.php">feedback</a></li> <!-- Added feedback link -->
   </ul>
</li>

            </ul>
         </div>

         <ul>
            <li><a href="saved.php">saved <i class="far fa-heart"></i></a></li>
            <li><a href="#">account <i class="fas fa-angle-down"></i></a>
               <ul>
                  <?php if($user_id == ''){ ?>
                  <li><a href="login.php">Log in</a></li>
                  <li><a href="register.php">register new</a></li>
                  <li><a href="./admin/login.php">Admin Login</a> <?php } ?></li>

                  <?php if($user_id != ''){ ?>
                  <li><a href="update.php">update profile</a></li>
                  <li><a href="components/user_logout.php" onclick="return confirm('logout from this website?');">logout</a>
                  <?php } ?></li>
               </ul>
            </li>
         </ul>
      </section>
   </nav>

</header>
<style>
.header .navbar.nav-1{
   background-color:rgb(93, 0, 57)

;
}

</style>


<!-- header section ends -->