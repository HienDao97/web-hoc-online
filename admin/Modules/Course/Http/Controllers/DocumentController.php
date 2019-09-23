<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Document;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use DB;
use App\Models\KMsg;
use Carbon\Carbon;
use Validator;
use Session;

class DocumentController extends Controller
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

        $courses = Course::whereNull('deleted_at')->get();
        return view('course::document.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->only('title', 'description', 'link', 'course_id');

            $validatorArray = [
                'title' => 'required',
                'link' => 'required',
                'course_id' => 'required',
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
                Document::create($params);
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::document.create', compact('courses'));
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
            $params = $request->only('title', 'description', 'link', 'course_id');

            $validatorArray = [
                'title' => 'required',
                'description'   => 'required|max:100',
                'link' => 'required',
                'course_id' => 'required',
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
                $item = Document::where('id', $id)->whereNull('deleted_at')->first();
                if(empty($item)){
                    $result->message = ["Không tồn tại khoá học này "];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
                $item->title = $params["title"];
                $item->description = $params["description"];
                $item->link = $params["link"];
                $item->course_id = $params["course_id"];
                $item->save();
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $item = Document::where('documents.id', $id)->whereNull('deleted_at')->first();
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::document.edit', compact('item', 'courses'));
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
        $result = Document::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();
            return redirect(route('document.index'))->with('messages','Xoá bài học thành công');
        } else {
            return redirect(route('document.index'))->withErrors(["Không tồn tại bài học này "]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = Document::select("documents.*", "courses.name as course_name")
            ->join('courses', 'courses.id', '=', 'documents.course_id')
            ->whereNull('documents.deleted_at');
        return Datatables::of($query)
            ->filter(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (($value == "") || ($value == -1) || ($value == null)) {

                    } else {
                        if ($key == 'course_id') {
                            $query->where('course_id', $value);
                        }
                    }
                }
            })
            ->escapeColumns([])
            ->addColumn('actions', function ($classroom) {
                $html = Document::genColumnHtml($classroom);
                return $html;
            })
            ->editColumn('download_count', function ($classroom) {
                return number_format($classroom->download_count);
            })

            ->removeColumn('updated_at')
            ->removeColumn('deleted_at')
            ->make(true);
    }
}
