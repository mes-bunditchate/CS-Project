{{-- resources/views/calendar/index.blade.php --}}
@extends('layouts.main')

@section('content')
<head>
    <!-- FullCalendar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            font-size: 2.2rem;
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 3px 12px rgba(0,0,0,0.2);
        }

        .modal-header {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .modal-close {
            float: right;
            cursor: pointer;
            color: #888;
            font-size: 1.2rem;
        }

        .modal-close:hover {
            color: #000;
        }
    </style>
</head>

<h1>📅 Calendar</h1>
<div id="calendar"></div>

<!-- Custom Modal -->
<div class="modal-overlay" id="eventModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="modal-header">Appointment Details</div>
        <p><strong>Patient:</strong> <span id="eventTitle"></span></p>
        <p><strong>Time:</strong> <span id="eventTime"></span></p>
        <button id="sendEmailBtn" class="btn btn-primary" style="margin-top: 10px;">ส่งอีเมลหาลูกค้า</button>
        <!-- <p><strong>Description:</strong></p><p id="eventDescription"></p> -->
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

<script>
    function closeModal() {
        $('#eventModal').fadeOut();
    }

    $(document).ready(function () {
        let selectedEventId = null;
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            timeFormat: 'HH:mm',
            events: @json($calendarEvents),
            eventClick: function(event) {
                $('#eventTitle').text(event.title);
                $('#eventTime').text(moment(event.start).format('D MMMM YYYY [at] HH:mm')); // <-- ตรงนี้ด้วย
                selectedEventId = event.id;
                $('#eventModal').fadeIn();
            }
        });
        $('#sendEmailBtn').click(function () {
            console.log(selectedEventId);
            if (selectedEventId) {
                const confirmSend = confirm("คุณแน่ใจหรือไม่ว่าต้องการส่งอีเมลแจ้งเตือนลูกค้ารายนี้?");
                if (!confirmSend) return;

                $.ajax({
                    url: `/calendar/${selectedEventId}/send-email`,
                    method: 'GET',
                    success: function (res) {
                        alert(res.message || 'ส่งอีเมลเรียบร้อยแล้ว');
                        closeModal();
                    },
                    error: function (xhr) {
                        alert('เกิดข้อผิดพลาดในการส่งอีเมล');
                    }
                });
            }
        });
    });

    // ปิด modal เมื่อคลิกด้านนอก
    $(document).on('click', '#eventModal', function (e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection