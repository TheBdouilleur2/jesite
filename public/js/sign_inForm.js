document.getElementById("sign-in").addEventListener("submit", function(e) {
	e.preventDefault();
	var data = new FormData(this);
	var xhr = new XMLHttpRequest();
	 
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Utilisateur conecté !");
				console.log(res.data);
				alert("Votre compte à été créé avec succes!");

				document.location.href = "http://jesite.fr/index.php"; /* Redirection vers la page d'acceuil */
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