<?php
   require("./Movie.php");
   session_start([
    'cookie_lifetime' => 0, 
    'gc_maxlifetime' => 3600
]);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylenew.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;700;800&family=Sen:wght@700&display=swap" rel="stylesheet">
    <title>MOVIELANE</title>
    <script src="https://kit.fontawesome.com/dc49a974a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .trailer {
            margin-bottom: 20px;
        }
        .trailer img {
            width: 100px; 
            height: auto; 
            margin-bottom: 10px;
        }
        .trailer p {
            margin-bottom: 5px;
        }
        .showTrailer {
            background-color: green; 
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width:300px;
        }

        .bookTickets {
            background-color: red; 
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width:300px;
        }
        .trailer-container {
            display: none;
            margin-top: 10px;

        }
        .trailer-container iframe {
            width: 100%;
            height: 300px; 
            border: none;
        }
        .movie-title {
    color: blue; 
}
.error-message {
            text-align: center;
            font-size: 24px;
            color: red;
            margin-top: 20px; 
        }
        .profile-icon {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .profile-dropdown:hover .dropdown-content {
            display: block;
        }
        .footer-content {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center items horizontally */
}

.footer-content a {
    margin-bottom: 10px; /* Add margin below the button */
}


</style>
</head>
<body>
<div class="background-animation"></div>

<div class="navbar">
    <div class="navbar-container">
        <img src="./img/lo.png" style="width:150px; height:50px;">
        <div class="logo-container"><h1 class="logo">MOVIELANE </h1></div>

        <div>
            <a href="./search.html" class="my-btn">
                <i class="fa fa-search"></i> Search Movie by Title
            </a>
        </div>

        <div class="nav-buttons">
        <?php
        
        if (isset($_SESSION['user_id'])) {
            // If logged in, display the profile icon with dropdown menu
            echo '<div class="profile-dropdown">';
            echo '<button class="profile-icon"><i class="fas fa-user"></i></button>';
            echo '<div class="dropdown-content">';
            echo '<a href="/editProfile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>';
            echo '<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>';
            echo '</div>';
            echo '</div>';
        } else {
            // If not logged in, display the "LOGIN" and "REGISTER" buttons
            echo '<a href="/loginn.php"><button id="loginBtn">LOGIN</button></a>';
            echo '<a href="/creaAccount.html"><button id="registerBtn">REGISTER</button></a>';
        }
        ?>
         
        </div>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script>
    // JavaScript to close dropdown menu when clicking outside
    document.addEventListener("click", function(event) {
        var profileDropdown = document.querySelector(".profile-dropdown");
        if (!profileDropdown.contains(event.target)) {
            var dropdownContent = profileDropdown.querySelector(".dropdown-content");
            dropdownContent.style.display = "none";
        }
    });
</script>
        
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="flex-box">
            <div id="myCarousel" class="carousel slide" >
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <iframe width="100%" height="345" src="https://www.youtube.com/embed/qQlr9-rF32A">
                        </iframe>
                    </div>

                    <div class="item">
                        <iframe width="100%" height="345" src="https://www.youtube.com/embed/gYA5WOFhd-Y">
                        </iframe>
                    </div>

                    <div class="item">
                        <iframe width="100%" height="345" src="https://www.youtube.com/embed/ss2KvK-w6w8">
                        </iframe>
                    </div>
                </div>

                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


        </div>
    </div>
</div>
<div class="movie-list-container">
            <div class="movie-list-header">
                <h1 class="movie-list-title">Now Playing</h1>
                <i class="arrow fa-solid fa-chevron-right"></i>
            </div>

        

            <section class="trailerList">
            <?php foreach ($movieInfs as $movieInf) : ?>
    <?php if ($movieInf['comingSoon'] == 0) : ?>
        <div class="trailer" style="display: inline-block; margin-right: 20px;">
            <img src="<?php echo $movieInf['picture']; ?>" alt="<?php echo $movieInf['title']; ?>" style="width: 300px; height: 300px;">
            <p class='movie-title'><?php echo $movieInf['title']; ?></p>
            <p class='rating'>Rating: <?php echo $movieInf['reviews']; ?></p>
            <!-- Form to submit selected movie information -->

            <form method="POST" action="sh.php">
                <input type="hidden" name="selected_movie_id" value="<?php echo $movieInf['id']; ?>">
                <input type="hidden" name="selected_movie_title" value="<?php echo $movieInf['title']; ?>">
                <button type='submit' class='bookTickets'>Book Tickets</button>
            </form>
            <!-- Button to watch trailer -->
            <button class='showTrailer' onclick="toggleTrailer(this, '<?php echo $movieInf['trailer']; ?>')">Watch Trailer</button>
            <!-- Trailer container -->
            <div class='trailer-container'>
                <iframe width='400' height='800' src='<?php echo $movieInf['trailer']; ?>'></iframe>
            </div>
        </div>
        <?php endif; ?>
<?php endforeach; ?>
</section>


<script>
    function toggleTrailer(button, trailerUrl) {
        var trailerContainer = button.nextElementSibling;

        if (trailerContainer.style.display === "none" || trailerContainer.style.display === "") {
            trailerContainer.style.display = "block";
            button.textContent = "Hide Trailer";
        } else {
            trailerContainer.style.display = "none";
            button.textContent = "Watch Trailer";
        }
    }
</script>
<div class="movie-list-header">
                <h1 class="movie-list-title">Coming Soon</h1>
                <i class="arrow fa-solid fa-chevron-right"></i>
            </div>

        

            <section class="trailerList">
                        <?php foreach ($movieInfs as $movieInf) : ?>
                <?php if ($movieInf['comingSoon'] == 1) : ?>
                    <div class="trailer" style="display: inline-block; margin-right: 20px;">
                        <img src="<?php echo $movieInf['picture']; ?>" alt="<?php echo $movieInf['title']; ?>" style="width: 300px; height: 300px;">
                        <p class='movie-title'><?php echo $movieInf['title']; ?></p>
                        <p class='rating'>Rating: <?php echo $movieInf['reviews']; ?></p>
                        <!-- Form to submit selected movie information -->

                        <form method="POST" action="sh1.php">
                            <input type="hidden" name="selected_movie_id" value="<?php echo $movieInf['id']; ?>">
                            <input type="hidden" name="selected_movie_title" value="<?php echo $movieInf['title']; ?>">
                            <button type='submit' class='bookTickets'>Book Tickets</button>
                        </form>
                        <!-- Button to watch trailer -->
                        <button class='showTrailer' onclick="toggleTrailer(this, '<?php echo $movieInf['trailer']; ?>')">Watch Trailer</button>
                        <!-- Trailer container -->
                        <div class='trailer-container'>
                            <iframe width='400' height='800' src='<?php echo $movieInf['trailer']; ?>'></iframe>
                        </div>
                    </div>
                    <?php endif; ?>
            <?php endforeach; ?>
            </section>



<script>
    function toggleTrailer(button, trailerUrl) {
        var trailerContainer = button.nextElementSibling;

        if (trailerContainer.style.display === "none" || trailerContainer.style.display === "") {
            trailerContainer.style.display = "block";
            button.textContent = "Hide Trailer";
        } else {
            trailerContainer.style.display = "none";
            button.textContent = "Watch Trailer";
        }
    }
</script>
</div>

<footer class="copyright">
    <div class="footer-content">
        <a href="/loginn.php"><button>Superuser ? </button></a>
        <p>&copy; SEPROJECT <span id="ano"></span></p>
    </div>
</footer>


    </div>
    <script src="index.js"></script>
<script>
    $(document).ready(function () {
        $('.owl-one').owlCarousel({
            stagePadding: 280,
            loop: true,
            margin: 20,
            nav: true,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 1000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 1,
                    stagePadding: 40,
                    nav: false
                },
                480: {
                    items: 1,
                    stagePadding: 60,
                    nav: true
                },
                667: {
                    items: 1,
                    stagePadding: 80,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true
                }
            }
        })
    })
</script>
<script>


        const year = document.querySelector('#ano');
        ano.innerHTML = new Date().getFullYear();
    </script>

</body>
</html>