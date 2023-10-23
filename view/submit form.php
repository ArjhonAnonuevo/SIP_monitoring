<!DOCTYPE html>
<html>
<head>
    <title>User Information Viewer</title>
</head>
<body>
    <h1>User Information Viewer</h1>

    <!-- Form to input user information to insert into the database -->
    <form action="submit.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <input type="submit" name="submit" value="Insert User Info">
    </form>
</body>
</html>
