<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Order; 
use Carbon\Carbon;
use DB;
class ReportController extends Controller
{
    // Kiem tra xac thuc khi admin chua dang nhap
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function byOrder(Request $request)
    {  
        $year = strftime("%Y", time());
        if ($request->year) {
            $year = $request->year;
        }
        $orderYear = $this->orderByYear();
        $orderMonth = $this->orderByMonth($year);
        $orders = Order::orderBy('created_at');
        if ($request->from) { 
            $from = date("Y-m-d", strtotime($request->from));
            $orders = $orders->where('transaction_date','>=',$from);
        }
        if ($request->to) { 
            $to = date("Y-m-d", strtotime($request->to));
            $orders = $orders->where('transaction_date','<=',$to);
        }
        $total_amount = $orders->sum('total_amount');
        $orders = $orders->get(); 
        $unconfimred = 0;
        $confimred = 0;
        $delivery = 0;
        $delivered = 0;
        $cancel = 0;
        foreach ($orders as $key => $value) {
            switch ($value->status) {
                case 'unconfimred':
                    $unconfimred++;
                    break;
                case 'confimred':
                    $confimred++;
                    break;
                case 'delivery':
                    $delivery++;
                    break;
                case 'delivered':
                    $delivered++;
                    break; 
                case 'cancel':
                    $cancel++;
                    break;           
                default:
                    break;
            }
        }
        return view('admin.report.byorder', compact('orderMonth','orderYear','unconfimred','confimred','delivery','delivered','cancel','total_amount')); 
    } 
    public function byProduct(Request $request)
    {
        
        return view('admin.report.byproduct');
    }
    public function orderByYear()
    {
        $year = strftime("%Y", time());
        $orderYear = DB::table('orders')
                    ->select(DB::raw('year(transaction_date) as getYear'), DB::raw('COUNT(*) as value'))
                    ->where('transaction_date', '>=', $year)
                    ->groupBy('getYear')
                    ->orderBy('getYear', 'ASC')
                    ->get();
        return $orderYear;
    }
    public function orderByMonth($year)
    { 
        $orderMonth = DB::table('orders')
                    ->select(DB::raw('month(transaction_date) as getMonth'), DB::raw('COUNT(*) as value'))
                    ->whereYear('transaction_date',$year)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
        return $orderMonth;
    }
}