$(document).ready(function () {
    $("#logBtn").click(function (e) {
        e.preventDefault();
        let logEmail = $("#logEmail").val();
        let logPass = $("#logPass").val();
        let reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        let rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        let errors = [];

        if(!reEmail.test(logEmail)){
            errors.push('Wrong First Name');
            document.getElementById('logEmail').style.borderColor='red';
        }else{
            document.getElementById('logEmail').style.borderColor='green';
        }
        if(!rePass.test(logPass)){
            errors.push('Wrong Last Name');
            document.getElementById('logPass').style.borderColor='red';
        }else{
            document.getElementById('logPass').style.borderColor='green';
        }
        let ispisi="";
        ispisi+="<ul>"
        if(errors!=0){
            for(var i=0;i<errors.length;i++){
                ispisi+="<li>"+errors[i]+"</li>";
            }
            ispisi+="</ul>"
            document.getElementById("error").innerHTML=ispisi;
            document.getElementById("error").style.color="red";
        }else{
            $.ajax({
                url : "index.php?page=loginU",
                method : "POST",
                data : {
                    btnLogin : "send",
                    email : logEmail,
                    password : logPass
                },
                success : function () {
                    window.location='index.php?page=Home';
                },
                error: function(xhr, status, errmsg)
                {
                    if(xhr.status == 409)
                        $('#error').html("An account with these data does not exist");
                    if(xhr.status == 422)
                        $('#error').html("Wrong format of data");
                    if(xhr.status == 500)
                        $('#error').html("Problem with server");
                        window.location='index.php?page=404';

                }
            })
        }
    })
})