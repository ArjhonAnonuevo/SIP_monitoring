<!DOCTYPE html>
<html>
<head>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .custom-card {
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      height: auto;
      margin-bottom: 20px;
    }
    .custom-card .card-header {
      background-color: #f5f5f5;
      font-weight: bold;
    }
    .custom-card .card-body {
      padding: 0;
    }
    .custom-card .table {
      margin-bottom: 0;
    }
    .custom-container {
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="custom-container">
    <div class="card custom-card">
      <div class="card-header">
        <h5 class="mb-0">List of Users</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>john@example.com</td>
                <td>John</td>
                <td>Doe</td>
                <td>
                  <button type="button" class="btn btn-primary btn-sm">View</button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>jane@example.com</td>
                <td>Jane</td>
                <td>Smith</td>
                <td>
                  <button type="button" class="btn btn-primary btn-sm">View</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Bootstrap JS (optional) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
