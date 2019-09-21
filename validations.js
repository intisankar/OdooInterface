function Validate()
{
var studentname = /^[A-Za-z .]*$/;
var hall = /^[A-Za-z0-9]*$/;
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var mail = document.frm.email.value;
var dob = document.frm.dob.value;
// aler(mail);
if(mail.match(mailformat))
{
	document.frm.email.focus();
	return true;
}
else
{
	alert("You have entered an invalid Email Address!");
	document.frm.email.focus();
	return false;
}



}
