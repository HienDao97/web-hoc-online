<?php

namespace Modules\Course\Http\Controllers;

use App\Models\KMsg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $actions = request()->route()->getAction();
        $controller = explode("@",$actions['controller']);
        $controller = $controller[0];
        Session::put('edit', Auth::user()->hasPermission($controller, "edit"));
        Session::put('destroy', Auth::user()->hasPermission($controller, "destroy"));
        return view('course::course.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'name' => 'required|unique:courses',
                'code' => 'required|unique:courses',
                'class_info' => 'required|max:500',
            ];
            $result = new KMsg();

            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            // Save project
            try {
                Course::create($params);
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            return view('course::course.create');
        }
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
        return view('course::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'name' => 'required',
                'code' => 'required',
                'class_info' => 'required|max:500',
            ];
            $result = new KMsg();

            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            // Save project
            try {
                $item = Course::where('id', $id)->whereNull('deleted_at')->first();
                if(empty($item)){
                    $result->message = ["Không tồn tại khoá học này "];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
                $item->name = $params["name"];
                $item->code = $params["code"];
                $item->class_info = $params["class_info"];
                $item->save();
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $item = Course::where('id', $id)->whereNull('deleted_at')->first();
            return view('course::course.edit', compact('item'));
        }
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
    public function destroy($id)
    {
        $result = Course::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('course.index'))->with('messages','Xoá khoá học thành công');
        } else {
            return redirect(route('course.index'))->withErrors(["Không tồn tại khoá học này "]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = Course::whereNull('deleted_at');
        return Datatables::of($query)
            ->escapeColumns([])
            ->addColumn('actions', function ($theory_group) {
                $html = Course::genColumnHtml($theory_group);
                return $html;
            })

            ->removeColumn('updated_at')
            ->removeColumn('deleted_at')
            ->make(true);
    }
}
