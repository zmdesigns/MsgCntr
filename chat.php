<!DOCTYPE html>
<html lang="en">
	<head>
  <title>.</title>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="bbody">
  	<div class="container">
  		<div class="row">
        <div class="col-lg-12 px-0">
          <ul class="list-group mt-4" id="chat-lstbox">
              <!-- Chat history goes here -->
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10 px-0 inputdiv">
          <input type="text" class="form-control" id="chat_txtbox">
        </div>
        <div class="col-lg-1 px-0 inputdiv">
          <button class="btn btn-primary" id="chat_btn" type="button">Send</button>
        </div>
        <div class="col-lg-1 px-0 inputdiv text-right">
          <button class="btn btn-info" id="info_btn" type="button" data-toggle="tooltip" data-placement="top" title="Mssages last for 24 hours. Now scrolls to bottom :)">i</button>
        </div>
      </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script src="js/cookie.js"></script>

    <script>
      function getChatHistory() {
        $('#chat-lstbox').empty();
        $.ajax({
          url:'include/getChat.php',
          dataType:"json"
        }).done(function(data) {
          $('#chat-lstbox').append(data.join(' '));
          $('#chat-lstbox').animate({scrollTop: $('#chat-lstbox').prop("scrollHeight")}, 500);
        });
      }

      function sendChatMessage() {
        $.ajax({
          url:'include/sendChat.php',
          type: "post",
          data:{username: Cookies.get('username'),
                message: $('#chat_txtbox').val()}
        }).done(function() {
          getChatHistory();
          $('#chat_txtbox').val("");
        });
      }

      $(document).ready(function(data) {
        if (Cookies.get("username") == null)
            window.location.href = "index.html";
        $('[data-toggle="tooltip"]').tooltip(); //init tooltips
        getChatHistory();
      });

      $("#chat_btn").click(function() {
        sendChatMessage();
      });

      $(document).keypress(function(e) {
        if(e.which == 13) {
          if ($('#chat_txtbox').is(':focus')) {
            sendChatMessage();
          }
        }
      });

      window.setInterval(function(){
        getChatHistory();
      }, 30000);


    </script>
  </body>
</html>

