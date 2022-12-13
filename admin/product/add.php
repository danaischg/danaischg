    <div class="container-fluid">
        <script>
            function formValid() {
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                f = document.formAddproduct

                if (f.cat_id.value == 0) {
                    alert("Please choose category");
                    return false;
                }
                if (f.sup_id.value == 0) {
                    alert("Please choose supplier");
                    return false;
                }
                if (f.shop_id.value == 0) {
                    alert("Please choose shop");
                    return false;
                }
                return true;
            }
        </script>
        <!-- Add into table -->
        <section class="row">
            <div class="pt-3 col-lg-10 col-md-9 col-12">
                <h1 class="text-center pb-4">Adding Product</h1>
                <form id="formAddproduct" name="formAddproduct" method="POST" action="add/store" enctype="multipart/form-data" onsubmit="return formValid()">

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="Name">Product Name</label>
                        <input type="text" name="name" id="Name" class="form-control" placeholder="" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="ChooseCategory">Choose Category</label>
                        <div name="slcategory" id="ChooseCategory">
                            <select name='cat_id' class='form-control' required>
                                <option value='0'>Please choose category</option>
                                <option value='23'>Angry Birds</option>
                                <option value='26'>Disney</option>
                                <option value='27'>Avenger</option>
                                <option value='28'>Batman</option>
                                <option value='29'>Lego</option>
                                <option value='30'>Winx 2</option>
                                <option value='31'>Harry Potter</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="ChooseSupplier">Choose Supplier</label>
                        <div name="slsupplier" id="ChooseSupplier">
                            <select name='sup_id' class='form-control' required>
                                <option value='0'>Please choose supplier</option>
                                <option value='9'>Chodosi</option>
                                <option value='10'>bachhoasi</option>
                                <option value='13'>teenager toy</option>
                                <option value='14'>13plus</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="ChooseShop">Choose Shop</label>
                        <div name="slshop" id="ChooseShop">
                            <select name='shop_id' class='form-control' required>
                                <option value='0'>Please choose shop</option>
                                <option value='7'>The Light Toy 1</option>
                                <option value='9'>The Light Toy 2</option>
                                <option value='10'>The Light Toy 3</option>
                                <option value='15'>The Light Toy 4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="Price">Price</label>
                        <input type="number" name="price" id="Price" step="0.01" min="1" class="form-control" placeholder="" required />
                    </div>


                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="Small_desc">Small Description</label>
                        <input type="text" name="small_desc" id="Small_desc" class="form-control" placeholder="" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="Detail_desc">Detail Description </label>
                        <textarea name="detail_desc" id="Detail_desc" class="form-control" placeholder="" rows="10" required></textarea>
                    </div>

                    <div class="d-md-flex justify-content-start align-items-center mb-3">
                        <h6 class="font-weight-bold mb-3 mb-lg-0 mr-5">Gender:</h6>

                        <div class="form-check form-check-inline mb-0 mr-5">
                            <input class="form-check-input" type="radio" name="for_gender" id="MaleGender" value="male" required>
                            <label class="form-check-label" for="MaleGender">Male</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 ml-5">
                            <input class="form-check-input" type="radio" name="for_gender" id="FemaleGender" value="female" required>
                            <label class="form-check-label" for="FemaleGender">Female</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 ml-5">
                            <input class="form-check-input" type="radio" name="for_gender" id="BothGender" value="both" required>
                            <label class="form-check-label" for="BothGender">Both</label>
                        </div>
                    </div>

                    <div class="d-md-flex justify-content-start align-items-center mb-3">
                        <h6 class="font-weight-bold mb-3 mb-lg-0 mr-5">Age:</h6>

                        <div class="form-check form-check-inline mb-0 ml-4 mr-5">
                            <input class="form-check-input" type="radio" name="for_age" id="Age1" value="1315" required>
                            <label class="form-check-label" for="Age1">13 - 15&nbsp;&nbsp;</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 ml-4">
                            <input class="form-check-input" type="radio" name="for_age" id="Age2" value="1619" required>
                            <label class="form-check-label" for="Age2">16 - 19&nbsp;</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 ml-5">
                            <input class="form-check-input" type="radio" name="for_age" id="Age3" value="1319" required>
                            <label class="form-check-label" for="Age3">All</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="Quantity">Quantity</label>
                        <input type="number" name="quantity" id="Quantity" min="1" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Image" class="form-label font-weight-bold">Product Image</label>
                        <input type="file" name="image" id="Image" class="form-control-file" required />
                    </div>

                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-info" name="btnAdd" value="Add new" />
                        <input type="button" class="btn btn-info" name="btnIgnore" value="Cancel" onclick="window.location='product.html'" />
                    </div>
                </form>
            </div>
        </section>
    </div>