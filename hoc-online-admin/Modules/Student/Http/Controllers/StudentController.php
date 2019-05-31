<?php

namespace Modules\Student\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Classroom;
use Modules\Course\Entities\Course;
use Modules\Student\Entities\Student;
use Modules\Student\Entities\StudentClassroom;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $courses = Course::with("class")->whereNull('deleted_at')->get();
        return view('student::student.index', compact('courses'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = Student::select("students.*", "class_rooms.class_name as classroom_name", "courses.name as course_name")
            ->leftJoin('student_classrooms', 'students.id', '=', 'student_classrooms.student_id')
            ->leftJoin("courses", "courses.id", "=", "student_classrooms.course_id")
            ->leftJoin("class_rooms", "class_rooms.id", "=", "student_classrooms.class_room_id")
            //->groupBy('students.id')
            ->whereNull('students.deleted_at');


        //dd($query);
        return Datatables::of($query)
            ->filter(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (($value == "") || ($value == -1) || ($value == null)) {

                    } else {
                        if ($key == 'name') {
                            $query->where('students.name', 'LIKE', '%' . $value . '%');
                        } elseif ($key == 'created_at') {
                            $date = explode(' - ', $value);
                            if($date[0] != $date[1]){
                                $start_date = Carbon::parse($date[0])->format('Y-m-d H:i:s');
                                $end_date = Carbon::parse($date[1])->format('Y-m-d H:i:s');
                                $query->whereBetween('students.created_at', array($start_date, $end_date));
                            }

                        }  elseif($key == "course_id"){
                            $query->where('student_classrooms.course_id', $value);
                        }  elseif($key == "classroom_id"){
                            $query->where('student_classrooms.class_room_id', $value);
                        }
                    }
                }
            })
            ->escapeColumns([])
            ->editColumn('created_at', function ($student) {
                return Carbon::parse($student->created_at)->format('d-m-Y');
            })
            ->editColumn('status', function ($student) {
                if($student->status == 0){
                    return "<label class=\"label label-default\">Chưa kích hoạt</label>";
                }
                else{
                    return "<label class=\"label label-success\">Kích hoạt</label>";
                }
            })
            ->editColumn('gender', function ($student) {
                if($student->gender == 0){
                    return "Nữ";
                }
                else{
                    return "Nam";
                }
            })
            ->addColumn('actions', function ($student) {
                $html = Student::genColumnHtml($student);
                return $html;
            })
            ->removeColumn('password')
            ->make(true);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id){
        $items = Orders::select("users.*", "orders.created_at","orders.id as order_id", "orders.status", "orders.total_price")->where('orders.customer_id',$id)->join(
            'users', 'users.id', '=', 'orders.customer_id'
        )->get();
        $user = Users::where('id', $id)->first();
        return view('student::student.view', compact('items', 'user'));
    }

    /**
     * @return mixed
     */
    public function create(){
        $courses = Course::with("class")->whereNull('deleted_at')->get();
        return view('student::student.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request){
        $params = $request->all();
        $validatorArray = [
            'name' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'mobile' => 'required',
        ];


        $validator = Validator::make($request->all(), $validatorArray);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        DB::beginTransaction();
        try {
            $avatar ="";
            if($request->hasFile('avatar')){
                $img = $request->file('avatar')->getClientOriginalName();
                $request->avatar->move('img/user',$img);
                $avatar = $img;
            }
            //dd($params["birthday"]);
            $id = Student::insertGetId([
                "name" => $params["name"],
                "email" => $params["email"],
                "password" => bcrypt($params["password"]),
                "avatar" => $avatar,
                "gender" => (int) $params["gender"],
                "birthday" => (!empty($params["birthday"])) ? $params["birthday"] : "",
                "mobile" => $params["mobile"],
                "status" => $params["status"],
                "created_at" => Carbon::now()
            ]);
            if(!empty($params['course'])){
                $array = [];
                foreach ($params['course'] as $value){
                    if(!empty($params['classroom'][$value])){
                        foreach ($params['classroom'][$value] as $vl){
                            $item = [];
                            $item["class_room_id"] = $vl;
                            $item["course_id"] = $value;
                            $item["student_id"] = $id;
                            $item["status"] = 1;
                            array_push($array, $item);
                        }
                    }
                }
                StudentClassroom::insert($array);

            }
            DB::commit();
            return redirect(route('student.index'))->with('messages','Tạo học sinh thành công');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('[Student] ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors([trans('core::user.error_save')]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if(empty($params['check_change_password'])){
            $validatorArray = [
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'mobile' => 'required'
            ];
        }else{
            $validatorArray = [
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'mobile' => 'required'
            ];
        }
        $validator = Validator::make($request->all(), $validatorArray);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        $obj = Student::where("id", $id)->whereNull('deleted_at')->first();
        if ($obj) {
            if($request->hasFile('avatar')){
                $img = $request->file('avatar')->getClientOriginalName();
                $request->avatar->move('img/user',$img);
                $obj->avatar = $img;
            }
            $obj->name = $params["name"];
            $obj->email = $params["email"];
            $obj->gender = $params["gender"];
            $obj->mobile = $params["mobile"];
            $obj->birthday = $params["birthday"];
            $obj->status = $params["status"];
            if($params['password']!=""){
                $obj->password = bcrypt($params['password']);
            }
            $obj->save();
            if(!empty($params['course'])){
                $array = [];
                foreach ($params['course'] as $value){
                    if(!empty($params['classroom'][$value])){
                        foreach ($params['classroom'][$value] as $vl){
                            $item = [];
                            $item["class_room_id"] = $vl;
                            $item["course_id"] = $value;
                            $item["student_id"] = $id;
                            $item["status"] = 1;
                            array_push($array, $item);
                        }
                    }
                }
                $obj->saveListClass($array);

            }

            return redirect(route('student.index'))->with('messages','Cập nhật học sinh thành công');
        } else {
            return redirect(route('student.index'))->withErrors(["Không tồn tại học sinh này"]);
        }
    }

    /**
     * Restore the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){
        $result = Student::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('student.index'))->with('messages','Xoá học sinh thành công');
        } else {
            return redirect(route('student.index'))->withErrors(["Không tồn tại học sinh này"]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $student = Student::where('id', $id)->first();
        $courses = Course::with("class")->whereNull('deleted_at')->get();
        $studentclass = StudentClassroom::where('student_id', $id)->pluck('class_room_id')->toArray();
        return view('student::student.edit', compact('student','courses', 'studentclass'));
    }
}
