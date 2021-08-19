// Load the event handlers
window.onload = prepareEventHandlers;

function prepareEventHandlers() {
    hamburgerBtn();
    searchBtn();
}

// To function the hamburger button
function hamburgerBtn() {
    var hamburgerBtn = document.getElementById("header-hamburgernav");
    var isHamburgerBtnActive = false;
    hamburgerBtn.addEventListener("click", function() {
        if (isHamburgerBtnActive) {
            hamburgerBtn.removeAttribute("class");
        }
        else {
            hamburgerBtn.setAttribute("class", "active");
        }
        isHamburgerBtnActive = !isHamburgerBtnActive;
    });
    
    var navLinks = document.querySelectorAll("nav a");
    var hamburgerMql = window.matchMedia("(min-width:980px)");
    hamburgerMql.addListener(function(e) {
        if (isHamburgerBtnActive) {
            // Temporary remove the class when browser width is more than 980px
            if (e.matches && isHamburgerBtnActive) {
                hamburgerBtn.removeAttribute("class");
            }
            else {
                hamburgerBtn.setAttribute("class", "active");
            }
            
            // Prevent the transition animation when resizing
            for (var i = 0; i < navLinks.length; i++) {
                navLinks[i].style.transition = "none";
                navLinks[i].offsetHeight;
                navLinks[i].removeAttribute("style");
            }
        }
    });
}

// To function the search button
function searchBtn() {
    var searchInput = document.getElementById("input-search");
    var searchBtn = document.getElementById("btn-search");
    var isSearchBtnActive = false;
    searchBtn.addEventListener("click", function() {
        if (isSearchBtnActive) {
            searchInput.removeAttribute("style");
        }
        else {
            searchInput.style.display = "inline";
        }
        
        isSearchBtnActive = !isSearchBtnActive;
    });
}

// Validate the uploaded icon and display the icon when successful
function profileIconInput(inputFile, section) {
    var isValid = true;
    // Check if image is uploaded
    if (inputFile.files && inputFile.files[0]) {
        var errorMessage = "";
        var validExt = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
        var fileSize = inputFile.files[0].type / 1024;
        var maxFileSize = 1000;

        // Validate the image
        if (!validExt.includes(inputFile.files[0].type)) {
            errorMessage = "Image can only be in jpg, png or gif!";
            isValid = false;
        }
        else if (fileSize > maxFileSize) {
            errorMessage = "Image size cannot exceed more than 1MB!";
            isValid = false;
        }
        else {
            var reader = new FileReader();

            reader.onload = function(e) {
                var profileIcon = document.getElementById("image-profileicon");
                profileIcon.style.backgroundImage = "url(" + e.target.result + ")";
            }

            reader.readAsDataURL(inputFile.files[0]);
        }
        
        if (!isValid) {
            inputFile.value = "";
        }

        // Display the error if the user entered the wrong value
        displayErrorMessage(section, errorMessage, isValid);
    }
}

// Display the error message for forms
function displayErrorMessage(section, errorMessage, isValid) {
    // Clear the error message
    section.querySelector(".inputerror").textContent = "";
    
    // Display the error message if the validation fails
    if (!isValid) {
        section.querySelector(".inputerror").textContent = errorMessage;
    }
}

function minDate() {
    var today = new Date();
    var day = today.getDate() + 1;
    var month = today.getMonth() + 1;
    var year = today.getFullYear();
    
    if (day < 10){
        day = '0' + day;
    }
    
    if (month < 10){
        month = '0' + month;
    } 

    today = year + '-' + month + '-' + day;
    document.getElementById("input-date").setAttribute("min", today);
}