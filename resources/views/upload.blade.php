<!DOCTYPE html>
<html>
<head>
	<title>Upload song</title>
</head>
<body>
<form method="post" action="{{route("song.upload")}}" enctype="multipart/form-data" >
{{csrf_field()}}
	<input type="file" name="song">
	<button type="submit">Upload</button>
</form>
</body>
</html>