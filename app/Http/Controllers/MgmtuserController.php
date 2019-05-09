<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Mgmtuser;
use App\Http\Model\Department;
use App\Http\Model\Userinternal;
use App\Http\Model\Position;
use App\Http\Model\Country;

class MgmtuserController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_mgmtuser = Mgmtuser::GetAllData();
        $no = 1;
    	return view('pages/cms/mgmtuser/index', compact('data_mgmtuser','no'));
    }

    function create()
    {
        $position = Position::all();
        if (session()->get('session_superadmin') == 1) {
            $userinternal = Userinternal::OrderbyCode();
        }else{
            $userinternal = Userinternal::OrderbyCode()
            ->where('id_country','=',session()->get('session_country'));
        }
        return view('pages/cms/mgmtuser/create', compact('userinternal','position'));
    }

    function edit($id)
    {
        if (session()->get('session_superadmin') == 1) {
            $userinternal = Userinternal::OrderbyCode();
        }else{
            $userinternal = Userinternal::OrderbyCode()->where('id_country','=',session()->get('session_country'));
        }
        $position = Position::all();
        $mgmtuser=Mgmtuser::where('id','=',$id)->first();
        return view('pages/cms/mgmtuser/edit')
        ->with('userinternal',$userinternal)
        ->with('position',$position)
        ->with('data_mgmtuser',$mgmtuser);
    }

    function view($id)
    {
        $mgmtuser=Mgmtuser::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/mgmtuser/view')
        ->with('data_mgmtuser',$mgmtuser);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'id_user_internal' => 'required',
            'id_position' => 'required',
            'password' => 'required|confirmed',
            'telephone' => 'required',
            'is_active' => 'required',
        ]);

        $userinternal = Userinternal::where('id','=',$request->id_user_internal)->first();

    	$mgmtuser = new Mgmtuser;
        $mgmtuser->id_country = $userinternal->id_country; 
		$mgmtuser->id_designated_department = $userinternal->id_department; 
		$mgmtuser->id_user_internal = $request->id_user_internal;
        $mgmtuser->id_position = $request->id_position;
        $mgmtuser->password = md5($request->password);
        $mgmtuser->password = md5($request->password_confirmation);
        $mgmtuser->email = $userinternal->email;
        $mgmtuser->telephone = $request->telephone;
        $mgmtuser->is_active = $request->is_active;
        $mgmtuser->created_by = session()->get('session_name'); 
    	$mgmtuser->save();

        $request->session()->flash('alert-success', 'New mgmtuser has been added successfully!');

    	return redirect('mgmtuser');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'id_user_internal' => 'required',
            'id_position' => 'required',
            'password' => 'required|confirmed',
            'telephone' => 'required',
            'is_active' => 'required',
        ]);

        $userinternal = Userinternal::where('id','=',$request->id_user_internal)->first();
        
    	$mgmtuser = Mgmtuser::where('id','=',$id)->first();
        $mgmtuser->id_country = $userinternal->id_country; 
        $mgmtuser->id_designated_department = $userinternal->id_department; 
        $mgmtuser->id_user_internal = $request->id_user_internal;
        $mgmtuser->id_position = $request->id_position;
        $mgmtuser->password = md5($request->password);
        $mgmtuser->password = md5($request->password_confirmation);
        $mgmtuser->email = $userinternal->email;
        $mgmtuser->telephone = $request->telephone;
        $mgmtuser->is_active = $request->is_active;
        $mgmtuser->updated_by = session()->get('session_name') ;
    	$mgmtuser->save();

        $request->session()->flash('alert-success', 'Mgmtuser has been updated successfully!');

    	return  redirect('mgmtuser');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $mgmtuser = Mgmtuser::find($id);
        $mgmtuser->is_active = '2';
        $mgmtuser->updated_by = session()->get('session_name') ;
        $mgmtuser->save();

        $request->session()->flash('alert-success', 'Mgmtuser has been deleted successfully!');

        return  redirect('mgmtuser');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$mgmtuser = Mgmtuser::find($id);
    	$mgmtuser->delete();

    	return  redirect('mgmtuser');
    } 
}
