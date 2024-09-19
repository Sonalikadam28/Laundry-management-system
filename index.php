<!-- index.php -->
<?php include 'template/header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<style>
    /* CSS for title animation */
    .title-container {
        text-align: center;
        margin-top: 50px;
        opacity: 0;
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Basic CSS for card layout */
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Adjust column width as needed */
        gap: 30px; /* Adjust gap between cards */
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 5px;
        transition: transform 0.3s ease;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif; /* Change font-family */
    }

    .card img {
        width: 100%; /* Make the image fill the entire width of the card */
        height: auto; /* Maintain aspect ratio */
        display: block; /* Ensure the image behaves as a block element */
        transition: transform 0.3s ease; /* Add a smooth transition effect */
    }

    .card-content {
        padding: 15px;
        transition: background-color 0.3s ease;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333; /* Change title font color */
    }

    .card-description {
        font-size: 14px;
        color: #555; /* Change description font color */
    }

    /* Button styling */
    button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: Arial, sans-serif; /* Change font-family */
    }

    button:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    /* Hover effect */
    .card:hover {
        transform: scale(1.05);
    }

    .vision-mission-container {
        max-width: 1200px;
        margin: auto;
        padding: 40px 20px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 2.5rem;
    }

    .vision,
    .mission {
        margin-bottom: 30px;
    }

    .vision h2,
    .mission h2 {
        font-size: 2rem;
        margin-bottom: 15px;
        color: #343a40;
        position: relative;
        padding-bottom: 10px;
    }

    .vision h2::after,
    .mission h2::after {
        content: '';
        width: 50px;
        height: 3px;
        background-color: #007bff;
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .vision p,
    .mission p {
        font-size: 1.2rem;
        color: #555;
        line-height: 1.8;
    }

    .vision-icon,
    .mission-icon {
        font-size: 4rem;
        color: #007bff;
        margin-right: 20px;
    }

    .row {
        align-items: center;
    }

    .why-choose-us {
        max-width: 1200px;
        margin: auto;
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    .heading {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        position: relative;
    }

    .heading::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 50px;
        height: 2px;
        background-color: #f39c12;
        transform: translateY(-50%);
    }

    .benefits {
        font-size: 1.1rem;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .benefits li {
        margin-bottom: 10px;
    }

    .image-container img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url('images/bg_11.png');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center text-center">
                    <div class="col-md-10 col-sm-12 ftco-animate">
                        <h1 class="mb-3">Manage Your Investments Easily and Effectively</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url('images/bg_8.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center text-center">
                    <div class="col-md-10 col-sm-12 ftco-animate">
                        <h1 class="mb-3">Does Your Money Need Speed?</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url('images/bg_10.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center text-center">
                    <div class="col-md-10 col-sm-12 ftco-animate">
                        <h1 class="mb-3">We Help Growing Businesses</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END slider -->

    <div class="vision-mission-container">
        <h1>Our Vision & Mission</h1>
        <div class="row vision">
            <div class="col-md-1 text-center" id="eyevision">
                <i class="bi bi-eye vision-icon"></i>
            </div>
            <div class="col-md-10">
                <h2>Vision</h2>
                <p style="text-align: justify">Our vision is to be the leading provider of innovative solutions that empower businesses to achieve excellence and growth. We strive to create a future where technology and creativity blend seamlessly to deliver exceptional experiences.</p>
            </div>
        </div>

        <div class="row mission">
            <div class="col-md-1 text-center">
                <i class="bi bi-bullseye mission-icon"></i>
            </div>
            <div class="col-md-10">
                <h2>Mission</h2>
                <p style="text-align: justify">Our mission is to deliver high-quality products and services that exceed our clients' expectations. We are committed to continuous improvement, sustainability, and fostering a culture of innovation and integrity in everything we do.</p>
            </div>
        </div>
    </div>

    <div class="why-choose-us">
        <div class="row">
            <div class="col-md-6">
                <div class="heading">WHY CHOOSE US?</div>
                <ul class="benefits">
                    <li>Daily Market Updates</li>
                    <li>Easy Settlements of Withdrawals</li>
                    <li>Team, Technology & Experience of Forex Trading</li>
                    <li>Useful Trading at MT5 Trade Platform</li>
                </ul>
            </div>
            <div class="col-md-6 image-container">
                <img src="images/bg_13.jpg" alt="Why Choose Us">
            </div>
        </div>
    </div>

    <?php include 'template/footer.php'; ?>
    <?php include 'template/script.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.home-slider').owlCarousel({
                loop: true,
                autoplay: true,
                margin: 0,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                nav: false,
                autoplayHoverPause: false,
                items: 1,
                autoHeight: true,
                autoHeightClass: 'owl-height',
                dots: false
            });
        });
    </script>
</body>

  </body>
</html>