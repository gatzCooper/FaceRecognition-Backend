function validate()
{
	var username=document.getElementById("username").value;	
	var password=document.getElementById("password").value;

if(username=="admin" && password=="1234")

{

	window.location.href="adminpanel.html";
	alert("login successfully");
}

else{

	alert("login failed");
	return;
}

}