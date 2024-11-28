<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <title>Prefect Management System</title>

  <style>
    /* Global Styles */
    body {
      background-color: #f4f6f9;
      font-family: Arial, sans-serif;
    }

    .navbar {
      background-color: #28a745;
      color: white;
      font-weight: bold;
      padding: 1.5rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-container {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 1320px;
      margin-left: -103px;
    }

    /* Table Styles */
    .table thead {
      background-color: #343a40;
      color: white;
      font-weight: bold;
    }

    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
      cursor: pointer;
    }

    .btn-dark {
      background-color: #333;
      border: none;
      padding: 0.5rem 1rem;
      font-size: 1rem;
      transition: all 0.3s;

    }

    .btn-dark:hover {
      background-color: #555;
    }

    /* Icon Styles */
    .fa-pen-to-square:hover {
      color: #007bff;
      transition: 0.3s;
    }

    .fa-trash:hover {
      color: #dc3545;
      transition: 0.3s;
    }

    /* Modal Customization */
    .modal-header {
      background-color: #dc3545;
      color: white;
    }

    .modal-content {
      border-radius: 8px;
      overflow: hidden;
    }

    .modal-footer .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .modal-footer .btn-danger {
      background-color: #dc3545;
      border: none;
      transition: all 0.3s;
    }

    .modal-footer .btn-danger:hover {
      background-color: #c82333;
    }

    /* Delete Animation */
    .modal-content.animate-out {
      animation: professionalExit 0.8s ease forwards;
    }

    @keyframes professionalExit {
      0% {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
      50% {
        opacity: 0.6;
        transform: scale(0.9) translateY(-10px);
      }
      100% {
        opacity: 0;
        transform: scale(0.5) translateY(-50px);
      }
    }
    .alert{
      margin-left: -103px;
    }
    .alert-warning{
      width: 300px;
    }
    #is{
      margin-left: 78px;
      font-size: 5px;
      margin-top: -24px;
      display: flex;
    }
    #hit{
      margin-left: 900px;
    }


  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg text-center">
    Prefect Management System Record
  </nav>

  <div class="container mt-5">
    <?php if (isset($_GET["msg"])): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_GET["msg"]) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="table-container mt-4">
      <div class="d-flex justify-content-between mb-3">
        <h4 class="text-secondary">Manage Records</h4>
        <a href="add_new.php" class="btn btn-dark" id="hit">Add New</a>
        <a href="add_new.php" class="btn btn-dark">Back</a>
      </div>

      <table class="table table-hover text-center">
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
            <th>Narative Report</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "db_conn.php";
          $result = mysqli_query($conn, "SELECT * FROM `crud`");
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
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
                <a href="edit.php?id=<?= $row['id'] ?>" class="text-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <div class="isod">
                <a href="#" class="text-dark" id="is" onclick="openDeleteModal(<?= $row['id'] ?>)">
                  <i class="fa-solid fa-trash fs-5"></i>
                </a>
              </div>


                <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p>Are you sure you want to delete this record?</p>
          <p class="text-muted">Type <strong>yes</strong> to proceed:</p>
          <input type="text" id="confirmInput" class="form-control text-center" placeholder="Enter confirmation text">
          <small id="errorFeedback" class="text-danger d-none">Incorrect confirmation phrase.</small>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and Custom Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let recordIdToDelete = null;

      window.openDeleteModal = function(recordId) {
        recordIdToDelete = recordId;
        document.getElementById("confirmInput").value = ""; 
        document.getElementById("errorFeedback").classList.add("d-none");
        new bootstrap.Modal(document.getElementById("deleteModal")).show();
      };

      document.getElementById("confirmDeleteButton").addEventListener("click", function() {
        const confirmInput = document.getElementById("confirmInput").value.trim().toLowerCase();
        const modalContent = document.querySelector("#deleteModal .modal-content");

        if (confirmInput === "yes") {
          modalContent.classList.add("animate-out");
          setTimeout(() => {
            window.location.href = `delete.php?id=${recordIdToDelete}`;
          }, 800);
        } else {
          document.getElementById("errorFeedback").classList.remove("d-none");
        }
      });
    });
  </script>






              </td>
            </tr>
          <?php }

           ?>
        </tbody>
      </table>
    </div>
  </div>

  </body>

</html>





