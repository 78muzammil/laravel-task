<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>List</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container mt-1">
	    <div class="card">
	        <div class="card-header bg-primary text-white">
	            <h5>List</h5>
	        </div>
	        <div class="card-body p-3">
	        	<div class="row g-4">
	                <div class="col-md-6 offset-md-6 text-end">
	                    <a href="{{ route('form') }}" class="btn btn-info">Add</a>
	                    <a href="{{route('import.form')}}" class="btn btn-info">Import</a>
	                </div>
	            </div>
				<table class="table table-striped border mt-3">
				    <thead class="thead-dark">
				        <tr>
				            <th>Profile Image</th>
				            <th>Name</th>
				            <th>Phone</th>
				            <th>Email</th>
				            <th>Street Address</th>
				            <th>City</th>
				            <th>State</th>
				            <th>Country</th>
				            <th class="text-center">Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    	@if(count($list)>0)
				    	@foreach($list as $key => $value)
				    	<tr data-id="{{$value->id}}">
				    		<td><img src="{{ file_exists(public_path('profile_images/'.$value->profile_image)) ? asset('profile_images/'.$value->profile_image) : asset('no-image.jpg') }}"style="max-width: 100px; height: 100px;"></td>
				    		<td>{{$value->name}}</td>
				    		<td>{{$value->phone}}</td>
				    		<td>{{$value->email}}</td>
				    		<td>{{$value->street_address}}</td>
				    		<td>{{$value->city}}</td>
				    		<td>{{$value->state}}</td>
				    		<td>{{$value->country}}</td>
				    		<td class="text-center">
				    			<a href="{{route('form',['id'=>$value->id])}}" class="btn btn-success">Edit</a>
				    			<a class="btn btn-danger btn-delete" data-value="{{$value->id}}"> Delete</a>
				    		</td>
				    	</tr>
				    	@endforeach
				    	@endif
				    </tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script>
		$(document).ready(function () {
			$(".btn-delete").click(function(e){
				e.preventDefault();
	    		let id  = $(this).attr("data-value");
	    		var csrfToken = $('meta[name="csrf-token"]').attr('content');
	    		if (confirm("Are you sure you want to delete this record?")) {
	    			 $.ajax({
	                    url: 'delete/'+ id,
	                    type: 'DELETE',
	                    headers: {
				            'X-CSRF-TOKEN': csrfToken
				        },
	                    success: function(response) {
	                        alert("Record Deleted successfully!");
	                        $('tr[data-id="'+ id +'"]').remove();
	                    },
	                    error: function(response) {
	                        alert("Error deleting item.");
	                    }
	                });
	            } else {
	                alert('Your record is Safe.');
	            }
	    	});
	    });
	</script>
</body>
</html>