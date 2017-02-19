
Message Center

Php backend
	getChat.php
		lookup chat history in database filter by messages less than 24hrs old
	sendChat.php
		insert chat message into database
	helpers.php
		database connection and utility functions
			You must create a database login creditals php file with $server,$user,$pass,$db variables and place it outside the webroot directory
			Alter include path in db_connect() to the location of db login creditals file
		

Html Jquery/bootstrap frontend
	index.html 
		Welcome user
		set username using cookie
	chat.php
		request and display messages every 30 sec
		send new messages
	style.css
	cookies.js
		javascript api for cookies https://github.com/js-cookie/js-cookie

Mysql database 
	Chat_Table
		id (int)
		sent (datetime)
		username (varchar20)
		message (text)
		hidden (boolean)