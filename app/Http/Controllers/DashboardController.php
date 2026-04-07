<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordenes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;

class DashboardController extends BasicController
{
  public $model = Ordenes::class;
  public $reactView = 'Admin/Dashboard';
  public $prefix4filter = 'ordenes';

  /**
   * Obtiene los datos de KPI para el dashboard
   */
  public function getKpiData(Request $request)
  {
    // Obtener parámetros de filtro

    $startDate = Carbon::parse($request->input('start_date', Carbon::today()->toDateString()))->startOfDay()->toDateTimeString();
    $endDate = Carbon::parse($request->input('end_date', Carbon::today()->toDateString()))->endOfDay()->toDateTimeString();
    $branchId = $request->input('branch_id');



    // Construir consulta base
    $query = Ordenes::where('status_id', '>=', 3)
      ->whereBetween('created_at', [$startDate, $endDate]);

    // Aplicar filtro de sucursal si existe
    if ($branchId) {
      $query->where('branch_id', $branchId);
    }

    // Obtener datos actuales

    $currentSales = $query->sum('monto');
    $currentOrders = Ordenes::where('status_id', '>=', 3)
      ->whereBetween('created_at', [$startDate, $endDate])
      ->when($branchId, function ($q) use ($branchId) {
        return $q->where('branch_id', $branchId);
      })
      ->count();

    // Calcular ticket promedio
    $averageTicket = $currentOrders > 0 ? $currentSales / $currentOrders : 0;

    // Obtener ventas cruzadas (ejemplo: productos adicionales)
    /* $crossSales = Ordenes::whereBetween('created_at', [$startDate, $endDate])
            ->when($branchId, function ($q) use ($branchId) {
                return $q->where('branch_id', $branchId);
            })
            ->where('is_cross_sale', true)
            ->sum('monto'); */
    $crossSales = 0;

    // Obtener ventas del mes actual
    $firstDayOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
    $lastDayOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();



    $monthlySales = Ordenes::where('status_id', '>=', 3)
      ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
      ->when($branchId, function ($q) use ($branchId) {
        return $q->where('branch_id', $branchId);
      })
      ->sum('monto');

    // Calcular cambios porcentuales si se solicita comparación
    $compare = $request->input('compare');
    $salesChange = null;


    if ($compare) {
      // Calcular fechas para comparación
      $comparisonDates = $this->getComparisonDates($startDate, $endDate, $compare);



      // Obtener ventas del período anterior para comparación
      $previousSales = Ordenes::where('status_id', '>=', 3)
        ->whereBetween('created_at', [$comparisonDates['start_date'], $comparisonDates['end_date']])
        ->when($branchId, function ($q) use ($branchId) {
          return $q->where('branch_id', $branchId);
        })
        ->sum('monto');

      // Calcular cambio porcentual
      if ($previousSales > 0) {
        $salesChange = (($currentSales - $previousSales) / $previousSales) * 100;
      }
    }



    // Preparar respuesta
    $metrics = [
      [
        'title' => 'VENTA',
        'value' => 'S/' . number_format($currentSales, 0),
        'change' => $salesChange !== null ? sprintf('%+.1f%%', $salesChange) : '',
        'changeType' => $salesChange > 0 ? 'positive' : ($salesChange < 0 ? 'negative' : 'neutral')
      ],
      [
        'title' => 'PEDIDOS',
        'value' => $currentOrders,
        'change' => '',
        'changeType' => 'neutral'
      ],
      [
        'title' => 'TICKET PROM',
        'value' => 'S/' . number_format($averageTicket, 0),
        'change' => '',
        'changeType' => 'neutral'
      ],
      [
        'title' => 'VENTA CROSS',
        'value' => 'S/' . number_format($crossSales, 0),
        'change' => '',
        'changeType' => 'neutral'
      ],
      [
        'title' => 'VENTA MES',
        'value' => 'S/' . number_format($monthlySales, 0),
        'change' => '',
        'changeType' => 'neutral'
      ]
    ];

    return response()->json([
      'metrics' => $metrics
    ]);
  }

  /**
   * Obtiene la distribución de utilidad
   */
  public function getUtilityDistribution(Request $request)
  {
    // Obtener parámetros de filtro
    $startDate = $request->input('start_date', Carbon::today()->format('Y-m-d'));
    $endDate = $request->input('end_date', Carbon::today()->format('Y-m-d'));
    $branchId = $request->input('branch_id');

    // Consulta para obtener distribución de utilidad por canal
    $query = DB::table('ordenes')
      ->select(DB::raw('chanel, SUM(monto) as total_profit'))
      ->whereBetween('created_at', [$startDate, $endDate])
      ->groupBy('chanel');

    // Aplicar filtro de sucursal si existe
    if ($branchId) {
      $query->where('branch_id', $branchId);
    }

    $utilityData = $query->get();

    // Calcular total para porcentajes
    $totalProfit = $utilityData->sum('total_profit');

    // Preparar datos para el gráfico
    $labels = [];
    $data = [];
    $backgroundColors = [];
    $borderColors = [];

    // Colores para los canales
    $colors = [
      'web' => ['rgba(59, 130, 246, 0.8)', 'rgba(59, 130, 246, 1)'],
      'whatsapp' => ['rgba(16, 185, 129, 0.8)', 'rgba(16, 185, 129, 1)'],
      'rappi' => ['rgba(249, 115, 22, 0.8)', 'rgba(249, 115, 22, 1)']
    ];

    foreach ($utilityData as $item) {
      $labels[] = ucfirst($item->chanel);

      // Calcular porcentaje
      $percentage = $totalProfit > 0 ? round(($item->total_profit / $totalProfit) * 100, 1) : 0;
      $data[] = $percentage;

      // Asignar colores
      $chanel = strtolower($item->chanel);
      $backgroundColors[] = $colors[$chanel][0] ?? 'rgba(156, 163, 175, 0.8)';
      $borderColors[] = $colors[$chanel][1] ?? 'rgba(156, 163, 175, 1)';
    }

    return response()->json([
      'labels' => $labels,
      'data' => $data,
      'colors' => [
        'backgroundColor' => $backgroundColors,
        'borderColor' => $borderColors
      ]
    ]);
  }

  /**
   * Obtiene la distribución por canal
   */
  public function getChannelDistribution(Request $request)
  {
    // Obtener parámetros de filtro
    $startDate = Carbon::parse($request->input('start_date', Carbon::today()->toDateString()))->startOfDay()->toDateTimeString();
    $endDate = Carbon::parse($request->input('end_date', Carbon::today()->toDateString()))->endOfDay()->toDateTimeString();
    $branchId = $request->input('branch_id');

    // Consulta para obtener distribución de ventas por canal
    $query = DB::table('ordenes')
      ->select(DB::raw('chanel, COUNT(*) as total_sales'))
      ->where('status_id', '>=', 3)
      ->whereBetween('created_at', [$startDate, $endDate])
      ->groupBy('chanel');

    // Aplicar filtro de sucursal si existe
    if ($branchId) {
      $query->where('branch_id', $branchId);
    }

    $channelData = $query->get();

    // Calcular total para porcentajes
    $totalSales = $channelData->sum('total_sales');

    // Preparar datos para el gráfico
    $labels = [];
    $data = [];
    $backgroundColors = [];
    $borderColors = [];

    // Colores para los canales
    $colors = [
      'web' => ['rgba(99, 102, 241, 0.8)', 'rgba(99, 102, 241, 1)'],
      'whatsapp' => ['rgba(34, 197, 94, 0.8)', 'rgba(34, 197, 94, 1)'],
      'rappi' => ['rgba(245, 158, 11, 0.8)', 'rgba(245, 158, 11, 1)']
    ];

    foreach ($channelData as $item) {
      $labels[] = strtoupper($item->chanel);

      // Calcular porcentaje
      $percentage = $totalSales > 0 ? round(($item->total_sales / $totalSales) * 100, 1) : 0;
      $data[] = $percentage;

      // Asignar colores
      $chanel = strtolower($item->chanel);
      $backgroundColors[] = $colors[$chanel][0] ?? 'rgba(156, 163, 175, 0.8)';
      $borderColors[] = $colors[$chanel][1] ?? 'rgba(156, 163, 175, 1)';
    }

    return response()->json([
      'labels' => $labels,
      'data' => $data,
      'colors' => [
        'backgroundColor' => $backgroundColors,
        'borderColor' => $borderColors
      ]
    ]);
  }

  /**
   * Obtiene las ventas diarias
   */
  public function getDailySales(Request $request)
  {
    // Obtener parámetros de filtro

    $startDate = $request->input('start_date')
      ? Carbon::parse($request->input('start_date'))->subDays(29)->startOfDay()->toDateTimeString()
      : Carbon::today()->subDays(29)->startOfDay()->toDateTimeString();

    $endDate = $request->input('end_date')
      ? Carbon::parse($request->input('end_date'))->endOfDay()->toDateTimeString()
      : Carbon::today()->endOfDay()->toDateTimeString();
    $period = $request->input('period', 'diario');
    $branchId = $request->input('branch_id');
    $compare = $request->input('compare');



    // Obtener datos actuales
    $currentPeriodData = $this->getSalesDataByPeriod($startDate, $endDate, $period, $branchId);

    // Datos para comparación si se solicita
    $previousPeriodData = [];
    $previousPeriodLabel = '';


    if ($compare) {
      // Calcular fechas para comparación
      $comparisonDates = $this->getComparisonDates($startDate, $endDate, $compare);

      // Obtener datos del período anterior
      $previousPeriodData = $this->getSalesDataByPeriod(
        $comparisonDates['start_date'],
        $comparisonDates['end_date'],
        $period,
        $branchId
      );


      // Establecer etiqueta para el período de comparación
      $previousPeriodLabel = $compare === 'período_anterior' ? 'Período Anterior' : 'Año Anterior';
    }

    // Determinar etiqueta para el período actual
    $currentMonth = Carbon::parse($endDate)->format('F');
    $currentPeriodLabel = ucfirst($this->translateMonth($currentMonth));

    return response()->json([
      'labels' => array_keys($currentPeriodData),
      'currentPeriodData' => array_values($currentPeriodData),
      'previousPeriodData' => array_values($previousPeriodData),
      'currentPeriodLabel' => $currentPeriodLabel,
      'previousPeriodLabel' => $previousPeriodLabel
    ]);
  }

  /**
   * Obtiene las ventas semanales
   */
  public function getWeeklySales(Request $request)
  {
    // Obtener parámetros de filtro
    $startDate = $request->input('start_date', Carbon::today()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->input('end_date', Carbon::today()->format('Y-m-d'));
    $branchId = $request->input('branch_id');
    $compare = $request->input('compare');

    // Obtener datos actuales agrupados por semana
    $currentPeriodData = $this->getWeeklySalesData($startDate, $endDate, $branchId);

    // Datos para comparación si se solicita
    $previousPeriodData = [];
    $previousPeriodLabel = '';

    if ($compare) {

      // Calcular fechas para comparación
      $comparisonDates = $this->getComparisonDates($startDate, $endDate, $compare);

      //restamos un mes para que nos muestre la data semanal del mes anterior 
      if ($compare === 'período_anterior') {
        $comparisonDates['start_date'] = Carbon::parse($comparisonDates['start_date'])->subMonth()->toDateTimeString();
        $comparisonDates['end_date'] = Carbon::parse($comparisonDates['end_date'])->subMonth()->toDateTimeString();
      }
      // Obtener datos del período anterior
      $previousPeriodData = $this->getWeeklySalesData(
        $comparisonDates['start_date'],
        $comparisonDates['end_date'],
        $branchId
      );

      // Establecer etiqueta para el período de comparación
      $previousPeriodLabel = $compare === 'período_anterior' ? 'Mes Anterior' : 'Año Anterior';
    }

    // Determinar etiqueta para el período actual
    $currentMonth = Carbon::parse($endDate)->format('F');
    $currentPeriodLabel = ucfirst($this->translateMonth($currentMonth));

    return response()->json([
      'labels' => ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
      'currentPeriodData' => array_values($currentPeriodData),
      'previousPeriodData' => array_values($previousPeriodData),
      'currentPeriodLabel' => $currentPeriodLabel,
      'previousPeriodLabel' => $previousPeriodLabel
    ]);
  }

  /**
   * Obtiene los productos más vendidos
   */
  public function getTopProducts(Request $request)
  {
    // Obtener parámetros de filtro
    $startDate = Carbon::parse($request->input('start_date', Carbon::today()->toDateString()))->startOfDay()->toDateTimeString();
    $endDate = Carbon::parse($request->input('end_date', Carbon::today()->toDateString()))->endOfDay()->toDateTimeString();

    $branchId = $request->input('branch_id');
    $limit = $request->input('limit', 10);

    // Consulta para obtener productos más vendidos
    $query = DB::table('detalle_ordens')
      ->join('ordenes', 'detalle_ordens.orden_id', '=', 'ordenes.id')
      ->join('products', 'detalle_ordens.producto_id', '=', 'products.id')
      ->select(DB::raw('products.producto, SUM(detalle_ordens.cantidad) as total_quantity'))
      ->where('tipo_servicio', '=', 'producto')
      ->where('ordenes.status_id', '>=', 3)
      ->whereBetween('ordenes.created_at', [$startDate, $endDate])
      ->groupBy('products.producto')
      ->orderBy('total_quantity', 'desc')
      ->limit($limit);

    // Aplicar filtro de sucursal si existe
    if ($branchId) {
      $query->where('ordenes.branch_id', $branchId);
    }

    $topProducts = $query->get();

    // Preparar datos para el gráfico
    $products = [];
    $quantities = [];
    $colors = [];

    // Color base para degradado
    $baseColor = 'rgba(59, 130, 246, ';

    foreach ($topProducts as $index => $product) {
      $products[] = $product->producto;
      $quantities[] = $product->total_quantity;

      // Crear degradado de color
      $opacity = 0.8 - ($index * (0.45 / $limit));
      $colors[] = $baseColor . max(0.35, $opacity) . ')';
    }

    return response()->json([
      'labels' => $products,
      'data' => $quantities,
      'colors' => $colors
    ]);
  }

  /**
   * Obtiene las ventas por categoría
   */
  public function getCategorySales(Request $request)
  {
    // Obtener parámetros de filtro
    $startDate = Carbon::parse($request->input('start_date', Carbon::today()->toDateString()))->startOfDay()->toDateTimeString();
    $endDate = Carbon::parse($request->input('end_date', Carbon::today()->toDateString()))->endOfDay()->toDateTimeString();
    $branchId = $request->input('branch_id');

    // Consulta para obtener ventas por categoría
    $query = DB::table('detalle_ordens')
      ->join('ordenes', 'detalle_ordens.orden_id', '=', 'ordenes.id')
      ->join('products', 'detalle_ordens.producto_id', '=', 'products.id')
      ->join(DB::raw('(SELECT product_id, MIN(category_id) as category_id FROM products_has_category GROUP BY product_id) as phc'), 'products.id', '=', 'phc.product_id')
      ->join('categories', 'phc.category_id', '=', 'categories.id')
      ->select(DB::raw('categories.name, SUM(detalle_ordens.cantidad) as total_quantity'))
      ->where('tipo_servicio', '=', 'producto')
      ->where('ordenes.status_id', '>=', 3)
      ->whereBetween('ordenes.created_at', [$startDate, $endDate])
      ->groupBy('categories.name')
      ->orderBy('total_quantity', 'desc');

    // Aplicar filtro de sucursal si existe
    if ($branchId) {
      $query->where('ordenes.branch_id', $branchId);
    }


    $categorySales = $query->get();

    // Preparar datos para el gráfico
    $categories = [];
    $quantities = [];
    $colors = [
      'rgba(244, 63, 94, 0.8)',  // Rosa
      'rgba(249, 115, 22, 0.8)', // Naranja
      'rgba(59, 130, 246, 0.8)', // Azul
      'rgba(16, 185, 129, 0.8)', // Verde
      'rgba(168, 85, 247, 0.8)'  // Púrpura
    ];

    foreach ($categorySales as $index => $category) {
      $categories[] = $category->name;
      $quantities[] = $category->total_quantity;
    }

    // Asegurar que hay suficientes colores
    while (count($colors) < count($categories)) {
      $colors = array_merge($colors, $colors);
    }

    // Recortar el array de colores al tamaño necesario
    $colors = array_slice($colors, 0, count($categories));

    return response()->json([
      'labels' => $categories,
      'data' => $quantities,
      'colors' => $colors
    ]);
  }

  /**
   * Obtiene los pedidos mensuales
   */
  public function getMonthlyOrders(Request $request)
  {
    // Obtener parámetros de filtro
    $year = $request->input('year', Carbon::now()->year);
    $compareYear = $request->input('compare_year', Carbon::now()->year - 1);
    $branchId = $request->input('branch_id');



    // Obtener datos del año actual
    $currentYearData = $this->getMonthlyOrdersData($year, $branchId);

    // Obtener datos del año anterior para comparación
    $previousYearData = $this->getMonthlyOrdersData($compareYear, $branchId);

    return response()->json([
      'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      'datasets' => [
        [
          'label' => $year,
          'data' => $currentYearData,
          'borderColor' => 'rgba(59, 130, 246, 1)',
          'backgroundColor' => 'rgba(59, 130, 246, 0.1)'
        ],
        [
          'label' => $compareYear,
          'data' => $previousYearData,
          'borderColor' => 'rgba(16, 185, 129, 1)',
          'backgroundColor' => 'rgba(16, 185, 129, 0.1)'
        ]
      ]
    ]);
  }

  /**
   * Obtiene los montos mensuales
   */
  public function getMonthlyAmount(Request $request)
  {
    // Obtener parámetros de filtro
    $year = $request->input('year', Carbon::now()->year);
    $compareYear = $request->input('compare_year', Carbon::now()->year - 1);
    $branchId = $request->input('branch_id');

    // Obtener datos del año actual
    $currentYearData = $this->getMonthlyAmountData($year, $branchId);

    // Obtener datos del año anterior para comparación
    $previousYearData = $this->getMonthlyAmountData($compareYear, $branchId);

    return response()->json([
      'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      'datasets' => [
        [
          'label' => $year,
          'data' => $currentYearData,
          'borderColor' => 'rgba(59, 130, 246, 1)',
          'backgroundColor' => 'rgba(59, 130, 246, 0.1)'
        ],
        [
          'label' => $compareYear,
          'data' => $previousYearData,
          'borderColor' => 'rgba(16, 185, 129, 1)',
          'backgroundColor' => 'rgba(16, 185, 129, 0.1)'
        ]
      ]
    ]);
  }

  /**
   * Exporta los datos del dashboard
   */
  public function exportData(Request $request)
  {
    $format = $request->input('format', 'csv');

    // Crear instancia del exportador
    $export = new DashboardExport($request->all());

    // Generar nombre de archivo
    $filename = 'dashboard_' . Carbon::now()->format('Y-m-d_H-i-s');

    // Exportar en el formato solicitado
    switch ($format) {
      case 'xlsx':
        return Excel::download($export, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
      case 'pdf':
        return Excel::download($export, $filename . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
      case 'csv':
      default:
        return Excel::download($export, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }
  }

  /**
   * Métodos auxiliares
   */

  /**
   * Obtiene las fechas para comparación
   */
  private function getComparisonDates($startDate, $endDate, $compareType)
  {
    $startDate = Carbon::parse($startDate);
    $endDate = Carbon::parse($endDate);
    $diffDays = $endDate->diffInDays($startDate) + 1;

    switch ($compareType) {
      case 'período_anterior':
        $compStartDate = (clone $startDate)->subDays($diffDays)->startOfDay();
        $compEndDate = (clone $startDate)->subDays(1)->endOfDay();
        break;
      case 'mismo_período_año_anterior':
        $compStartDate = (clone $startDate)->subYear()->startOfDay();
        $compEndDate = (clone $endDate)->subYear()->endOfDay();
        break;
      default:
        $compStartDate = (clone $startDate)->subDays($diffDays)->startOfDay();
        $compEndDate = (clone $startDate)->subDays(1)->endOfDay();
    }

    return [
      'start_date' => $compStartDate->toDateTimeString(),
      'end_date' => $compEndDate->toDateTimeString()
    ];
  }

  /**
   * Obtiene datos de ventas según el período
   */

  private function getSalesDataByPeriod($startDate, $endDate, $period, $branchId = null)
  {
    // Convertir a objetos Carbon y ajustar al inicio y fin del día
    $startDate = Carbon::parse($startDate)->startOfDay();
    $endDate = Carbon::parse($endDate)->endOfDay();

    // Inicializar array para almacenar resultados
    $result = [];

    // Determinar formato de agrupación según el período
    switch (strtolower($period)) {
      case 'diario':
        $groupFormat = '%Y-%m-%d'; // Formato para MySQL
        $labelFormat = 'd/m'; // Formato para etiquetas
        $interval = '1 day';
        break;
      case 'semanal':
        $groupFormat = '%Y-%u'; // Formato para semanas en MySQL
        $labelFormat = '\S\e\m W';
        $interval = '1 week';
        break;
      case 'mensual':
        $groupFormat = '%Y-%m';
        $labelFormat = 'M Y';
        $interval = '1 month';
        break;
      case 'trimestral':
        $groupFormat = '%Y-%m';
        $labelFormat = '\TQ \d\e Y';
        $interval = '3 months';
        break;
      case 'anual':
        $groupFormat = '%Y';
        $labelFormat = 'Y';
        $interval = '1 year';
        break;
      default:
        $groupFormat = '%Y-%m-%d';
        $labelFormat = 'd/m';
        $interval = '1 day';
    }

    // Consulta para obtener ventas agrupadas por el período
    $query = DB::table('ordenes')
      ->select(DB::raw("DATE_FORMAT(created_at, \"$groupFormat\") as period, SUM(monto) as total_amount"))
      ->where('ordenes.status_id', '>=', 3)
      ->whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()])
      ->groupBy(DB::raw("DATE_FORMAT(created_at, \"$groupFormat\")"))
      ->orderBy('period');

    // Aplicar filtro de sucursal si existe
    if ($branchId) {
      $query->where('branch_id', $branchId);
    }

    $salesData = $query->get();

    // Inicializar array con todas las fechas en el rango
    $current = clone $startDate;
    while ($current <= $endDate) {
      $periodKey = $current->format(str_replace('%', '', $groupFormat)); // Eliminar '%' para PHP
      $periodLabel = $current->format($labelFormat);
      $result[$periodLabel] = 0;
      $current->modify("+{$interval}");
    }

    // Llenar con datos reales
    foreach ($salesData as $item) {
      try {
        $date = Carbon::createFromFormat(str_replace('%', '', $groupFormat), $item->period);
        $label = $date->format($labelFormat);
        $result[$label] = (float) $item->total_amount;
      } catch (\Exception $e) {
        // Manejo de errores si el formato no coincide
      }
    }

    return $result;
  }

  /**
   * Obtiene datos de ventas semanales
   */
  private function getWeeklySalesData($startDate, $endDate, $branchId = null)
  {
    // Convertir a objetos Carbon
    $startDate = Carbon::parse($startDate);
    $endDate = Carbon::parse($endDate);

    // Inicializar array para las 4 semanas
    $result = [
      'Semana 1' => 0,
      'Semana 2' => 0,
      'Semana 3' => 0,
      'Semana 4' => 0
    ];

    // Determinar el primer día del mes
    $firstDayOfMonth = $startDate->copy()->startOfMonth();

    // Calcular las fechas de inicio y fin de cada semana
    $weekRanges = [
      'Semana 1' => [
        $firstDayOfMonth->copy(),
        $firstDayOfMonth->copy()->addDays(6)
      ],
      'Semana 2' => [
        $firstDayOfMonth->copy()->addDays(7),
        $firstDayOfMonth->copy()->addDays(13)
      ],
      'Semana 3' => [
        $firstDayOfMonth->copy()->addDays(14),
        $firstDayOfMonth->copy()->addDays(20)
      ],
      'Semana 4' => [
        $firstDayOfMonth->copy()->addDays(21),
        $firstDayOfMonth->copy()->endOfMonth()
      ]
    ];

    // Consultar ventas para cada semana
    foreach ($weekRanges as $week => $dates) {

      $query = DB::table('ordenes')
        ->where('status_id', '>=', 3)
        ->whereBetween('created_at', [$dates[0]->toDateTimeString(), $dates[1]->toDateTimeString()]);

      // Aplicar filtro de sucursal si existe
      if ($branchId) {
        $query->where('branch_id', $branchId);
      }

      $result[$week] = (float) $query->sum('monto');
    }

    return $result;
  }

  /**
   * Obtiene datos de pedidos mensuales
   */
  private function getMonthlyOrdersData($year, $branchId = null)
  {
    $result = [];

    // Consultar pedidos para cada mes
    for ($month = 1; $month <= 12; $month++) {
      $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
      $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

      $query = DB::table('ordenes')
        ->where('status_id', '>=', 3)
        ->whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()]);

      // Aplicar filtro de sucursal si existe
      if ($branchId) {
        $query->where('branch_id', $branchId);
      }

      $result[] = $query->count();
    }


    return $result;
  }

  /**
   * Obtiene datos de montos mensuales
   */
  private function getMonthlyAmountData($year, $branchId = null)
  {
    $result = [];

    // Consultar montos para cada mes
    for ($month = 1; $month <= 12; $month++) {
      $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
      $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

      $query = DB::table('ordenes')
        ->where('status_id', '>=', 3)
        ->whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()]);

      // Aplicar filtro de sucursal si existe
      if ($branchId) {
        $query->where('branch_id', $branchId);
      }

      $result[] = round($query->sum('monto') / 1000, 2); // Convertir a miles para mejor visualización
    }

    return $result;
  }

  /**
   * Traduce el nombre del mes al español
   */
  private function translateMonth($month)
  {
    $translations = [
      'January' => 'enero',
      'February' => 'febrero',
      'March' => 'marzo',
      'April' => 'abril',
      'May' => 'mayo',
      'June' => 'junio',
      'July' => 'julio',
      'August' => 'agosto',
      'September' => 'septiembre',
      'October' => 'octubre',
      'November' => 'noviembre',
      'December' => 'diciembre'
    ];

    return $translations[$month] ?? $month;
  }
}
