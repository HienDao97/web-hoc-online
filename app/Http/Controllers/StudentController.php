<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomUnitExercise;
use App\Models\Comment;
use App\Models\Exercise;
use App\Models\KMsg;
use App\Models\StudentClass;
use App\Models\Theory;
use App\Student;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::user()->id == $id){
            $student = Student::where('id', $id)->first();
            $studentClass = StudentClass::select("student_classrooms.*", "courses.name as course_name", "class_rooms.class_name as classroom_name")
                ->where('student_classrooms.student_id', $id)
                ->join('courses', 'courses.id', '=', 'student_classrooms.course_id')
                ->join('class_rooms', 'class_rooms.id', '=', 'student_classrooms.class_room_id')
                ->get();
            $studentClass = $studentClass->groupBy(function($item){
                return $item->course_name;
            });
            $classExercise = ClassroomUnitExercise::where('student_id', $id)->get();
            //dd($studentClass);
            return view('student.info', compact('student', 'studentClass', 'classExercise'));
        }else{
            abort(404, "View not found");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function changePassword(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'password'=>'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6'
            ];
            $result = new KMsg();


            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            try {
                $student = Student::where('id', Auth::user()->id)->first();
                $student->password = bcrypt($params['password']);
                $result->message = "Đổi mật khẩu thành công";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (\Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            return view('student.change_password');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classroom(Request $request){
        $studentClassroom = StudentClass::where('student_id', Auth::user()->id)->where('class_room_id', $request->id)->first();
        $classroom = Classroom::where('id', $request->id)->first();
        if(empty($classroom)){
            return redirect()->back()->with("messages", "Không tồn tại khoá học này");
        }

        if(!empty($studentClassroom) || $classroom->type == 0){
            $theories = Theory::where('classroom_id', $request->id)->whereNull('deleted_at')->get();

            if(empty($request->id_baihoc)){
                //dd($theories);
                if(count($theories) > 0){
                    $id_baihoc = $theories->min('id');
                    $exercise = Exercise::where('theory_id', $theories[0]->id)->whereNull('deleted_at')->first();
                }else{
                    $id_baihoc = "";
                    $exercise = "";
                }

            }else{
                $id_baihoc = $request->id_baihoc;
                $exercise = Exercise::where('theory_id', $request->id_baihoc)->whereNull('deleted_at')->first();
            }
            $answer_count = 0;
            if(!empty($exercise)){
                $answers= json_decode($exercise->answer);
                $answer_count = count($answers);
            }
            $list_answer = Exercise::listAnswer();
            return view('student.classroom',  compact('theories','exercise', 'answer_count', 'list_answer', 'id_baihoc'));
        }else{
            return view('classroom.register-classroom', compact('classroom'))->with("messages", "Bạn chưa đăng kí tham gia vào khoá học này");
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function answer(Request $request)
    {
        $params = $request->all();
        $result = new KMsg();

        try {
            $exercise = Exercise::where('id', $params['exercise'])->first();
            if (empty($exercise)) {
                $result->message = "Bài tập không tồn tại";
                $result->result = KMsg::RESULT_ERROR;
            } else {
                //count point
                $list_answer = Exercise::listAnswer();
                $answers = json_decode($exercise->answer);
                $point = 0;
                for ($i = 0; $i < count($answers); $i++) {
                    if($answers[$i] == $params['answer'][$i][0]) {
                        $point = $point + 1;
                    }
                }
                //render html
                $point_of_answer = round($point/count($answers), 2) * 10;
                if(9 <= $point_of_answer && $point_of_answer <= 10){
                    $number = random_int(0,3);
                    $text = Exercise::listText()[$number];
                }else if(7 <= $point_of_answer && $point_of_answer < 9){
                    $number = random_int(4, 7);
                    $text = Exercise::listText()[$number];
                }else if(5 <= $point_of_answer && $point_of_answer <7){
                    $number = random_int(8, 11);
                    $text = Exercise::listText()[$number];
                }else{
                    $number = random_int(12, 15);
                    $text = Exercise::listText()[$number];
                }
                $html = view('student.answer', compact('answers','list_answer', 'point', 'params', 'text'))->render();
                //update point of thery in class
                $classroomUnitExercise = ClassroomUnitExercise::where('student_id', Auth::user()->id)->where('theory_id',$exercise->theory_id)->first();
                if(empty($classroomUnitExercise)){
                    ClassroomUnitExercise::insert([
                        "point" => $point_of_answer,
                        "student_id" => Auth::user()->id,
                        "theory_id" => $exercise->theory_id,
                        "classroom_id" => $exercise->classroom_id
                    ]);
                }else{
                    $classroomUnitExercise->point = $point_of_answer;
                    $classroomUnitExercise->save();
                }

                //update status of student class
                $maxTheory = Theory::where('classroom_id', $classroomUnitExercise->classroom_id)->count();
                $currentTheory = ClassroomUnitExercise::where('classroom_id', $classroomUnitExercise->classroom_id)->count();

                if($maxTheory == $currentTheory){
                    StudentClass::where("student_id",Auth::user()->id)
                        ->where("class_room_id", $exercise->classroom_id)
                        ->where("course_id", $exercise->course_id)->update([
                            "status" => 1
                        ]);
                }
                $result->message = "Chấm bài thành công";
                $result->result = $html;
            }
            return \response()->json($result);
        } catch (\Exception $ex) {
            Log::error('[Answer] ' . $ex->getMessage());
            $result->message = "Xảy ra lỗi trong quá trình chấm điểm";
            $result->result = KMsg::RESULT_ERROR;
            return \response()->json($result);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function comment(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->only("content", "parent_name");

            $validatorArray = [
                'content'=>'required|max:200',
                'parent_name' => 'required'
            ];
            $result = new KMsg();


            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            try {
                $params["public"] = 0;
                $params["student_id"] = Auth::user()->id;
                $params["student_name"] = Auth::user()->name;
                Comment::create($params);
                $result->message = "Để lại bình luận thành công";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (\Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            return view('student.comment');
        }
    }

    public function changeAvatar(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();
            // Save project
            try {
                $result = new KMsg();
                $item = Student::where('id', $id)->first();
                if(!empty($request->hasFile('file'))){
                    $validatorArray = [
                        'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                    $validator = Validator::make($params, $validatorArray);
                    if ($validator->fails()) {
                        $result->message = $validator->messages();
                        $result->result = KMsg::RESULT_ERROR;
                        return \response()->json($result);
                    }
                    $img = $request->file('file')->getClientOriginalName();
                    $request->file('file')->move('img/',$img);
                    $item->avatar = $img;
                    $item->save();
                }
                $result->message = "Cập nhật avatar";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json(["Some thing was wrong"]);
            }

        } else {
            $item = Student::where('id', $id)->first();
            return view('student.change-avatar', compact('item'));
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
