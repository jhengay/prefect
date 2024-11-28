<?php   
include "db_conn.php";

// Ensure ID is provided in the query string
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "Invalid request. ID is required.";
    exit;
}

$id = $_GET["id"]; // Sanitize the ID
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

// Handle the form submission
if (isset($_POST["submit"])) {
    // Sanitize and validate form input
    $full_name = filter_var(trim($_POST['full_name']), FILTER_SANITIZE_STRING);
    $tcname = filter_var(trim($_POST['tcname']), FILTER_SANITIZE_STRING);
    $n_section = filter_var(trim($_POST['n_section']), FILTER_SANITIZE_STRING);
    $cause_prefect = filter_var(trim($_POST['cause_prefect']), FILTER_SANITIZE_STRING);
    $gender = filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING);
    $t_record = $_POST['t_record'];
    $tdate = $_POST['tdate'];
    $i_law = filter_var(trim($_POST['i_law']), FILTER_SANITIZE_STRING);
    $narative = filter_var(trim($_POST['narative']), FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($full_name) || empty($tcname) || empty($n_section) || empty($cause_prefect) || empty($t_record) || empty($tdate) || empty($i_law) || empty($gender) || empty($narative)) {
        echo "All fields are required.";
        exit;
    }

    // Escape strings to prevent SQL injection
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $tcname = mysqli_real_escape_string($conn, $tcname);
    $n_section = mysqli_real_escape_string($conn, $n_section);
    $cause_prefect = mysqli_real_escape_string($conn, $cause_prefect);
    $gender = mysqli_real_escape_string($conn, $gender);
    $t_record = mysqli_real_escape_string($conn, $t_record);
    $tdate = mysqli_real_escape_string($conn, $tdate);
    $i_law = mysqli_real_escape_string($conn, $i_law);
    $narative = mysqli_real_escape_string($conn, $narative);

    // SQL to update the record
    $sql = "UPDATE crud SET full_name = ?, tcname = ?, n_section = ?, cause_prefect = ?, gender = ?, t_record = ?, tdate = ?, i_law = ?, narative = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $full_name, $tcname, $n_section, $cause_prefect, $gender, $t_record, $tdate, $i_law, $narative, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header("Location: index.php?msg=Data updated successfully");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Prefect Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar {
            background-color: #28a745;
            padding: 1rem;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-success, .btn-danger {
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            width: 400px;
            margin-top: 20px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-check-inline {
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 text-center w-100" href="#">Prefect Discipline Management System</a>
        </div>
    </nav>

    <!-- Main Form -->
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Make changes and click "Update" to save the updated information.</p>
        </div>

        <?php
        // Fetch the existing data
        $sql = "SELECT * FROM crud WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Record not found.";
            exit;
        }
        ?>


        <!-- Form starts here -->
        <div class="form-container">
            <form action="" method="post">
                <!-- Full Name and Teacher Name -->
                <div class="form-row form-section">
                    <div class="col-md-6">
                        <label class="form-label">Name of Student</label>
                        <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teacher of Student</label>
                        <input type="text" class="form-control" name="tcname" value="<?php echo htmlspecialchars($row['tcname']); ?>" required>
                    </div>
                </div>

                <!-- Section and Cause of Prefect -->
                <div class="form-row form-section">
                    <div class="col-md-6">
                        <label class="form-label">Section of Student</label>
                        <input type="text" class="form-control" name="n_section" value="<?php echo htmlspecialchars($row['n_section']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Violations</label>
                        <input type="text" class="form-control" name="cause_prefect" value="<?php echo htmlspecialchars($row['cause_prefect']); ?>" required>
                    </div>
                </div>

                <!-- Date of Incident and Prefect -->
                <div class="form-row form-section">
                    <div class="col-md-6">
                        <label class="form-label">Date of Incident</label>
                        <input type="date" class="form-control" name="t_record" value="<?php echo htmlspecialchars($row['t_record']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Prefect</label>
                        <input type="date" class="form-control" name="tdate" value="<?php echo htmlspecialchars($row['tdate']); ?>" required>
                    </div>
                </div>

               <div class="form-group">
   <label class="form-label">Penalty</label>
   <select class="form-control" name="i_law" id="huys" required>
      <option value="disabled">Select Penalty</option>
      
      <!-- Class 1 Penalties -->
      <optgroup label="Class 1 Misdemeanors">
         <option value="1st Offense - Reprimand with counseling with parent">Reprimand with counseling with parent</option>
         <option value="2nd Offense - Suspension of 1-2 days with counseling with parent">Suspension of 1-2 days with counseling with parent</option>
         <option value="3rd Offense - Shall be treated as a less grave offense, thus 3 days supension ">Shall be treated as a less grave offense, thus 3 days supension</option>
      </optgroup>
      
      <!-- Class 2 Penalties -->
      <optgroup label="Class 2 Misdemeanors">
         <option value="1st Offense - Suspension which shall not exceed three(3) days">Suspension which shall not exceed three(3) days</option>
         <option value="2nd Offense - Suspension for 4-6 days">Suspension for 4-6 days</option>
         <option value="3rd Offense - Shall be treated as a grave offense, thus 7 days">Shall be treated as a grave offense, thus 7 days</option>
      </optgroup>
      
      <!-- Class 3 Penalties -->
      <optgroup label="Class 3 Misdemeanors">
         <option value="1st Offense - Suspension for seven(7) days">Suspension for seven(7) days</option>
         <option value="2nd Offense - Suspension for more than seven(7) days but not more than one(1) year - refers to the Principal pproval"> Suspension for more than seven(7) days but not more than one(1) year - refers to the Principal approval</option>
         <option value="3rd Offense - Expulsion - refers to the Principal approval">Expulsion - refers to the Principal approval</option>
      </optgroup>
   </select>
</div>
                <!-- Narrative -->
                <div class="form-group">
                    <label class="form-label">Narrative Report</label>
                    <textarea class="form-control" name="narative" rows="3" required><?php echo htmlspecialchars($row['narative']); ?></textarea>
                </div>

                <!-- Gender -->
<div class="form-group form-section">
    <label class="form-label">Gender</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo $row['gender'] == 'Male' ? 'checked' : ''; ?>>
        <label class="form-check-label">Male</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo $row['gender'] == 'Female' ? 'checked' : ''; ?>>
        <label class="form-check-label">Female</label>
    </div>
</div>


                <!-- Buttons -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

   
</body>
</html>
