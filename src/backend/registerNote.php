<?php
/* 

    τρέχει κάθε φορά που ο χρήστης πατάει "submit" για τις σημειώσεις μιας ημέρας

*/

require("./modules/databaseFunctions.php");

insertNoteToDatabase(
    $conn,
    $_POST["day"],
    $_POST["month"],
    $_POST["year"],
    $_POST["note"],
);

// επιστρεφει πισω στην αρχικη σελιδα και της λεει οτι ενα σημειωμα αποθηκευτηκε, ωστε ο client να δειξει στον χρηστη τι εγινε πανω πανω
echo "<script>window.location = '../..?saved=1'</script>";

?>