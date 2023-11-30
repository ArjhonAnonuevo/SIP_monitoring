document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: 'fetch_events.php',
      eventTimeFormat: {
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

 
    var eventForm = document.getElementById('eventForm');
    eventForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var eventData = {
        title: document.getElementById('event_name').value,
        start: moment(document.getElementById('event_time').value).format('YYYY-MM-DD HH:mm'),
        allDay: true
      };
      fetch(eventForm.getAttribute('action'), {
        method: eventForm.getAttribute('method'),
        body: new URLSearchParams(new FormData(eventForm))
      })
        .then(function(response) {
          return response.json();
        })
        .then(function(response) {
          if (response.success) {
            calendar.addEvent(eventData);
            document.getElementById('event_name').value = '';
            document.getElementById('event_time').value = '';
          } else {
            console.log(response.error);
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    });
  });