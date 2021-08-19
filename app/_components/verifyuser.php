<?php
    // Direct the user if there are not allowed access certain page
    function verifyUser($userType) {
        if ($userType == 'M') {
            // Direct to sign in page if the non-member tries to access the member page
            if (!isset($_SESSION["memberId"])) {
                header("Location: signin.php");
                exit;
            }
        }
        else {
            // Direct to index page if the member tries to access the auth page
            if (isset($_SESSION["memberId"])) {
                header("Location: index.php");
                exit;
            }
        }
    }
?>