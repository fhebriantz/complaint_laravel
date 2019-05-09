@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Management User Department</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Management User Department <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Management User Department</h3></div>
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
                        <form method="POST" action="{{url('/mgmtuserdept/'.$data_mgmtuserdept->id.'/edit')}}">
                        {{ csrf_field() }}
                            <table class="table">  

                                <tr>
                                    <td>Management User</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_mgmt_user" style="width: 100%">
                                            <option value="">-- Choose User --</option>
                                            @foreach($mgmtuser as $mgmtuser)
                                            <option value="{{$mgmtuser->id}}" {{ ($data_mgmtuserdept->id_mgmt_user == $mgmtuser->id ? 'selected':'') }} >{{$mgmtuser->id}} - {{$mgmtuser->email}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> 

                                <tr>
                                    <td>Department</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_designated_department" style="width: 100%">
                                            <option value="">-- Choose Department --</option>
                                            @foreach($department as $dept)
                                            <option value="{{$dept->id}}" {{ ($data_mgmtuserdept->id_designated_department == $dept->id ? 'selected':'') }} >{{$dept->country_code}} - {{$dept->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> 

                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="{{url('/mgmtuserdept')}}"  style="text-decoration: none;">Back</a>
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