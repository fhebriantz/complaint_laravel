<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Emailtemplate;
use App\Http\Model\Country;

class EmailtemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        if (session()->get('session_superadmin') == 1) {
            $data_emailtemplate = Emailtemplate::GetAllData();
        }else{
            $data_emailtemplate = Emailtemplate::GetAllData()->where('id_country','=',session()->get('session_country'));
        }
        $no = 1;
    	return view('pages/cms/emailtemplate/index', compact('data_emailtemplate','no'));
    }

    function create()
    {
        $country = Country::GetAllData();
        return view('pages/cms/emailtemplate/create', compact('country'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        $emailtemplate=Emailtemplate::where('id','=',$id)->first();
        return view('pages/cms/emailtemplate/edit')
        ->with('country',$country)
        ->with('data_emailtemplate',$emailtemplate);
    }

    function view($id)
    {
        $emailtemplate=Emailtemplate::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/emailtemplate/view')
        ->with('data_emailtemplate',$emailtemplate);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'type_of_email' => 'required',
            'is_active' => 'required',
        ]);

    	$emailtemplate = new Emailtemplate;
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $emailtemplate->id_country = $request->id_country;
        }else{
            $emailtemplate->id_country = session()->get('session_country');
        }
        $emailtemplate->subject = $request->subject; 
		$emailtemplate->message = $request->message; 
		$emailtemplate->type_of_email = $request->type_of_email;
        $emailtemplate->is_active = $request->is_active;
        $emailtemplate->created_by = session()->get('session_name'); 
    	$emailtemplate->save();

        $request->session()->flash('alert-success', 'New emailtemplate has been added successfully!');

    	return redirect('emailtemplate');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'type_of_email' => 'required',
            'is_active' => 'required',
        ]);

        
    	$emailtemplate = Emailtemplate::where('id','=',$id)->first();
        if (session()->get('session_superadmin') == 1) {
            $validatedData = $request->validate([
                'id_country' => 'required',
            ]);
            $emailtemplate->id_country = $request->id_country;
        }else{
            $emailtemplate->id_country = session()->get('session_country');
        }
        $emailtemplate->subject = $request->subject; 
        $emailtemplate->message = $request->message; 
        $emailtemplate->type_of_email = $request->type_of_email;
        $emailtemplate->is_active = $request->is_active;
        $emailtemplate->updated_by = session()->get('session_name'); 
        $emailtemplate->save();

        $request->session()->flash('alert-success', 'Emailtemplate has been updated successfully!');

    	return  redirect('emailtemplate');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $emailtemplate = Emailtemplate::find($id);
        $emailtemplate->is_active = '2';
        $emailtemplate->updated_by = session()->get('session_name') ;
        $emailtemplate->save();

        $request->session()->flash('alert-success', 'Emailtemplate has been deleted successfully!');

        return  redirect('emailtemplate');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$emailtemplate = Emailtemplate::find($id);
    	$emailtemplate->delete();

    	return  redirect('emailtemplate');
    } 
}
