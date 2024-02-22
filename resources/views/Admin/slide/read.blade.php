@extends("admin.layout")
@section("do-du-lieu-tu-view")
    <div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url('backend/slide/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width:100px;">Name</th>
                    <th>Photo</th>
                    <th style="width:100px;">Display</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>
                        @if($row->photo != "" && file_exists('upload/slide/'.$row->photo))
                        <img src="{{ asset('upload/slide/'.$row->photo) }}" style="width:100px;">
                        @endif
                    </td>
                    <td style="text-align:center;">
                        @if($row->display == 1)
                        <span class="glyphicon glyphicon-check"></span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <a href="{{ url('backend/slide/update/'.$row->id) }}">Edit</a>&nbsp;
                        <a href="{{ url('backend/slide/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                    <!-- có thể truy vấn trực tiếp ở đây -->
                    
                @endforeach
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            {{ $data->render() }}
        </div>
    </div>
</div>
@endsection