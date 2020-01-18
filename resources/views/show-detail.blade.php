<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

<div class="card">
  <div class="card-header">
    Contact submitted successfully
  </div>
  <div class="card-body">
  	<div class="form-group">
    	<label for="exampleInputPassword1">Name:</label>
    	<span>{{$data['name']}}</span>
    </div>
    <div class="form-group">
    	<label for="exampleInputPassword1">Email:</label>
    	<span>{{$data['email']}}</span>
    </div>
    <div class="form-group">
    	<label for="exampleInputPassword1">Message:</label>
    	<span>{{$data['message']}}</span>
    </div>
  </div>
</div>
<a href="{{url('/')}}" class="btn btn-primary">Back to Home</a>
</body>
</html>