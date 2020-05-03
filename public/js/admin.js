$(".perm").click(function(e){
    e.preventDefault();
    let hrefArray = this.href.split("/");
	let id = hrefArray[3];
	
	let data = new FormData();
	data.append("id", id);

    /* Requète asynchrone. */
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Permission changée");
				document.location.reload();
			} else {
				alert(res.msg);
			}
		} else if (this.readyState == 4) {
			alert("Une erreur est survenue...");
		}
	};

    alert('Êtes vous bien sûr de vouloir changer les permissions?');
	xhr.open("POST", "controllers/php/async/changePerm.php", true);
	xhr.responseType = "json";
    xhr.send(data);
    
    return false;
});


$(".supr").click(function(e){
    e.preventDefault();
    let hrefArray = this.href.split("/");
	let id = hrefArray[3];
	
	let data = new FormData();
	data.append("id", id);

    /* Requète asynchrone. */
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Utilisateur supprimé");
				document.location.reload();
			} else {
				alert(res.msg);
			}
		} else if (this.readyState === 4) {
			alert("Une erreur est survenue...");
		}
	};

    alert("Êtes vous bien sûr de vouloir supprimer cet utilisateur?");
	xhr.open("POST", "controllers/php/async/deleteUser.php", true);
	xhr.responseType = "json";
    xhr.send(data);
    
    return false;
});
