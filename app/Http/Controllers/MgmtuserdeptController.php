<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Mgmtuserdept;
use App\Http\Model\Country;

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
        $country = Country::GetAllData();
        return view('pages/cms/mgmtuserdept/create', compact('country'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        $mgmtuserdept=Mgmtuserdept::where('id','=',$id)->first();
        return view('pages/cms/mgmtuserdept/edit')
        ->with('country',$country)
        ->with('data_mgmtuserdept',$mgmtuserdept);
    }

    function view($id)
    {
        $mgmtuserdept=Mgmtuserdept::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/mgmtuserdept/view')
        ->with('data_mgmtuserdept',$mgmtuserdept);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'mgmtuserdept_name' => 'required',
            'mgmtuserdept_desc' => 'required',
            'is_active' => 'required',
        ]);

    	$mgmtuserdept = new Mgmtuserdept;
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $mgmtuserdept->id_country = $request->id_country;
        }else{
            $mgmtuserdept->id_country = session()->get('session_country');
        }
        $mgmtuserdept->mgmtuserdept_name = $request->mgmtuserdept_name; 
		$mgmtuserdept->mgmtuserdept_desc = $request->mgmtuserdept_desc; 
		$mgmtuserdept->email = $request->email;
        $mgmtuserdept->head_of_mgmtuserdept = $request->head_of_mgmtuserdept;
        $mgmtuserdept->manager = $request->manager;
        $mgmtuserdept->flag_designated = $request->flag_designated;
        $mgmtuserdept->flag_external = $request->flag_external;
        $mgmtuserdept->is_active = $request->is_active;
        $mgmtuserdept->created_by = session()->get('session_name'); 
    	$mgmtuserdept->save();

        $request->session()->flash('alert-success', 'New mgmtuserdept has been added successfully!');

    	return redirect('mgmtuserdept');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'mgmtuserdept_name' => 'required',
            'mgmtuserdept_desc' => 'required',
            'is_active' => 'required',
        ]);
        
    	$mgmtuserdept = Mgmtuserdept::where('id','=',$id)->first();
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $mgmtuserdept->id_country = $request->id_country;
        }else{
            $mgmtuserdept->id_country = session()->get('session_country');
        }
        $mgmtuserdept->mgmtuserdept_name = $request->mgmtuserdept_name; 
        $mgmtuserdept->mgmtuserdept_desc = $request->mgmtuserdept_desc; 
        $mgmtuserdept->email = $request->email;
        $mgmtuserdept->head_of_mgmtuserdept = $request->head_of_mgmtuserdept;
        $mgmtuserdept->manager = $request->manager;
        $mgmtuserdept->flag_designated = $request->flag_designated;
        $mgmtuserdept->flag_external = $request->flag_external;
        $mgmtuserdept->is_active = $request->is_active;
        $mgmtuserdept->updated_by = session()->get('session_name') ;
    	$mgmtuserdept->save();

        $request->session()->flash('alert-success', 'Mgmtuserdept has been updated successfully!');

    	return  redirect('mgmtuserdept');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $mgmtuserdept = Mgmtuserdept::find($id);
        $mgmtuserdept->is_active = '2';
        $mgmtuserdept->updated_by = session()->get('session_name') ;
        $mgmtuserdept->save();

        $request->session()->flash('alert-success', 'Mgmtuserdept has been deleted successfully!');

        return  redirect('mgmtuserdept');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$mgmtuserdept = Mgmtuserdept::find($id);
    	$mgmtuserdept->delete();

    	return  redirect('mgmtuserdept');
    } 
}
