<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'application_id',
        'applicant_name',
        'programme',
        'intake',
        'status',
        'payment_status'
    ];

    public function statusLogs()
    {
        return $this->hasMany(ApplicationStatusLog::class);
    }

    public function communicationLogs()
    {
        return $this->hasMany(CommunicationLog::class);
    }
}
