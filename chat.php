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
              <li>Test Item</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10 px-0 inputdiv">
          <textarea class="form-control" id="chat_txt"></textarea>
        </div>
        <div class="col-lg-1 px-0 inputdiv">
          <button class="btn btn-primary" id="chat_btn" type="button">Send</button>
        </div>
        <div class="col-lg-1 px-0 inputdiv text-right">
          <button class="btn btn-info hidden-sm-down" id="info_btn" type="button" data-toggle="tooltip" data-placement="top" title="Textarea auto-sizes to content. Page only refreshes when there is new messages">i</button>
        </div>
      </div>
    </div>

    <!-- jQuery, Tether, Bootstrap JS, JSCookie -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="js/cookie.js"></script>

    <script>
      function getChatHistory() {
        $.ajax({
          url:'include/getChat.php',
          dataType:"json"
        }).done(function(data) {
          //If there are no new messages (last message from ajax=last li element)
          newest_msg = jQuery('<div />').html(data[data.length-1]).text();
          last_msg = $("li").last().text();
          if (newest_msg.includes(last_msg)) {

          }
          else {
          	$('#chat-lstbox').empty();
          	$('#chat-lstbox').append(data.join(' '));
          	$('#chat-lstbox').animate({scrollTop: $('#chat-lstbox').prop('scrollHeight')}, 500);
          }
        });
      }

      function sendChatMessage() {
        $.ajax({
          url:'include/sendChat.php',
          type: "post",
          data:{username: Cookies.get('username'),
                message: $('#chat_txt').val()}
        }).done(function() {
          getChatHistory();
          $('#chat_txt').val("");
        });
      }

      //If no username is set, redirect user to index
      //Otherwise, load chat history
      $(document).ready(function(data) {
        if (Cookies.get('username') == null)
            window.location.href = "index.html";
        $('[data-toggle="tooltip"]').tooltip(); //init tooltips
        getChatHistory();
      });

      $('#chat_btn').click(function() {
        sendChatMessage();
      });

      //Send chat message on enter key press if textarea input focused
      $(document).keypress(function(e) {
        if(e.which == 13) {
          if ($('#chat_txt').is(':focus')) {
            sendChatMessage();
          }
        }
      });

      //Refresh chat history every 30 secs
      window.setInterval(function(){
        getChatHistory();
      }, 20000);

      //Size the height of the textarea input to fit content
      $('.inputdiv').on( 'change keyup keydown paste cut', 'textarea', function (){
        $(this).height(0).height(this.scrollHeight);
      }).find( 'textarea' ).change();


    </script>
  </body>
</html>

