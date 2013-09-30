window.onload = function () {
	document.getElementById('submit').disabled = true;
	var qform = document.getElementById('questionBox');
	var inputs = qform.getElementsByTagName('input');
	for(var i = 0; i < inputs.length;i++) {
		inputs[i].onclick = function(evt) { checkForm2();};
	}
}

function checkForm2() {
	document.getElementById('submit').disabled = false;
}
