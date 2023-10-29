
  function displayAttendanceDates() {
    var table, rows, i, attendanceDate;
    table = document.getElementById("attendanceTable");
    rows = table.rows;
    for (i = 1; i < rows.length; i++) {
      attendanceDate = new Date(rows[i].getElementsByTagName("TD")[6].innerHTML); // 6 is the index of the "Attendance date" column
      console.log(attendanceDate.toDateString()); // Display the attendance date in the console
    }
  }

