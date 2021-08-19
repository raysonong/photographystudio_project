<?php
    // Start the session
    session_start();
    
    // Check if the user is a registered user
    require_once("_components/verifyuser.php");
    verifyUser('M');

    // Function for the select dropdown time
    require_once("_components/timedropdown.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation
            $currentPage = "Book Appointment";
        
            // Connect the database
            require("_connect/database.php");
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/bookappointment.css">
        <script src="_js/global.js"></script>
        <script src="_js/bookappointment.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Book Appointment</title>
    </head>
    <body>
        <!-- Header -->
        <?php
            require_once("_components/header.php");
        ?>
        <!-- Content -->
        <section id="content">
            <?php
                include_once("_components/sidenav.php");
            ?>
            <form id="content-bookappointment" action="_process/bookAppointmentProcess.php" method="post" onsubmit="return validateBookAppointment();" name="bookAppointment">
                <h2>Book Appointment</h2>
                <section id="bookappointment-event">
                    <select id="input-event" name="event">
                        <option value="">Select your Event</option>
                        <?php
                            // Create the SQL statement
                            $sql = "SELECT serviceName FROM services WHERE categoryId = 2;";
                            // Execute the query
                            $queryResult = mysqli_query($conn, $sql);
                        
                            while ($oneService = mysqli_fetch_assoc($queryResult)) {
                                $oneServiceName = $oneService["serviceName"];
                        ?>
                        <option value="<?php echo $oneServiceName; ?>"><?php echo $oneServiceName; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <p class="inputerror"></p>
                </section>
                <section id="bookappointment-print">
                    <label>Choose your printing service (Optional):</label>
                    <?php
                        // Create the SQL statement
                        $sql = "SELECT serviceId, serviceName FROM services WHERE categoryId = 3;";
                        // Execute the query
                        $queryResult = mysqli_query($conn, $sql);
                        
                        // Display all the print services in checkbox
                        while ($oneService = mysqli_fetch_assoc($queryResult)) {
                            $oneServiceName = $oneService["serviceName"];
                    ?>
                    <label for="input-print<?php echo str_replace(' ', '', strtolower($oneServiceName)); ?>">
                        <input type="checkbox" id="input-print<?php echo str_replace(' ', '', strtolower($oneServiceName)); ?>" name="print[]" value="<?php echo $oneService["serviceId"]; ?>" onchange="caculateTotal();">
                        <?php echo $oneServiceName; ?>
                    </label>
                    <?php
                        }
                        
                        // Close the database connection
                        mysqli_close($conn);
                    ?>
                    <p class="inputerror"></p>
                </section>
                <section id="bookappointment-date">
                    <label for="input-date">Date Available:</label>
                    <input type="date" id="input-date" name="date" onkeydown="return false;">
                    <p class="inputerror"></p>
                </section>
                <section id="bookappointment-time">
                    <section>
                        <select id="input-timestart" name="timestart" onchange="caculateTotal();">
                            <option value="">Select Start Time</option>
                            <?php
                                timeDropdown("09:00", "20:00");
                            ?>
                        </select>
                        <select id="input-timeend" name="timeend" onchange="caculateTotal();">
                            <option value="">Select End Time</option>
                            <?php
                                timeDropdown("10:00", "21:00");
                            ?>
                        </select>
                    </section>
                    <p class="inputerror"></p>
                </section>
                <section id="bookappointment-price">
                    <p>Total Price: <strong id="price-info"></strong></p>
                    <input type="hidden" name="price" id="input-price">
                </section>
                <section>
                    <input type="submit" id="btn-placebooking" class="btn orangebtn" value="Place Booking">
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