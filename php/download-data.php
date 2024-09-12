<?php
// Downloads CSV of users logged information
session_start();

$mysqli = require "../php/login-database.php";
$currentID = $_SESSION['userID'];
$sql = "SELECT `id`, `title`, `arrival_type`, `log_date`, `arrival_period`, `arrived` 
        FROM `order_log` WHERE owner_id = $currentID";

// Creates a temporary file using the users ID to avoid duplicate names with write only permissions
$fp = fopen("../tempfiles/file_userid" . $currentID . ".csv", "w");
// Add headers to CSV file
fputcsv($fp, array("ID", "Title", "Type", "Date Logged", "Period", "Status"));

$result = $mysqli->execute_query($sql);
// if there is more than one row then begin downloading
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['arrival_period'] = periodConverter($row['arrival_period']);
        $row['arrived'] = boolToTextArrived($row['arrived']);
        fputcsv($fp, $row);
    }
}

fclose($fp);

// Prepping file to download
$filePath = "../tempfiles/file_userid" . $currentID . ".csv";

if (file_exists($filePath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    // download file
    readfile($filePath);
}

// delete the file upon it's download by the user
ignore_user_abort(true);
unlink($filePath);
exit;

function periodConverter(int $typeNum)
{
    // converts the stored int to plain text
    if ($typeNum === 1) {
        return "Weekly";
    } elseif ($typeNum === 2) {
        return "Bi-Weekly";
    } elseif ($typeNum === 3) {
        return "Monthly";
    } elseif ($typeNum === 4) {
        return "Bi-Monthly";
    } elseif ($typeNum === 5) {
        return "Quaterly";
    } elseif ($typeNum === 6) {
        return "Semi-Annually";
    } elseif ($typeNum === 7) {
        return "Annually";
    }

    return "Contact <a href='https://mail.google.com/mail/?view=cm&fs=1&to=support@somj.dev&su=Support%20Ticket' target='_blank'>Support</a>, Query Invalid";
}

function boolToTextArrived($bool)
{
    // converts the stored bool to plain text
    if ($bool === true) {
        return "Arrived";
    } else {
        return "Missing";
    }
}
