// Load the event handlers
window.addEventListener("load", function() {
    if (document.getElementById("input-date")) {
        minDate();
        caculateTotal();
    }
});

// Validate the gender
function eventInput(bookAppForm) {
    var isValid = false;
    var errorMessage = "";
    var eventInput = bookAppForm.event.value;
    var section = document.getElementById("bookappointment-event");
    
    // Check whether if the user inputted correctly
    if (eventInput == "") {
        errorMessage = "Please select the event!";
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
function dateInput(bookAppForm) {
    var isValid = false;
    var errorMessage = "";
    var dateInput = bookAppForm.date.value;
    var section = document.getElementById("bookappointment-date");
    
    // Check whether if the user inputted correctly
    if (dateInput == "") {
        errorMessage = "Please select the date!";
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

// Validate the time
function timeInput(bookAppForm) {
    var isValid = false;
    var errorMessage = "";
    var timeStartInput = bookAppForm.timestart.value;
    var timeEndInput = bookAppForm.timeend.value;
    var section = document.getElementById("bookappointment-time");
    
    // Check whether if the user inputted correctly
    if (timeStartInput == "" && timeEndInput == "") {
        errorMessage = "Please select the start and end time!";
    }
    else if (timeStartInput == "") {
        errorMessage = "Please select the start time!";
    }
    else if (timeEndInput == "") {
        errorMessage = "Please select the end time!";
    }
    else if (timeStartInput >= timeEndInput) {
        errorMessage = "Please select the apporiate time range!";
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
function validateBookAppointment() {
    // Select the form
    var bookAppForm = document.bookAppointment;
    
    // Retrieve the result of every input validation
    var isEventValid = eventInput(bookAppForm);
    var isDateValid = dateInput(bookAppForm);
    var isTimeValid = timeInput(bookAppForm);
    
    // Return the result of its whole validation
    return isDateValid && isTimeValid;
}

function caculateTotal() {
    var bookAppForm = document.bookAppointment;
    var total = 0;
    var checked = document.querySelectorAll('input[name="print[]"]:checked');
    var timeStartInput = bookAppForm.timestart.value;
    var timeEndInput = bookAppForm.timeend.value;
    var hour = 0;
    
    if (checked) {
        total += 10 * checked.length;
    }
    
    if (timeStartInput != "" && timeEndInput != "" && timeStartInput <= timeEndInput) {
        hour = parseFloat(timeEndInput.slice(0, 2)) - parseFloat(timeStartInput.slice(0, 2));
        total += 30 * hour;
    }
    
    document.getElementById("price-info").textContent = "$" + total.toFixed(2);
    document.getElementById("input-price").value = total.toFixed(2);
}