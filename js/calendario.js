document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'pt-br',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    initialDate: Date.now(),
    navLinks: true,
    selectable: true,
    selectMirror: true,

    
    editable: false,
    dayMaxEvents: true,
    events: []
  });


  async function fetchEvents() {
    try {
      const response = await fetch('includes/_scripts/repository/processos/findAll.php');
      if (!response.ok) throw new Error('Erro ao buscar eventos');
      const events = await response.json();
      if (events.error) throw new Error(events.error);

      return events;
    } catch (error) {
      console.error('Erro ao buscar eventos:', error);
      alert('Erro ao buscar eventos: ' + error.message);
      return [];
    }
  }
  calendar.on('eventClick', function (info) {
    const codigo = info.event.extendedProps.codigo; 
    window.location.href = `dashboard.php?r=acompanhamento&codigo=${codigo}`; 
  });

  fetchEvents().then(events => {
    calendar.addEventSource(events);
    calendar.render();
  });
});
