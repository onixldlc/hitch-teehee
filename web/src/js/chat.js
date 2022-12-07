let hitch_constant={
	origin: location.origin,
	hostname: location.host
}

console.log(`ws://${hitch_constant.hostname.replace(":8080",":8082")}`)
const socket = io(`ws://${hitch_constant.hostname.replace(":8080",":8082")}`);


function createNewMessage(Username, Message, Timestamp, color){
	return `<div class="messages"><div class="timestamp">${Timestamp}</div><div class="username" style="color:${color};">${Username}</div><div class="divider">:</div><div class="message">${Message}</div></div>`;
	/*
	<div class="messages">
		<div class="timestamp">${Timestamp}</div>
		<div class="username">${Username}:</div>
		<div class="divider">:</div>
		<div class="message">${Message}</div>
	</div>
	*/
}

function addNewMessage(newMessage){
	document.getElementsByClassName("top-chat-content")[0].innerHTML += newMessage;
}

function padLeadingZeros(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
}

function createTimestamp(){
	var date = new Date;
	var minutes = date.getMinutes();
	var hour = date.getHours();
	return String(`${padLeadingZeros(hour, 2)}:${padLeadingZeros(minutes, 2)}`);
}

function sendInput(username,color,userid,thread){
	var messageDiv = document.getElementsByClassName("chatInput")[0].children[0];
	var message = messageDiv.value;
	if(username && message && color){
		socket.emit('message',{"timestamp":createTimestamp(),"userid":userid,"username":username,"message":message,"color":color,"thread":thread});
		messageDiv.value = "";
	}
}

function init(){
	var cred = window.cred;
	var username; 
	var color; 
	var thread; 
	var userid;

	console.log(cred)

	if(cred){
		window.cred=null;
		document.head.getElementsByTagName("script")[2].innerHTML="";

		username = cred.username;
		color = cred.color;
		thread = cred.thread;
		userid = cred.userid;
	}
	else{
		var container = document.getElementsByClassName("chatContainer")[0];
		var inputs = container.children[0];
		var button = container.children[1];

		inputs.style = "pointer-events: none;"
		inputs.children[0].style = "background-color: #2c2c2c;"
		button.style = "background-color: #3b3b3b;"
	}

	// fetch(`${hitch_constant.origin}/grab-messages`,{
	// 	method: "POST",
	// 	headers: {"Content-Type":"application/json"},
	// 	body: JSON.stringify({"thread":thread}),
	// })
	// .then(response => response.json())
	// .then(data => {
	// 	data.forEach((json) => {
	// 		addNewMessage(createNewMessage(json.username, json.message, json.timestamp, json.color))
	// 	});
	// })

	if(thread == undefined){
		thread = "global"
	}
	document.getElementsByClassName("chatContainer")[0].children[1].onclick=function(){sendInput(username,color,userid,thread)};
	document.getElementsByTagName("title")[0].innerText = thread
}

socket.on('message', json => {
	if(json.thread == document.getElementsByTagName("title")[0].innerText){
		addNewMessage(createNewMessage(json.username, json.message, json.timestamp, json.color));
	}
});

function parseURLParams(url) {
	var queryStart = url.indexOf("?") + 1,
		queryEnd   = url.indexOf("#") + 1 || url.length + 1,
		query = url.slice(queryStart, queryEnd - 1),
		pairs = query.replace(/\+/g, " ").split("&"),
		parms = {}, i, n, v, nv;

	if (query === url || query === "") return;

	for (i = 0; i < pairs.length; i++) {
		nv = pairs[i].split("=", 2);
		n = decodeURIComponent(nv[0]);
		v = decodeURIComponent(nv[1]);

		if (!parms.hasOwnProperty(n)){
			parms[n]=v;
		}
	}
	return parms;
}

init();
