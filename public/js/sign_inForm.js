document.getElementById("sign-in").addEventListener("submit", function(e) {
	e.preventDefault();
	var data = new FormData(this);
	var xhr = new XMLHttpRequest();
	 
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Utilisateur connecté !");
				console.log(res.data);

				document.location.href = "http://" + document.location.hostname
			} else {
				alert(res.msg);
			}
		} else if (this.readyState == 4) {
			alert("Une erreur est survenue...");
		}
	};

	xhr.open("POST", "controllers/php/async/connectUser.php", true);
	xhr.responseType = "json";
	xhr.send(data);
	 
	return false;

});
