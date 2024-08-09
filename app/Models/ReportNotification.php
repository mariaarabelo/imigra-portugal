<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportNotification extends Model
{
    use HasFactory;

    //protected $table = 'Report_Notification'; 


    // Relacionamento entre ReportNotification e Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'idnotification');
    }

    /*
    // Relacionamento entre ReportNotification e Report
    public function report()
    {
        return $this->belongsTo(Report::class, 'IdReport');
    }
	*/    
}
