<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Barryvdh\DomPDF\PDF;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    protected $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function streamInvoice($id)
    {
        $order = $this->order->findOrFail($id);

        $pdf = $this->pdf->loadView('pdf.order', ['order' => $order]);

        return $pdf->stream();
    }
}
