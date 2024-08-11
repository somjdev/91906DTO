<!-- Contains the table for the logpage.php site-->
<div class="table-div">
    <div class="top-table">
        <form method="get">
            <input type="text" placeholder="Search by Title..." name="search_content">
            <input type="submit" name="search_log">
        </form>
        <a href="../html/userpage.php" class="btn">Return to main page</a>
        <a href="../php/download-data.php" class="btn">Download Table</a>
    </div>
    <table class="content-table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Date Logged</th>
            <th>Arrival Period</th>
            <th>Arrived?</th>
        </tr>
        <?php
        $mysqli = require "../php/login-database.php";

        $current_id = $_SESSION['user_id'];

        // Gets relevant information from the database, if there is supplied search information it will be included in the WHERE clause
        if (isset($_GET['search_log'])) {
            $search_title = $_GET['search_content'];
            $sql = "SELECT `id`, `title`, `arrival_type`, `log_date`, `arrival_period`, `arrived` 
        FROM `order_log` WHERE owner_id = $current_id AND `title` LIKE '%$search_title%'";
        } else {
            $sql = "SELECT `id`, `title`, `arrival_type`, `log_date`, `arrival_period`, `arrived` 
        FROM `order_log` WHERE owner_id = $current_id";
        }


        $result = $mysqli->execute_query($sql);

        // if there is more than one row the data will be echo'd to the table row by row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["title"] . "</td>
                    <td>" . $row["arrival_type"] . "</td>
                    <td>" . $row["log_date"] . "</td>
                    <td>" . periodConverter($row["arrival_period"]) . "</td>
                    <td>"
                    . boolToTextArrived($row['arrived']) .
                    " <a class='btn btn-delete' href='../php/update-status.php?id=$row[id]&type=$row[arrived]'>Mark as " . boolToTextArrived(!$row['arrived']) . "</a>
                    </td>
                <tr>"
                );
            }
            echo "</table";
        } else {
            echo "No Results";
        }

        function periodConverter(int $typeNum)
        {
            // converts int to plain text value
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

            // Returns place to contact me if the int is out of range
            return "Contact <a href='https://mail.google.com/mail/?view=cm&fs=1&to=support@somj.dev&su=Support%20Ticket' target='_blank'>Support</a>, Query Invalid";
        }

        function boolToTextArrived($bool)
        {
            // converts bool to plain text
            if ($bool == true) {
                return "Arrived";
            } else {
                return "Missing";
            }
        }
        ?>


    </table>
</div>