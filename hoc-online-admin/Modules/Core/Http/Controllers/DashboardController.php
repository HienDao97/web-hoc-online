<?php

namespace Modules\Core\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Orders;
use Modules\Products\Entities\Product;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
//        $end_date = Carbon::now("asia/ho_chi_minh")->format('Y-m-d H:i:s');
//        $endDate = strtotime($end_date);
//        $start_date = date('Y-m-d H:i:s', $endDate - 11*86400);
//        $orders = Orders::whereBetween('created_at', array($start_date, $end_date))->orderBy('created_at', 'desc')->get();
//        $orderDay = $orders->groupBy(function($date) {
//            return Carbon::parse($date->created_at)->format('Y-m-d'); // grouping by day
//        });
//        $date = array();
//        $total_array = array();
//        $labels = "";
//        for($i = 0; $i < 11 ; $i++){
//            $start_date = strtotime($start_date);
//            $start_date = date('Y-m-d H:i:s', $start_date + 86400);
//            $temp = Carbon::parse($start_date)->format('Y-m-d');
//            if(empty($orderDay[$temp])){
//                array_push($total_array, 0);
//            }
//            else{
//                $total =  0;
//                foreach ($orderDay[$temp] as $item){
//                    $total += (int) $item->total_price;
//                }
//                array_push($total_array, $total/1000000);
//            }
//            array_push($date, $temp);
//        };
//        $labels .= implode(',', $date);
//
//        $products = Product::orderBy('created_at','DESC')->take(10)->get();

        return view('core::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('core::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('core::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
