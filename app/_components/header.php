<?php
    $activeLink = "";
    if (isset($currentPage)) {
        $activeLink = "id='header-nav-current'";
    }
    else {
        $currentPage = "";
    }
?>
<header>
    <a href="index.php" id="header-logo" title="Creative Studio">
        <h1 id="header-logo-name">Creative Studio</h1>
    </a>
    <div id="header-hamburgernav">
        <div></div>
    </div>
    <nav>
        <ul id="header-nav">
            <li>
                <a href="index.php" title="Home" <?php if ($currentPage == "Home") echo $activeLink; ?>>Home</a>
            </li>
            <li>
                <a href="aboutus.php" title="About Us" <?php if ($currentPage == "About Us") echo $activeLink; ?>>About Us</a>
            </li>
            <li>
                <a href="services.php" title="Services" <?php if ($currentPage == "Services") echo $activeLink; ?>>Services</a>
            </li>
            <li>
                <a href="contact.php" title="Contact" <?php if ($currentPage == "Contact") echo $activeLink; ?>>Contact</a>
            </li>
        </ul>
        <ul id="header-auth">
            <?php
                if (!isset($_SESSION["memberId"])) {
            ?>
            <li>
                <a href="signin.php" id="header-auth-signin" title="Sign In">Sign In</a>
            </li>
            <li>
                <a href="signup.php" id="header-auth-signout" class="btn orangebtn" title="Sign Up">Sign Up</a>
            </li>
            <?php
                }
                else {
            ?>
            <li>
                <a href="myprofile.php" id="header-auth-myaccount" title="My Account">
                    <section id="myaccount-profileicon"
                        <?php
                            if ($_SESSION["profileIcon"] != "") {
                                echo "style='background-image: url(_images/profileicons/{$_SESSION["profileIcon"]});'";
                            }
                        ?>
                    ></section>
                    My Account
                </a>
                <ul id="auth-myaccount">
                    <li>
                        <a href="myprofile.php" class="btn orangebtn" title="My Profile">My Profile</a>
                    </li>
                    <li>
                        <a href="signout.php" title="Sign Out">Sign Out</a>
                    </li>
                </ul>
            </li>
            <?php
                }
            ?>
        </ul>
        <form action="search.php" method="get" id="header-search">
            <input type="text" id="input-search" name="search" placeholder="Search...">
            <input type="button" id="btn-search" value="Search">
        </form>
    </nav>
</header>