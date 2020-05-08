document.getElementById("send_comment").addEventListener("submit", function(e) {
	e.preventDefault();
	var data = new FormData(this);
    var xhr = new XMLHttpRequest();
    
    let path = document.location.pathname;

	data.append("path", path);

	xhr.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			var res = this.response;
			if (res.success) {
				document.getElementById("msg").value = '';
				$('.comments').load('../controllers/php/loadComments.php');
			} else {
				alert(res.msg);
			}
		} else if (this.readyState === 4) {
			alert("Une erreur est survenue...");
		}
	};

	xhr.open("POST", "/controllers/php/async/postComment.php", true);
	xhr.responseType = "json";
	xhr.send(data);

	return false;
});

setInterval( 'loadComments()' , 60000);
    
function loadComments(){
    $('.comments').load('../controllers/php/loadComments.php');
}