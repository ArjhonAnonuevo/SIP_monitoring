document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: 'fetch_events.php',
      eventTimeFormat: {
          hour: '2-digit',
          minute: '2-digit',
          meridiem: 'short'
      },
  });

  calendar.render();

  function openModal(title, start) {
      var modal = document.getElementById('eventModal');
      modal.classList.remove('hidden');

      document.getElementById('eventTitle').textContent = title;
      document.getElementById('eventStart').textContent = `Start: ${moment(start).format('YYYY-MM-DD HH:mm')}`;

      document.getElementById('closeModalBtn').addEventListener('click', function () {
          modal.classList.add('hidden');
      });
  }

  // Handle form submission to add events
  $('#eventForm').on('submit', function (event) {
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
          success: function (response) {
              if (response.success) {
                  calendar.addEvent(eventData);
                  $('#event_name').val('');
                  $('#event_time').val('');
              } else {
                  console.log(response.error);
              }
          },
          error: function (xhr, status, error) {
              console.log(error);
          }
      });
  });
});
