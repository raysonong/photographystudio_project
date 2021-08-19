<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the text on the small hero
            $currentPage = "Search";
        
            // Store the user inputs
            $search = isset($_GET["search"]) ? $_GET["search"] : "";

            // Connect the database
            require("_connect/database.php");

            // Create the SQL statement
            $sql = "SELECT s.serviceName, s.serviceDesc FROM services AS s INNER JOIN categories AS c on s.categoryId = c.categoryId WHERE s.serviceName LIKE '%$search%'";
            // Execute the query
            $queryResult = mysqli_query($conn, $sql);
        
            // Get the number of rows
            $numOfRows = mysqli_num_rows($queryResult);
        
            // Close the database connection and the sql query
            mysqli_close($conn);
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/search.css">
        <script src="_js/global.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Creative Studio - Search</title>
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
            <h2>Search Results</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get" id="content-searchForm">
                <input type="text" id="input-contentsearch" name="search" placeholder="Search...">
                <input type="submit" id="btn-contentsearch" class="orangebtn" value="Search">
            </form>
            <?php
                // Check if the user inputted a value
                if ($search != "" && $numOfRows > 0) {
                    // Display the results
                    while ($oneResult = mysqli_fetch_assoc($queryResult)) {
            ?>
            <section class="content-search">
                <h3><?php echo $oneResult["serviceName"]; ?></h3>
                <p>
                    <?php echo $oneResult["serviceDesc"]; ?>
                </p>
            </section>
            <?php
                    }
                }
                else {
            ?>
            <p>Search result not found, try searching another one.</p>
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