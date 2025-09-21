<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query();

        // Search theo tên sinh viên (applicant_name)
        // if ($request->has('q')) {
        //     $query->where('applicant_name', 'like', '%' . $request->q . '%');
        // }
        if ($request->has('applicant_name')) {
            $query->where('applicant_name', 'LIKE', '%' . $request->applicant_name . '%');
        }


        // Filter theo status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter theo payment_status
        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant_name' => 'required|string|max:255',
            'programme'      => 'required|string|max:255',
            'intake'         => 'required|string|max:50',
        ]);

        $application = Application::create([
            'application_id' => 'APP-' . date('Y') . '-' . str_pad(Application::count() + 1, 4, '0', STR_PAD_LEFT),
            'applicant_name' => $request->applicant_name,
            'programme'      => $request->programme,
            'intake'         => $request->intake,
            'status'         => 'submitted',
            'payment_status' => 'unpaid',
        ]);

        return response()->json($application, 201);
    }

    public function update(Request $request, $application_id)
    {
        $application = Application::where('application_id', $application_id)->firstOrFail();

        $application->update($request->only([
            'applicant_name',
            'programme',
            'intake',
            'status',
            'payment_status'
        ]));

        return response()->json($application);
    }

    public function destroy($application_id)
    {
        $application = Application::where('application_id', $application_id)->firstOrFail();
        $application->delete();

        return response()->json(['message' => 'Application deleted successfully']);
    }
}
