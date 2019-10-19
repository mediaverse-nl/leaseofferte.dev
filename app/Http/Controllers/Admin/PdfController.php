<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Barryvdh\DomPDF\PDF;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    protected $pdf;
    protected $order;

    public function __construct(PDF $pdf, Order $order)
    {
        $this->pdf = $pdf;
        $this->order = $order;
    }

    public function streamInvoice($id)
    {
        $order = $this->order->findOrFail($id);

        $pdf = $this->pdf->loadView('pdf.invoice', ['order' => $order]);

        return $pdf->stream();
    }

    public function downloadInvoice($id)
    {
        $order = $this->order->findOrFail($id);

        $pdf = $this->pdf->loadView('pdf.invoice', ['order' => $order]);

        return $pdf->download('tantemartje-invoice-'.$order->id.'.pdf');
    }

    public function streamPackingSlip($id)
    {
        $order = $this->order->findOrFail($id);

        $pdf = $this->pdf->loadView('pdf.packingSlip', ['order' => $order]);

        return $pdf->stream();
    }

    public function downloadPackingSlip($id)
    {
        $order = $this->order->findOrFail($id);

        $pdf = $this->pdf->loadView('pdf.packingSlip', ['order' => $order]);

        return $pdf->download('tantemartje-packing-slip-'.$order->id.'.pdf');
    }
}
