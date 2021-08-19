// Validate the email
function emailInput(contactForm) {
    var isValid = false;
    var errorMessage = "";
    var emailInput = contactForm.email.value;
    var section = document.getElementById("contact-email");
    var format = new RegExp("^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,255}$");
    
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
function contactNoInput(contactForm) {
    var isValid = false;
    var errorMessage = "";
    var contactNoInput = contactForm.contactNo.value;
    var section = document.getElementById("contact-contactno");
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

// Validate the subject
function subjectInput(contactForm) {
    var isValid = false;
    var errorMessage = "";
    var subjectInput = contactForm.subject.value;
    var section = document.getElementById("contact-subject");
    var format = new RegExp("^.{1,50}$");
    
    // Check whether if the user inputted correctly
    if (subjectInput == "") {
        errorMessage = "Please fill in the subject!";
    }
    else if (!format.test(subjectInput)) {
        errorMessage = "Subject cannot exceed 50 characters!";
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

// Validate the message
function messageInput(contactForm) {
    var isValid = false;
    var errorMessage = "";
    var messageInput = contactForm.message.value;
    var section = document.getElementById("contact-message");
    var format = new RegExp("^.{1,255}$");
    
    // Check whether if the user inputted correctly
    if (messageInput == "") {
        errorMessage = "Please fill in your message!";
    }
    else if (!format.test(messageInput)) {
        errorMessage = "Message cannot exceed 255 characters!";
    }
    else {
        // Set true if the user input this value correctly
        isValid = true;
    }
    
    // Display the error if the user entered the wrong value
    displayErrorMessage(section, errorMessage, isValid);
    
    // Return the result of this input validation
    return isValid;
}

// Validate the user input
function validateContact() {
    // Select the form
    var contactForm = document.contact;
    
    // Retrieve the result of every input validation
    var isEmailValid = emailInput(contactForm);
    var isContactNoValid = contactNoInput(contactForm);
    var isSubjectValid = subjectInput(contactForm);
    var isMessageValid = messageInput(contactForm);
    
    // Return the result of its whole validation
    return isEmailValid && isContactNoValid && isSubjectValid && isMessageValid;
}