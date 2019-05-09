<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Country;

class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        if (session()->get('session_superadmin') == 1) {
            $data_country = Country::GetAllData();
            $no = 1;
            return view('pages/cms/country/index', compact('data_country','no'));
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    }

    function create()
    {
        if (session()->get('session_superadmin') == 1) {
            return view('pages/cms/country/create');
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    }

    function edit($id)
    {
        if (session()->get('session_superadmin') == 1) {
            $country=Country::where('id','=',$id)->first();
            return view('pages/cms/country/edit')
            ->with('data_country',$country);
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    }

    function view($id)
    {
        if (session()->get('session_superadmin') == 1) {
            $country=Country::GetAllData()->where('id','=',$id)->first();
            return view('pages/cms/country/view')
            ->with('data_country',$country);
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'country_code' => 'required|unique:dbs_country',
                'country_name' => 'required',
                'is_active' => 'required',
            ]);

        	$country = new Country;
            
            $country->country_code = $request->country_code; 
    		$country->country_name = strtoupper($request->country_name); 
            $country->is_active = $request->is_active;
            $country->created_by = session()->get('session_name'); 
        	$country->save();

            $request->session()->flash('alert-success', 'New country has been added successfully!');

        	return redirect('country');
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'country_code' => 'required',
                'country_name' => 'required',
                'is_active' => 'required',
            ]);
            
        	$country = Country::where('id','=',$id)->first();
            $country->country_name = strtoupper($request->country_name); 
            $country->is_active = $request->is_active;
            $country->updated_by = session()->get('session_name') ;
        	$country->save();

            $request->session()->flash('alert-success', 'Country has been updated successfully!');

        	return  redirect('country');
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        if (session()->get('session_superadmin') == 1) {
            $country = Country::find($id);
            $country->is_active = '2';
            $country->updated_by = session()->get('session_name') ;
            $country->save();

            $request->session()->flash('alert-success', 'Country has been deleted successfully!');

            return  redirect('country');
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    } 

    // Function: Delete data from table
    public function delete_db($id){
        if (session()->get('session_superadmin') == 1) {
        	// find khusus untuk primary key di database
        	$country = Country::find($id);
        	$country->delete();

        	return  redirect('country');
        }else{
            $request->session()->flash('alert-danger', 'Access denied!');
            return redirect('department');
        }
    } 
}
