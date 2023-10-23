<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Attendance Form</h1>

        <!-- Morning Time-In Form -->
        <form action="morning time in.php" method="post">
            <div class="form-group">
                <label for="morning_timein">Time-In (Morning):</label>
                <input type="time" class="form-control" id="morning_timein" name="morning_timein" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Morning Time-In</button>
        </form>

        <!-- Lunch Time-Out Form -->
        <form action="lunch out.php" method="post">
            <div class="form-group">
                <label for="lunch_timeout">Time-Out (Lunch):</label>
                <input type="time" class="form-control" id="lunch_timeout" name="lunch_timeout" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Lunch Time-Out</button>
        </form>

        <!-- After Lunch Time-In Form -->
        <form action="after lunch time in.php" method="post">
            <div class="form-group">
                <label for="after_lunch_timein">Time-In (After Lunch):</label>
                <input type="time" class="form-control" id="after_lunch_timein" name="after_lunch_timein" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit After Lunch Time-In</button>
        </form>

        <!-- End of Day Time-Out Form -->
        <form action="end of day time out.php" method="post">
            <div class="form-group">
                <label for="end_of_day_timeout">Time-Out (End of Day):</label>
                <input type="time" class="form-control" id="end_of_day_timeout" name="end_of_day_timeout" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit End of Day Time-Out</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
