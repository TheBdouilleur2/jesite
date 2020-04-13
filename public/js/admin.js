$(".perm").click(function(e){
    e.preventDefault();
    let href_array = this.href.split('/')
	let id = href_array[3];
	
	let data = new FormData()
	data.append('id', id)

    /* Requète asynchrone. */
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Permission changée");
				$('.users').load('../controllers/php/loadUsers.php');
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
    
    return false
});

$(".supr").click(function(e){
    e.preventDefault();
    let href_array = this.href.split('/')
	let id = href_array[3];
	
	let data = new FormData()
	data.append('id', id)

    /* Requète asynchrone. */
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Utilisateur suprimé");
				$('.users').load('../controllers/php/loadUsers.php');
			} else {
				alert(res.msg);
			}
		} else if (this.readyState == 4) {
			alert("Une erreur est survenue...");
		}
	};

    alert('Êtes vous bien sûr de vouloir suprimer cet utilisateur?');
	xhr.open("POST", "controllers/php/async/deleteUser.php", true);
	xhr.responseType = "json";
    xhr.send(data);
    
    return false
});