<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceInvoice;
use App\Models\Service;

class ServiceInvoiceDetail extends Model
{
    protected $fillable = [
        'service_invoice_id',
        'service_id',
        'prev_reading',
        'curr_reading',
        'amount',
    ];

    public function serviceInvoice()
    {
        return $this->belongsTo(ServiceInvoice::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
