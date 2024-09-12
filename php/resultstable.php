<!-- Table for the main userpage-->
<div class="table-div">
    <div class="top-table">
        <!-- <form method="get">
            <input type="text" placeholder="Search by Title..." name="search_content">
            <input type="submit" name="search_log">
        </form> -->
        <a href="../html/logpage.php" class="btn">Go to log page</a>
    </div>
    <table class="content-table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Next Arrival</th>
            <th>Arrival Period</th>
            <th></th>
        </tr>
        <?php
        $mysqli = require "../php/login-database.php";

        $current_id = $_SESSION['userID'];

        $result = $mysqli->execute_query("SELECT id, title, arrival_type, arrival_date, arrival_period 
        FROM order_data WHERE owner_id = $current_id");

        // Checks if there is more than one row of data and if there is it will loop through every valid row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ("
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["title"] . "</td>
                    <td>" . $row["arrival_type"] . "</td>
                    <td>" . $row["arrival_date"] . "</td>
                    <td>" . periodConverter($row["arrival_period"]) . "</td>
                    <td>
                        <a class='btn btn-edit' href='../php/check-validity.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-delete' href='../php/delete-entry.php?id=$row[id]'>Delete</a>
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

            return "Contact <a href='https://mail.google.com/mail/?view=cm&fs=1&to=support@somj.dev&su=Support%20Ticket' target='_blank'>Support</a>, Query Invalid";
        }
        ?>


    </table>
</div>
