import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// import { Calendar } from '@fullcalendar/core';
// import dayGridPlugin from '@fullcalendar/daygrid';
// import timeGridPlugin from '@fullcalendar/timegrid';

// document.addEventListener('DOMContentLoaded', function () {
//     var calendarEl = document.getElementById('calendar');
//     var calendar = new Calendar(calendarEl, {
//         plugins: [dayGridPlugin, timeGridPlugin],
//         initialView: 'dayGridMonth',
//         headerToolbar: {
//             left: 'prev,next',
//             center: 'title',
//             right: 'dayGridMonth,timeGridWeek,timeGridDay',
//         },
//         events: '/calendar', // استبدلها برابط جلب البيانات
//         eventClick: function (info) {
//             // منع الرابط الافتراضي إذا كان موجودًا
//             info.jsEvent.preventDefault();

//             // عرض تفاصيل الحدث
//             var eventDetails = `
//                 <h4>تفاصيل الموعد:</h4>
//                 <p><strong>عنوان:</strong> ${info.event.title}</p>
//                 <p><strong>تاريخ البدء:</strong> ${info.event.start.toLocaleString()}</p>
//                 <p><strong>تاريخ الانتهاء:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'N/A'}</p>
//             `;

//             // مثال: عرض التفاصيل في نافذة منبثقة بسيطة
//             var modal = document.getElementById('eventModal');
//             var modalContent = document.getElementById('modalContent');
//             modalContent.innerHTML = eventDetails;
//             modal.style.display = 'block';
//         },
//     });
//     calendar.render();
// });
// import { createCalendar,
//     createViewDay,
//     createViewMonthAgenda,
//     createViewMonthGrid,
//     createViewWeek  } from '@schedule-x/calendar'
// import '@schedule-x/theme-default/dist/index.css'
// import { createEventModalPlugin } from '@schedule-x/event-modal'

// const eventModal = createEventModalPlugin()
// const calendar = createCalendar({
//   views: [createViewDay(), createViewMonthAgenda(), createViewMonthGrid(), createViewWeek()],
//   events: calendarEvents ,
//   plugins: [eventModal],
//   selectedDate: '2024-12-18',

// })

// calendar.render(document.getElementById('calendar'))
import { createCalendar, viewDay, viewMonthAgenda, viewMonthGrid, viewWeek } from '@schedule-x/calendar'
 import { createEventModalPlugin } from '@schedule-x/event-modal'
import '@schedule-x/theme-default/dist/index.css'

const calendar = createCalendar({
  views: [viewMonthGrid, viewMonthAgenda, viewWeek, viewDay],
  defaultView: viewMonthGrid.name,
  events: calendarEvents,
  plugins: [createEventModalPlugin(), createEventModalPlugin()]
})

const calendarEl = document.getElementById('calendar')

calendar.render(calendarEl)
