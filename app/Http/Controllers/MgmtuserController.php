<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Mgmtuser;
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
        $country = Country::GetAllData();
        return view('pages/cms/mgmtuser/create', compact('country'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        $mgmtuser=Mgmtuser::where('id','=',$id)->first();
        return view('pages/cms/mgmtuser/edit')
        ->with('country',$country)
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
            'mgmtuser_name' => 'required',
            'mgmtuser_desc' => 'required',
            'is_active' => 'required',
        ]);

    	$mgmtuser = new Mgmtuser;
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $mgmtuser->id_country = $request->id_country;
        }else{
            $mgmtuser->id_country = session()->get('session_country');
        }
        $mgmtuser->mgmtuser_name = $request->mgmtuser_name; 
		$mgmtuser->mgmtuser_desc = $request->mgmtuser_desc; 
		$mgmtuser->email = $request->email;
        $mgmtuser->head_of_mgmtuser = $request->head_of_mgmtuser;
        $mgmtuser->manager = $request->manager;
        $mgmtuser->flag_designated = $request->flag_designated;
        $mgmtuser->flag_external = $request->flag_external;
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
            'mgmtuser_name' => 'required',
            'mgmtuser_desc' => 'required',
            'is_active' => 'required',
        ]);
        
    	$mgmtuser = Mgmtuser::where('id','=',$id)->first();
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $mgmtuser->id_country = $request->id_country;
        }else{
            $mgmtuser->id_country = session()->get('session_country');
        }
        $mgmtuser->mgmtuser_name = $request->mgmtuser_name; 
        $mgmtuser->mgmtuser_desc = $request->mgmtuser_desc; 
        $mgmtuser->email = $request->email;
        $mgmtuser->head_of_mgmtuser = $request->head_of_mgmtuser;
        $mgmtuser->manager = $request->manager;
        $mgmtuser->flag_designated = $request->flag_designated;
        $mgmtuser->flag_external = $request->flag_external;
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
