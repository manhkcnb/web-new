@extends("admin.layout")
@section("do-du-lieu-tu-view")
	<div class="col-md-12">  
	    <div class="panel panel-primary">
	        <div class="panel-heading">Add edit</div>
	        <div class="panel-body">
	        <form method="post" action="{{ $action }}">
	        	@csrf
	        	<!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Parent</div>
	                <div class="col-md-10">
	                    @php
	                    	if(isset($record->id))
	                    		$categories = DB::table("categories")->where("parent_id","=","0")->where("id","<>",$record->id)->orderBy("id","desc")->get();
	                    	else
	                    		$categories = DB::table("categories")->where("parent_id","=","0")->orderBy("id","desc")->get();
	                    @endphp
	                    <select name="parent_id" class="form-control" style="width:250px;">
	                    	<option value="0"></option>
	                    	@foreach($categories as $row)
	                    	<option @if(isset($record->parent_id) && $record->parent_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
	                    	@endforeach
	                    </select>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Name</div>
	                <div class="col-md-10">
	                    <input type="text" value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" required>
	                </div>
	            </div>
	            <!-- end rows -->	
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2"></div>
	                <div class="col-md-10">
	                    <input type="checkbox" @if(isset($record->display_at_home_page) && $record->display_at_home_page == 1) checked @endif name="display_at_home_page" id="display_at_home_page"> <label for="display_at_home_page">Display at home page</label>
	                </div>
	            </div>
	            <!-- end rows -->            
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2"></div>
	                <div class="col-md-10">
	                    <input type="submit" value="Process" class="btn btn-primary">
	                </div>
	            </div>
	            <!-- end rows -->
	        </form>
	        </div>
	    </div>
	</div>
@endsection