// Validate the email
function emailInput(signinForm) {
    var isValid = false;
    var errorMessage = "";
    var emailInput = signinForm.email.value;
    var section = document.getElementById("signin-email");
    
    // Check whether if the user inputted correctly
    if (emailInput == "") {
        errorMessage = "Please fill in your email address!";
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
function passwordInput(signinForm) {
    var isValid = false;
    var errorMessage = "";
    var passwordInput = signinForm.password.value;
    var section = document.getElementById("signin-password");
    
    // Check whether if the user inputted correctly
    if (passwordInput == "") {
        errorMessage = "Please fill in your password!";
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
function validateSignIn() {
    // Select the form
    var signinForm = document.signin;
    
    // Retrieve the result of every input validation
    var isEmailValid = emailInput(signinForm);
    var isPasswordValid = passwordInput(signinForm);
    
    // Return the result of its whole validation
    return isEmailValid && isPasswordValid;
}