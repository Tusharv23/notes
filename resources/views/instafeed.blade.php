@include('layouts.app')
<!DOCTYPE html>
<html>
<head>
	<title>InstaFeed</title>
	<style type="text/css">
		.heading{
			width: 300px;
			margin: auto;
		}
	</style>
	
		
	</script>
</head>
<body>
<div class="container">
	<div class="heading">
	InstaFeed
</div>
<div class="row ">
<div class="col-md-2"></div>
<div class="col-md-10 photo_holder" id="instafeed">
	
</div>
	
</div>
</div>
</body>
<script type="text/javascript">
	var url = window.location.href;
var hash = url.substring(url.indexOf('=')+1);
alert(hash);
</script>
</html>