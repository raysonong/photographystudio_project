// Load the event handlers
window.addEventListener("load", function() {
    // For the user to be able to upload profile icon
    var profileIconUploadBtn = document.getElementById("btn-profileicon");
    profileIconUploadBtn.addEventListener("change", function() {
        profileIconInput(this, document.getElementById("signup-profileicon"));
    });
});

// Validate the name
function nameInput(signupForm) {
    var isValid = false;
    var errorMessage = "";
    var section = document.getElementById("signup-name");
    var firstNameInput = signupForm.firstName.value;
    var lastNameInput = signupForm.lastName.value;
    var firstNameFormat = new RegExp("^[a-zA-Z\\s]{1,50}$");
    var lastNameFormat = new RegExp("^[a-zA-Z]{1,20}$");
    
    // Check whether if the user inputted correctly
    if (firstNameInput == "" || lastNameInput == "") {
        errorMessage = "Please fill in your first and last name!";
    }
    else if (!firstNameFormat.test(firstNameInput)) {
        errorMessage = "First name should contain letters or spaces and no more than 50 characters!";
    }
    else if (!lastNameFormat.test(lastNameInput)) {
        errorMessage = "Last name should only contain letters and no more than 20 characters!";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of the validation
    return isValid;
}

// Validate the gender
function genderInput(signupForm) {
    var isValid = false;
    var errorMessage = "";
    var genderInput = signupForm.gender.value;
    var section = document.getElementById("signup-gender");
    
    // Check whether if the user inputted correctly
    if (genderInput == "") {
        errorMessage = "Please select your gender!";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of the validation
    return isValid;
}

// Validate the email
function emailInput(signupForm) {
    var isValid = false;
    var errorMessage = "";
    var emailInput = signupForm.email.value;
    var section = document.getElementById("signup-email");
    var format = new RegExp("^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$");
    
    // Check whether if the user inputted correctly
    if (emailInput == "") {
        errorMessage = "Please fill in your email address!";
    }
    else if (!format.test(emailInput)) {
        errorMessage = "Please enter your valid email! (e.g. name@email.com)";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of the validation
    return isValid;
}

// Validate the contact number
function contactNoInput(signupForm) {
    var isValid = false;
    var errorMessage = "";
    var contactNoInput = signupForm.contactNo.value;
    var section = document.getElementById("signup-contactno");
    var format = new RegExp("^([0-9]{8,8})");
    
    // Check whether if the user inputted correctly
    if (contactNoInput == "") {
        errorMessage = "Please fill in your contact number!";
    }
    else if (!format.test(contactNoInput)) {
        errorMessage = "Please enter a valid contact number! (e.g. 9xxx5xxx)";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of the validation
    return isValid;
}

// Validate the password
function passwordInput(signupForm) {
    var isValid = false;
    var errorMessage = "";
    var passwordInput = signupForm.password.value;
    var section = document.getElementById("signup-password");
    var format = new RegExp("(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{6,100}");
    
    // Check whether if the user inputted correctly
    if (passwordInput == "") {
        errorMessage = "Please fill in your password!";
    }
    else if (!format.test(passwordInput)) {
        errorMessage = "Password should contain a number, uppercase and lowercase, and at least 6 characters long!";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of the validation
    return isValid;
}

// Validate the password
function cfmPasswordInput(signupForm) {
    var isValid = false;
    var errorMessage = "";
    var cfmPasswordInput = signupForm.cfmPassword.value;
    var section = document.getElementById("signup-cfmpassword");
    
    // Check whether if the user inputted correctly
    if (cfmPasswordInput == "") {
        errorMessage = "Please fill in the confirm password!";
    }
    else if (cfmPasswordInput != signupForm.password.value) {
        errorMessage = "Confirm password did not match the password entered!";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of the validation
    return isValid;
}

// Validate the user input
function validateSignUp() {
    // Select the form
    var signupForm = document.signup;
    
    // Retrieve the result of every input validation
    var isNameValid = nameInput(signupForm);
    var isGenderValid = genderInput(signupForm);
    var isEmailValid = emailInput(signupForm);
    var isContactNoValid = contactNoInput(signupForm);
    var isPasswordValid = passwordInput(signupForm);
    var isCfmPasswordValid = cfmPasswordInput(signupForm);
    
    // Return the result of its whole validation
    return isNameValid && isGenderValid && isEmailValid && isContactNoValid && isPasswordValid && isCfmPasswordValid;
}