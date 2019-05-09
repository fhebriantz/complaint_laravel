<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Mgmtuser;
use App\Http\Model\Department;
use App\Http\Model\Mgmtuserdept;

class MgmtuserdeptController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        $data_mgmtuserdept = Mgmtuserdept::GetAllData();
        $no = 1;
    	return view('pages/cms/mgmtuserdept/index', compact('data_mgmtuserdept','no'));
    }

    function create()
    {
        $mgmtuser = Mgmtuser::GetAllData();
        $department = Department::GetAllData();
        return view('pages/cms/mgmtuserdept/create', compact('mgmtuser','department'));
    }

    function edit($id)
    {
        $mgmtuser = Mgmtuser::GetAllData();
        $department = Department::GetAllData();
        $mgmtuserdept=Mgmtuserdept::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/mgmtuserdept/edit')
        ->with('mgmtuser',$mgmtuser)
        ->with('department',$department)
        ->with('data_mgmtuserdept',$mgmtuserdept);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'id_mgmt_user' => 'required',
            'id_designated_department' => 'required',
        ]);

    	$mgmtuserdept = new Mgmtuserdept;
        $mgmtuserdept->id_mgmt_user = $request->id_mgmt_user; 
		$mgmtuserdept->id_designated_department = $request->id_designated_department; 
    	$mgmtuserdept->save();

        $request->session()->flash('alert-success', 'New mgmtuserdept has been added successfully!');

    	return redirect('mgmtuserdept');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'id_mgmt_user' => 'required',
            'id_designated_department' => 'required',
        ]);
        
    	$mgmtuserdept = Mgmtuserdept::where('id','=',$id)->first();
        $mgmtuserdept->id_mgmt_user = $request->id_mgmt_user; 
        $mgmtuserdept->id_designated_department = $request->id_designated_department; 
    	$mgmtuserdept->save();

        $request->session()->flash('alert-success', 'Mgmtuserdept has been updated successfully!');

    	return  redirect('mgmtuserdept');
    }

    // // Function: Delete data -> update is_active = 2
    // public function delete(Request $request, $id){
        
    //     $mgmtuserdept = Mgmtuserdept::find($id);
    //     $mgmtuserdept->is_active = '2';
    //     $mgmtuserdept->updated_by = session()->get('session_name') ;
    //     $mgmtuserdept->save();

    //     $request->session()->flash('alert-success', 'Mgmtuserdept has been deleted successfully!');

    //     return  redirect('mgmtuserdept');
    // } 

    // // Function: Delete data from table
    // public function delete_db($id){
    // 	// find khusus untuk primary key di database
    // 	$mgmtuserdept = Mgmtuserdept::find($id);
    // 	$mgmtuserdept->delete();

    // 	return  redirect('mgmtuserdept');
    // } 
}
