<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// untuk menyingkat materi gak usah pake APP
use Auth;
use Illuminate\Routing\Middleware\LoginCheck;
use vendor\autoload;
use App\Http\Model\Slider;
use App\Http\Model\Country;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('logincheck');
    }

    public function list()
    { 
        if (session()->get('session_superadmin') == 1) {
            $data_slider = Slider::GetAllData();
        }else{
            $data_slider = Slider::GetAllData()->where('id_country','=',session()->get('session_country'));
        }
        $no = 1;
    	return view('pages/cms/slider/index', compact('data_slider','no'));
    }

    function create()
    {
        $country = Country::GetAllData();
        return view('pages/cms/slider/create', compact('country'));
    }

    function edit($id)
    {
        $country = Country::GetAllData();
        $slider=Slider::where('id','=',$id)->first();
        return view('pages/cms/slider/edit')
        ->with('country',$country)
        ->with('data_slider',$slider);
    }

    function view($id)
    {
        $slider=Slider::GetAllData()->where('id','=',$id)->first();
        return view('pages/cms/slider/view')
        ->with('data_slider',$slider);
    }

    // Function: Create new data
    function insert(Request $request)  
    {
        $validatedData = $request->validate([
            'nama_slider' => 'required',
            'caption' => 'required',
            'tanggal_dibuat' => 'required',
            'is_active' => 'required',
        ]);

    	//Upload picture
        $slider = new Slider;
        if($request->file('nama_slider') == "" || $request->file('nama_slider') == null)
        {
            $slider->nama_slider = $slider->nama_slider;
        } 
        else
        {
            $files      = $request->file('nama_slider');
            $fileNames   = 'slider'.time().'.'.$files->getClientOriginalExtension();
            $destinationPath = public_path('assets/images');
            $files->move($destinationPath, $fileNames);
            $slider->nama_slider = $fileNames;
        }

        try {   
            //Save new product data image$slider = Slider::where('id','=',$id)->first();
            if (session()->get('session_superadmin') == 1) {
                $validatedData = $request->validate([
                    'id_country' => 'required',
                ]);
                $slider->id_country = $request->id_country;
            }else{
                $slider->id_country = session()->get('session_country');
            }
            $slider->caption = $request->caption;
            $slider->tanggal_dibuat = $request->tanggal_dibuat;
            $slider->is_active = $request->is_active;
            $slider->created_by = session()->get('session_name'); 
            $slider->save();

            $request->session()->flash('alert-success', 'New product has been added successfully!');
        }
        catch (Exception $e)
        {
            $request->session()->flash('alert-danger', 'Error to upload picture, please try again!');
        }

    	return redirect('slider');
    }

    // Function: Edit data based on ID
    function update (Request $request, $id)  
    {
        $validatedData = $request->validate([
            'caption' => 'required',
            'tanggal_dibuat' => 'required',
            'is_active' => 'required',
        ]);
        
    	$slider = Slider::where('id','=',$id)->first();
        if($request->file('nama_slider') == "" || $request->file('nama_slider') == null)
        {
            $slider->nama_slider = $slider->nama_slider;
        } 
        else
        {
            $files      = $request->file('nama_slider');
            $fileNames   = 'slider'.time().'.'.$files->getClientOriginalExtension();
            $destinationPath = public_path('assets/images');
            $files->move($destinationPath, $fileNames);
            $slider->nama_slider = $fileNames;
        }

        try {   
            //Save new product data image$slider = Slider::where('id','=',$id)->first();
            if (session()->get('session_superadmin') == 1) {
                $validatedData = $request->validate([
                    'id_country' => 'required',
                ]);
                $slider->id_country = $request->id_country;
            }else{
                $slider->id_country = session()->get('session_country');
            }
            $slider->caption = $request->caption;
            $slider->tanggal_dibuat = $request->tanggal_dibuat;
            $slider->is_active = $request->is_active;
            $slider->updated_by = session()->get('session_name') ;
            $slider->save();

            $request->session()->flash('alert-success', 'New product has been added successfully!');
        }
        catch (Exception $e)
        {
            $request->session()->flash('alert-danger', 'Error to upload picture, please try again!');
        }

    	return  redirect('slider');
    }

    // Function: Delete data -> update is_active = 2
    public function delete(Request $request, $id){
        
        $slider = Slider::find($id);
        $slider->is_active = '2';
        $slider->updated_by = session()->get('session_name') ;
        $slider->save();

        $request->session()->flash('alert-success', 'Slider has been deleted successfully!');

        return  redirect('slider');
    } 

    // Function: Delete data from table
    public function delete_db($id){
    	// find khusus untuk primary key di database
    	$slider = Slider::find($id);
    	$slider->delete();

    	return  redirect('slider');
    } 
}
