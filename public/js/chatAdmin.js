
$("#send_msg").submit(function(e){
	e.preventDefault();
	var data = new FormData(this);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			var res = this.response;
			if (res.success) {
				document.getElementById("msg").value = '';
				$('#msgs_admin').load('../../controllers/php/loadAdminMessages.php');
			} else {
				alert(res.msg);
			}
		} else if (this.readyState === 4) {
			alert("Une erreur est survenue...");
		}
	};

	xhr.open("POST", "../controllers/php/async/sendMsg.php", true);
	xhr.responseType = "json";
	xhr.send(data);

	return false;
});

setInterval( 'loadMessages()' , 30000);
	
function loadMessages(){
	$('#msgs_admin').load('../../controllers/php/loadAdminMessages.php');
}
