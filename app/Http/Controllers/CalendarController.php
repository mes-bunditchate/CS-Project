<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminderMail;

class CalendarController extends Controller
{
    public function index()
    {
        $events = MedicalRecord::all();

        $calendarEvents = [];
        foreach ($events as $event) {
            $calendarEvents[] = [
                'title' => 'No. ' .$event->patient_id,
                'start' => $event->appointment_date,
                'id' => $event->id,
            ];
        }

        return view('calendar.index', compact('calendarEvents'));
    }

    public function sendEmail($id)
    {
        $appointment = MedicalRecord::all()->findOrFail($id);

        if (!$appointment->patient || !$appointment->patient->email) {
            return response()->json(['message' => 'ไม่พบอีเมลลูกค้า'], 422);
        }

        Mail::to($appointment->patient->email)
            ->send(new AppointmentReminderMail($appointment));

        return response()->json(['message' => 'ส่งอีเมลสำเร็จ']);
    }
}
