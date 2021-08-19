<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation and the small hero
            $currentPage = "Contact";
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/contact.css">
        <script src="_js/global.js"></script>
        <script src="_js/contact.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Contact</title>
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
            <article id="content-contact">
                <article id="contact-info">
                    <h2>Contact Info</h2>
                    <p>HP No.: +65 9816 1234</p>
                    <p>Office No.: +65 6824 9876</p>
                    <p>Email: mail@creativestudio.sg</p>
                </article>
                <article id="contact-operatingDay">
                    <h2>Operating Days</h2>
                    <p>Tues-Fri: 9am-9pm</p>
                    <p>Sat-Sun: 10am-6.30pm</p>
                    <p>Closed on Mon and PH</p>
                </article>
                <article id="contact-location">
                    <h2>Locate Us</h2>
                    <iframe id="contactinfo-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.6611865763484!2d103.84676001400858!3d1.379949998993564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da16eb64b0249d%3A0xe5f10ff680eed942!2sNanyang%20Polytechnic!5e0!3m2!1sen!2ssg!4v1594884585540!5m2!1sen!2ssg" width="720" height="480" style="border:0;"></iframe>
                </article>
            </article>
            <hr>
            <form id="content-contactForm" action="_process/contactProcess.php" method="post" onsubmit="return validateContact();" name="contact">
                <h2>For Enquiries</h2>
                <section id="contact-email">
                    <input type="text" id="input-email" name="email" placeholder="Your Email">
                    <p class="inputerror"></p>
                </section>
                <section id="contact-contactno">
                    <input type="text" id="input-contactno" name="contactNo" placeholder="Your Contact No.">
                    <p class="inputerror"></p>
                </section>
                <section id="contact-subject">
                    <input type="text" id="input-subject" name="subject" placeholder="Subject">
                    <p class="inputerror"></p>
                </section>
                <section id="contact-message">
                    <textarea name="message" id="input-message" placeholder="Message"></textarea>
                    <p class="inputerror"></p>
                </section>
                <section>
                    <input type="submit" id="btn-send" class="btn orangebtn" value="Send">
                    <?php
                        if (isset($_SESSION["message"])) {
                            // Show the display message
                            echo $_SESSION["message"];
                            // Remove the session after the message was display
                            unset($_SESSION["message"]);
                        }
                    ?>
                </section>
            </form>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>