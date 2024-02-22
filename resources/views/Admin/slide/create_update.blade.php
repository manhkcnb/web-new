@extends("admin.layout")
@section("do-du-lieu-tu-view")
	<div class="col-md-12">  
	    <div class="panel panel-primary">
	        <div class="panel-heading">Add edit</div>
	        <div class="panel-body">
	        	<!-- muốn upload được file thì phải có thuộc tính enctype="multipart/form-data" -->
	        <form method="post" enctype="multipart/form-data" action="{{ $action }}">
	        	@csrf
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Name</div>
	                <div class="col-md-10">
	                    <input type="text" required value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" required>
	                </div>
	            </div>
	            
	            
	            </div>
	            
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2"></div>
	                <div class="col-md-10">
	                    <input type="checkbox" @if(isset($record->hot) && $record->hot == 1) checked @endif name="display" id="display"> <label for="display">Display</label>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Photo</div>
	                <div class="col-md-10">
	                    <input type="file" name="photo">
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