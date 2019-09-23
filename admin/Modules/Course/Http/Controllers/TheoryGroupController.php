<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\TheoryGroup;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use App\Models\KMsg;
use Carbon\Carbon;

class TheoryGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('course::theory_group.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'name' => 'required',
                'course' => 'required',
                'description' => 'required|max:500',
                'status' => 'required'
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
                $params['course_id'] = $params['course'];
                TheoryGroup::create($params);
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::theory_group.create', compact('courses'));
        }
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
                'course' => 'required',
                'description' => 'required|max:500',
                'status' => 'required'
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
                $item = TheoryGroup::where('id', $id)->whereNull('deleted_at')->first();
                if(empty($item)){
                    $result->message = ["Không tồn tại khoá học này "];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
                $item->name = $params["name"];
                $item->course_id = $params["course"];
                $item->description = $params["description"];
                $item->status = $params["status"];
                $item->save();
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $item = TheoryGroup::where('id', $id)->whereNull('deleted_at')->first();
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::theory_group.edit', compact('item','courses'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $result = TheoryGroup::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('theory.group.index'))->with('messages','Xoá khoá loại khoá học thành công');
        } else {
            return redirect(route('theory.group.index'))->withErrors(["Không tồn tại loại khoá học này "]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = TheoryGroup::with("course")->whereNull('deleted_at');
        return Datatables::of($query)
            ->escapeColumns([])
            ->addColumn('actions', function ($course) {
                $html = TheoryGroup::genColumnHtml($course);
                return $html;
            })
            ->editColumn('course_id', function ($theory_group){
                return $theory_group->course->name;
            })
            ->editColumn('status', function ($theory_group){
                if($theory_group->status == 0){
                    return "<label class=\"label label-default\">Chưa kích hoạt</label>";
                }
                else{
                    return "<label class=\"label label-success\">Kích hoạt</label>";
                }
            })
            ->removeColumn('updated_at')
            ->removeColumn('deleted_at')
            ->make(true);
    }
}
