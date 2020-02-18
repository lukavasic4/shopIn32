<div class="check-out">
<div class="container">

	<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
    	    <table class="table-heading simpleCart_shelfItem">
		  <tr>
			<th class="table-grid">ID</th>
			<th>First Name</th>
			<th>Last Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Date of registration</th>
              <th>ID Role</th>
              <th>Update</th>
              <th>Delete</th>
		  </tr>

                <?php
                foreach ($users as $u):
                ?>
		  <tr class="cart-header" id="korisnici">
              <td><?= $u->korisnik_id ?></td>
              <td><?= $u->ime ?></td>
              <td><?= $u->prezime ?></td>
              <td><?= $u->email ?></td>
              <td><?= $u->lozinka ?></td>
              <td><?= $u->datum_registracije ?></td>
              <td><?= $u->uloga_id ?></td>
              <td><a class="item_add hvr-skew-backward izmeni" data-update="<?= $u->korisnik_id ?>" href="#">Update</a></td>
              <td><a class="item_add hvr-skew-backward izbrisi" data-delete="<?= $u->korisnik_id ?>" href="#">Delete</a></td>
		  </tr>
                <?php endforeach; ?>
	</table>
	</div>
	</div>
    <div class="container update">
        <h3>Update user</h3>
        <div class="login">
            <form method="post" action="#" >
                <div class="col-md-6 login-do">
                    <div class="login-mail">
                        <input type="text" placeholder="ID" id="idk" name="idk" required="" disabled>
                        <i  class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="First name" id="updateFirst" name="updateFirst" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Last name" id="updateLast" name="updateLast" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Email" id="updateEmail" name="updateEmail" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Password" id="updatePassword" name="updatePassword" required="">
                        <i class="glyphicon glyphicon-lock"></i>
                    </div>
                    <div>
                        <select class="form-control login-mail" name="updateUloga" id="updateUloga">
                            <option value="0">Choose..</option>
                       <?php
                        foreach($roles as $role):
                       ?>
                        <option value="<?= $role->idUloga?>"><?= $role->naziv_uloge?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="hvr-skew-backward">
                        <input type="submit" id="btnUpdateUser" name="btnUpdateUser" value="Update">
                    </label>
                </div>
                <div id="greske"></div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="login">
            <h3 class="razmak">Add user</h3>
            <form method="post" action="#" >
                <div class="col-md-6 login-do">
                    <div class="login-mail">
                        <input type="text" placeholder="First name" id="addFirst" name="addFirst" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Last name" id="addLast" name="addLast" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Email" id="addEmail" name="addEmail" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Password" id="addPassword" name="addPassword" required="">
                        <i class="glyphicon glyphicon-lock"></i>
                    </div>
                    <div>
                        <select class="form-control login-mail" name="addUloga" id="addUloga">
                            <option value="0">Choose..</option>
                            <?php
                            foreach($roles as $role):
                                ?>
                                <option value="<?= $role->idUloga?>"><?= $role->naziv_uloge?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="hvr-skew-backward">
                        <input type="submit" id="btnAddUser" name="btnAddUser" value="Add">
                    </label>

                </div>
                <div id="greske"></div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
    <div class="bs-example4" data-example-id="simple-responsive-table">
        <h3 class="razmak">Products</h3>
        <div class="table-responsive">
            <table class="table-heading simpleCart_shelfItem">
                <tr>
                    <th class="table-grid">ID</th>
                    <th>Product Name</th>
                    <th>Gender</th>
                    <th>Old price</th>
                    <th>New price</th>
                    <th>Image</th>
                    <th>ID Categories</th>
                </tr>

                <?php
                foreach ($products as $p):
                    ?>
                    <tr class="cart-header" id="proizvodi">
                    <td><?= $p->idProizvod ?></td>
                    <td><?= $p->naziv_proizvoda ?></td>
                    <td><?= $p->pol ?></td>
                    <td><?= $p->stara_cena ?></td>
                    <td><?= $p->nova_cena ?></td>
                    <td><?= $p->slika ?></td>
                    <td><?= $p->idKategorije ?></td>
                    <td><a class="item_add hvr-skew-backward izmeniProizvod" data-update="<?= $p->idProizvod ?>" href="#">Update</a></td>
                    <td><a class="item_add hvr-skew-backward izbrisiProizvod" data-delete="<?= $p->idProizvod ?>" href="#">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="container updateProduct">
        <div class="login">
            <h3 class="razmak" >Update product</h3>
            <form method="post" action="" >
                <div class="col-md-6 login-do">
                    <div class="login-mail">
                        <input type="text" placeholder="ID" id="idp" name="idp" required="" disabled>
                        <i  class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Product Name" id="updateProduct" name="updateProduct" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Gender" id="updateGender" name="updateGender" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Old price" id="updateOld" name="updateOld" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="New price" id="updateNew" name="updateNew" required="">
                        <i class="glyphicon glyphicon-lock"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Image" id="updateImage" name="updateImage" required="">
                        <i class="glyphicon glyphicon-lock"></i>
                    </div>
                    <div>
                        <select class="form-control login-mail" name="updateCat" id="updateCat">
                            <option value="0">Choose..</option>
                            <?php
                            foreach($categories as $c):
                                ?>
                                <option value="<?= $c->id?>"><?= $c->naziv_kategorije ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="hvr-skew-backward">
                        <input type="submit" id="btnUpdateProduct" name="btnUpdateProduct" value="Update">
                    </label>
                </div>
                <div id="greske"></div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="login">
            <h3 class="razmak">Add Product</h3>
            <form method="post" action="index.php?page=insertProduct" enctype="multipart/form-data">
                <div class="col-md-6 login-do">
                    <div class="login-mail">
                        <input type="text" placeholder="Product Name" id="addName" name="addName" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div>
                        <select class="form-control login-mail" id="pol" name="pol">
                            <option value="0">Choose..</option>
                            <option value="1">Men</option>
                            <option value="2">Women</option>
                        </select>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="Old price" id="addOld" name="addOld" required="">
                        <i  class="glyphicon glyphicon-envelope"></i>
                    </div>
                    <div class="login-mail">
                        <input type="text" placeholder="New price" id="addNew" name="addNew" required="">
                        <i class="glyphicon glyphicon-lock"></i>
                    </div>
                    <div class="login-mail">
                        <input type="file" id="addFoto" name="addFoto" required="">
                    </div>
                    <div>
                        <select class="form-control login-mail" name="addCat" id="addCat">
                            <option value="0">Choose..</option>
                            <?php
                            foreach($categories as $c):
                                ?>
                                <option value="<?= $c->id?>"><?= $c->naziv_kategorije ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="hvr-skew-backward">
                        <input type="submit" id="btnAddProduct" name="btnAddProduct" value="Add">
                    </label>

                </div>
                <div id="greske"></div>
                <div class="clearfix"> </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="app/Assets/js/admin.js" type="text/javascript"></script>