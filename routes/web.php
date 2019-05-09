<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'LoginController@show'); 

Route::get('login', 'LoginController@show'); 
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::get('/logout', 'LogoutController@index');

// =====ROUTE:SHOW=====
// Show list of Department
Route::get('department', 'DepartmentController@list'); 
// Show form create of Department
Route::get('department/create', 'DepartmentController@create');
// Show form edit of Department
Route::get('department/{id}/edit','DepartmentController@edit');  
// Show form view of Department
Route::get('department/{id}/view','DepartmentController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('department/create','DepartmentController@insert'); 
// Call function to update
Route::put('department/{id}/edit','DepartmentController@update');  
// Call function to delete
Route::delete('department/{id}/delete','DepartmentController@delete');
// Call function to view
Route::get('department/{id}/view','DepartmentController@view'); 


// =====ROUTE:SHOW=====
// Show list of Country
Route::get('country', 'CountryController@list'); 
// Show form create of Country
Route::get('country/create', 'CountryController@create');
// Show form edit of Country
Route::get('country/{id}/edit','CountryController@edit');  
// Show form view of Country
Route::get('country/{id}/view','CountryController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('country/create','CountryController@insert'); 
// Call function to update
Route::put('country/{id}/edit','CountryController@update');  
// Call function to delete
Route::delete('country/{id}/delete','CountryController@delete');
// Call function to view
Route::get('country/{id}/view','CountryController@view'); 


// =====ROUTE:SHOW=====
// Show list of Userinternal
Route::get('userinternal', 'UserinternalController@list'); 
// Show form create of Userinternal
Route::get('userinternal/create', 'UserinternalController@create');
// Show form edit of Userinternal
Route::get('userinternal/{id}/edit','UserinternalController@edit');  
// Show form view of Userinternal
Route::get('userinternal/{id}/view','UserinternalController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('userinternal/create','UserinternalController@insert'); 
// Call function to update
Route::put('userinternal/{id}/edit','UserinternalController@update');  
// Call function to delete
Route::delete('userinternal/{id}/delete','UserinternalController@delete');
// Call function to view
Route::get('userinternal/{id}/view','UserinternalController@view'); 


// =====ROUTE:SHOW=====
// Show list of Mgmtuser
Route::get('mgmtuser', 'MgmtuserController@list'); 
// Show form create of Mgmtuser
Route::get('mgmtuser/create', 'MgmtuserController@create');
// Show form edit of Mgmtuser
Route::get('mgmtuser/{id}/edit','MgmtuserController@edit');  
// Show form view of Mgmtuser
Route::get('mgmtuser/{id}/view','MgmtuserController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('mgmtuser/create','MgmtuserController@insert'); 
// Call function to update
Route::put('mgmtuser/{id}/edit','MgmtuserController@update');  
// Call function to delete
Route::delete('mgmtuser/{id}/delete','MgmtuserController@delete');
// Call function to view
Route::get('mgmtuser/{id}/view','MgmtuserController@view'); 


// =====ROUTE:SHOW=====
// Show list of Mgmtuserdept
Route::get('mgmtuserdept', 'MgmtuserdeptController@list'); 
// Show form create of Mgmtuserdept
Route::get('mgmtuserdept/create', 'MgmtuserdeptController@create');
// Show form edit of Mgmtuserdept
Route::get('mgmtuserdept/{id}/edit','MgmtuserdeptController@edit');  
// Show form view of Mgmtuserdept
Route::get('mgmtuserdept/{id}/view','MgmtuserdeptController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('mgmtuserdept/create','MgmtuserdeptController@insert'); 
// Call function to update
Route::put('mgmtuserdept/{id}/edit','MgmtuserdeptController@update');  
// Call function to delete
Route::delete('mgmtuserdept/{id}/delete','MgmtuserdeptController@delete');
// Call function to view
Route::get('mgmtuserdept/{id}/view','MgmtuserdeptController@view'); 


// =====ROUTE:SHOW=====
// Show list of Cmsuser
Route::get('cmsuser', 'CmsuserController@list'); 
// Show form create of Cmsuser
Route::get('cmsuser/create', 'CmsuserController@create');
// Show form edit of Cmsuser
Route::get('cmsuser/{id}/edit','CmsuserController@edit');  
// Show form view of Cmsuser
Route::get('cmsuser/{id}/view','CmsuserController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('cmsuser/create','CmsuserController@insert'); 
// Call function to update
Route::put('cmsuser/{id}/edit','CmsuserController@update');  
// Call function to delete
Route::delete('cmsuser/{id}/delete','CmsuserController@delete');
// Call function to view
Route::get('cmsuser/{id}/view','CmsuserController@view'); 


// =====ROUTE:SHOW=====
// Show list of Slider
Route::get('slider', 'SliderController@list'); 
// Show form create of Slider
Route::get('slider/create', 'SliderController@create');
// Show form edit of Slider
Route::get('slider/{id}/edit','SliderController@edit');  
// Show form view of Slider
Route::get('slider/{id}/view','SliderController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('slider/create','SliderController@insert'); 
// Call function to update
Route::put('slider/{id}/edit','SliderController@update');  
// Call function to delete
Route::delete('slider/{id}/delete','SliderController@delete');
// Call function to view
Route::get('slider/{id}/view','SliderController@view'); 


// =====ROUTE:SHOW=====
// Show list of Emailtemplate
Route::get('emailtemplate', 'EmailtemplateController@list'); 
// Show form create of Emailtemplate
Route::get('emailtemplate/create', 'EmailtemplateController@create');
// Show form edit of Emailtemplate
Route::get('emailtemplate/{id}/edit','EmailtemplateController@edit');  
// Show form view of Emailtemplate
Route::get('emailtemplate/{id}/view','EmailtemplateController@view');  

// =====ROUTE:FUNCTION=====
// Call function to insert
Route::post('emailtemplate/create','EmailtemplateController@insert'); 
// Call function to update
Route::put('emailtemplate/{id}/edit','EmailtemplateController@update');  
// Call function to delete
Route::delete('emailtemplate/{id}/delete','EmailtemplateController@delete');
// Call function to view
Route::get('emailtemplate/{id}/view','EmailtemplateController@view'); 