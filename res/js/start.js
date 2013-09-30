window.onload = function () {
	document.getElementById('username').onfocus = function() {
		if(this.value == 'Username') this.value = '';
		document.getElementById('helper').innerHTML = '';
		}
	document.getElementById('username').onblur = function() {
		if(this.value == '') this.value = 'Username';
		}
	document.getElementById('questionBox').onsubmit = function() {return checkForm();};
}

function checkForm() {
	if ((document.getElementById('username').value == '') || (document.getElementById('username').value == 'Username') || (document.getElementById('username').value.length < 3) || (document.getElementById('username').value.length > 10)) {
	document.getElementById('helper').innerHTML = 'To register, please enter a username between 3 and 10 characters in length';
		return false;
	}
}
