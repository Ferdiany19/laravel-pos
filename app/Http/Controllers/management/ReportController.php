<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use App\models\Item;
use App\models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDayExport;
use App\Exports\ReportMonthExport;
use App\Exports\ReportYearExport;

class ReportController extends Controller
{

    public function day_export_pdf($date)
    {
        $items = $this->day_search(new Request(['date' => $date]));
        $pdf = PDF::loadView('pdf.pdfReportDay',['items' => $items,'date' => $date])->setPaper('a4','Landscape');
        return $pdf->download('reportDay'.$date .'.pdf');
    }


    public function day_export_excel($date)
    {
        $items = $this->day_search(new Request(['date' => $date]));
        return Excel::download(new ReportDayExport($items,$date), 'reportDay'.$date.'.xlsx');
    }

    public function day_index(){
        $item_name = Item::all();
        $time_now = Carbon::now();
        $date = new Request(['date' => $time_now]);
        $items = $this->day_search($date);
        return view('management.report.day')->with([
            'items' => $items,
            'item_name' => $item_name
        ]);
    }

    public function day_search(Request $date){
        $date = Carbon::parse($date['date'])->setTime(0,0,0,0);
        $items = OrderDetail::whereDate('created_at','=',$date)->get();
        foreach($items as $item){
            $item['name'] = $item->items()->first()->name;
            $item['invoice'] = $item->orders()->first()->invoice;
        }
        return $items;
    }


    public function month_export_pdf($month)
    {
        $items = $this->month_search(new Request(['month' => $month]));
        $pdf = PDF::loadView('pdf.pdfReportMonth',['items' => $items,'month' => $month])->setPaper('a4','Landscape');
        return $pdf->download('reportMonth'. $month .'.pdf');
    }


    public function month_export_excel($month)
    {
        $items = $this->month_search(new Request(['month' => $month]));
        return Excel::download(new ReportMonthExport($items,$month), 'reportMonth'.$month.'.xlsx');
    }

    public function month_index(){
        $item_name = Item::all();
        $time_now = Carbon::now()->setTime(0,0,0,0)->format('m-Y');
        $month = new Request(['month' => $time_now]);
        $items = $this->month_search($month);
        return view('management.report.month')->with([
            'items' => $items,
            'item_name' => $item_name
        ]);
    }

    public function month_search(Request $month){
        $month = Carbon::createFromFormat('d-m-Y','01-' . $month['month'])->setTime(0,0,0,0);
        $items = OrderDetail::whereMonth('created_at', '=' ,$month)->get();
        foreach($items as $item){
            $item['name'] = $item->items()->first()->name;
            $item['invoice'] = $item->orders()->first()->invoice;
        }
        return $items;
    }


    public function year_export_pdf($year)
    {
        $items = $this->year_search(new Request(['year' => $year]));
        $pdf = PDF::loadView('pdf.pdfReportYear',['items' => $items,'year' => $year])->setPaper('a4','Landscape');
        return $pdf->download('reportYear'. $year .'.pdf');
    }


    public function year_export_excel($year)
    {
        $items = $this->year_search(new Request(['year' => $year]));
        return Excel::download(new ReportYearExport($items,$year), 'reportYear'.$year.'.xlsx');
    }

    public function year_index(){
        $item_name = Item::all();
        $time_now = Carbon::now()->setTime(0,0,0,0)->format('Y');
        $year = new Request(['year' => $time_now]);
        $items = $this->year_search($year);
        return view('management.report.year')->with([
            'items' => $items,
            'item_name' => $item_name
        ]);
    }

    public function year_search(Request $year){
        $year = Carbon::createFromFormat('d-m-Y','01-01-' . $year['year'])->setTime(0,0,0,0);
        $items = OrderDetail::whereYear('created_at', '=' ,$year)->get();
        foreach($items as $item){
            $item['name'] = $item->items()->first()->name;
            $item['invoice'] = $item->orders()->first()->invoice;
        }
        return $items;
    }
}
