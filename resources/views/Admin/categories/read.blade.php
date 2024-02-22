@extends("admin.layout")
@section("do-du-lieu-tu-view")
    <div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url('backend/categories/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <th style="width:100px;">Home page</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td style="text-align:center;">
                        @if($row->display_at_home_page == 1)
                        <span class="glyphicon glyphicon-check"></span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <a href="{{ url('backend/categories/update/'.$row->id) }}">Edit</a>&nbsp;
                        <a href="{{ url('backend/categories/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                    <!-- có thể truy vấn trực tiếp ở đây -->
                    @php
                        $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id","desc")->get();
                    @endphp
                    @foreach($subCategories as $rowSub)
                        <tr>
                            <td style="padding-left: 30px;">{{ $rowSub->name }}</td>
                            <td style="text-align:center;">
                                @if($rowSub->display_at_home_page == 1)
                                <span class="glyphicon glyphicon-check"></span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ url('backend/categories/update/'.$rowSub->id) }}">Edit</a>&nbsp;
                                <a href="{{ url('backend/categories/delete/'.$rowSub->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    @endforeach
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