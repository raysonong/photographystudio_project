<?php
    // Start the session
    session_start();
    
    // Check if the user is a registered user
    require_once("_components/verifyuser.php");
    verifyUser('M');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Set the active link on the navigation
            $currentPage = "Current Booking";
        
            // Connect the database
            require("_connect/database.php");
        
            $filter = "";
            if (isset($_GET['bookingId'])) {
               // Set the bookingId
               $bookingId = $_GET['bookingId'];
               $filter = " WHERE bookingId = $bookingId AND memberId = " . $_SESSION["memberId"];
            }
        
            // Create the SQL statement
            $sql = "SELECT * FROM bookings" . $filter;
            // Execute the query
            $queryResult = mysqli_query($conn, $sql);
            // Fetch the currently edited records
            $booking = mysqli_fetch_assoc($queryResult);
        ?>
        <link rel="stylesheet" type="text/css" href="_css/common.css">
        <link rel="stylesheet" type="text/css" href="_css/bookappointment.css">
        <script src="_js/global.js"></script>
        <script src="_js/bookappointment.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Edit Booking</title>
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
            <form id="content-bookappointment" action="_process/editProcess.php" method="post" onsubmit="return validateBookAppointment();" name="bookAppointment">
                <h2>Edit Booking</h2>
                <?php
                    if ($booking && isset($_GET['bookingId'])) {
                ?>
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
                        <option value="<?php echo $oneServiceName; ?>"
                        <?php 
                            if ($booking["event"] == $oneServiceName) echo "selected";
                        ?>
                        >
                            <?php echo $oneServiceName; ?>
                        </option>
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
                        <input type="checkbox" id="input-print<?php echo str_replace(' ', '', strtolower($oneServiceName)); ?>" name="print[]" value="<?php echo $oneService["serviceId"]; ?>" onchange="caculateTotal();"
                        <?php
                            if ($oneServiceName == "Canvas" && $booking["canvas"] == "Yes")
                            {
                                echo "checked";
                            }
                            else if ($oneServiceName == "Photobook" && $booking["photoBook"] == "Yes")
                            {
                                echo "checked";
                            }
                            else if ($oneServiceName == "Photo Edit" && $booking["photoEdit"] == "Yes")
                            {
                                echo "checked";
                            }
                        ?>
                        >
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
                    <input type="date" id="input-date" name="date" onkeydown="return false;" value="<?php echo $booking["dateSlot"]; ?>">
                    <p class="inputerror"></p>
                </section>
                <section id="bookappointment-time">
                    <section>
                        <select id="input-timestart" name="timestart" onchange="caculateTotal();">
                            <option value="">Select Start Time</option>
                            <?php
                                $start = strtotime("09:00");
                                $end = strtotime("20:00");
                                $time = $start;

                                // Display the time
                                while($time <= $end) {
                            ?>
                            <option value="<?php echo date("H:i",$time); ?>"
                            <?php if ($booking["timeStart"] == date("H:i:s",$time)) echo "selected"; ?>>
                                <?php echo date("H:i",$time); ?>
                            </option>
                            <?php
                                    $time = strtotime('+1 hour',$time);
                                }
                            ?>
                        </select>
                        <select id="input-timeend" name="timeend" onchange="caculateTotal();">
                            <option value="">Select End Time</option>
                            <?php
                                $start = strtotime("10:00");
                                $end = strtotime("21:00");
                                $time = $start;

                                // Display the time
                                while($time <= $end) {
                            ?>
                            <option value="<?php echo date("H:i",$time); ?>"
                            <?php if ($booking["timeEnd"] == date("H:i:s",$time)) echo "selected"; ?>>
                                <?php echo date("H:i",$time); ?>
                            </option>
                            <?php
                                    $time = strtotime('+1 hour',$time);
                                }
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
                    <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                    <a href="currentbooking.php" id="btn-back">Back</a>
                    <input type="submit" id="btn-save" class="btn orangebtn" value="Save">
                    <?php
                        if (isset($_SESSION["message"])) {
                            // Show the display message
                            echo $_SESSION["message"];
                            // Remove the session after the message was display
                            unset($_SESSION["message"]);
                        }
                    ?>
                </section>
                <?php
                    }
                    else {
                ?>
                <p>No record found or you do not have access to edit this record!</p>
                <?php
                    }
                ?>
            </form>
        </section>
        <!-- Footer -->
        <?php
            include_once("_components/footer.php");
        ?>
    </body>
</html>