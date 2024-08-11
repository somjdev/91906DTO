<!-- Main sidebar for the userpage -->
<div class="sidebar">
    <?php if (isset($_GET['edit'])): ?>
    <!-- If the site is accessed with a get value named edit use the edit sidebar-->
        <?php echo "<h2>Editing Element ID: " . $_GET['id'] . "</h2>" ?>
        <form method="post" action="../php/edit-entry.php">
            <?php if (isset($_GET['title'])): // if the title value is set use the title value?>
                <?php echo '<input placeholder="Title" value='. $_GET['title'] .' type="text" name="title" required><br>'?>
            <?php else: // if not use default placeholder?>
                <input placeholder="Title" type="text" name="title" required><br>
            <?php endif; ?>
            
            <?php echo '<input type="hidden" name="id" value='. $_GET['id'].'>'// Stores the current ID of the data being editted?>

            <select name="type" required>
                <option selected value="Magazine">Magazine</option>
                <option value="Book">Book</option>
                <option value="Newspaper">Newspaper</option>
                <option value="Films">Films</option>
            </select><br>
            
            <?php if (isset($_GET['date'])): // if the date value is stored use the date value?>
                <?php echo '<input value=' . $_GET['date'] . ' type="date" name="arrival" required><br>'?>
            <?php else: // if not use todays date?>
                <input type="date" name="arrival" required><br>
            <?php endif; ?>
            
            <select name="period" required>
                <option selected value="1">Weekly</option>
                <option value="2">Bi-Weekly</option>
                <option value="3">Monthly</option>
                <option value="4">Bi-Monthly</option>
                <option value="5">Quaterly</option>
                <option value="6">Semi-Annually</option>
                <option value="7">Annually</option>
            </select><br>

            <button type="submit">Edit</button>
        </form>
    <?php else: ?>
        <h2>Add Element</h2>
        <form method="post" action="../php/add-entry.php">
            <input placeholder="Title" type="text" name="title" required><br>

            <select name="type" required>
                <option selected value="Magazine">Magazine</option>
                <option value="Book">Book</option>
                <option value="Newspaper">Newspaper</option>
                <option value="Films">Films</option>
            </select><br>

            <input type="date" name="arrival" required>

            <select name="period" required>
                <option selected value="1">Weekly</option>
                <option value="2">Bi-Weekly</option>
                <option value="3">Monthly</option>
                <option value="4">Bi-Monthly</option>
                <option value="5">Quaterly</option>
                <option value="6">Semi-Annually</option>
                <option value="7">Annually</option>
            </select><br>

            <button type="submit">Add</button>
        </form>
    <?php endif; ?>
</div>
