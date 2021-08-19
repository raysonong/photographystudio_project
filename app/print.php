<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation and the small hero
            $currentPage = "Print";
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/services.css">
        <script src="_js/global.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Print</title>
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
            <?php
                include_once("_components/servicelist.php");
            ?>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>