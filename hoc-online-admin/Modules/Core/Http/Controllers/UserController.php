<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Modules\Core\Entities\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $users = User::withTrashed()->paginate();
        $current_user = Auth::user();
        $actions = request()->route()->getAction();
        $controller = explode("@",$actions['controller']);
        $controller = $controller[0];
//        dd((Auth::user()->avatar!=null?Auth::user()->avatar:'/img/logo.jpg'));
        return view('core::user/index', [
            "params" => $params,
            "users" => $users,
            "current_user" => $current_user,
            "controller" => $controller
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('core::user/create', [
            "roles" => Role::all()->pluck("name", "id"),
            "groups" => Group::all()->pluck("name", "id")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $currentUser = Auth::user();

        $validatorArray = [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];


        $validator = Validator::make($request->all(), $validatorArray);
        if ($validator->fails()) {
            $message = $validator->errors();
            return Redirect::back()->withInput()->withErrors([$message->first()])->with(['modal_error' => $message->first()]);
        }

        DB::beginTransaction();
        try {
            $avatar ="";
            if($request->hasFile('avatar')){
                $img = $request->file('avatar')->getClientOriginalName();
                $request->avatar->move('img/user',$img);
                $avatar = $img;
            }

            $result = User::create([
                "username" => $params["username"],
                "email" => $params["email"],
                "password" => $params["password"],
                "avatar" => $avatar
            ]);

            $roles = isset($params["roles"]) ? $params["roles"] : [];
            $result->saveListRoles($roles);

            $groups = isset($params["groups"]) ? $params["groups"] : [];
            $result->saveListGroups($groups);

            DB::commit();
            return Redirect::route('core.user.index')->with('messages','Create new user successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return Redirect::back()->withInput()->withErrors([trans('core::user.error_save')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $obj = User::withTrashed()->where("id", $id)->first();
        return view('core::user.edit', [
            'user' => $obj,
            'user_roles' => $obj->user_roles()->pluck("role_id")->toArray(),
            'user_groups' => $obj->user_groups()->pluck("group_id")->toArray(),
            "roles" => Role::all()->pluck("name", "id"),
            "groups" => Group::all()->pluck("name", "id")
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $currentUser = Auth::user();

        $validatorArray = [
//            'username' => 'required|unique:users,username,'.$id,
//            'email' => 'required|email|unique:users,email,'.$id,
            'username'=>'required',
            'email'=>'required',
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6'

        ];




        $validator = Validator::make($request->all(), $validatorArray);
        if ($validator->fails()) {
            $message = $validator->errors();
            return Redirect::route('core.user.edit', $id)->withErrors([$message->first()]);
        }
        $obj = User::withTrashed()->where("id", $id)->first();
        if ($obj) {
            if($request->hasFile('avatar')){
                $img = $request->file('avatar')->getClientOriginalName();
                $request->avatar->move('img/user',$img);
                $obj->avatar = $img;
            }
            $obj->username = $params["username"];
            $obj->email = $params["email"];
            if($params['password']!=""){
                $obj->password = $params['password'];
            }
            $obj->save();

            $roles = isset($params["roles"]) ? $params["roles"] : [];
            $obj->saveListRoles($roles);

            $groups = isset($params["groups"]) ? $params["groups"] : [];
            $obj->saveListGroups($groups);

            return Redirect::route('core.user.index')->with('messages','Edit user successfully');
        } else {
            return Redirect::route('core.user.index')->withErrors([trans('core::user.error_exist')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $obj = User::where("id", $id)->first();
        if ($obj) {
            $obj->delete();

            return Redirect::route('core.user.index')->with('messages','Delete user successfully');
        } else {
            return Redirect::route('core.user.index')->withErrors([trans('core::user.error_exist')]);
        }
    }

    /**
     * Restore the specified resource from storage.
     * @return Response
     */
    public function restore($id)
    {
        $obj = User::withTrashed()->where("id", $id)->first();
        if ($obj) {
            $obj->restore();

            return Redirect::route('core.user.index')->with('messages','Restore user successfully');
        } else {
            return Redirect::route('core.user.index')->withErrors([trans('core::user.error_exist')]);
        }
    }

    /**
     * ResetPassword
     * @return Response
     */
    public function resetPassword($id)
    {
        $obj = User::withTrashed()->where("id", $id)->first();
        if ($obj) {
            $password = 123456789;

            $obj->password=$password;
            $obj->save();

            $message = trans('core::user.restore_password_success').". Mật khẩu là: 123456789";
            Session::flash('header_message', $message);

            return Redirect::route('core.user.index');
        } else {
            return Redirect::route('core.user.index')->withErrors([trans('core::user.error_exist')]);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * change information of own user
     */
    public function changeInformation($id){
        $user_id = Auth::id();
        if($id == $user_id){
            $obj = User::where('id',$user_id)->first();
            if(!empty($obj)){
                return view('core::user.changeInformation',[
                    'user' => $obj,
                ]);
            }
            else{
                return \redirect()-back()->withErrors(['Look like is something wrong']);
            }
        }
        else {
            return \redirect()->back()->withInput()->withErrors(['Update error, look like is something wrong']);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * update user information
     * just only yourself
     */
    public function updateUserInformation(Request $request,$id) {
        $params = $request->all();
        $currentUser = Auth::id();
        if($currentUser == $id){
            $validatorArray = [
                'name'=>'required',
                'email'=>'required',
                'password' => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|min:6'
            ];

            $validator = Validator::make($request->all(), $validatorArray);
            if ($validator->fails()) {
                $message = $validator->errors();
                return redirect()->back()->withErrors([$message->first()]);
            }
            $obj = User::where("id", $currentUser)->first();
            if ($obj) {
                if($request->hasFile('avatar')){
                    $img = $request->file('avatar')->getClientOriginalName();
                    $request->avatar->move('image/admin',$img);
                    $obj->avatar = $img;
                }
                $obj->name = $params["name"];
                $obj->email = $params["email"];
                if($params["password"] != $params["password_confirmation"]){
                    return Redirect()->back()->withErrors(['Password or password confirm was wrong']);
                }
                if($params['password']!=""){
                    $obj->password = bcrypt($params['password']);
                }

                $obj->save();

                return redirect()->back()->with('messages','Change your information is successfully');
            } else {
                return Redirect()->back()->withErrors([trans('core::user.error_exist')]);
            }
        }
        else{
            return \redirect()->back()->withInput()->withErrors(['Update error, look like is something wrong']);
        }


    }
}
