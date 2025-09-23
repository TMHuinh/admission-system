<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'action',
        'template',
        'sent_to',
        'sent_at',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'application_id');
    }
}
