
Message Center

Php backend
	getChat.php
		lookup chat history in database filter by messages less than 24hrs old
	sendChat.php
		insert chat message into database
	helpers.php
		

Html Jquery/bootstrap frontend
	index.html 
		Welcome user
		set username using cookie
	msgCntr.html
		show messages
		get new message every 30 sec
		send messages

Mysql database 
	Chat_Table
		id (id)
		sent (datetime)
		username (varchar20)
		message (text)
		hidden (boolean)