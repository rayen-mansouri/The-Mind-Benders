<?php
require_once __DIR__ . '/event_con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id']) && isset($_POST['action'])) {
    $eventC = new eventCon("event");
    $eventId = $_POST['event_id'];
    $action = $_POST['action'];
    
    $result = false;
    if ($action === 'like') {
        $result = $eventC->updateLikes($eventId, true);
    } elseif ($action === 'unlike') {
        $result = $eventC->updateLikes($eventId, false);
    } elseif ($action === 'dislike') {
        $result = $eventC->updateDislikes($eventId, true);
    } elseif ($action === 'undislike') {
        $result = $eventC->updateDislikes($eventId, false);
    }

    // Get updated event data
    $event = $eventC->getEvent($eventId);
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $result,
        'likes' => $event['likes'],
        'dislikes' => $event['dislikes']
    ]);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Invalid request']);
}
