<?php
session_start();

$mysqli = require "../php/login-database.php";
$current_id = $_SESSION['user_id'];
$sql = "SELECT `id`, `title`, `arrival_type`, `log_date`, `arrival_period`, `arrived` 
        FROM `order_log` WHERE owner_id = $current_id";

$fp = fopen("../tempfiles/file_userid" . $current_id . ".csv", "w");
fputcsv($fp, array("ID", "Title", "Type", "Date Logged", "Period", "Status"));

$result = $mysqli->execute_query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['arrival_period'] = periodConverter($row['arrival_period']);
        $row['arrived'] = boolToTextArrived($row['arrived']);
        fputcsv($fp, $row);
    }
}

fclose($fp);

$file_path = "../tempfiles/file_userid" . $current_id . ".csv";

if (file_exists($file_path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
}

ignore_user_abort(true);
unlink($file_path);
exit;

function periodConverter(int $typeNum)
{
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
    if ($bool === true) {
        return "Arrived";
    } else {
        return "Missing";
    }
}