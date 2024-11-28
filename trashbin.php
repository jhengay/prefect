<?php
include "db_conn.php";

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM archied_records WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch records from the database
$result = mysqli_query($conn, "SELECT * FROM archied_records");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deleted Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #0d6efd;
      color: white;
    }
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
    }
    .container {
      margin-top: 100px;
    }
    .card {
      border: none;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .search-container {
      width: 100%;
      max-width: 400px;
      margin-bottom: 20px;
      position: relative;
    }
    .search-bar {
      width: 100%;
      padding: 10px 15px;
      padding-right: 40px; /* Space for the icon */
      border: 1px solid #ddd;
      border-radius: 8px;
      transition: width 0.3s ease-out;
      animation: fade .6s ease-out ;
    }
    @keyframes fade{
        from{
            opacity: 0;
            transform: translateX(-100px);
        }
        to{
            opacity: 1;
            transform: translateX(0px);
        }
    }
    .search-bar:focus {
      border: 1px solid black;
    }
    .search-icon {
      position: absolute;
      right: 20px;
      top: 30%;
      
      color: #ddd;
      font-size: 18px;
      animation: pol 1s ease-out;
    }
    @keyframes pol{
        from{
            opacity: 0;
            transform: translateX(-700px);
        }
        to{
            opacity: 1;
            transform: translateX(0px);
        }
    }
    .fa-search:focus{
        color: blue;
    }
    .table {
      margin-top: 20px;
    }
    .table thead {
      background-color: #0d6efd;
      color: white;
    }
    .table tbody tr:hover {
      background-color: #f1f3f5;
    }
    .btn-back {
      display: inline-block;
      margin-bottom: 20px;
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 10px;
      width: 100px;
      border-radius: 25px;
      text-transform: uppercase;
      font-weight: bold;
      font-size: 0.9rem;
      transition: background-color 0.3s ease;
    }
    .btn-back:hover {
      background-color: #0b5ed7;
    }
    .action-icons {
      font-size: 1.2rem;
      cursor: pointer;
      transition: transform 0.2s ease;
    }
    .action-icons:hover {
      transform: scale(1.2);
    }
    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 1.2rem;
      }
      .table {
        font-size: 0.8rem;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar fixed-top">
  <div class="container-fluid">
    <a href="homepage.php" class="navbar-brand text-white">Prefect Management</a>
  </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="card p-4">
        <a href="homepage.php" class="btn btn-back">Back</a>
        <h2 class="text-primary">Deleted Records</h2>
        
        <!-- Search bar with icon -->
        <div class="search-container">
            <input type="text" id="searchInput" class="search-bar">
            <i class="fas fa-search search-icon"></i>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Teacher</th>
                        <th>Section</th>
                        <th>Violations</th>
                        <th>Gender</th>
                        <th>Date of Incident</th>
                        <th>Date of Record</th>
                        <th>Penalty</th>
                        <th>Narrative</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr data-id="<?= $row['id'] ?>">
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["full_name"] ?></td>
                        <td><?= $row["tcname"] ?></td>
                        <td><?= $row["n_section"] ?></td>
                        <td><?= $row["cause_prefect"] ?></td>
                        <td><?= $row["gender"] ?></td>
                        <td><?= $row["t_record"] ?></td>
                        <td><?= $row["tdate"] ?></td>
                        <td><?= $row["i_law"] ?></td>
                        <td><?= $row["narative"] ?></td>
                        <td>
                            <i class="fas fa-print text-primary action-icons" title="Print" onclick="printRecord(<?= $row['id'] ?>)"></i>
                            <a href="?delete_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash-alt text-danger action-icons" title="Delete"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function printRecord(id) {
    const row = document.querySelector(`#dataTable tbody tr[data-id="${id}"]`);
    if (!row) {
        alert("Record not found!");
        return;
    }

    const cells = row.cells;
    const recordData = `
        ID: ${cells[0].textContent}
        Name: ${cells[1].textContent}
        Teacher: ${cells[2].textContent}
        Section: ${cells[3].textContent}
        Violations: ${cells[4].textContent}
        Gender: ${cells[5].textContent}
        Date of Incident: ${cells[6].textContent}
        Date of Record: ${cells[7].textContent}
        Penalty: ${cells[8].textContent}
        Narrative Report: ${cells[9].textContent}
    `;

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFont("Helvetica", "normal");
    doc.setFontSize(12);
    doc.text("Record Details", 10, 10);
    doc.text(recordData, 10, 20);
    doc.save(`${cells[1].textContent}_Record.pdf`);
}

document.getElementById("searchInput").addEventListener("input", function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll("#dataTable tbody tr");

    rows.forEach(row => {
        const nameCell = row.cells[1]; 
        const name = nameCell.textContent.toLowerCase();

        if (name.includes(filter)) {
            row.style.display = ""; 
        } else {
            row.style.display = "none"; 
        }
    });
});
</script>

</body>
</html>
