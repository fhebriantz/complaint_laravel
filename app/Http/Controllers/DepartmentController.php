<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Department;
use App\Http\Model\Country;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        if (session()->get('session_superadmin') == 1) {
            $data_department = Department::GetAllData();
        }else{
            $data_department = Department::GetAllData()->where('id_country','=',session()->get('session_country'));
        }
        $no = 1;
    	return view('pages/cms/department/index', compact('data_department','no'));
    }

    function create()
    {
        $country = Country::GetAllData();
        return view('pages/cms/department/create', compact('country'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        $department=Department::where('id','=',$id)->first();
        return view('pages/cms/department/edit')
        ->with('country',$country)
        ->with('data_department',$department);
    }

    function view($id)
    {
        $department=Department::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/department/view')
        ->with('data_department',$department);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'department_name' => 'required',
            'department_desc' => 'required',
            'is_active' => 'required',
        ]);

    	$department = new Department;
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $department->id_country = $request->id_country;
        }else{
            $department->id_country = session()->get('session_country');
        }
        $department->department_name = $request->department_name; 
		$department->department_desc = $request->department_desc; 
		$department->email = $request->email;
        $department->head_of_department = $request->head_of_department;
        $department->manager = $request->manager;
        $department->flag_designated = $request->flag_designated;
        $department->flag_external = $request->flag_external;
        $department->is_active = $request->is_active;
        $department->created_by = session()->get('session_name'); 
    	$department->save();

        $request->session()->flash('alert-success', 'New department has been added successfully!');

    	return redirect('department');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'department_name' => 'required',
            'department_desc' => 'required',
            'is_active' => 'required',
        ]);
        
    	$department = Department::where('id','=',$id)->first();
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $department->id_country = $request->id_country;
        }else{
            $department->id_country = session()->get('session_country');
        }
        $department->department_name = $request->department_name; 
        $department->department_desc = $request->department_desc; 
        $department->email = $request->email;
        $department->head_of_department = $request->head_of_department;
        $department->manager = $request->manager;
        $department->flag_designated = $request->flag_designated;
        $department->flag_external = $request->flag_external;
        $department->is_active = $request->is_active;
        $department->updated_by = session()->get('session_name') ;
    	$department->save();

        $request->session()->flash('alert-success', 'Department has been updated successfully!');

    	return  redirect('department');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $department = Department::find($id);
        $department->is_active = '2';
        $department->updated_by = session()->get('session_name') ;
        $department->save();

        $request->session()->flash('alert-success', 'Department has been deleted successfully!');

        return  redirect('department');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$department = Department::find($id);
    	$department->delete();

    	return  redirect('department');
    } 
}
