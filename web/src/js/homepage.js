let hitch_constant={
	origin: location.origin,
	hostname: location.host,
	cookies: document.cookie.split(";").map(value=>value.split("=")).reduce((prev, curr)=>{prev[curr[0]]=curr[1];return prev},{}),
}

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

$( function() {
	$( ".rooms" ).resizable({handles: 'e'},{
		start: function(event, ui) {
			$('iframe').css('pointer-events','none');}
		,stop: function(event, ui) {
			$('iframe').css('pointer-events','auto');
		}
	});
	$('.rooms').resize(function(){
		$('.chat').width($(".bottom").width()-$(".rooms").width()); 
	});
} );

function createThread(id,imgSrc,msg,checked=0){
	var threadChecked = "";
	var threadSelected = "thread-not-select";

	if(checked){
		threadChecked = 'checked=""';
		threadSelected = 'thread-select';
	}
	var inputRadio= `<input id="${id}" type="radio" name="threads" value="${id}" ${threadChecked}></input>`
	var thread = `
<label for="${id}" id="${id}">
	<div class="threads thread-not-select" onclick="checkAndUpdateActiveThread()">
		<div class="thread-left">
			<div class="thread-img">
				<img src="img/${imgSrc}" height="50" width="50" alt="">
			</div>
		</div>
		<div class="thread-right">
			<div class="thread-top">
				<div class="thread-title">${id}</div>
			</div>
			<div class="thread-bottom">
				<div class="thread-last-message">${msg}</div>
			</div>
		</div>
	</div>
</label>`
	return inputRadio+thread
}

























function createAddThreadPrompt(){
	return `
<div class="login-container">
	<div class="login-prompt">
		<div class="login-prompt-top">
		</div>

		<div class="login-prompt-bottom">
			
			<div class="prompt-form">
				<div class="text-input">
			
					<div class="sign">thread name:</div>
					<input type="text" name="thread-name" id="username">

				</div>

				<div class="color-input-and-button">
					<div class="color-input" style>
					<div class="sign" style="color: transparent;" >color:</div>
					<div style="width:64px;height:30px"></div>
				</div>
				<div class="devider"></div>
					<button class="close-button"> Close </button>
					<div style="width: 10px;"></div>
					<button class="create-button" > Create </button>
				</div>
			</div>

		</div>
	</div>
</div>`

}



























function createLoginPrompts(){
	return `
	<div class="login-container">
	<div class="login-prompt">
		<div class="login-prompt-top">
			<input id="login" type="radio" name="login-option" value="login" checked="">
			<label for="login">
				<div class="prompt-button login" onclick="loginType()">
					<div>Login</div>
				</div>
			</label>
			
			<div class="devider"></div>

			<input id="guess" type="radio" name="login-option" value="guess">
			<label for="guess">
				<div class="prompt-button guess" onclick="loginType()">
					<div>Guess</div>
				</div>
			</label>

			<div class="devider"></div>

			<input id="register" type="radio" name="login-option" value="register">
			<label for="register">
				<div class="prompt-button register" onclick="loginType()">
					<div>register</div>
				</div>
			</label>


		</div>

		<div class="login-prompt-bottom">
		</div>
	</div>
</div>`
}


function loginUser(){
	return `
<div class="prompt-form">
	<div class="text-input">

		<div class="sign">username:</div>
		<input type="text" name="username" id="username">

		<div class="sign">password:</div>
		<input type="password" name="password" id="password">

	</div>
	<div class="color-input-and-button">
		<div class="color-input" style>
			<div class="sign" style="color: transparent;" >color:</div>
			<div style="width:64px;height:30px"></div>
		</div>
		<div class="devider"></div>
		<button class="create-button" > Login </button>
	</div>
</div>
`;
}

function guessUser(){
	return `
<div class="login-prompt-bottom">

	<div class="prompt-form" style="margin-top: 35px;">
		<div class="text-input">

			<div class="sign">username:</div>
			<input type="text" name="username" id="username">
			<input type="password" name="password" id="password" style="display:none;">

		</div>
		<div class="color-input-and-button">
			<div class="color-input">
				<div class="sign">color:</div>
				<input type="color" name="color" id="color">
			</div>
			<div class="devider"></div>
			<button class="create-button" > Login </button>
		</div>
	</div>

</div>
`;
}

function registerUser(){
	return `
<div class="prompt-form">
	<div class="text-input">

		<div class="sign">username:</div>
		<input type="text" name="username" id="username">

		<div class="sign">password:</div>
		<input type="password" name="password" id="password">

	</div>
	<div class="color-input-and-button">
		<div class="color-input">
			<div class="sign">color:</div>
			<input type="color" name="color" id="color">
		</div>
		<div class="devider"></div>
		<button class="create-button"> Register </button>
	</div>
</div>
`;
}













function changeIframe(thread,Cred){
	var chatIframe = document.getElementsByClassName("chat")[0].children[0]
	chatIframe.src = `http://chat.${hitch_constant.hostname}/chat?username=${Cred.username}&color=${Cred.color}&thread=${thread}`
	// chatIframe.src = `http://chat.hitch.teehee:3000/chat?username=${Cred.username}&color=${Cred.color}&thread=${thread}`
}



async function checkAndUpdateActiveThread(){
	await sleep(50)
	var threadList = document.getElementsByClassName("thread-container")[0].childNodes;
	threadList.forEach(element => {
		if(element.checked){
			changeIframe(element.id, credJson)
		}
	});
}


function addThread(id,imgSrc,msg){
	document.getElementsByClassName("thread-container")[0].innerHTML += createThread(id,imgSrc,msg)
}

function removeThread(id){

	// document.getElementsByName("Admin")[0].remove()
	var threadList = document.getElementsByClassName("thread-container")[0].childNodes;
	threadList.forEach(element => {
		if(element.id == id){
			element.remove();
		}
	});
	
	// document.getElementById(id);
}

function login(){
	

}






function init(){

	loginType();

	document.body.innerHTML += createLoginPrompts();

	var threads = "";
	threads += createThread("Global","forum-img_global.png","nice to see you man bla bla bla next next AA...",1)
	threads += createThread("Main","forum-img_main.png","nice to see you man bla bla bla next next AA...")
	
	document.getElementsByClassName("thread-container")[0].innerHTML = threads;

	document.getElementsByClassName("thread-adder")[0].parentElement.parentElement.onclick = function(){addThreadPrompt()}
}

















function addThreadPrompt(){
	document.body.innerHTML += createAddThreadPrompt();
	var bottomPrompt = document.getElementsByClassName("login-prompt-bottom")[0]

	bottomPrompt.getElementsByTagName("button")[1].onclick = function(){
		var threadId = document.getElementById("username").value;
		if(threadId != ""){
			addThread(threadId,"no-photo.png","new chat room")
			closePrompt()
		}
		else{
			alert("thread name cant be empty")
		}
	}
	bottomPrompt.getElementsByTagName("button")[0].onclick = function(){
		closePrompt()
	}
}



function closePrompt(){
	var loginContainer = document.getElementsByClassName("login-container")[0]
	loginContainer.remove()
	checkAndUpdateActiveThread()
}

async function loginType(){
	await sleep(50)
	
	var type="";
	var listButton = document.getElementsByName("login-option")
	var bottomPrompt = document.getElementsByClassName("login-prompt-bottom")[0]

	listButton.forEach(element => {
		if(element.checked){
			type = element.id
		}
	});
	
	if(type == "login"){
		bottomPrompt.innerHTML = loginUser()

		bottomPrompt.getElementsByTagName("button")[0].onclick = async function(){
			var json = grabInput();
			var check = await authenticate(json);

			console.log(check);
	
			if(check.status == "success"){
				closePrompt()
			}
			else{
				alert("invalid user")
			}
		}

		

		var json = grabInput();
		var check = await checkIfExist(json);
		
	}
	else if(type == "guess"){
		bottomPrompt.innerHTML = guessUser()
		
		bottomPrompt.getElementsByTagName("button")[0].onclick = async function(){
			var json = grabInput();
			var check = await checkIfExist(json);
	
			if(check.status == "success"){
				closePrompt()
			}
			else{
				alert("username is taken")
			}
		}
	}
	else if(type == "register"){
		bottomPrompt.innerHTML = registerUser()
		
		bottomPrompt.getElementsByTagName("button")[0].onclick = async function(){
			var json = grabInput();
			register(json);
			// closePrompt()
			// alert("username is taken")
		}
	}
}

function grabInput(){
	credJson["username"] = document.getElementById("username").value;
	credJson["password"] = document.getElementById("password").value;
	credJson["color"] = (document.getElementById("color")) ? (document.getElementById("color").value).substring(1) : "000000";
	credJSON["PHPSESSID"] = hitch_constant.cookies.PHPSESSID
	// credJson["color"] = (document.getElementById("color").value).substring(1) || "000000";
	return credJson
}

function authenticate(credJson){
	var data = fetch(String(document.location).replace('home', 'auth'),{
		method: "POST",
		headers: {"Content-Type":"application/json"},
		body: JSON.stringify({"username":credJson.username, "password":credJson.password}),
	})
	.then(response => response.json())
	.then(data => {
		return data;
	})
	return data;
}

function checkIfExist(credJson){
	var data = fetch(String(document.location).replace('home', 'check-if-user-exist'),{
		method: "POST",
		headers: {"Content-Type":"application/json"},
		body: JSON.stringify({"username":credJson.username}),
	})
	.then(response => response.json())
	.then(data => {
		return data;
	})
	return data;
}

async function register(credJson){
	// var check = await checkIfExist(credJson);
	// console.log(check.status)
	// if(check.status != "success"){
	// 	return {"status":"failed"}
	// }
	let url = `http://api.${hitch_constant.hostname}/api/auth/register.php`
	console.log(url);
	var data = await fetch(url,{
		method: "POST",
		headers: {"Content-Type":"application/json"},
		body: JSON.stringify(credJson),
	})
	.then(response => response.text())
	.then(data => {
		console.log(data)
		return data;
	})
	return data;
}



var credJson = {};
init();