$(document).ready(function() {

});

	var First_name = ['100', 'Employee First Name must be 100 characters or less.'];
	var Last_name = ['100', 'Employee Last Name must be 100 characters or less.'];
	var Building = ['3', 'Building Code must be 3 characters or less.'];


	function validText(text, name) {
		console.log(window[name][1]);
		var len = text.length;
		if (len > window[name][0]) {
			//do something
			document.getElementById(name + "Err").innerHTML = window[name][1];
		}
		console.log(len);
	};