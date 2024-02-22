@extends("admin.layout")
@section("do-du-lieu-tu-view")
    <div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url('backend/products/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width:100px;">Photo</th>
                    <th>Name</th>
                    <th style="width:180px;">Category</th>
                    <th style="width:100px;">Price</th>
                    <th style="width:80px;">Quantity</th>
                    <th style="width:80px;">Discount</th>
                    <th style="width:80px;">Hot</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>
                    	@if($row->photo != "" && file_exists('upload/products/'.$row->photo))
                    	<img src="{{ asset('upload/products/'.$row->photo) }}" style="width:100px;">
                    	@endif
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>
                    	<!-- gọi hàm getCategoryName trong class App\MyCustomClass\Products -->
                    	{{ App\MyCustomClass\Products::getCategoryName($row->category_id) }}
                    </td>
                    <td>{{ number_format($row->price) }}</td>
                    <td>{{ $row->quantity }}</td>
                    <td style="text-align:center;">{{ $row->discount }}%</td>
                    <td style="text-align:center;">
                    	@if($row->hot == 1)
                    	<span class="glyphicon glyphicon-check"></span>
                    	@endif
                    </td>
                    <td style="text-align:center;">
                        <a href="{{ url('backend/products/update/'.$row->id) }}">Edit</a>&nbsp;
                        <a href="{{ url('backend/products/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
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