// Validate the password
function currentPasswordInput(changePasswordForm) {
    var isValid = false;
    var errorMessage = "";
    var passwordInput = changePasswordForm.currentPassword.value;
    var section = document.getElementById("changepw-currentpassword");
    
    // Check whether if the user inputted correctly
    if (passwordInput == "") {
        errorMessage = "Please fill in your current password!";
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
function passwordInput(changePasswordForm) {
    var isValid = false;
    var errorMessage = "";
    var passwordInput = changePasswordForm.password.value;
    var section = document.getElementById("changepw-password");
    var format = new RegExp("(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{6,100}");
    
    // Check whether if the user inputted correctly
    if (passwordInput == "") {
        errorMessage = "Please fill in your new password!";
    }
    else if (!format.test(passwordInput)) {
        errorMessage = "New password should contain a number, uppercase and lowercase, and at least 6 characters long!";
    }
    else if (passwordInput == changePasswordForm.currentPassword.value) {
        errorMessage = "New password should not be the same as your current password!";
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
function cfmPasswordInput(changePasswordForm) {
    var isValid = false;
    var errorMessage = "";
    var cfmPasswordInput = changePasswordForm.cfmPassword.value;
    var section = document.getElementById("changepw-cfmpassword");
    
    // Check whether if the user inputted correctly
    if (cfmPasswordInput == "") {
        errorMessage = "Please fill in the confirm new password!";
    }
    else if (cfmPasswordInput != changePasswordForm.password.value) {
        errorMessage = "Confirm new password did not match the password entered!";
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
function validateChangePassword() {
    // Select the form
    var changePasswordForm = document.changePassword;
    
    // Retrieve the result of every input validation
    var isCurrentPasswordValid = currentPasswordInput(changePasswordForm);
    var isPasswordValid = passwordInput(changePasswordForm);
    var isCfmPasswordValid = cfmPasswordInput(changePasswordForm);
    
    // Return the result of its whole validation
    return isCurrentPasswordValid && isPasswordValid && isCfmPasswordValid;
}