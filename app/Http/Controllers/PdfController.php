<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function invoice(Request $request)
    {
        $request->validate([
            'emisor' => 'required|string',
            'logo' => 'required|image'
        ]);

        $image = $request->file('logo');
        $base64 = base64_encode(file_get_contents($image));
        $imageSrc = 'data:image/png;base64,' . $base64;

        $items = json_decode($request->items);
        $subtotal = 0;
        $total = 0;
        foreach ($items as $item) {
            $subtotal += $item->cantidad * $item->precio;
            $tipo = $item->tipo;
        }

        if($tipo == 'producto') {
            $cantidadImpuesto = ($request->impuesto * $subtotal) / 100;
            $totalConDescuento = $subtotal + $cantidadImpuesto;
            $cantidadDescuento = ($request->descuento * $totalConDescuento) / 100;
            $total = $totalConDescuento - $cantidadDescuento;
        } else {
            $cantidadDescuento = ($request->descuento * $subtotal) / 100;
            $totalConDescuento = $subtotal - $cantidadDescuento;
            $cantidadImpuesto = ($request->impuesto * $subtotal) / 100;
            $total = $totalConDescuento + $cantidadImpuesto;
        }

        $pdf = Pdf::loadView('pdf.invoice', [
            'emisor' => json_decode($request->emisor),
            'cliente' => json_decode($request->cliente),
            'image' => $imageSrc,
            'numeroFactura' => $request->numeroFactura,
            'fechaFactura' => $request->fechaFactura,
            'fechaVencimiento' => $request->fechaVencimiento,
            'items' => $items,
            'subtotal' => $subtotal,
            'impuesto' => $request->impuesto,
            'descuento' => $request->descuento,
            'total' => $total
        ]);


        $fileName = 'pdfs/' . time() . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());
        $url = Storage::disk('public')->url($fileName);

        return response()->json([
            'success' => true,
            'url' => $url
        ]);
    }
}
