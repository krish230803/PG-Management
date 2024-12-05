
<?php
session_start();
error_reporting(0);
include('db.php');
$user=$_SESSION['uname'];
$img=$_SESSION['img0'];


?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Management System</title>

    <!-- Swiper JS CSS-->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <!-- Scroll Reveal -->
    <link rel="stylesheet" href="css/scrollreveal.min.js">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>
<body>
<!-- Header -->
    <header class="header">
            <nav class="nav container flex">
                    <a href="#" class="logo-content flex" >
                        <ion-icon name="home-outline"  class="nav-link"></ion-icon>
                        <span class="logo-text">PG Management System</span>
                    </a>

                    <div class="menu-content">
                            <ul class="menu-list flex">
                                    <li><a href="#home" class="nav-link active-navlink">home</a></li>
                                    <li><a href="#about" class="nav-link">about</a></li>
                                    <li><a href="#menu" class="nav-link">Services</a></li>
                                    <li><a href="#review" class="nav-link">review</a></li>
                       
                            </ul>
                           
                            <div class="media-icons flex">
                                    <a href="https://www.facebook.com"><i class='bx bxl-facebook'></i></a>
                                    <a href="https://twitter.com/i/flow/login"><i class='bx bxl-twitter' ></i></a>
                                    <a href="https://www.instagram.com/accounts/login"><i class='bx bxl-instagram-alt' ></i></a>
                                    <a href="https://github.com/login"><i class='bx bxl-github'></i></a>
                                    <a href="https://www.youtube.com/login"><i class='bx bxl-youtube'></i></a>
                            </div>

                            <i class='bx bx-x navClose-btn'></i>
                        </div>
                        
                        <div class="contact-content flex">
                        <a href="search/index.php"><ion-icon name="search-outline" class="nav-link" style="height:20px; width: 20px;"></ion-icon></a>
                            <i class='bx bx-phone phone-icon' ></i>
                            <span class="phone-number">0022-0303-2030</span>
                        </div>
                        <div>
                                <?php
                                if($user== true && $img == true){
                                echo '<a href="edit_profile.php">
                                        <img id="log" src="'. $img .'" style="display: inline-block; height:50px; width:50px; border-radius: 50%"> </a>';
                                }
                              else{   
                              echo '<a href="edit_profile.php">
                              <ion-icon class="nav-link" name="person-circle-outline" style="height:50px; width:50px;"></ion-icon> </a> ';} ?>
                        </div>
                        <div>
                        <span class="nav-link"> <?php
                if($user== true){
                        echo $user;
                }
                 ?></span> <br>
                        <span > <?php
                if($user== true){   
                  
                echo '<a class="nav-link" href="logout.php">LOGOUT</a>'; } ?> </span>
                        </div>
                        <div>
                                <?php if($user == false){
                                   echo ' <button type="submit" id= "log1" name="login" style="width:100px;"><a href="login.php" style="text-decoration: none; color: inherit;">Login</a></button>
                                   <button type="submit" id= "log1" name="signup" style="width:100px;"><a href="registration.php" style="text-decoration: none; color: inherit;">Sign up</a></button>';     
                                } ?>

                       

                        </div>
                       
                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
                
    </header>

<!-- Home Section -->
    <main>
        <section class="home" id="home">
                <div class="home-content">
                        <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                                <img src="images/homeImg1.jpg" alt="" class="home-img">

                                                <div class="home-details">
                                                        <div class="home-text">
                                                                <h4 class="homeSubtitle">PG Accomodation for Every day living.</h4>
                                                                <h2 class="homeTitle">Comfortable<br> Perfect Place to Live</h2>
                                                        </div>

                                                        <button class="button"><a href = "search/index.php">Explore</a></button>
                                                </div>
                                        </div>

                                        <div class="swiper-slide">
                                                <img src="images/homeImg2.jpg" alt="" class="home-img">

                                                <div class="home-details">
                                                        <div class="home-text">
                                                                <h4 class="homeSubtitle">Living Spaces with thoughtful Designs.</h4>
                                                                <h2 class="homeTitle">Exciting </h2>
                                                        </div>

                                                        <button class="button"><a href = "search/index.php">Explore</a></button>
                                                </div>
                                        </div>

                                        
                                </div>

                                <div class="swiper-button-next swiper-navBtn"></div>
                                <div class="swiper-button-prev swiper-navBtn"></div>
                                <div class="swiper-pagination"></div>
                        </div>
                </div>
        </section>

    
<!-- About Section -->
        <section class="section about" id="about">
                <div class="about-content container">
                        <div class="about-imageContent">
                                <img src="images/aboutImg.jpg" alt="" class="about-img">

                        </div>

                        <div class="about-details">
                                <div class="about-text">
                                        <h4 class="content-subtitle"><i>Our Management Services</i></h4>
                                        <h2 class="content-title">We Combine Classics <br> and Modernity</h2>
                                        <p class="content-description">We provide a platform to user that is useful for easily finding of PG near to work-place, We also provide information of our Food Provider.
                                               </p>

                                        <ul class="about-lists flex">
                                                <li class="about-list">Living Place</li>
                                                <li class="about-list dot">.</li>
                                                <li class="about-list">Peaceful</li>
                                                <li class="about-list dot">.</li>
                                                <li class="about-list">Wifi</li>
                                        </ul>
                                </div>

                                <div class="about-buttons flex">
                                        <button class="button"><a href="contact.php" style="color: white; text-decoration: none">Contact Us</a></button>
                                        <a href="#" class="about-link flex">
                                                <span class="link-text">see more</span>
                                                <i class='bx bx-right-arrow-alt about-arrowIcon'></i>
                                        </a>
                                </div>
                        </div>

                </div>
        </section>

    
<!-- Menu Section -->
        <section class="section menu" id="menu">
            <div class="menu-container container">
                    <div class="meu-text">
                            <h4 class="section-subtitle"><i>Services</i></h4>
                            <h2 class="section-title">Our Top PGs</h2>
                            <p class="section-description">
                                This services are provide to you for your batter living experience, so that you don't have any kind of problem.
                            </p>
                    </div>

                    <div class="menu-content">
                    <div class="menu-items">
    <?php
    include('db.php');
    $pg_ids = array(17, 16, 21, 23);
    $pg_ids_string = implode(",", $pg_ids);
    $query = "SELECT `id`, `pg_name`, `image`, `description`, `price` FROM pginfo WHERE id IN ($pg_ids_string)";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pg_id = $row['id'];
            $pg_name = $row['pg_name'];
            $pg_image = $row['image'];
            $description = $row['description']; // Manually added description
            $price = $row['price']; // Manually added price
            ?>
            <div class="menu-item flex">
                <img src="search/DATA/<?php echo $pg_image; ?>" alt="" class="menu-img">
                <div class="menuItem-details">
                    <h4 class="menuItem-topic"><?php echo $pg_name; ?></h4>
                    <p class="menuItem-des"><?php echo $description; ?></p> <!-- Display manually added description -->
                </div>
                <div class="menuItem-price flex">
                    <span class="discount-price"><?php echo '₹' . $price; ?></span> <!-- Display manually added price -->
                    <button type="submit" id="log1" name="explore" style="width:100px;">
                        <a href="search/pg_details.php?id=<?php echo $pg_id; ?>" style="text-decoration: none; color: inherit;">Explore</a>
                    </button>
                </div>
            </div>
        <?php
        }
    } else {
        echo "No PGs found.";
    }
    mysqli_close($con);
    ?>
</div>


                            <div class="time-table">
                                    <span class="time-topic">PG Office Time</span>

                                    <ul class="time-lists">
                                            <li class="time-list flex">
                                                    <span class="open-day"> Sunday</span>
                                                    <span class="open-time">Closed</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Monday</span>
                                                    <span class="open-time">9.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Tuesday</span>
                                                    <span class="open-time">9.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Wednesday</span>
                                                    <span class="open-time">9.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Thursday</span>
                                                    <span class="open-time">9.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Friday</span>
                                                    <span class="open-time">9.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Saturday</span>
                                                    <span class="open-time">9.00am - 12.00pm</span>
                                            </li>
                                    </ul>
                            </div>
                    </div>
            </div>
        </section>


        <section class="section menu" id="menu">
            <div class="menu-container container">
                    <div class="meu-text">
                            <h4 class="section-subtitle"><i>Services</i></h4>
                            <h2 class="section-title">Our Top Food Provider</h2>
                            <p class="section-description">
                                This services are provide to you for your batter living experience With better food experience.
                            </p>
                    </div>

                    <div class="menu-content">
                            <div class="menu-items">
                                    <div class="menu-item flex">
                                            <img src="images/gramin_bhojanalaya.jpg" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Gramin Bhojanalaya</h4>
                                                    <p class="menuItem-des">Here we provide pure and Khathiyawadi food and it is available on afternoon and evening.</p>
                                            </div>

                                    </div>
                                    <div class="menu-item flex">
                                            <img src="images/ashapura_bhojanalaya.jpg" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Ashapura Bhojanalaya</h4>
                                                    <p class="menuItem-des">Here we provider pure gujarati food at 60 rs and also provide tiffin service at 80rs.</p>
                                            </div>

                                    </div>
                                    <div class="menu-item flex">
                                            <img src="images/satadhar_bhojanalaya.jpg" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Satadhar Bhojanalaya</h4>
                                                    <p class="menuItem-des">Here we provide kathiyawadi, Gujarati and Panjabi food and also provide tiffin service adn take away service</p>
                                            </div>

                                           
                                    </div>
                                    
                            </div>
                 </div>
            </div>
        </section>
    

<!-- Reviews Section -->
        <section class="section review" id="review">
            <div class="review-container container">
                    <div class="review-text">
                            <h4 class="section-subtitle"><i>Reviews</i></h4>
                            <h2 class="section-title">What User Says</h2>
                            <p class="section-description">Some reviews that user gave about the living experience and facilities that provide in the PG.</p>
                    </div>

                    <div class="tesitmonial swiper mySwiper">
                            <div class="swiper-wrapper">
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/profileImg2.jpg" alt="" class="review-img">
                                            <p class="review-quote">The affordable pricing and excellent amenities, including high-speed internet and laundry services, make it an excellent choice for anyone looking for a reliable and friendly place to stay.</p>
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Krupali chavda</span>
                                                    <span class="job">Student</span>
                                            </div>
                                    </div>
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/profileImg1.jpg" alt="" class="review-img">
                                            <p class="review-quote">I couldn't have asked for a better PG accommodation. The security measures in place, such as 24/7 security personnel and secure access control systems, provided me with peace of mind throughout my stay</p>
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Saurabh Joshi</span>
                                                    <span class="job">Employee</span>
                                            </div>
                                    </div>
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/profileImg3.jpg" alt="" class="review-img">
                                            <p class="review-quote">I recently stayed at this PG accommodation and had a wonderful experience. The rooms were clean, cozy, and well-maintained, making it a comfortable living space.</p>
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Nisarg Panya</span>
                                                    <span class="job">Student</span>
                                            </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next swiper-navBtn"></div>
                                <div class="swiper-button-prev swiper-navBtn"></div>
                                <div class="swiper-pagination"></div>
                    </div>
            </div>
        </section>

    
<!-- Newsletter Section -->
        <section class="section newsletter">
            <div class="newletter-container container">
                <a href="#" class="logo-content flex">
                        <!-- <i class='bx bx-coffee logo-icon'></i>
                        <span class="logo-text">Coffee.</span>
                    </a>

                    <p class="section-description">This is the perfect place to find a nice and cozy spot to sip some. You'll find the Java Jungle, Coffee Bean and more shops right in this website.</p>

                    <div class="newsletter-inputBox">
                            <input type="email" placeholder="emai@example.com" class="newletter-input">
                            <button class="button newsletter-button">Subscribe</button>
                    </div> -->

                    <div class="newsletter media-icons flex">
                        <a href="https://www.facebook.com"><i class='bx bxl-facebook'></i></a>
                        <a href="https://twitter.com/i/flow/login"><i class='bx bxl-twitter' ></i></a>
                        <a href="https://www.instagram.com/accounts/login"><i class='bx bxl-instagram-alt' ></i></a>
                        <a href="https://github.com/login"><i class='bx bxl-github'></i></a>
                        <a href="https://www.youtube.com/login"><i class='bx bxl-youtube'></i></a>
                </div>
            </div>
        </section>
        
    
<!-- Footer Section -->
        <!-- <footer class="section footer">
            <div class="footer-container container">
                    <div class="footer-content">
                        <a href="#" class="logo-content flex">
                                <i class='bx bx-coffee logo-icon'></i>
                                <span class="logo-text">Coffee.</span>
                            </a>

                            <p class="content-description">Coffee is a cafe that serve many variant of coffee and other dishes with very comfortable place.</p>

                            <div class="footer-location flex">
                                <i class='bx bx-map map-icon'></i>
                                
                                <div class="location-text">
                                        USA Californa 65 South Fifth St.Sicklerville, NJ 08081
                                </div>
                            </div>
                    </div>

                    <div class="footer-linkContent">
                            <ul class="footer-links">
                                    <h4 class="footerLinks-title">Facility</h4>

                                    <li><a href="#" class="footer-link">Private Room</a></li>
                                    <li><a href="#" class="footer-link">Meeting Room</a></li>
                                    <li><a href="#" class="footer-link">Event Room</a></li>
                                    <li><a href="#" class="footer-link">Creative Studio</a></li>
                                    <li><a href="#" class="footer-link">Custom Room</a></li>
                            </ul>
                            <ul class="footer-links">
                                    <h4 class="footerLinks-title">Facility</h4>

                                    <li><a href="#" class="footer-link">Coffee</a></li>
                                    <li><a href="#" class="footer-link">Beverages</a></li>
                                    <li><a href="#" class="footer-link">Dishes</a></li>
                            </ul>
                            <ul class="footer-links">
                                    <h4 class="footerLinks-title">Support</h4>

                                    <li><a href="#" class="footer-link">About Us</a></li>
                                    <li><a href="#" class="footer-link">FAQs</a></li>
                                    <li><a href="#" class="footer-link">Private Policy</a></li>
                                    <li><a href="#" class="footer-link">Help Us</a></li>
                            </ul>
                    </div>
            </div>
            <div class="footer-copyRight">&#169; CodingLab. All rigths reserved</div>
        </footer> -->

<!-- Scroll Up -->
        <a href="#home" class="scrollUp-btn flex">
                <i class='bx bx-up-arrow-alt scrollUp-icon'></i>
        </a>

</main>

<!-- Swiper JS -->
<script src="js/swiper-bundle.min.js"></script>

<!-- Scroll Reveal -->
<script src="js/scrollreveal.js"></script>

<!-- JavaScript -->
    <script src="js/script.js"></script>
</body>
</html>