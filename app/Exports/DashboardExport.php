<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $filters;
    
    /**
     * Constructor
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Obtener parámetros de filtro
        $startDate = $this->filters['start_date'] ?? Carbon::today()->format('Y-m-d');
        $endDate = $this->filters['end_date'] ?? Carbon::today()->format('Y-m-d');
        $period = $this->filters['period'] ?? 'diario';
        $branchId = $this->filters['branch_id'] ?? null;
        
        // Determinar formato de agrupación según el período
        switch (strtolower($period)) {
            case 'diario':
                $groupFormat = 'Y-m-d';
                $labelFormat = 'd/m/Y';
                break;
            case 'semanal':
                $groupFormat = 'Y-W';
                $labelFormat = '\S\e\m\a\n\a W, Y';
                break;
            case 'mensual':
                $groupFormat = 'Y-m';
                $labelFormat = 'F Y';
                break;
            case 'trimestral':
                $groupFormat = 'Y-n';
                $labelFormat = '\T\r\i\m\e\s\t\r\e Q, Y';
                break;
            case 'anual':
                $groupFormat = 'Y';
                $labelFormat = 'Y';
                break;
            default:
                $groupFormat = 'Y-m-d';
                $labelFormat = 'd/m/Y';
        }
        
        // Consulta para obtener ventas agrupadas por el período
        $query = DB::table('sales')
            ->select(DB::raw("
                DATE_FORMAT(date, '{$groupFormat}') as periodo,
                COUNT(*) as num_ventas,
                SUM(amount) as monto_total,
                AVG(amount) as ticket_promedio,
                SUM(profit) as utilidad
            "))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy(DB::raw("DATE_FORMAT(date, '{$groupFormat}')"))
            ->orderBy('periodo');
            
        // Aplicar filtro de sucursal si existe
        if ($branchId) {
            $query->where('branch_id', $branchId);
        }
        
        $salesData = $query->get();
        
        // Formatear los datos para la exportación
        $formattedData = $salesData->map(function ($item) use ($groupFormat, $labelFormat) {
            // Formatear la fecha según el período
            $date = Carbon::createFromFormat($groupFormat, $item->periodo);
            
            return [
                'Período' => $date->format($labelFormat),
                'Número de Ventas' => $item->num_ventas,
                'Monto Total' => 'S/' . number_format($item->monto_total, 2),
                'Ticket Promedio' => 'S/' . number_format($item->ticket_promedio, 2),
                'Utilidad' => 'S/' . number_format($item->utilidad, 2),
                'Margen (%)' => $item->monto_total > 0 
                    ? number_format(($item->utilidad / $item->monto_total) * 100, 2) . '%'
                    : '0.00%'
            ];
        });
        
        return $formattedData;
    }
    
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Período',
            'Número de Ventas',
            'Monto Total',
            'Ticket Promedio',
            'Utilidad',
            'Margen (%)'
        ];
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        $period = ucfirst($this->filters['period'] ?? 'diario');
        $startDate = $this->filters['start_date'] ?? Carbon::today()->format('d/m/Y');
        $endDate = $this->filters['end_date'] ?? Carbon::today()->format('d/m/Y');
        
        return "Reporte {$period} ({$startDate} - {$endDate})";
    }
    
    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la fila de encabezados
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '3B82F6'] // Azul
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF']]
            ],
            
            // Estilo para todas las celdas
            'A1:F100' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ],
            
            // Estilo para columnas numéricas
            'B2:F100' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ],
            ],
        ];
    }
}
