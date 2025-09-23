<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationAcceptedMail;
use App\Models\Application;
use App\Models\CommunicationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function send(Request $request, $application_id)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Lấy application có status = accepted
        $application = Application::where('application_id', $application_id)
            ->where('status', 'accepted')
            ->firstOrFail();

        // 1. Gửi email
        Mail::to($request->email)->send(new ApplicationAcceptedMail($application));

        // 2. Lưu log vào DB
        $log = CommunicationLog::create([
            'application_id' => $application->application_id,
            'action'         => 'reminder_accepted',
            'template'       => 'document_due', // ví dụ, có thể thay đổi theo tình huống
            'sent_to'        => $request->email,
            'sent_at'        => now(),
        ]);

        return response()->json([
            'message' => 'Acceptance email sent & logged successfully',
            'to'      => $request->email,
            'log'     => $log
        ]);
    }
}
