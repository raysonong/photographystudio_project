<?php
    // Connect the database
    require("_connect/database.php");

    // Filter the service list based on current page
    $filter = "";
    if ($currentPage) {
        $filter = " WHERE c.categoryName = '$currentPage'";
    }

    // Create the query
    $sql = "SELECT s.serviceName, s.serviceDesc, s.serviceImage 
    FROM services AS s 
    INNER JOIN categories AS c 
    on s.categoryId = c.categoryId" . $filter;

    // Execute the query
    $queryResult = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);
                
    // Display the service list
    if ($queryResult) {
        while ($oneService = mysqli_fetch_assoc($queryResult)) {
?>
<article class="content-service">
    <img class="service-image" src="_images/photos/<?php echo $oneService["serviceImage"]; ?>" alt="<?php echo $oneService["serviceName"]; ?>">
    <article class="service-info">
        <h2><?php echo $oneService["serviceName"]; ?></h2>
        <p>
            <?php echo $oneService["serviceDesc"]; ?>
        </p>
    </article>
</article>
<?php
        }
    }
    else {
?>
    <p>Oops! It looks like there is nothing here.</p>
<?php
    }
?>
<a href="services.php">Back to Services</a>