function verif_inp() {
    // Reset error messages
    document.getElementById("date_error").innerHTML = "";
    document.getElementById("title_error").innerHTML = "";
    document.getElementById("description_error").innerHTML = "";
    document.getElementById("prix_error").innerHTML = "";
    document.getElementById("error_global").innerHTML = "";
    document.getElementById("success_global").innerHTML = "";

    // Get form values
    var date = document.getElementById("date").value;
    var title = document.getElementById("title").value;
    var description = document.getElementById("description").value;
    var prix = document.getElementById("prix").value;

    var isValid = true; // Flag to track overall form validity

    // Validate date (must not be empty) and >= current date
    if (date === "" || new Date(date) < new Date()) {
        if (date === "") {
            document.getElementById("date_error").innerHTML = "Date is required.";
        } else {
            document.getElementById("date_error").innerHTML = "Date must be greater than or equal to the current date.";
        }
        isValid = false;
    }

    // Validate title (must not be empty)
    if (title === "") {
        document.getElementById("title_error").innerHTML = "Title is required.";
        isValid = false;
    }

    // Validate description (must not be empty)
    if (description === "") {
        document.getElementById("description_error").innerHTML = "Description is required.";
        isValid = false;
    }

    // Validate price (must not be empty and must be a number)
    if (prix === "" || isNaN(prix) || prix <= 0) {
        document.getElementById("prix_error").innerHTML = "Valid price is required.";
        isValid = false;
    }

    // If form is valid, show success message, else show global error
    if (isValid) {
        document.getElementById("success_global").innerHTML = "Form is ready to submit!";
    } else {
        document.getElementById("error_global").innerHTML = "Please correct the errors in the form.";
    }

    // Return form validity (false will prevent form submission)
    return isValid;
}


function verif_inp_update() {
    // Reset error messages
    document.getElementById("date_error").innerHTML = "";
    document.getElementById("title_error").innerHTML = "";
    document.getElementById("description_error").innerHTML = "";
    document.getElementById("prix_error").innerHTML = "";

    // Get form values
    var date = document.getElementById("date").value;
    var title = document.getElementById("titre").value;
    var description = document.getElementById("description").value;
    var prix = document.getElementById("prix").value;

    var isValid = true; // Flag to track overall form validity

    // Validate date (must not be empty) and >= current date
    if (date === "" || new Date(date) < new Date()) {
        if (date === "") {
            document.getElementById("date_error").innerHTML = "Date is required.";
        } else {
            document.getElementById("date_error").innerHTML = "Date must be greater than or equal to the current date.";
        }
        isValid = false;
    }

    // Validate title (must not be empty)
    if (title === "") {
        document.getElementById("title_error").innerHTML = "Title is required.";
        isValid = false;
    }

    // Validate description (must not be empty)
    if (description === "") {
        document.getElementById("description_error").innerHTML = "Description is required.";
        isValid = false;
    }

    // Validate price (must not be empty and must be a number)
    if (prix === "" || isNaN(prix) || prix <= 0) {
        document.getElementById("prix_error").innerHTML = "Valid price is required.";
        isValid = false;
    }

    // Return form validity (false will prevent form submission)
    return isValid;

}
