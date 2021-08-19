// Load the event handlers
window.addEventListener("load", function() {
    // For the user to be able to upload profile icon
    var profileIconUploadBtn = document.getElementById("btn-profileicon");
    profileIconUploadBtn.addEventListener("change", function() {
        profileIconInput(this, document.getElementById("editprofile-info"));
    });
});

// Validate the gender
function genderInput(myProfileForm) {
    var isValid = false;
    var errorMessage = "";
    var genderInput = myProfileForm.gender.value;
    var section = document.getElementById("editprofile-gender");
    
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

// Validate the contact number
function contactNoInput(myProfileForm) {
    var isValid = false;
    var errorMessage = "";
    var contactNoInput = myProfileForm.contactNo.value;
    var section = document.getElementById("editprofile-contactno");
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

// Validate the user input
function validateMyProfile() {
    // Select the form
    var myProfileForm = document.myProfile;
    
    // Retrieve the result of every input validation
    var isGenderValid = genderInput(myProfileForm);
    var isContactNoValid = contactNoInput(myProfileForm);
    
    // Return the result of its whole validation
    return isGenderValid && isContactNoValid;
}