<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'programme'    => 'required|string|max:255',
            'intake'       => 'required|string|max:50',
            'email'        => 'required|email|unique:registrations,email',
            'phone'        => 'required|string|max:20',
        ]);

        $registration = Registration::create($validated);

        $application = Application::create([
            'application_id' => 'APP-' . date('Y') . '-' . str_pad(Application::count() + 1, 4, '0', STR_PAD_LEFT),
            'applicant_name' => $registration->student_name,
            'programme'      => $registration->programme,
            'intake'         => $registration->intake,
            'status'         => 'submitted',
            'payment_status' => 'unpaid',
        ]);

        return response()->json([
            'registration' => $registration,
            'application'  => $application,
        ], 201);
    }
}
