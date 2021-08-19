<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation and the small hero
            $currentPage = "Services";
        
            // Connect the database
            require("_connect/database.php");
            
            // Create the SQL statement
            $sql = "SELECT * FROM categories";
            // Execute the query
            $queryResult = mysqli_query($conn, $sql);
        
            // Close the database connection
            mysqli_close($conn);
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/services.css">
        <script src="_js/global.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Services</title>
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
                while ($oneCategory = mysqli_fetch_assoc($queryResult)) {
            ?>
            <article class="content-service">
                <img class="service-image" src="_images/photos/<?php echo $oneCategory["categoryImage"]; ?>" alt="<?php echo $oneCategory["categoryName"]; ?>">
                <article class="service-info">
                    <h2><?php echo $oneCategory["categoryName"]; ?></h2>
                    <p>
                        <?php echo $oneCategory["categoryDesc"]; ?>
                    </p>
                    <a href="<?php echo strtolower($oneCategory["categoryName"]) . ".php"; ?>">See more</a>
                </article>
            </article>
            <?php
                }
            ?>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>