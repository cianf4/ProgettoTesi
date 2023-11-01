<x-app-layout>
  <!--  <style>
        .button-container {
            display: flex;
            justify-content: center;
        }
    </style>-->
    <style>
        .dropdown-container {
            text-align: center;
        }

        #viewSelector {
            width: 115px; /* Larghezza desiderata del menu a tendina */
            border-radius: 10px; /* Imposta il raggio di arrotondamento desiderato */
            padding: 8px 12px; /* Imposta il padding desiderato per spaziatura interna */

        }
        #calendar {
            max-height: 815px; /* Imposta l'altezza massima desiderata */
        //overflow-y: auto; /* Aggiungi una barra di scorrimento verticale se necessario */
        }


    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="dropdown-container">
        <select id="viewSelector">
            <option value="dayGridMonth">Mese</option>
            <option value="timeGridWeek">Settimana</option>
            <option value="timeGridDay">Giorno</option>
        </select>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id='calendar' class="p-10"></div>
            </div>
        </div>
    </div>



@push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    slotMinTime: '8:00:00',
                    slotMaxTime: '20:00:00',
                    allDaySlot: false,
                    events: @json($events),


                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: false,
                    },
                    eventContent: function (arg)  {
                        var group = arg.event.extendedProps.group;
                        var name = arg.event.title;
                        var date = arg.timeText;
                        var status = arg.event.extendedProps.status;
                        var user = arg.event.extendedProps.user;
                        var content = document.createElement('div');



                        if (status) {
                            var statusElement = document.createElement('span');
                            statusElement.textContent = status;
                            content.appendChild(statusElement);
                            statusElement.classList.add('text-2xs', 'text-white', 'uppercase', 'font-semibold', 'p-1', 'rounded-sm');
                            switch (status) {
                                case 'planned':
                                    statusElement.classList.add('bg-amber-600');
                                    break;
                                case 'completed':
                                    statusElement.classList.add('bg-indigo-600');
                                    break;
                                case 'canceled':
                                    statusElement.classList.add('bg-red-600');
                                    break;
                                case 'active':
                                    statusElement.classList.add('bg-emerald-600');
                                    break;
                            }
                        }

                        if (name) {
                            var nameElement = document.createElement('div');
                            nameElement.textContent = name;
                            content.appendChild(nameElement);
                            nameElement.classList.add('text-sm', 'font-semibold', 'text-white', 'mt-1');
                        }
                        if (user) {
                            var userElement = document.createElement('div');
                            userElement.textContent = user;
                            content.appendChild(userElement);
                            userElement.classList.add('text-sm', 'font-semibold', 'text-white', 'mt-1');
                        }

                        if (date) {
                            var dateElement = document.createElement('div');
                            dateElement.textContent = date;
                            content.appendChild(dateElement);
                            dateElement.classList.add('text-xs', 'text-white');
                        }

                        if (group) {
                            var groupElement = document.createElement('div');
                            groupElement.textContent = group;
                            content.appendChild(groupElement);
                            groupElement.classList.add('text-sm', 'font-semibold', 'text-white', 'mt-1');
                        }


                        return { domNodes: [content] };
                    },
                });
                calendar.render();
                const viewSelector = document.getElementById('viewSelector');
                viewSelector.addEventListener('change', function () {
                    const selectedView = viewSelector.value;
                    calendar.changeView(selectedView); // Cambia la visualizzazione in base alla selezione
                });
                /*
                document.getElementById('switchToWeek').addEventListener('click', function () {
                    calendar.changeView('timeGridWeek');
                });

                // Gestisci il click sul bottone "Giorno"
                document.getElementById('switchToDay').addEventListener('click', function () {
                    calendar.changeView('timeGridDay');
            });
                document.getElementById('switchToMonth').addEventListener('click', function () {
                    calendar.changeView('dayGridMonth');
                });
            */});
        </script>
    @endpush
</x-app-layout>
