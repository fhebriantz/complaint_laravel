@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Email Template</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Email Template <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Email Template</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    	<form method="POST" action="{{url('/emailtemplate/create')}}">
						{{ csrf_field() }}
	                        <table class="table">  

                                @if(session()->get('session_superadmin') == 1)
                                <tr>
                                    <td>Country</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_country" style="width: 100%">
                                            <option value="">-- Choose Country --</option>
                                            @foreach($country as $kontri)
                                            <option value="{{$kontri->id}}" {{ (old('id_country') == $kontri->id ? 'selected':'') }} >{{$kontri->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> 
                                @else
                                @endif    
                                <tr>
                                    <td>Subject <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="subject" required="" placeholder="Subject Name" value="{{ old('subject') }}" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Message <em style="color:red">*</em></td>
                                    <td><textarea id="summernote" class="form-control" name="message" required="" placeholder="Description" style="width: 100%">{{ old('message') }}</textarea></td>
                                </tr> 
                                <tr>
                                    <td>Type of Email</td>
                                    <td>
                                        <select name="type_of_email"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Type --</option>
                                            <option value="Success_Complaint" {{ (old('type_of_email') == 'Success_Complaint' ? 'selected':'') }}>Success_Complaint</option>

                                            <option value="Feedback" {{ (old('type_of_email') == 'Feedback' ? 'selected':'') }}>Feedback</option>

                                            <option value="Complaint_Fixed" {{ (old('type_of_email') == 'Complaint_Fixed' ? 'selected':'') }}>Complaint_Fixed</option>

                                            <option value="Acknowledge" {{ (old('type_of_email') == 'Acknowledge' ? 'selected':'') }}>Acknowledge</option>

                                            <option value="Review" {{ (old('type_of_email') == 'Review' ? 'selected':'') }}>Review</option>

                                            <option value="Success_Complaint (Internal)" {{ (old('type_of_email') == 'Success_Complaint (Internal)' ? 'selected':'') }}>Success_Complaint (Internal)</option>

                                            <option value="Feedback (Internal)" {{ (old('type_of_email') == 'Feedback (Internal)' ? 'selected':'') }}>Feedback (Internal)</option>

                                            <option value="Complaint_Fixed (Internal)" {{ (old('type_of_email') == 'Complaint_Fixed (Internal)' ? 'selected':'') }}>Complaint_Fixed (Internal)</option>

                                            <option value="Acknowledge (Internal)" {{ (old('type_of_email') == 'Acknowledge (Internal)' ? 'selected':'') }}>Acknowledge (Internal)</option>

                                            <option value="Review (Internal)" {{ (old('type_of_email') == 'Review (Internal)' ? 'selected':'') }}>Review (Internal)</option>
                                        </select>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>Is Active <em style="color:red">*</em></td>
                                    <td>
                                        <select name="is_active"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Status --</option>
                                            <option value="1" {{ (old('is_active') == '1' ? 'selected':'') }}>Active</option>
                                            <option value="0" {{ (old('is_active') == '0' ? 'selected':'') }}>Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

								<tr>
									<td></td>
									<td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="{{url('/emailtemplate')}}"  style="text-decoration: none;">Back</a>
                                    </td>
								</tr>
	                        </table>
	                    </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection


@section('header')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('.datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD H:m:s'
            });
    });
</script>
@endsection