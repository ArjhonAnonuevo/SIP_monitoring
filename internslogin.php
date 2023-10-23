<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="card-body">
      <div class="container">
        <div class="card">
          <div class="card-header">
            <h2>Login</h2>
            <div id="toggleButtons" class="d-inline-block">
              <button id="loginButton" class="btn btn-primary btn-sm active">Login</button>
              <button id="registerButton" class="btn btn-primary btn-sm">Register</button>
            </div>
          </div>
          <div class="card-body">
            <form action="login_process.php" method="post">
              <div class="form-group">
                <i class="fas fa-user"></i> <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
              </div>
              <div class="form-group">
                <i class="fas fa-lock"></i><label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
      var loginButton = document.getElementById('loginButton');
      var registerButton = document.getElementById('registerButton');
      var loginForm = document.getElementById('loginForm');
      loginButton.addEventListener('click', function() {
        loginButton.classList.add('active');
        registerButton.classList.remove('active');
        loginForm.style.display = 'block';
      });
      registerButton.addEventListener('click', function() {
        registerButton.classList.add('active');
        loginButton.classList.remove('active');
        window.location.href = 'internsregister.php';
      });
    </script>
  </body>
</html>