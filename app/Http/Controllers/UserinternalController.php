<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Userinternal;
use App\Http\Model\Department;
use App\Http\Model\Country;

class UserinternalController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        if (session()->get('session_superadmin') == 1) {
            $data_userinternal = Userinternal::GetAllData();
        }else{
            $data_userinternal = Userinternal::GetAllData()->where('id_country','=',session()->get('session_country'));
        }
        $no = 1;
    	return view('pages/cms/userinternal/index', compact('data_userinternal','no'));
    }

    function create()
    {
        $country = Country::GetAllData();
        if (session()->get('session_superadmin') == 1) {
            $department = Department::OrderbyCode();
        }else{
            $department = Department::OrderbyCode()->where('id_country','=',session()->get('session_country'));
        }
        return view('pages/cms/userinternal/create', compact('country','department'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        if (session()->get('session_superadmin') == 1) {
            $department = Department::OrderbyCode();
        }else{
            $department = Department::OrderbyCode()->where('id_country','=',session()->get('session_country'));
        }
        $userinternal=Userinternal::where('id','=',$id)->first();
        return view('pages/cms/userinternal/edit')
        ->with('country',$country)
        ->with('department',$department)
        ->with('data_userinternal',$userinternal);
    }

    function view($id)
    {
        $userinternal=Userinternal::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/userinternal/view')
        ->with('data_userinternal',$userinternal);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'branch_work_desc' => 'required',
            'branch_work_base_on_spu' => 'required',
            'email' => 'required',
            'is_active' => 'required',
        ]);

    	$userinternal = new Userinternal;
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $userinternal->id_country = $request->id_country;
        }else{
            $userinternal->id_country = session()->get('session_country');
        }
        $userinternal->username = $request->username; 
		$userinternal->id_department = $request->id_department; 
		$userinternal->branch_work_desc = $request->branch_work_desc;
        $userinternal->branch_work_base_on_spu = $request->branch_work_base_on_spu;
        $userinternal->email = $request->email;
        $userinternal->is_active = $request->is_active;
        $userinternal->created_by = session()->get('session_name'); 
    	$userinternal->save();

        $request->session()->flash('alert-success', 'New userinternal has been added successfully!');

    	return redirect('userinternal');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'branch_work_desc' => 'required',
            'branch_work_base_on_spu' => 'required',
            'email' => 'required',
            'is_active' => 'required',
        ]);
        
    	$userinternal = Userinternal::where('id','=',$id)->first();
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $userinternal->id_country = $request->id_country;
        }else{
            $userinternal->id_country = session()->get('session_country');
        }
        $userinternal->username = $request->username; 
        $userinternal->id_department = $request->id_department; 
        $userinternal->branch_work_desc = $request->branch_work_desc;
        $userinternal->branch_work_base_on_spu = $request->branch_work_base_on_spu;
        $userinternal->email = $request->email;
        $userinternal->is_active = $request->is_active;
        $userinternal->updated_by = session()->get('session_name') ;
    	$userinternal->save();

        $request->session()->flash('alert-success', 'Userinternal has been updated successfully!');

    	return  redirect('userinternal');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $userinternal = Userinternal::find($id);
        $userinternal->is_active = '2';
        $userinternal->updated_by = session()->get('session_name') ;
        $userinternal->save();

        $request->session()->flash('alert-success', 'Userinternal has been deleted successfully!');

        return  redirect('userinternal');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$userinternal = Userinternal::find($id);
    	$userinternal->delete();

    	return  redirect('userinternal');
    } 
}
