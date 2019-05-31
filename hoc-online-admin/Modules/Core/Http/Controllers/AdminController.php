<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Requests\LoginRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
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

    /**
     * Login page for admin
     */
    public function login()
    {
        //dd(1);
        return view('core::user.login');
    }

    /**
     * Process login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginPost(LoginRequest $request)
    {
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password],$request->remember_me)) {
            return redirect(route('admin_home'));
        } else {
            return redirect()->back()->withInput()->with('login_error','Username and/or password invalid OR your account was deleted' );
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }


    public function forgotPassword(){
        return view('core::user.passwords.email');
    }

    public function sendResetLinkEmail(Request $request){
        $data = $request->all();
        $user = User::where('email',$data['email'])->first();
        if(count($user)>0){
            $user = User::find($user->id);
            $user->resetpassword_token = bin2hex(openssl_random_pseudo_bytes(32));
            $user->save();

            Mail::to($data['email'])->send(new ResetPassword($user->resetpassword_token,$user->username));
            return redirect()->back()->with('messages','Send message successfully! Check email to reset your password');

        }
        else
        {
            return redirect()->back()->with('errors','This email is not registered')->withInput();
        }
    }

    public function resetPassword($token){
        $check = User::where('resetpassword_token',$token)->first();

        if($check!=null){
            return view('core::user.passwords.reset',compact('token'));
        }
        else {
            return redirect(route('login'));
        }
    }


    public function saveNewPassword(Request $request){
        try{

            $this->validate($request,[
                'password'=>'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6'
            ],[
                'password.required'=>'Password is not allowed null',
                'password_confirmation.required'=>'Password is not allowed null',
            ]);

            $data = $request->all();

            $user = User::where('resetpassword_token',$data['token'])->first();
            if($user!=null){
                $user = User::find($user->id);
                $user->password = $data['password'];
                $user->save();
                Auth::login($user,true);
                return redirect(route('admin_home'));

            }
            else{
                return redirect()->back()->withErrors(['Reset password failed, look like something went wrong!']);
            }
        }
        catch(Exception $ex){
            return redirect()->back()->withInput();
        }

    }
}
