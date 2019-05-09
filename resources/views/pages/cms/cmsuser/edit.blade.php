@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">CMS User</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> CMS User <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data CMS User</h3></div>
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
                        <form method="POST" action="{{url('/cmsuser/'.$data_cmsuser->id.'/edit')}}">
                        {{ csrf_field() }}
                            <table class="table">  

                                @if(session()->get('session_superadmin') == 1)
                                <tr>
                                    <td>Country</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_country" style="width: 100%">
                                            <option value="">-- Choose Country --</option>
                                            @foreach($country as $kontri)
                                            <option value="{{$kontri->id}}" {{ ($data_cmsuser->id_country == $kontri->id ? 'selected':'') }} >{{$kontri->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> 
                                @else
                                @endif    
                                <tr>
                                    <td>Fullname <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="fullname" required="" placeholder="Fullname" value="{{ $data_cmsuser->fullname }}" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Username <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="username" required="" placeholder="username" value="{{ $data_cmsuser->username }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Password <em style="color:red">*</em></td>
                                    <td> <input type="password" class="form-control" name="password" placeholder="Password" value="" style="width: 100%"></td>
                                </tr>
                                <tr>
                                    <td>Confirmation Password <em style="color:red">*</em></td>
                                    <td> <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" value="" style="width: 100%"></td>
                                </tr> 

                                @if(session()->get('session_superadmin') == 1)
                                <tr>
                                    <td>Is Superadmin</td>
                                    <td>
                                        <select name="is_superadmin"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Superadmin --</option>
                                            <option value="1" {{ ($data_cmsuser->is_superadmin == '1' ? 'selected':'') }}>Yes</option>
                                            <option value="0" {{ ($data_cmsuser->is_superadmin == '0' ? 'selected':'') }}>No</option>
                                        </select>
                                    </td>
                                </tr>  
                                @else
                                @endif       
                                <tr>
                                    <td>Is Active <em style="color:red">*</em></td>
                                    <td>
                                        <select name="is_active"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Status --</option>
                                            <option value="1" {{ ($data_cmsuser->is_active == '1' ? 'selected':'') }}>Active</option>
                                            <option value="0" {{ ($data_cmsuser->is_active == '0' ? 'selected':'') }}>Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="{{url('/cmsuser')}}"  style="text-decoration: none;">Back</a>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="_method" value="PUT">
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