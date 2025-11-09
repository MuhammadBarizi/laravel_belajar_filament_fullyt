<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\CustomerModel;
use App\Models\PenjualanModel;
use App\Models\FakturModel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportBarangPdf(Request $request)
    {
        $ids = $request->query('ids');
        $ids = $ids ? explode(',', $ids) : [];

        $records = Barang::whereIn('id', $ids)->get();

        $filename = 'barang-export-' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.barang', ['records' => $records]);

        return $pdf->download($filename);
    }

    public function exportCustomerPdf(Request $request)
    {
        $ids = $request->query('ids');
        $ids = $ids ? explode(',', $ids) : [];

        $records = CustomerModel::whereIn('id', $ids)->get();

        $filename = 'customer-export-' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.customer', ['records' => $records]);

        return $pdf->download($filename);
    }

    public function exportPenjualanPdf(Request $request)
    {
        $ids = $request->query('ids');
        $ids = $ids ? explode(',', $ids) : [];

        $records = PenjualanModel::whereIn('id', $ids)->with('customer')->get();

        $filename = 'penjualan-export-' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.penjualan', ['records' => $records]);

        return $pdf->download($filename);
    }

    public function exportFakturPdf(Request $request)
    {
        $ids = $request->query('ids');
        $ids = $ids ? explode(',', $ids) : [];

        $records = FakturModel::whereIn('id', $ids)->with('customer')->get();

        $filename = 'faktur-export-' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.faktur', ['records' => $records]);

        return $pdf->download($filename);
    }
}
