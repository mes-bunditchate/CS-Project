<p>เรียนคุณ {{ $appointment->patient->name ?? 'ลูกค้า' }},</p>
<p>นี่คือการแจ้งเตือนนัดหมายของคุณ:</p>

<ul>
    <li><strong>วันเวลา:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y เวลา H:i') }}</li>
</ul>

<p>ขอบคุณที่ใช้บริการ</p>