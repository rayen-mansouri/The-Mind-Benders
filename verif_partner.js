function verif_partner() {
    // Reset error messages
    document.getElementById("name_error").innerHTML = "";
    document.getElementById("address_error").innerHTML = "";
    document.getElementById("email_error").innerHTML = "";
    document.getElementById("error_global").innerHTML = "";
    document.getElementById("success_global").innerHTML = "";

    let isValid = true;

    // Get form values
    const name = document.getElementById("name").value.trim();
    const address = document.getElementById("address").value.trim();
    const email = document.getElementById("email").value.trim();

    // Validate Partner Name
    if (name === "") {
        document.getElementById("name_error").innerHTML = "Partner name is required.";
        isValid = false;
    } else if (name.length < 3) {
        document.getElementById("name_error").innerHTML = "Name must be at least 3 characters.";
        isValid = false;
    }

    // Validate Address
    if (address === "") {
        document.getElementById("address_error").innerHTML = "Address is required.";
        isValid = false;
    } else if (address.length < 5) {
        document.getElementById("address_error").innerHTML = "Address must be at least 5 characters.";
        isValid = false;
    }

    // Validate Email
    if (email === "") {
        document.getElementById("email_error").innerHTML = "Email is required.";
        isValid = false;
    } else if (!validateEmail(email)) {
        document.getElementById("email_error").innerHTML = "Please enter a valid email address.";
        isValid = false;
    }

    // Display global error or success message
    if (!isValid) {
        document.getElementById("error_global").innerHTML = "Please correct the highlighted errors.";
    } else {
        document.getElementById("success_global").innerHTML = "Form validated successfully!";
    }

    return isValid;
}

// Helper function to validate email format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function verif_partner_update() {
    // Reset error messages
    document.getElementById("name_error").innerHTML = "";
    document.getElementById("address_error").innerHTML = "";
    document.getElementById("email_error").innerHTML = "";

    let isValid = true;

    // Get form values
    const name = document.getElementById("name").value.trim();
    const address = document.getElementById("address").value.trim();
    const email = document.getElementById("email").value.trim();

    // Validate Partner Name
    if (name === "") {
        document.getElementById("name_error").innerHTML = "Partner name is required.";
        isValid = false;
    } else if (name.length < 3) {
        document.getElementById("name_error").innerHTML = "Name must be at least 3 characters.";
        isValid = false;
    }

    // Validate Address
    if (address === "") {
        document.getElementById("address_error").innerHTML = "Address is required.";
        isValid = false;
    } else if (address.length < 5) {
        document.getElementById("address_error").innerHTML = "Address must be at least 5 characters.";
        isValid = false;
    }

    // Validate Email
    if (email === "") {
        document.getElementById("email_error").innerHTML = "Email is required.";
        isValid = false;
    } else if (!validateEmail(email)) {
        document.getElementById("email_error").innerHTML = "Please enter a valid email address.";
        isValid = false;
    }


    return isValid;
}

// Helper function to validate email format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

