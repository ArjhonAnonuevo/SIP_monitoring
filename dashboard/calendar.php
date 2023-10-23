<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js'></script> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <style>
      #calendar {
        width: 100%;
        height: 700px;
      }
      .custom-button {
       background-color: green;
      }
      #eventForm {
        width: 100%;
        height: 350px;
        margin-top: 20px;
      }
      .fc-toolbar h2,
      .fc-col-header-cell-cushion {
        color: #177245;
      }
      .fc-daygrid-day:hover {
        background-color: #177245;
      }
      .fc-daygrid-day-number:hover {
        color: #fff;
      }
      .fc .fc-daygrid-day.fc-day-today:hover{
        background-color: #177245;
      }
      .fc-daygrid-day-number {
        color: #177245;
      }
      .fc-prev-button.fc-button-primary,
      .fc-next-button.fc-button-primary {
        background-color: #177245;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="calendar-card">
            <div class="card-body">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Add Event</h2>
              <form id="eventForm" action="add_events.php" method="POST">
                <div class="form-group">
                  <label for="event_name">Event Name:</label>
                  <input type="text" class="form-control" id="event_name" name="event_name" required>
                </div>
                <div class="form-group">
                  <label for="event_time">Event Time:</label>
                  <input type="datetime-local" class="form-control" id="event_time" name="event_time" required>
                </div>
                <button type="submit" class="btn btn-primary custom-button">Add Event</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: 'fetch_events.php',
    eventTimeFormat: { // to display time in 'am' or 'pm' format
      hour: '2-digit',
      minute: '2-digit',
      meridiem: 'short'
    },
    eventClick: function(info) {
      // Handle event click
      var eventTitle = info.event.title;
      var eventStart = info.event.start;
      var eventDetails = 'Event: ' + eventTitle + '\nStart: ' + eventStart;
      alert(eventDetails);
    }
  });
  calendar.render();

  // Handle form submission to add events
  $('#eventForm').on('submit', function(event) {
    event.preventDefault();
    var eventData = {
      title: $('#event_name').val(),
      start: moment($('#event_time').val()).format('YYYY-MM-DD HH:mm'),
      allDay: true
    };
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      data: $(this).serialize(),
      success: function(response) {
        if (response.success) {
          calendar.addEvent(eventData);
          $('#event_name').val('');
          $('#event_time').val('');
        } else {
          console.log(response.error);
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });
});

    </script>
  </body>
</html>