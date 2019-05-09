<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Routing\Middleware\LoginCheck;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Model\Cms_user;
use DateTime;
use Auth;
use DB;
use Session;

class LoginController extends Controller
{ 

    // ============================ CMS LOGIN ==============================
    public function show(Request $request){
        $request->session()->forget('message');
        return view('pages/user/login');
    } 

    public function login(Request $request){
        $username = $request->username;
        $password = md5($request->password);
       
            $checkLogin = Cms_user::where(['username'=>$username,'password'=>$password,'is_active'=>'1'])
            ->select('dbs_cms_user.*')
            ->get();

            if (sizeof($checkLogin) > 0){
                foreach ($checkLogin as $key => $val) {
                    $id_user = $val->id;
                    $name = $val->fullname;
                    $country = $val->id_country;
                    $username = $val->username;
                    $is_superadmin = $val->is_superadmin;

                    $request->session()->put('session_login', true);
                    $request->session()->put('session_id', $id_user);
                    $request->session()->put('session_name', $name);
                    $request->session()->put('session_country', $country);
                    $request->session()->put('session_username', $username);
                    $request->session()->put('session_superadmin', $is_superadmin);
                    return  redirect('department');
                }
            }
            else{
                $request->session()->flash('message', 'Login failed username/password not match!');
                return view('pages/user/login');
            }
    }

    public function logout (Request $request){
                $request->session()->forget('session_login');
                $request->session()->forget('session_id');
                $request->session()->forget('session_name');
                $request->session()->forget('session_country');
                $request->session()->forget('session_username');
                $request->session()->forget('session_superadmin');
                $request->session()->forget('message');

                return  redirect('login');
    }



    // function insert (Request $request)  
    // {
    //     $validatedData = $request->validate([
                
    //             'fullname' => 'required',
    //             'username' => 'required|unique:user_management',
    //             'password' => 'required|confirmed',
    //             'is_superadmin' => 'required',
    //             'is_active' => 'required',
    //         ]);

    //     $user_management = new Cms_user;

    //         $user_management->fullname = $request->fullname; 
    //         $user_management->username = $request->username; 
    //         $user_management->password = $request->password; 
    //         $user_management->password = $request->password_confirmation; 
    //         $user_management->is_superadmin = $request->is_superadmin; 
    //         $user_management->is_active = $request->is_active; 
    //         $user_management->created_by = session()->get('session_name'); 
    //     // untuk mengsave
    //     $user_management->save();

    //     return  redirect('cms_user');
    // }

    // function update (Request $request, $id)  
    // {
    //     $validatedData = $request->validate([
                
    //             'fullname' => 'required',
    //             'username' => 'required|unique:user_management',
    //             'password' => 'required|confirmed',
    //             'is_superadmin' => 'required',
    //             'is_active' => 'required',
    //         ]);
        
    //     $user_management = Cms_user::find($id);

    //         $user_management->fullname = $request->fullname; 
    //         $user_management->username = $request->username; 
    //         $user_management->password = $request->password; 
    //         $user_management->password = $request->password_confirmation; 
    //         $user_management->is_superadmin = $request->is_superadmin; 
    //         $user_management->is_active = $request->is_active; 
    //         $user_management->updated_by = session()->get('session_name'); 
    //     // untuk mengsave
    //     $user_management->save();

    //     return  redirect('cms_user');
    // }


    public function delete($id){

        $user_management = Cms_user::find($id);
        $user_management->delete();
        
        return  redirect('forgotpass');
    } 
}
