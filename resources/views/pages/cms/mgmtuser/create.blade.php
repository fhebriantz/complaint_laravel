@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Mgmtuser</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Mgmtuser <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Mgmtuser</h3></div>
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
                    	<form method="POST" action="{{url('/mgmtuser/create')}}">
						{{ csrf_field() }}
	                        <table class="table">  
                                <tr>
                                    <td>User Internal</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_user_internal" style="width: 100%">
                                            <option value="">-- Choose User Internal --</option>
                                            @foreach($userinternal as $uint)
                                            <option value="{{$uint->id}}" {{ (old('id_user_internal') == $uint->id ? 'selected':'') }} >{{$uint->country_code}} - {{$uint->department_name}} ({{$uint->id}}) </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>Position</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_position" style="width: 100%">
                                            <option value="">-- Choose Position --</option>
                                            @foreach($position as $pos)
                                            <option value="{{$pos->id}}" {{ (old('id_position') == $pos->id ? 'selected':'') }} >{{$pos->position}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>   
                                <tr>
                                    <td>Password</td>
                                    <td><input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Confirmation Password</td>
                                    <td> <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" style="width: 100%"></td>
                                </tr> 
                                <tr>
                                    <td>Email</td>
                                    <td><input type="email"  class="form-control" name="email" placeholder="Email" readonly value="" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Telephone</td>
                                    <td><input type="text"  class="form-control" name="telephone" placeholder="Telephone" value="{{ old('telephone') }}" style="width: 100%"></td>
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
                                        <a class="btn btn-danger" href="{{url('/mgmtuser')}}"  style="text-decoration: none;">Back</a>
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