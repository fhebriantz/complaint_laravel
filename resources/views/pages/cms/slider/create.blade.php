@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Slider</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Slider <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Slider</h3></div>
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
                    	<form method="POST" action="{{url('/slider/create')}}"  enctype="multipart/form-data">
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
                                    <td>Slider Name <em style="color:red">*</em></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input required="" id="picture" type="file" name="nama_slider" class="file" data-show-upload="false" data-overwrite-initial="false" data-theme="fas">
                                            </div>
                                        </div>
                                    </td>
                                </tr>   
                                <tr>
                                    <td>Caption <em style="color:red">*</em></td>
                                    <td><textarea class="form-control" name="caption" required="" placeholder="Caption" style="width: 100%">{{ old('caption') }}</textarea></td>
                                </tr>           
                                <tr>
                                    <td>Tanggal Dibuat</td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="tanggal_dibuat" placeholder="YYYY-MM-DD hh:mm:ss"  value="{{ old('tanggal_dibuat') }}" >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
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
                                        <a class="btn btn-danger" href="{{url('/slider')}}"  style="text-decoration: none;">Back</a>
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
<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="{{ asset('themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('.datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD H:m:s'
            });
    });
</script>
<script>
    $("#picture").fileinput({
        theme: 'fas',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 2000,
        maxFilesNum: 1,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });

    $("form").submit(function(){
        var err = $(this).find(".kv-fileinput-error").text();

        if ($.trim(err)) {
            // do something
            return false;
        }
    });
</script>
@endsection