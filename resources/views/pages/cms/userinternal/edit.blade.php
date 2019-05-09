@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Userinternal</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Userinternal <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Userinternal</h3></div>
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
                        <form method="POST" action="{{url('/userinternal/'.$data_userinternal->id.'/edit')}}">
                        {{ csrf_field() }}
                            <table class="table">  

                                @if(session()->get('session_superadmin') == 1)
                                <tr>
                                    <td>Country</td>
                                    <td>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_country" style="width: 100%">
                                            <option value="">-- Choose Country --</option>
                                            @foreach($country as $kontri)
                                            <option value="{{$kontri->id}}" {{ ($data_userinternal->id_country == $kontri->id ? 'selected':'') }} >{{$kontri->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> 
                                @else
                                @endif    
                                <tr>
                                    <td>Userinternal Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="userinternal_name" required="" placeholder="Userinternal Name" value="{{ $data_userinternal->userinternal_name }}" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Userinternal Description <em style="color:red">*</em></td>
                                    <td><textarea class="form-control" name="userinternal_desc" required="" placeholder="Description" style="width: 100%">{{ $data_userinternal->userinternal_desc }}</textarea></td>
                                </tr> 
                                <tr>
                                    <td>Email</td>
                                    <td><input type="email"  class="form-control" name="email" placeholder="Email" value="{{ $data_userinternal->email }}" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Head Of Userinternal</td>
                                    <td><input type="email" class="form-control" name="head_of_userinternal" placeholder="Email Head Of Userinternal" value="{{ $data_userinternal->head_of_userinternal }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Manager</td>
                                    <td><input type="email" class="form-control" name="manager" placeholder="Email Manager" value="{{ $data_userinternal->manager }}" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Flag Designated</td>
                                    <td>
                                        <select name="flag_designated"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Flag --</option>
                                            <option value="1" {{ ($data_userinternal->flag_designated == '1' ? 'selected':'') }}>Yes</option>
                                            <option value="0" {{ ($data_userinternal->flag_designated == '0' ? 'selected':'') }}>No</option>
                                        </select>
                                    </td>
                                </tr>   
                                <tr>
                                    <td>Flag Ecternal</td>
                                    <td>
                                        <select name="flag_external"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Flag --</option>
                                            <option value="1" {{ ($data_userinternal->flag_external == '1' ? 'selected':'') }}>Yes</option>
                                            <option value="0" {{ ($data_userinternal->flag_external == '0' ? 'selected':'') }}>No</option>
                                        </select>
                                    </td>
                                </tr>       
                                <tr>
                                    <td>Is Active <em style="color:red">*</em></td>
                                    <td>
                                        <select name="is_active"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Status --</option>
                                            <option value="1" {{ ($data_userinternal->is_active == '1' ? 'selected':'') }}>Active</option>
                                            <option value="0" {{ ($data_userinternal->is_active == '0' ? 'selected':'') }}>Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="{{url('/userinternal')}}"  style="text-decoration: none;">Back</a>
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