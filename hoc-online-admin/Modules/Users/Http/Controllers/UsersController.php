<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Orders;
use Modules\Users\Entities\Users;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('users::index');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        return Datatables::of(Users::getBaseList())
            ->escapeColumns([])
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d-m-Y');
            })
            ->editColumn('name', function ($user) {
                if(!empty($user->name)){
                    return $user->name;
                }
                else{
                    return $user->firstname." ".$user->lastname;
                }
            })
            ->editColumn('email', function ($user) {
                if(!empty($user->email)){
                    return $user->email;
                }
                else{
                    return $user->email_order;
                }

            })
            ->editColumn('password', function ($user) {
                if(!empty($user->password)){
                    return "Has account";
                }
                return "Has not account";
            })
            ->addColumn('actions', function ($user) {
                $html = '<a href="'.route('user.view', $user->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil">View</i></a>';
                return $html;
            })
            ->removeColumn('email_order')
            ->removeColumn('firstname')
            ->removeColumn('lastname')
            ->make(true);
    }

    public function view($id){
        $items = Orders::select("users.*", "orders.created_at","orders.id as order_id", "orders.status", "orders.total_price")->where('orders.customer_id',$id)->join(
            'users', 'users.id', '=', 'orders.customer_id'
        )->get();
        $user = Users::where('id', $id)->first();
        return view('users::view', compact('items', 'user'));
    }
}
