<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation and the small hero
            $currentPage = "About Us";
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/aboutus.css">
        <script src="_js/global.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - About Us</title>
    </head>
    <body>
        <!-- Header -->
        <?php
            require_once("_components/header.php");
        ?>
        <!-- Hero -->
        <?php
            include_once("_components/smallhero.php");
        ?>
        <!-- Content -->
        <section id="content">
            <article id="content-intro">
                <img src="_images/photos/photographer2.jpg" alt="photographer">
                <article>
                    <h2>Introduction</h2>
                    <p>
                        We are a small company that offer photography services that are open to anyone who are looking for a photoshoot. Apart from offering our client's photo taking, we also provide photo editing and physical copy of a photo which you can choose to have a canvas or photobook. We do listen to our client's feedback so that our quality of the equipments and their photos would suit them.
                    </p>
                </article>
            </article>
            <article id="content-ourstory">
                <img src="_images/photos/office.jpg" alt="office">
                <article>
                    <h2>Our Story</h2>
                    <p>
                        Creative Studio was founded in 2014 by a team of 3 people. Before it was founded, they enjoyed taking pictures around Singapore and they eventually bring their photos to the level of creativity through unique poses and photo editing and thats when they decided to start up their own studio with the name called Creative Studio.
                    </p>
                </article>
            </article>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>