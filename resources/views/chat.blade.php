@include('layouts.app')
<!DOCTYPE html>
<html>
<head>
	<title>hello</title>
</head>
<style type="text/css">
	
.chat_dispaly
{
	
	width: 300px; 
	min-height: 400px;
	height: auto; 
	margin: auto;
	background-color: #ffffff;
}
.displayreceiver
{
	padding-top: 10px;
	margin-left: 20px;
	font-size: 20px;

}
.chat_received
{
	float: left;

}
.chat_send
{
	float: right;
}
</style>
<body>

<div style="width: 500px; margin: auto; background-color: #f4f4f4">
<div id="user">{{Auth::user()->name}}</div>
<div>chat with...
	@foreach($users as $users)
		@if( $users->name != Auth::user()->name)
			<div style="font-size: 16px; margin-top: 15px;"><a href="" id="{{$users->name}}" class="receiver" >{{$users->name}}</a></div>
		@endif
	@endforeach
</div>
<div class="board" ></div>


<div class="message" style="width: 300px; margin: auto; display: none;" >
	
		<input type="text" name="message" id="chat" style=" width: 240px;">
		
	
	<div class="typingstatus"></div>
</div>
</div>
</body>
<script type="text/javascript">
	$('.receiver').click(function(e)
	{	e.preventDefault();
		$('.message').css('display','block');
		var receiver = $(this).attr('id') ;
		
		 var elem = document.getElementById('chatwith'+receiver);
		if (elem == null) 
		{
			$('.chat_dispaly').hide();
			$('.board').append('<div class="chat_dispaly" id="chatwith'+receiver+'"><div class="displayreceiver">'+receiver+'</div><hr></div>');
			$('#chatwith'+receiver).show();
		}
		else
		{
				$('.chat_dispaly').hide();
				$('#chatwith'+receiver).show();
		}

		 
	
	});
	function sendMessage()
	{
		var text = $('#chat').val();
		var url = '/sendmessage';
		var reciever = $('.displayreceiver').text();
		var method = 'POST';
		
		$.ajax({
			url: url,
			type: method,
			data: { text: text , receiver: reciever },
			process:false,
			contenttype:false,
			 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
		});

	}

	$(document).ready(function()
	{
		$('input').keyup(function(e)
		{ 
			
			if(e.keyCode == 13)
				sendMessage();
			
		})

		pullData();
	});

	function pullData()
	{
		retrieveMessage()
		
	}

	function retrieveMessage()
	{
		$.get("/retrieve",function(data){
			sortChat(data);	
		});
	}

	function sortChat(data)
	{
		var sender = $('#user').text();
		for (var i = 0; i < data.length; i++) 
		{
			if(sender == data[i].sender_username)
			{
				var elem = document.getElementById('chatwith'+data[i].receiver_username);
				if(elem == null)
				{
					$('.chat_dispaly').hide();
						$('.board').append('<div class="chat_dispaly" id="chatwith'+data[i].receiver_username+'"><div class="displayreceiver">'+data[i].receiver_username+'</div><hr></div>');
						
				}

				$('#chatwith'+data[i].receiver_username).append('<div class="chat_send">'+data[i].text+'</div>');
			}
			else
			{
				var elem = document.getElementById('chatwith'+data[i].sender_username);
				if(elem == null)
				{
					$('.chat_dispaly').hide();
						$('.board').append('<div class="chat_dispaly" id="chatwith'+data[i].sender_username+'"><div class="displayreceiver">'+data[i].sender_username+'</div><hr></div>');
						
				}

				$('#chatwith'+data[i].sender_username).append('<div class="chat_received">'+data[i].text+'</div>');
			}
		}
	}



</script>
<!-- <script type="text/javascript">
for (var i = 0; i < data.length; i++) 
		if( data != '')
			{
				var elem = document.getElementById('chatwith'+data.sender_username);
					if (elem == null) 
					{
						$('.chat_dispaly').hide();
						$('.board').append('<div class="chat_dispaly" id="chatwith'+data.sender+'"><div class="displayreceiver">'+data.sender_username+'</div><hr></div>');
						$('#chatwith'+data.sender).show();
						$('.message').css('display','block');
					}

					$('#chatwith'+data.sender).append('<div class="chat_received">'+data.text+'</div>');
			}

function ajaxForm(e) {
    $('p.text-danger').remove();
    let progressBar = $(".main-progress .progress-bar");
    progressBar.css('width','0');
    progressBar.show();
    progressBar.animate({"width":"50%"});
    let form = $(this);
    let url = form.attr('action');
    let method = form.attr('method');

    let formData = new FormData(form[0]);
    //check if form has csrf token
    if(form.find("input[name='_token']")[0] == undefined){
        let csrf = $("meta[name='csrf-token']");
        if(!csrf){
            throw "Could not find token.";
        }
        formData.append('_token',csrf);
    }
>>>>>>> bb662e7e340fb881c6bc6a744b7d4bf4cd923abd

  
var username
	$(document).ready(function(){



		pullData();
        usename = $('#username').html();

        $(document).keyup(function(e){
        	if(e.keyCode == 13)
        		sendMessage();
        	else
        		isTyping();
        });
	});

	function pullData()
	{
		retrieveChatMessage();
		retrieveTypingStatus();
		setTimeout(pullData,3000);
	}

	function retrieveChatMessage()
	{
		$.post('/retrieveChatMessage', {username: username}, function(data){
			if(data.length > 0)
			{
				$('.chats_dispaly').append('<div>'+data+'</div>');
			}
		})
	}

	function retrieveTypingStatus()
	{
		$.post('/retrieveTypingStatus',{username: username},function(username)
		{
			if(username.length > 0)
				$('.typingstatus').html(username+ ' is typing');
			else
				$('.typingstatus').html('');

		});
	}


	function sendMessage()
	{
		var text = $(".message").val();

		if(text.length > 0 )
		{
			$.post('/chat',{text: text, username: username, data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        }}, function()
			{
				$('.chat_dispaly').append('<div style="text-align:right;">'+text+'</div>');
				$('.message').val('');
				notTyping();
			});
		}
	}
	function isTyping()
	{
		$.post('/typing' , {username:username});
	}
	function notTyping()
	{
		$.post('/nottyping' , {username:username});
	}
</script> -->
</html>