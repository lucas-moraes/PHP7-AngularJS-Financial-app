function logIn(){
    const login = document.getElementById('login').value;
    const pass = document.getElementById('pass').value;

    var formdata = new FormData();
    formdata.append("pass", pass);

    var requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: 'follow'
    };

    fetch("./encrypt.php", requestOptions)
        .then(response => response.text())
        .then(data => {
            var formdata = new FormData();
            formdata.append("login", login);
            formdata.append("pass", data);
            
            var requestOptions = {
              method: 'POST',
              body: formdata,
              redirect: 'follow'
            };
            
            fetch("http://localhost/cloudcont/backend/view/Login.php", requestOptions)
              .then(response => response.json())
              .then(result => {
                if(result.username == 'lucaspf'){
                  window.location.href = "../home/principal.html";
                } else {
                  console.log("credenciais inválidas");
                }
              })
        })
}

