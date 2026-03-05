<?php
require("../backend/modules/databaseFunctions.php");

$allNotes = getAllNotes($conn);

function createTableRowForAllNotes($allNotes) {
    foreach ($allNotes as $data) {
        $date = $data["Imerominia"];
        $simiosi = $data["Simiosi"];

        if ($simiosi == "") {
            continue;
        }

        echo "
            <tr>
                <td>$date</td>
                <td class='simiosi'>".$simiosi."</td>
            </tr>
        ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="./style.css">

<head>
    <meta charset="UTF-8">
    <title>Όλες οι σημειώσεις</title>
</head>

<body>
    <div style="">
        <table border="3em solid black;">
            <tr>
                <td class="title">
                    Ημερομηνία
                </td>

                <td class="title">
                    Σημειώσεις
                </td>
            </tr>

            <?php
            createTableRowForAllNotes($allNotes);
            ?>
        </table>

        <form action="../../">
            <input type="submit" class="generic" value="Αρχική σελίδα">
        </form>
    </div>
</body>

</html>