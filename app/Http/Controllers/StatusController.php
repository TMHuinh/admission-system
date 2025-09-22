<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusLog;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update(Request $request, $application_id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'changed_by' => 'nullable|string|max:255',
        ]);

        $application = Application::where('application_id', $application_id)->firstOrFail();

        // chỉ cho phép chuyển từ submitted
        if ($application->status !== 'submitted') {
            return response()->json([
                'error' => 'Only applications with status "submitted" can be updated.'
            ], 422);
        }

        $fromStatus = $application->status;
        $toStatus   = $request->status;

        // cập nhật application
        $application->status = $toStatus;
        $application->save();

        // ghi log
        $log = ApplicationStatusLog::create([
            'application_id' => $application->application_id,
            'from_status'    => $fromStatus,
            'to_status'      => $toStatus,
            'changed_by'     => $request->changed_by ?? 'system',
            'changed_at'     => now(),
        ]);

        return response()->json([
            'application' => $application,
            'log' => $log
        ]);
    }
}
