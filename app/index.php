<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation
            $currentPage = "Home";
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/index.css">
        <script src="_js/global.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Home</title>
    </head>
    <body>
        <!-- Header -->
        <?php
            require_once("_components/header.php");
        ?>
        <!-- Hero -->
        <?php
            include_once("_components/hero.php");
        ?>
        <!-- Content -->
        <section id="content">
            <section id="content-benefits">
                <h2>Client Benefits</h2>
                <article>
                    <img src="_images/icons/client_benefit/gift.png" alt="Gift Icon">
                    <h3>Special Gifts</h3>
                    <p>For every 5 successful bookings, we will give you a token as an appreciation.</p>
                </article>
                <article>
                    <img src="_images/icons/client_benefit/service.png" alt="Service Icon">
                    <h3>Services</h3>
                    <p>Choose your own services we offered that will statisfied your needs.</p>
                </article>
                <article>
                    <img src="_images/icons/client_benefit/photo_enchance.png" alt="Photo Enchance Icon">
                    <h3>Photo Enchancing</h3>
                    <p>Spice up your photo to become imaginative or even turn it into a photobook or a canvas!</p>
                </article>
                <article>
                    <img src="_images/icons/client_benefit/cancel_booking.png" alt="Cancel Booking Icon">
                    <h3>Booking Cancellation</h3>
                    <p>If you have booked but unable to make it, you can cancel it 7 days before you booked.</p>
                </article>
            </section>
            <hr>
            <section id="content-photo">
                <h2>Our Client's Photo</h2>
                <img src="_images/photos/womanandpuppy.jpg" alt="Woman and Puppy">
                <img src="_images/photos/photographer.jpg" alt="Photographer">
                <img src="_images/photos/bizwoman.jpg" alt="Business Woman">
                <img src="_images/photos/family.jpg" alt="Family">
                <img src="_images/photos/darkroom.jpg" alt="Woman in dark room">
                <img src="_images/photos/umbrella.jpg" alt="Boy Holding Umbrella">
            </section>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>