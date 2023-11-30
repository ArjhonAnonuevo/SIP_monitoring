
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
  <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">
  <!-- <link href="../css/calendar.css" type="text/css" rel="stylesheet"> -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
</head>
<body>
<div class="container mx-auto max-w-2xl">
  <div class="flex justify-center">
    <div class="w-full">
      <div class="bg-white rounded-lg shadow-lg">
        <div class="p-4">
          <div id="calendar"></div>
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

     // Handle form submission to add events
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

</script>
</body>
</html>
