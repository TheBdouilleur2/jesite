document.getElementById("project_edition").addEventListener("submit",function(e){
    e.preventDefault()

    var data = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            var res = this.response;
            if (res.success) {
                console.log("Le projet a bien été modifié !!");
                alert("Votre projet à bien été modifié");
                document.location.href = "http://" + document.location.hostname + "/projects"
            } else {
                alert(res.msg);
            }
        } else if (this.readyState == 4) {
            alert("Une erreur est survenue...");
        }
    };
    
        xhr.open("POST", "../controllers/php/async/setProject.php", true);
    xhr.responseType = "json";
    xhr.send(data);
    

    return false
})