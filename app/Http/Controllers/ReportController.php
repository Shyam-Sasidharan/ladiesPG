<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function index(Request $r, ReportService $service)
    {
        $r->validate(['type' => 'nullable|in:'.implode(',', array_keys(ReportService::TYPES)), 'month' => 'nullable|date_format:Y-m', 'format' => 'nullable|in:xlsx,pdf']);
        $type = $r->input('type', 'occupancy');
        $data = $service->data($type, $r->month);
        if ($r->format === 'xlsx') {
            $sheet = new Spreadsheet;
            $tab = $sheet->getActiveSheet();
            foreach (array_merge([$data['headers']], $data['rows']) as $i => $row) {
                foreach ($row as $j => $value) {
                    $tab->setCellValueExplicit(Coordinate::stringFromColumnIndex($j + 1).($i + 1), (string) $value, DataType::TYPE_STRING);
                }
            } $tab->getStyle('1:1')->getFont()->setBold(true);
            foreach (range(1, count($data['headers'])) as $c) {
                $tab->getColumnDimension(Coordinate::stringFromColumnIndex($c))->setAutoSize(true);
            }

            return response()->streamDownload(fn () => (new Xlsx($sheet))->save('php://output'), $type.'.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
        }
        if ($r->format === 'pdf') {
            $pdf = new Dompdf(['isRemoteEnabled' => false]);
            $pdf->loadHtml(view('reports.pdf', $data)->render());
            $pdf->setPaper('A4', 'landscape');
            $pdf->render();

            return response($pdf->output(), 200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'attachment; filename="'.$type.'.pdf"']);
        }
        $page = max(1, $r->integer('page', 1));
        $data['rows'] = new LengthAwarePaginator(array_slice($data['rows'], ($page - 1) * 25, 25), count($data['rows']), 25, $page, ['path' => $r->url(), 'query' => $r->query()]);

        return view('reports.index', $data + ['types' => ReportService::TYPES]);
    }
}
