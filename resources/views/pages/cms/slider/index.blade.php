@extends('layouts.cmsnew')

@section('content')
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Slider</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Slider</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Slider</h3>  <a href="{{url('/slider/create')}}"><button type="button" style="margin-bottom: 10px;" class="btn btn-success">Add New Slider</button></a></div>
                <div class="panel-body">
                    <div class="responsive-table">

                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Country</th>
                                    <th>Slider Name</th>
                                    <th>Caption</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Modified Date</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data_slider as $data)
                                <tr>    
                                    <td>{{ $no++ }}</td>
                                    <td>{{$data->country_name}}</td>
                                    <td>{{$data->nama_slider}}</td>
                                    <td>{{$data->caption}}</td>
                                    <td>{{ $data->is_active=='1' ? 'Active':'Inactive' }}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->updated_at}}</td>
                                    <td>
                                        <a href="{{url('/slider/'.$data->id.'/view')}}" style="margin-bottom: 5px"><button type="button" class="btn btn-primary" style="margin-bottom: 5px">View</button></a>
                                        <a href="{{url('/slider/'.$data->id.'/edit')}}"><button type="button" class="btn btn-warning" style="margin-bottom: 5px">Edit</button></a>
                                        <form method="POST" action="{{url('/slider/'.$data->id.'/delete')}}">
                                            <!-- csrf perlu ditambahakan di setiap post -->
                                            {{ csrf_field() }}
                                            <input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure want to delete caption {{$data->nama_slider}}?');"> 
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection