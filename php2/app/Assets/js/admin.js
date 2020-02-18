$(document).ready(function () {
    $(".izbrisi").click(function (e) {
        e.preventDefault();
        var id = $(this).data("delete");
        $.ajax({
            url : "index.php?page=deleteUser",
            method : "POST",
            dataType : "json",
            data : {
                btnDelete : "send",
                id : id
            },
            success : function (dataDelete) {
                alert("User successfully deleted");
                ispisiKorisnike(dataDelete);
            },
            error : function(xhr,statusTxt,error){
                var status = xhr.status;
                switch(status){
                    case 500:
                        alert("Greska na serveru.Trenutno nije moguce izbrisati korisnika");
                        window.location='index.php?page=404';
                        break;
                    case 404:
                        alert("Stranica nije pronadjena");
                        break;
                    default:
                        alert("Greska" + status + "-" + statusTxt);
                        break;
                }
            }
        });
    })
    $('.update').hide();
    $('.izmeni').click(function(e){
          e.preventDefault();
          $('.update').show();
          var idUpdate = $(this).data("update");
          // console.log(idUpdate);
          $.ajax({
              url : "index.php?page=getUser",
              method : "GET",
              dataType : "json",
              data : {
                  btnUpdate : "btnUpdate",
                  idUpdate : idUpdate
              },
              success : function(podaci,status,jqXHR){
                  $('#idk').val(podaci.korisnik_id);
                  $('#updateFirst').val(podaci.ime);
                  $('#updateLast').val(podaci.prezime);
                  $('#updateEmail').val(podaci.email);
                  $('#updatePassword').val(podaci.lozinka);
                  $('#updateUloga').val(podaci.uloga_id);
              },
              error : function(xhr,statusTxt,error){
                  console.log(xhr);
                  var status = xhr.status;
                  switch(status){
                      case 500:
                          alert("Greska na serveru.Trenutno nije moguce editovati podatke");
                          window.location='index.php?page=404';
                          break;
                      case 404:
                          alert("Stranica nije pronadjena");
                          break;
                      default:
                          alert("Greska" + status + "-" + statusTxt);
                          break;
                  }
              }
          })
    });
    $("#btnUpdateUser").click(function (e) {
            e.preventDefault();
          var idUpdate = $("#idk").val();
          var firstName = $('#updateFirst').val();
          var lastName = $('#updateLast').val();
          var email = $('#updateEmail').val();
          var passwordUpdate = $('#updatePassword').val();
          var updateRole = $('#updateUloga').val();

          $.ajax({
              url : "index.php?page=updateUser",
              method : "POST",
              dataType: "json",
              data : {
                  btnSend : "btnSend",
                  idUpdate : idUpdate,
                  firstName : firstName,
                  lastName : lastName,
                  email : email,
                  passwordUpdate : passwordUpdate,
                  updateRole : updateRole
              },
              success : function (data) {
                  ispisiKorisnike(data);
                  alert("Successfuly update user");
              },
              error : function(xhr,statusTxt,error){
                  console.log(xhr);
                  var status = xhr.status;
                  switch(status){
                      case 500:
                          alert("Greska na serveru.Trenutno nije moguce editovati podatke");
                          window.location='index.php?page=404';
                          break;
                      case 404:
                          alert("Stranica nije pronadjena");
                          break;
                      default:
                          alert("Greska" + status + "-" + statusTxt);
                          break;
                  }
              }
          })
    });
    function ispisiKorisnike(data) {
        var ispis = "";
        for(var d of data){
            ispis+=`
              <td>${d.korisnik_id}</td>
              <td>${d.ime}</td>
              <td>${d.prezime}</td>
              <td>${d.email}</td>
              <td>${d.lozinka}</td>
              <td>${d.datum_registracije}</td>
              <td>${d.uloga_id}</td>
              <td><a class="item_add hvr-skew-backward izmeni" data-update="${d.korisnik_id}" href="#">Update</a></td>
              <td><a class="item_add hvr-skew-backward izbrisi" data-delete="${d.korisnik_id}" href="#">Delete</a></td>`;
        }
        $("#korisnici").html(ispis);
    }
    $("#btnAddUser").click(function (e) {
        e.preventDefault();
        let addFirstName = $("#addFirst");
        let addLastName = $("#addLast");
        let addEmail = $("#addEmail");
        let addPassword = $("#addPassword");
        let addRole = $("#addUloga");

        let reFirst = /^[A-Z][a-z]{1,}$/;
        let reLast = /^[A-Z][a-z]{1,}$/;
        let reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        let rePassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        let reRole = /^[1-2]{1}$/;
        let errors = [];

        if (addFirstName.val() == " ") {
            errors.push("First name field can't be empty");
        } else {
            if (!reFirst.test(addFirstName.val())) {
                errors.push("Wrong format of first name");
            } else {
            }
        }
        if (addEmail.val() == "") {
            errors.push("Email field can't be empty");
        } else {
            if (!reEmail.test(addEmail.val())) {
                errors.push("Wrong format of email");
            } else {
            }
        }
        if (addLastName.val() == "") {
            errors.push("Last name field can't be empty");
        } else {
            if (!reLast.test(addLastName.val())) {
                errors.push("Wrong format of last name");
            }
        }

        if (addPassword.val() == "") {
            errors.push("Password filed can't be empty");
        } else {
            if (!rePassword.test(addPassword.val())) {
                errors.push("The password must have one number,one letter and at least 8 characters");
            } else {
            }
        }
        if(errors.length == 0){
            $.ajax({
                url : "index.php?page=insertUser",
                method : "POST",
                dataType : "json",
                data : {
                    btnInsert : "btnInsert",
                    addFirstName : addFirstName.val(),
                    addLastName : addLastName.val(),
                    addEmail : addEmail.val(),
                    addPassword : addPassword.val(),
                    addRole : addRole.val()
                },
                success : function (podaci) {
                    console.log(podaci);
                    ispisiKorisnike(podaci);
                },
                error : function(xhr,statusTxt,error){
                    console.log(xhr);
                    var status = xhr.status;
                    switch(status){
                        case 500:
                            alert("Greska na serveru.Trenutno nije moguce editovati podatke");
                            window.location='index.php?page=404';
                            break;
                        case 404:
                            alert("Stranica nije pronadjena");
                            break;
                        default:
                            alert("Greska" + status + "-" + statusTxt);
                            break;
                    }
                }
            })
        }else{

        }

    });
    $(".izbrisiProizvod").click(function (e) {
        e.preventDefault();
        let value = $(this).data("delete");
        console.log(value);
        $.ajax({
            url : "index.php?page=deleteProduct",
            method : "POST",
            dataType : "json",
            data : {
                delete : "delete",
                value : value
            },
            success : function (podaci) {
                console.log(podaci);
                ispisiProizvode(podaci);
            },
            error : function(xhr,statusTxt,error){
                console.log(xhr);
                var status = xhr.status;
                switch(status){
                    case 500:
                        alert("Greska na serveru.Trenutno nije moguce editovati podatke");
                        window.location='index.php?page=404';
                        break;
                    case 404:
                        alert("Stranica nije pronadjena");
                        break;
                    default:
                        alert("Greska" + status + "-" + statusTxt);
                        break;
                }
            }
        })
    });
    function ispisiProizvode(podaci) {
        var ispis="";
        for(var p of podaci){
            ispis+=` <td>${p.idProizvod}</td>
                        <td>${p.naziv_proizvoda}</td>
                        <td>${p.pol}</td>
                        <td>${p.stara_cena}</td>
                        <td>${p.nova_cena}</td>
                        <td>${p.slika}</td>
                        <td>${p.idKategorije}</td>
                        <td><a class="item_add hvr-skew-backward izmeniProizvod" data-update="${p.idProizvod}" href="#">Update</a></td>
                        <td><a class="item_add hvr-skew-backward izbrisiProizvod" data-delete="${p.idProizvod}" href="#">Delete</a></td>`;
        }
        $("#proizvodi").html(ispis);
    }
    $(".updateProduct").hide();
    $(".izmeniProizvod").click(function (e) {
        e.preventDefault();
        $(".updateProduct").show();
        let value = $(this).data("update");
        $.ajax({
            url : "index.php?page=getProduct",
            method : "GET",
            dataType : "json",
            data : {
                Update : "Update",
                value : value
            },
            success : function(podaci,status,jqXHR){
                console.log(jqXHR.status); //Dohvatanje statusa koji se vraca sa servera
                console.log("Podaci pristigli sa servera,ime:",podaci.naziv_proizvoda);
                $('#idp').val(podaci.idProizvod);
                $('#updateProduct').val(podaci.naziv_proizvoda);
                $('#updateGender').val(podaci.pol);
                $('#updateOld').val(podaci.stara_cena);
                $('#updateNew').val(podaci.nova_cena);
                $('#updateImage').val(podaci.slika);
                $('#updateCat').val(podaci.idKategorije);
            },
            error : function(xhr,statusTxt,error){
                console.log(xhr);
                var status = xhr.status;
                switch(status){
                    case 500:
                        alert("Greska na serveru.Trenutno nije moguce editovati podatke");
                        window.location='index.php?page=404';
                        break;
                    case 404:
                        alert("Stranica nije pronadjena");
                        break;
                    default:
                        alert("Greska" + status + "-" + statusTxt);
                        break;
                }
            }
        })
    })
    $("#btnUpdateProduct").click(function (e) {
        e.preventDefault();
        let productId = $("#idp").val();
        let productName = $("#updateProduct").val();
        let gender = $("#updateGender").val();
        let oldPrice = $("#updateOld").val();
        let newPrice = $("#updateNew").val();
        let slika = $("#updateImage").val();
        let categories = $("#updateCat").val();

        $.ajax({
            url : "index.php?page=updateProduct",
            method : "POST",
            dataType : "json",
            data : {
                updateSend : "updateSend",
                productId : productId,
                productName : productName,
                gender : gender,
                oldPrice : oldPrice,
                newPrice : newPrice,
                slika : slika,
                categories : categories
            },
            success : function (podaci) {
                ispisiProizvode(podaci);
                alert("Successfuly update user");
            },
            error : function(xhr,statusTxt,error){
                console.log(xhr);
                var status = xhr.status;
                switch(status){
                    case 500:
                        alert("Greska na serveru.Trenutno nije moguce editovati podatke");
                        window.location='index.php?page=404';
                        break;
                    case 404:
                        alert("Stranica nije pronadjena");
                        break;
                    default:
                        alert("Greska" + status + "-" + statusTxt);
                        break;
                }
            }
        })
    })
});