<?php

namespace App\Http\Controllers;

use App\Models\ClassroomUnitExercise;
use App\Models\Exercise;
use App\Models\KMsg;
use App\Models\StudentClass;
use App\Models\Theory;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;

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
            $studentClass = StudentClass::where('student_classrooms.student_id', $id)
                ->join('courses', 'courses.id', '=', 'student_classrooms.course_id')
                ->join('class_rooms', 'class_rooms.id', '=', 'student_classrooms.class_room_id')
                ->get();
            //dd($studentClass);
            return view('student.info', compact('student'));
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
        if(!empty($studentClassroom)){
            $theories = Theory::where('classroom_id', $request->id)->whereNull('deleted_at')->get();

            if(empty($request->id_baihoc)){
                $id_baihoc = $theories->min('id');
                $exercise = Exercise::where('theory_id', $theories[0]->id)->first();
            }else{
                $id_baihoc = $request->id_baihoc;
                $exercise = Exercise::where('theory_id', $request->id_baihoc)->first();
            }
            $answer_count = 0;
            if(!empty($exercise)){
                $answers= json_decode($exercise->answer);
                $answer_count = count($answers);
            }
            $list_answer = Exercise::listAnswer();
            return view('student.classroom',  compact('theories','exercise', 'answer_count', 'list_answer', 'id_baihoc'));
        }else{
            return view('classroom.register-classroom')->with("messages", "Bạn chưa đăng kí tham gia vào khoá học này");
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
                $list_answer = Exercise::listAnswer();
                $answers = json_decode($exercise->answer);
                $point = 0;
                for ($i = 0; $i < count($answers); $i++) {
                    if($answers[$i] == $params['answer'][$i][0]) {
                        $point = $point + 1;
                    }
                }
                $html = view('student.answer', compact('answers','list_answer', 'point', 'params'))->render();
                $classroomUnitExercise = ClassroomUnitExercise::where('student_id', Auth::user()->id)->where('theory_id',$exercise->theory_id)->first();
                if(empty($classroomUnitExercise)){
                    ClassroomUnitExercise::insert([
                        "point" => round($point/count($answers)) * 10,
                        "student_id" => Auth::user()->id,
                        "theory_id" => $exercise->theory_id,
                    ]);
                }else{
                    $classroomUnitExercise->point = $point;
                    $classroomUnitExercise->save();
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
