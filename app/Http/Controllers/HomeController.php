<?php

namespace App\Http\Controllers;

use App\Mail\SendToMailRoot;
use App\Models\Course;
use App\Models\KMsg;
use App\Models\NewsPost;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mail\ResetPassword;
use App\Mail\SugestMail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $courses = Course::whereNull('deleted_at')->get();
        $news = NewsPost::where("post_status", 1)
            ->whereDate("published_at", "<=", Carbon::now())
            ->orderBy('id', "DESC")
            ->paginate(4);
        return view('home.home', compact('courses', 'news'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function register(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'name' => 'required',
                'district' => 'required',
                'school' => 'required',
                'commune' => 'required',
                'province' => 'required',
                'birthday' => 'required',
                'email' => 'required|email|unique:students,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'mobile' => 'required|unique:students,mobile,NULL,id,deleted_at,NULL|min:10|max:10',
            ];
            $result = new KMsg();


            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }
            DB::beginTransaction();
            try {
                Student::create([
                    "name" => $params["name"],
                    "email" => $params["email"],
                    "password" => bcrypt($params["password"]),
                    "mobile" => $params["mobile"],
                    "birthday" => date("Y-m-d H:i:s", strtotime($params["birthday"])),
                    "school" => $params["school"],
                    "province_id" => $params["province"],
                    "district_id" => $params["district"],
                    "commune_id" => $params["commune"],
                    "status" => 1,
                    "created_at" => Carbon::now()
                ]);

//                Mail::to("vuthanh.edu10@gmail.com")->send(new SendToMailRoot($params));
                DB::commit();

                $result->message = "Đăng kí thành công";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (\Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $provinces = DB::table("provine")->get();
            return view('home.register', compact('provinces'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'password' => 'required',
                'mobile' => 'required',
            ];
            $result = new KMsg();
            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            try {
                if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password, 'status' => 1, 'deleted_at' => null],$request->remember_me)) {
                    $result->message = "Đăng nhập thành công";
                    $result->result = KMsg::RESULT_SUCCESS;
                    return \response()->json($result);
                } else {
                    $result->message = ["Tài khoản hoặc mật khẩu không chính xác"];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }

            } catch (\Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            return view('home.login');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function forgotPassword(Request $request){
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'email' => 'required',
            ];
            $result = new KMsg();
            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            try {
                $student = Student::where('email',$params['email'])->first();
                if(!empty($student)){
                    $student = Student::find($student->id);
                    $student->resetpassword_token = bin2hex(openssl_random_pseudo_bytes(32));
                    $student->save();

                    Mail::to($params['email'])->send(new ResetPassword($student->resetpassword_token,$student->name));
                    $result->message = "Gửi mail thành công";
                    $result->result = KMsg::RESULT_SUCCESS;
                    return \response()->json($result);
                }
                else
                {
                    $result->message = ["Email này chưa được đăng kí"];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }

            } catch (\Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            return view('home.forgotPassword');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gopY(Request $request){
        $params = $request->all();
        $validatorArray = [
            'name' => 'required',
            'age'  => 'numeric',
            'type' => 'required',
            'mobile' => 'required'
        ];
        $validator = Validator::make($params, $validatorArray);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }else{
            Mail::to("vuthanh.edu10@gmail.com")->send(new SugestMail($params));
            return redirect()->back()->with('messages','Gửi mail thành công');
        }
    }

    public function filter(Request $request){
        $result = new KMsg();
        if(empty($request->id) || empty($request->type)){
            $result->message = "Something was wrong";
            $result->result = KMsg::RESULT_ERROR;
            return \response()->json($result);
        }else{
            if($request->type == "district"){
                $html = "";
                $districts = DB::table("district")->select('id', 'name')->where('province_id', $request->id)->get();
                $html .= "<option value='' selected>-- Tất cả --</option>";
                foreach ($districts as $district){
                    if(!empty($request->value) && $request->value == $district->id){
                        $html .= "<option value=". $district->id ." selected>". $district->name ."</option>";
                    }else{
                        $html .= "<option value=". $district->id .">". $district->name ."</option>";
                    }
                }
                $result->message = $html;
                $result->result = KMsg::RESULT_SUCCESS;
            }
            else if($request->type == "commune"){
                $html = "";
                $communes = DB::table("commune")->select('id', 'name')->where('district_id', $request->id)->get();
                $html .= "<option value='' selected>-- Tất cả --</option>";
                foreach ($communes as $commune){
                    if(!empty($request->value) && $request->value == $commune->id){
                        $html .= "<option value=". $commune->id ." selected>". $commune->name ."</option>";
                    }else{
                        $html .= "<option value=". $commune->id .">". $commune->name ."</option>";
                    }
                }
                $result->message = $html;
                $result->result = KMsg::RESULT_SUCCESS;
            }
            return \response()->json($result);
        }
    }
}
