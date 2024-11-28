<?php 
include "db_conn.php";

if (isset($_POST["submit"])) {
   $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
   $tcname = mysqli_real_escape_string($conn, $_POST['tcname']);
   $n_section = mysqli_real_escape_string($conn, $_POST['n_section']);
   $cause_prefect = mysqli_real_escape_string($conn, $_POST['cause_prefect']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $t_record = mysqli_real_escape_string($conn, $_POST['t_record']);
   $tdate = mysqli_real_escape_string($conn, $_POST['tdate']);
   $i_law = mysqli_real_escape_string($conn, $_POST['i_law']);
   $narative = mysqli_real_escape_string($conn, $_POST['narative']);

   $sql = "INSERT INTO crud (id, full_name, tcname, n_section, cause_prefect, gender, t_record, tdate, i_law, narative) 
           VALUES (NULL, '$full_name', '$tcname', '$n_section', '$cause_prefect', '$gender', '$t_record', '$tdate', '$i_law', '$narative')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <title>Prefect Management System</title>

   <style>
      body {
         background-color: #f0f4f8;
         font-family: Arial, sans-serif;
      }

      .navbar {
         background-color: #28a745;
         color: white;
         font-weight: bold;
         padding: 1.5rem;
         text-align: center;
         font-size: 1.5rem;
      }

      .form-container {
         background-color: #ffffff;
         padding: 40px;
         border-radius: 8px;
         box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
         width: 840px;
         margin: auto;
      }

      .form-header {
         font-weight: bold;
         color: #333;
         text-align: center;
      }

      .form-subheader {
         color: #6c757d;
         text-align: center;
         margin-bottom: 20px;
      }

      .form-control {
         border: 1px solid #ced4da;
         border-radius: 5px;
      }

      .btn-success, .btn-danger {
         font-weight: bold;
         padding: 10px 20px;
         border-radius: 5px;
         width: 100%;
      }

      .btn-success:hover {
         background-color: #218838;
      }
      #ayaw {
      background-color: #skyblue;
}

      .btn-danger:hover {
         background-color: #c82333;
      }

      .radio-label {
         margin-left: 10px;
         margin-right: 20px;
      }

      .form-group {
         margin-bottom: 20px;
      }

      .btn-container {
         text-align: center;
         display: flex;
         gap: 10px;
         margin-top: 20px;
      }

      .link-container {
         text-align: center;
         margin-top: 10px;
      }

      .gender-group {
         display: flex;
         align-items: center;
         gap: 15px;
      }
      .Managements{
         margin-top: -915px;
         margin-left: 486px;
      }
   </style>
</head>

<body>
   <nav class="navbar">
      Prefect Management System
   </nav>

   <div class="container my-5">
      <div class="form-container">
         <h3 class="form-header">Add New Prefect Record</h3>
         <p class="form-subheader">Complete the form below to add a new record</p>

         <form action="" method="post">
            <div class="row">
               <div class="col-md-6 form-group">
                  <label class="form-label">Name of Student</label>
                  <input type="text" class="form-control" name="full_name" required>
               </div>
               <div class="col-md-6 form-group">
                  <label class="form-label">Teacher of Student</label>
                  <input type="text" class="form-control" name="tcname" required>
               </div>
            </div>

            <div class="form-group">
               <label class="form-label">Section of Student</label>
               <input type="text" class="form-control" name="n_section" required>
            </div>

            <div class="form-group">
               <label class="form-label">Violations</label>
               <input type="text" class="form-control" name="cause_prefect" required>
            </div>

            <div class="form-group">
               <label class="form-label">Date of Incident</label>
               <input type="date" class="form-control" name="t_record" required>
            </div>

            <div class="form-group">
               <label class="form-label">Date of Prefect</label>
               <input type="date" class="form-control" name="tdate" required>
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




 

<div class="form-group">
                    <label class="form-label">Narrative Report</label>
                    <textarea class="form-control" name="narative" rows="2" required></textarea>
                </div>







            <div class="form-group gender-group">
               <div class="Managements">
               <label class="form-label">Gender:</label>
               <input type="radio" class="form-check-input" name="gender" value="Male" id="male" required>
               <label for="male" class="radio-label">Male</label>
               <input type="radio" class="form-check-input" name="gender" value="Female" id="female" required>
               <label for="female" class="radio-label">Female</label>
            </div>
         </div>

            <div class="btn-container">
               <button type="submit" class="btn btn-success" name="submit">Insert</button>
               <a href="homepage.php" class="btn btn-danger">Back</a>
            </div>
            
            <div class="link-container">
               <a href="index.php" class="btn btn-outline-success">See Prefect Record</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>