$(document).ready(function () {
    let btnSend = $("#btnSend");
    btnSend.click(function(e) {
        e.preventDefault();
        let ime = $("#firstName");
        let prezime = $("#lastName");
        let email = $("#email");
        let password = $("#password");
        let errors = [];

        let reIme = /^[A-Z][a-z]{1,}$/;
        let rePrezime = /^[A-Z][a-z]{1,}$/;
        let reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        let rePassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        if (ime.val() == " ") {
            errors.push("First name field can't be empty");
        } else {
            if (!reIme.test(ime.val())) {
                errors.push("Wrong format of first name");
            } else {
            }
        }
        if (email.val() == "") {
            errors.push("Email field can't be empty");
        } else {
            if (!reEmail.test(email.val())) {
                errors.push("Wrong format of email");
            } else {
            }
        }
        if (prezime.val() == "") {
            errors.push("Last name field can't be empty");
        } else {
            if (!rePrezime.test(prezime.val())) {
                errors.push("Wrong format of last name");
            }
        }


        if (password.val() == "") {
            errors.push("Password filed can't be empty");
        } else {
            if (!rePassword.test(password.val())) {
                errors.push("The password must have one number,one letter and at least 8 characters");
            } else {
            }
        }
        var ispis="";
        ispis+="<ul>"
        if(errors!=0){
            for(var i=0;i<errors.length;i++){
                ispis+="<li>"+errors[i]+"</li>";
            }
            ispis+="</ul>"
            document.getElementById("greske").innerHTML=ispis;
            document.getElementById("greske").innerHTML="";
        }else{
            $.ajax({
                url: "index.php?page=reg",
                method:"post",
                data : {
                    send : "btn",
                    ime: ime.val(),
                    email: email.val(),
                    prezime: prezime.val(),
                    password: password.val()
                },
                success: function()
                {
                    console.log("Successful registration");
                    window.location='index.php?page=login';
                },
                error: function(xhr, status, errmsg)
                {
                    let tmp = "Došlo je do greške na serveru, pokušajte ponovo!";
                    switch(xhr.status)
                    {
                        case 409:
                            tmp = "Email i username moraju biti jedinstveni (neki od unetih podataka već postoji u bazi).";
                            break;
                        case 422:
                            let rez = JSON.parse(xhr.responseText);
                            tmp = "Uneti podaci nisu validni! <br/> <ul>";
                            for(let i in rez)
                            {
                                tmp += "<li>" + rez[i] + "</li>";
                            }
                            tmp += "</ul>";
                            break;
                        case 404:
                            tmp = "Stranica nije pronađena!";
                            break;
                    }
                    $("#greske").html(tmp);
                }
            })
        }
    });
})