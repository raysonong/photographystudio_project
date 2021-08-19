<section id="hero">
    <h1>Enjoy 5% discount on your first book!</h1>
    <a href="
    <?php
        if (!isset($_SESSION["memberId"])) {
            echo "signup.php";
        }
        else {
            echo "bookappointment.php";
        }
    ?>
    " class="btn bluebtn">Get Started</a>
</section>