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
            events: "{{ route('booking.events') }}", // Ambil data dari Controller
            eventClick: function(info) {
                alert('Detail: ' + info.event.title);
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
</style>
@endsection