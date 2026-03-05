<?php

$USERNAME = "root";
$PASSWORD = "";
$SERVER_NAME = "localhost:3306";
$DB_NAME = "calendar_notes_db";

$conn = mysqli_connect( // δημιουργία σύνδεσης με την mysql
    $SERVER_NAME,
    $USERNAME,
    $PASSWORD,
    $DB_NAME
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function initializeTable($conn) {
    mysqli_query(
        $conn,
        "CREATE TABLE IF NOT EXISTS notes(
            Imerominia DATE PRIMARY KEY,
            Simiosi VARCHAR(5000)
        )"
    );
}

initializeTable($conn);

function insertNoteToDatabase($conn, $day, $month, $year, $note) {
    return mysqli_query(
        $conn,
        "INSERT INTO notes(Imerominia, Simiosi) VALUES(
            '$year-$month-$day',
            '$note'
        )
        
        ON DUPLICATE KEY UPDATE Simiosi = VALUES(Simiosi)
        "
    );
}

function getNoteForDate($conn, $day, $month, $year): string {
    $result = mysqli_query(
        $conn,
        "SELECT Simiosi FROM notes WHERE Imerominia='$year-$month-$day';"
    );

    if ($result && mysqli_num_rows($result) > 0) {
        $dataForDate = mysqli_fetch_assoc($result);
        
        return $dataForDate["Simiosi"];
    } else {
        return "";
    }
}

// Επιστρεφει ολα τα σημειωματα για ολες τις ημερομηνίες εκτός απο τις ημέρες που το σημείωμα είναι κενό
function getAllNotes($conn) {
     $result = mysqli_query(
        $conn,
        "SELECT * FROM notes ORDER BY Imerominia ASC"
    );

    $notes = [];

    while ($nextEntry = mysqli_fetch_assoc($result)) {
       array_push($notes, $nextEntry);
    }

    return $notes;
}

?>