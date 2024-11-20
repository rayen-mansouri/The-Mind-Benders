<?php
// Include the event controller and model
include_once __DIR__ . '/../../../Controller/event_con.php';
include_once __DIR__ . '/../../../Model/event.php';

// Create an instance of the event controller
$eventC = new eventCon("event");

// Create an empty event variable
$event = null;

// Check if the form is submitted
if (
    isset($_POST["date"]) &&
    isset($_POST["title"]) &&
    isset($_POST["description"]) &&
    isset($_POST["prix"])
) {
    // Validate that no field is empty
    if (
        !empty($_POST["date"]) &&
        !empty($_POST["title"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["prix"])
    ) {

        // Create a new Event object
        $event = new Event(
            'null',
            $_POST['title'],
            $_POST['description'],
            $_POST['date'],
            $_POST['prix'],
        );

        // Add the event to the database
        $eventC->addEvent($event);

        // Success message and redirect
        $success_message = "Event added successfully!";
        header('Location: ../../../view/back/gestion events/gestion events.php?success_global=' . urlencode($success_message));
        exit();
    } else {
        // Error handling if any field is empty
        $error_message = "All fields are required.";
        header('Location: ../../../view/back/gestion events/gestion events.php?error_global=' . urlencode($error_message));
        exit();
    }
}
?>
