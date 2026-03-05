<?php
require("../miscUtils.php");
require("../backend/modules/databaseFunctions.php");

$day = add_prefix_to_num($_GET["day"]);
$month = add_prefix_to_num($_GET["month"]);
$year = $_GET["year"];

$date = short_date($day, $month, $year);
$alreadyWrittenNote = getNoteForDate($conn, $day, $month, $year);

function short_date($day, $month, $year) {
    return "$day/$month/$year";
}

function page_title($date) {
    return "Σημειώσεις για $date";
}

?>

<!DOCTYPE html>
<link rel="stylesheet" href="./style.css">
<html lang="en">

<head>
    <title> <?php echo page_title($date) ?></title>

</head>

<body>

    <table>
        <tr>
            <th class="title">Ημερομηνία:</th>
            <th class="dateContent">
                <?php echo $date ?>
            </th>
        </tr>
    </table>

    <form action="../backend/registerNote.php" method="post">
        <input type="hidden" name="day" value="<?php echo $day; ?>">
        <input type="hidden" name="month" value="<?php echo $month; ?>">
        <input type="hidden" name="year" value="<?php echo $year; ?>">

        <table>
            <tr>
                <th class="title">
                    Σημειώσεις:
                </th>

                <td class="simioseisContent">
                    <textarea rows="10" cols="100" name="note" style="border-style:none;"><?php echo $alreadyWrittenNote;?></textarea>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <form> <!-- what -->
                        <input type="submit" class="button">
                    </form>
                </td>

                <td>
                    <form action="../../"> <!-- return back to homepage -->
                        <input type="submit" class="button" value="Αρχική σελίδα">
                    </form>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>