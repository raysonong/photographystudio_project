<?php
    $activeLink = "";
    if (isset($currentPage)) {
        $activeLink = "id='sidenav-current'";
    }
    else {
        $currentPage = "";
    }
?>
<ul id="content-sidenav">
    <li>
        <a href="myprofile.php" title="My Profile" <?php if ($currentPage == "My Profile") echo $activeLink; ?>>My Profile</a>
    </li>
    <li>
        <a href="changepassword.php" title="Change Password" <?php if ($currentPage == "Change Password") echo $activeLink; ?>>Change Password</a>
    </li>
    <li>
        <a href="bookappointment.php" title="Book a Slot!" <?php if ($currentPage == "Book Appointment") echo $activeLink; ?>>Book a Slot!</a>
    </li>
    <li>
        <a href="searchbooking.php" title="Search Booking" <?php if ($currentPage == "Search Booking") echo $activeLink; ?>>Search Booking</a>
    </li>
    <li>
        <a href="currentbooking.php" title="Current Booking" <?php if ($currentPage == "Current Booking") echo $activeLink; ?>>Current Booking</a>
    </li>
    <li>
        <a href="signout.php" title="Sign Out">Sign Out</a>
    </li>
</ul>