@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Department</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Department <span class="fa-angle-right fa"></span> View</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Department</h3></div>
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
                                    <td><input type="text" class="form-control" value="{{ $data_department->country_name }}" readonly></td>
                                </tr> 
                                @else
                                @endif    
                                <tr>
                                    <td>Department Name <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->department_name }}" readonly></td>
                                </tr>   
                                <tr>
                                    <td>Department Description <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->department_desc }}" readonly></td>
                                </tr> 
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->email }}" readonly></td>
                                </tr>   
                                <tr>
                                    <td>Head Of Department</td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->head_of_department }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Manager</td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->manager }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Flag Designated</td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->flag_designated=='1' ? 'Yes':'No' }}" readonly></td>
                                </tr>   
                                <tr>
                                    <td>Flag Ecternal</td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->flag_external=='1' ? 'Yes':'No' }}" readonly></td>
                                </tr>       
                                <tr>
                                    <td>Is Active <em style="color:red">*</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->is_active=='1' ? 'Active':'Inactive' }}" readonly></td>
                                </tr> 
                                <tr>
                                    <td>Created By </td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->created_by }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Created Date</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->created_at }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Modified By</em></td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->updated_by }}" readonly></td>
                                </tr>  
                                <tr>
                                    <td>Modified Date</td>
                                    <td><input type="text" class="form-control" value="{{ $data_department->updated_at }}" readonly></td>
                                </tr>  
                                <tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a class="btn btn-danger" href="{{url('/department')}}"  style="text-decoration: none;">Back</a>
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