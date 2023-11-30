
  function displayAttendanceDates() {
    var table, rows, i, attendanceDate;
    table = document.getElementById("attendanceTable");
    rows = table.rows;
    for (i = 1; i < rows.length; i++) {
      attendanceDate = new Date(rows[i].getElementsByTagName("TD")[6].innerHTML); 
      console.log(attendanceDate.toDateString()); 
    }
  }

