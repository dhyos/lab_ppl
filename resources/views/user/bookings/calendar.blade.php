@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kalender Peminjaman</h1>
                <p class="text-gray-600 mt-1">Cek ketersediaan laboratorium secara visual.</p>
            </div>
            <a href="{{ route('booking.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                + Ajukan Baru
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div id="calendar"></div>
        </div>

    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Tampilan bulanan
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'id', // Bahasa Indonesia
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari'
            },
            events: "{{ route('booking.events') }}",

            eventContent: function(arg) {
                console.log('Event:', arg.event.title, 'Color:', arg.event.backgroundColor, 'Props:', arg.event.extendedProps);
                let props = arg.event.extendedProps;
                let timeText = arg.timeText;
                let labText = props.lab.length > 15 ? props.lab.substring(0, 15) + '...' : props.lab;
                let kegiatanText = props.kegiatan.length > 15 ? props.kegiatan.substring(0, 15) + '...' : props.kegiatan;
                let bgColor = arg.event.backgroundColor || '#3b82f6';
                return {
                    html: `<div style="font-size: 0.75rem; line-height: 1.1; padding: 2px; background-color: ${bgColor}; color: white; border-radius: 4px;">
                        <strong>${timeText}</strong><br>
                        ${labText}<br>
                        ${kegiatanText}
                    </div>`
                };
            },

            eventClick: function(info) {
                let props = info.event.extendedProps;
                let html = `
                    <strong>Lab:</strong> ${props.lab}<br>
                    <strong>Waktu:</strong> ${props.waktu}<br>
                    <strong>Kegiatan:</strong> ${props.kegiatan}
                `;
                if (props.type === 'booking') {
                    html += `<br><strong>Peminjam:</strong> ${props.user}<br><strong>Status:</strong> ${props.status}`;
                } else if (props.type === 'jadwal') {
                    html += `<br><strong>Status:</strong> ${props.status}`;
                }
                Swal.fire({
                    title: 'Detail ' + (props.type === 'booking' ? 'Peminjaman' : 'Jadwal'),
                    html: html,
                    icon: 'info',
                    confirmButtonText: 'Tutup'
                });
            },

            
            height: 'auto',
            contentHeight: 600
        });
        
        calendar.render();
    });
    
</script>

<style>
    /* Sedikit styling agar kalender lebih cantik */
    .fc-toolbar-title { font-size: 1.25rem !important; font-weight: bold; }
    .fc-button-primary { background-color: #2563eb !important; border-color: #2563eb !important; }
    .fc-event { cursor: pointer; }

    /* Event kalender */
    .custom-event {
        background-color: #2563eb !important;   /* Biru */
        border-radius: 8px !important;
        padding: 4px 6px !important;
        font-weight: 600;
        font-size: 0.85rem;
        color: #ffffff !important;
        border: none !important;
    }

    /* Hover effect */
    .custom-event:hover {
        background-color: #1d4ed8 !important;
        transform: scale(1.02);
        transition: all 0.2s ease-in-out;
    }

</style>
@endsection