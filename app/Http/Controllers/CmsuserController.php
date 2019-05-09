<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Cmsuser;
use App\Http\Model\Country;

class CmsuserController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        if (session()->get('session_superadmin') == 1) {
            $data_cmsuser = Cmsuser::GetAllData();
        }else{
            $data_cmsuser = Cmsuser::GetAllData()->where('id_country','=',session()->get('session_country'));
        }
        $no = 1;
    	return view('pages/cms/cmsuser/index', compact('data_cmsuser','no'));
    }

    function create()
    {
        $country = Country::GetAllData();
        return view('pages/cms/cmsuser/create', compact('country'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        $cmsuser=Cmsuser::where('id','=',$id)->first();
        return view('pages/cms/cmsuser/edit')
        ->with('country',$country)
        ->with('data_cmsuser',$cmsuser);
    }

    function view($id)
    {
        $cmsuser=Cmsuser::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/cmsuser/view')
        ->with('data_cmsuser',$cmsuser);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:dbs_cms_user',
            'password' => 'required|confirmed',
            'is_active' => 'required',
        ]);

    	$cmsuser = new Cmsuser;
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
                'is_superadmin' => 'required',
            ]);
            $cmsuser->id_country = $request->id_country;
            $cmsuser->is_superadmin = $request->is_superadmin;
        }else{
            $cmsuser->id_country = session()->get('session_country');
            $cmsuser->is_superadmin = 0;
        }
        $cmsuser->fullname = $request->fullname; 
		$cmsuser->username = $request->username; 
		$cmsuser->password = md5($request->password);
        $cmsuser->password = md5($request->password_confirmation);
        $cmsuser->is_active = $request->is_active;
        $cmsuser->created_by = session()->get('session_name'); 
    	$cmsuser->save();

        $request->session()->flash('alert-success', 'New cmsuser has been added successfully!');

    	return redirect('cmsuser');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'password' => 'required|confirmed',
            'is_active' => 'required',
        ]);
        
    	$cmsuser = Cmsuser::where('id','=',$id)->first();
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
                'is_superadmin' => 'required',
            ]);
            $cmsuser->id_country = $request->id_country;
            $cmsuser->is_superadmin = $request->is_superadmin;
        }else{
            $cmsuser->id_country = session()->get('session_country');
            $cmsuser->is_superadmin = 0;
        }
        $cmsuser->fullname = $request->fullname; 
        $cmsuser->username = $request->username; 
        $cmsuser->password = md5($request->password);
        $cmsuser->password = md5($request->password_confirmation);
        $cmsuser->is_active = $request->is_active;
        $cmsuser->updated_by = session()->get('session_name') ;
    	$cmsuser->save();

        $request->session()->flash('alert-success', 'Cmsuser has been updated successfully!');

    	return  redirect('cmsuser');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $cmsuser = Cmsuser::find($id);
        $cmsuser->is_active = '2';
        $cmsuser->updated_by = session()->get('session_name') ;
        $cmsuser->save();

        $request->session()->flash('alert-success', 'Cmsuser has been deleted successfully!');

        return  redirect('cmsuser');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$cmsuser = Cmsuser::find($id);
    	$cmsuser->delete();

    	return  redirect('cmsuser');
    } 
}
