$(document).ready(function () {
    $(".cena").change(function () {
        let vrednost = $(this).val();
        $.ajax({
            url : "index.php?page=filter",
            method : "POST",
            dataType : "json",
            data : {
                poslato : "send",
                value : vrednost
            },
            success : function (data) {
                filtriraniProizvodi(data);
            },
            error : function (err) {
                console.log(err);
            }
        });
    });
    function filtriraniProizvodi(data) {
        var ispis = "";
        for(var d of data){
            ispis+= ` <div class="col-md-4 item-grid1 simpleCart_shelfItem" data-id="${d.idProizvod}" data-cat="${d.id}">
                    <div class=" mid-pop">
                        <div class="pro-img">
                            <img src="${d.slika}" class="img-responsive" alt="">
                        </div>
                        <div class="mid-1">
                            <div class="women">
                                <div class="women-top">
                                    <span>${d.pol}</span>
                                    <h6><a href="single.html">${d.naziv_proizvoda}</a></h6>
                                </div>
                                <div class="img item_add">
                                    <a href="#"><img src="app/Assets/images/ca.png" alt=""></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="mid-2">
                                <p ><label>$${d.stara_cena}.00</label><em class="item_price">$${d.nova_cena}.00</em></p>
                                <div class="block">
                                    <div class="starbox small ghosting"> </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>
                </div>`;
        }
        $("#proizvodi").html(ispis);
    }
    function ispisiPaginaciju(paginacija) {
        var ispis = '';
        for(let i=0;i<paginacija;i++){
            ispis+=`<li role="presentation" class="pagination_link" id="${i}"><a href="#">${i+1}</a></li>`;
        }
        $("#paginacija").html(ispis);
    }
    $(document).on('click','.pagination_link',function (e) {
        e.preventDefault();
        page = $(this).attr("id");
        load_data(page);
    });
    load_data();
    function load_data(page){
        if(!page){
            page=0;
        }
        $.ajax({
            url : "index.php?page=productPagination",
            method : "POST",
            dataType : "json",
            data : {
                page : page
            },
            success : function (data) {
                filtriraniProizvodi(data.proizvodi);
                ispisiPaginaciju(data.numOfProducts);
            },
            error : function (xhr,status,error) {
                console.log(xhr.status);
            }
        })
    }
    $("#kategorije>ul>li>a").click(function (e) {
        e.preventDefault();
        var value = $(this).data("id");
       $.ajax({
           url: "index.php?page=filterCat",
           method : "POST",
           dataType: "json",
           data : {
               send : "poslato",
               value : value
           },
           success : function (podaci) {
                console.log(podaci);
                ispisPoKategoriji(podaci);
           },
           error : function (err) {
                console.log(err);
           }
       })
        function ispisPoKategoriji(podaci) {
            var upis = "";
            for(var p of podaci){
                upis+=`<div class="col-md-4 item-grid1 simpleCart_shelfItem" data-id="${p.idProizvod}" data-cat="${p.id}">
                    <div class=" mid-pop">
                        <div class="pro-img">
                            <img src="${p.slika}" class="img-responsive" alt="">
                        </div>
                        <div class="mid-1">
                            <div class="women">
                                <div class="women-top">
                                    <span>${p.pol}</span>
                                    <h6><a href="single.html">${p.naziv_proizvoda}</a></h6>
                                </div>
                                <div class="img item_add">
                                    <a href="#"><img src="app/Assets/images/ca.png" alt=""></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="mid-2">
                                <p ><label>$${p.stara_cena}.00</label><em class="item_price">$${p.nova_cena}.00</em></p>
                                <div class="block">
                                    <div class="starbox small ghosting"> </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>
                </div>`;
            }
            $("#proizvodi").html(upis);
        }
    });
    $(".korpa").click(function (e) {
        e.preventDefault();
        alert("The Cart is currently unavailable");
    });

});
