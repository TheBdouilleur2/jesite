
document.getElementById("send_msg").addEventListener("submit", function(e) {
	e.preventDefault();
	var data = new FormData(this);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			var res = this.response;
			if (res.success) {
				document.getElementById("msg").value = '';
				$('#msgs_user').load('../controllers/php/loadMessages.php');
			} else {
				alert(res.msg);
			}
		} else if (this.readyState === 4) {
			alert("Une erreur est survenue...");
		}
	};

	xhr.open("POST", "controllers/php/async/sendMsg.php", true);
	xhr.responseType = "json";
	xhr.send(data);

	return false;
});

setInterval( 'loadMessages()' , 30000);
	
function loadMessages(){
	$('#msgs_user').load('../controllers/php/loadMessages.php');
}