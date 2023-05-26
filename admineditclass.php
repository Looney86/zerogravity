<?php
include("connection.php");

// Fetch session details from the database
$sql = "SELECT sd.id, d.id AS day_id, d.name AS day_name, c.id AS coach_id, c.name AS coach_name, s.id AS slot_id, s.start, s.end
        FROM session_details sd
        JOIN days d ON sd.day = d.id
        INNER JOIN coach c ON sd.coach = c.id
        INNER JOIN slot s ON sd.time = s.id";

$result = mysqli_query($connection, $sql);

$sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if the form is submitted
if (isset($_POST['update'])) {
    $session_id = $_POST['session_id'];
    $selected_day = $_POST['day'];
    $selected_coach = $_POST['coach'];
    $selected_slot = $_POST['slot'];


    // Update the session details in the database
    $update_query = "UPDATE session_details
                     SET day = '$selected_day', coach = '$selected_coach', time = '$selected_slot'
                     WHERE id = '$session_id'";
    mysqli_query($connection, $update_query);

    header('Location: admineditclass.php');
    exit();
}

if (isset($_POST['add'])) {

    var_dump($_POST);
    $add_session = $_POST['add_session'];
    $add_day = $_POST['add_day'];
    $add_coach = $_POST['add_coach'];
    $add_slot = $_POST['add_slot'];
    $add_category = $_POST['category'];
    
    $add_query = "INSERT INTO session_details (id, day, coach, time, category) VALUES ('$add_session', '$add_day', '$add_coach', '$add_slot', '$add_category')";
    $results = mysqli_query($connection, $add_query);
    if (mysqli_affected_rows($connection) > 0) {
        header('Location: admineditclass.php');
    } else {
        echo "not inserted";
    }
    
}
?>

<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include 'adminheader.php'; ?>
<div class="container">
    <h2>Session Details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Day</th>
                <th>Coach</th>
                <th>Time</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sessions as $session) : ?>
                <tr>
                    <td><?php echo $session['day_name']; ?></td>
                    <td><?php echo $session['coach_name']; ?></td>
                    <td><?php echo $session['start'] . ' - ' . $session['end']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="showUpdateForm(<?php echo $session['id']; ?>)">Update</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-warning" onclick="showAddForm()">Add Session</button>
</div>

<div id="update-form" class="container" style="display: none;">
    <h2>Update Session Details</h2>
    <form method="POST" class="form-center">
        <input type="hidden" id="session-id" name="session_id">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="day">Day:</label>
                <select id="day" name="day" class="form-control">
                    <?php
                    $sql = "SELECT * FROM days";
                    $result = mysqli_query($connection, $sql);
                    $days = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($days as $day) : ?>
                        <option value="<?php echo $day['id']; ?>"><?php echo $day['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="coach">Coach:</label>
                <select id="coach" name="coach" class="form-control">
                    <?php
                    $sql1 = "SELECT * FROM coach";
                    $result1 = mysqli_query($connection, $sql1);
                    $coachs = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                    foreach ($coachs as $coach) : ?>
                        <option value="<?php echo $coach['id']; ?>"><?php echo $coach['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="slot">Time:</label>
                <select id="slot" name="slot" class="form-control">
                    <?php
                    $sql2 = "SELECT * FROM slot";
                    $result2 = mysqli_query($connection, $sql2);
                    $slots = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                    foreach ($slots as $slot) : ?>
                        <option value="<?php echo $slot['id']; ?>"><?php echo $slot['start'] . ' - ' . $slot['end']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
        <button type="submit" name="update" class="btn btn-success" style="width:200px; height:60px; margin-left:40%;margin-top:20px;">Update</button>
    </form>
</div>

<div id="add-form" class="container" style="display: none;">
    <h2>Add Session Details</h2>
    <form method="POST" class="form-center">
        <div class="row">
        <div class="form-group col-md-2">
                <label for="add_session">Day:</label>
                <select id="add_session" name="add_session" class="form-control">
                    <?php 
                    $sql4 = "SELECT * FROM session";
                    $result4 = mysqli_query($connection,$sql4);
                    $sessions = mysqli_fetch_all($result4,MYSQLI_ASSOC);
                    foreach ($sessions as $sessionn) : ?>
                        <option value="<?php echo $sessionn['id']; ?>"><?php echo $sessionn['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="add_day">Day:</label>
                <select id="add_day" name="add_day" class="form-control">
                    <?php foreach ($days as $day) : ?>
                        <option value="<?php echo $day['id']; ?>"><?php echo $day['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="add_coach">Coach:</label>
                <select id="add_coach" name="add_coach" class="form-control">
                    <?php foreach ($coachs as $coach) : ?>
                        <option value="<?php echo $coach['id']; ?>"><?php echo $coach['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="add_slot">Time:</label>
                <select id="add_slot" name="add_slot" class="form-control">
                    <?php foreach ($slots as $slot) : ?>
                        <option value="<?php echo $slot['id']; ?>"><?php echo $slot['start'] . ' - ' . $slot['end']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="category">Time:</label>
                <select id="category" name="category" class="form-control">
                    <?php
                    $sql3 = "SELECT * FROM category";
                    $result3 = mysqli_query($connection, $sql3);
                    $categories = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                    foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="submit" name="add" class="btn btn-warning" style="width:200px; height:60px; margin-left:40%;margin-top:20px;">Add</button>
    </form>
</div>

<script>
    function showUpdateForm(sessionId) {
        // Set the session ID in the hidden input field
        document.getElementById('session-id').value = sessionId;
        // Show the update form
        document.getElementById('update-form').style.display = 'block';
        // Hide the add form
        document.getElementById('add-form').style.display = 'none';
    }

    function showAddForm() {
        // Show the add form
        document.getElementById('add-form').style.display = 'block';
        // Hide the update form
        document.getElementById('update-form').style.display = 'none';
    }
</script>
