@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">CMS User</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> CMS User <span class="fa-angle-right fa"></span> View</p>
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
                            <table class="table">  

                                @if(session()->get('session_superadmin') == 1)
                                <tr>
                                    <td>Country</td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->country_name }}" readonly></td>
                                </tr> 
                                @else
                                @endif    
                                <tr>
                                    <td>fullname <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->fullname }}" readonly></td>
                                </tr>   
                                <tr>
                                    <td>username <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->username }}" readonly></td>
                                </tr> 
                                <tr>
                                    <td>password</td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->password }}" readonly></td>
                                </tr>   
                                <tr>
                                    <td>Is Superadmin <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->is_superadmin=='1' ? 'Yes':'No' }}" readonly></td>
                                </tr> 
                                <tr>
                                    <td>Is Active <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->is_active=='1' ? 'Active':'Inactive' }}" readonly></td>
                                </tr> 
                                <tr>
                                    <td>Created By </td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->created_by }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Created Date</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->created_at }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Modified By</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->updated_by }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Modified Date</td>
                                    <td><input type="text" class="form-control" value="{{ $data_cmsuser->updated_at }}" readonly></td>
                                </tr>  
                                <tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a class="btn btn-danger" href="{{url('/cmsuser')}}"  style="text-decoration: none;">Back</a>
                                    </td>
                                </tr>
                            </table>
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