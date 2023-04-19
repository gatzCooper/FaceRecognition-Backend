<?php
include('layout/headF.php');
?>


<section class="form7 cid-sFRWpp71BS" id="form7-15">

    <div class="mbr-overlay"></div>
    <div class="container">

        <div class="row justify-content-center mt-12">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form action="models/user.php?do=saveRegistration" method="POST" class="mbr-form form-with-styler mx-auto" data-form-title="Form Name">
                    <p class="mbr-text mbr-fonts-style align-center mb-4 display-7">
                        <!--                        --><?php //if ($success){ ?>
                        <!--                    <div class="alert alert-success alert-dismissable">-->
                        <!--                        Congrat: --><?php //echo($success); ?>
                        <!--                    </div>--><?php //}
                        //                    else if ($error) { ?>
                        <!---->
                        <!--                        <div class="alert alert-danger alert-dismissable">-->
                        <!--                            Problem: --><?php //echo htmlentities($error); ?>
                        <!--                        </div>-->
                        <!--                    --><?php //} ?>
                    </p>
                    <div class="row">

                    </div>

                    <div class="dragArea row">
                        <p><strong> ID</strong></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                            <input type="text" id="userNo" name="userNo" data-form-field="name" class="form-control"    required>
                        </div>


                        <p><strong>Role</strong></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                        <select name="role"  class="form-control" required>
                            <option></option>
                            <?php      $result = my_query("SELECT * FROM tbl_constants WHERE category='Role'");
                            for($i=1; $row = $result->fetch(); $i++){  ?>
                                <option ><?=$row['value'];?></option>
                            <?php } ?>
                        </select>
                        </div>

                        Name
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                            <input type="text" name="name" placeholder="ex.(lastname,firstname)" data-form-field="name" class="form-control" id="name-form7-15" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                            <input type="email" name="email" placeholder="Email" data-form-field="name" class="form-control" id="name-form7-15" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                            <input type="number" name="contact" placeholder="Contact Number" data-form-field="name" class="form-control" id="name-form7-15" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <textarea name="address" rows="4" cols="50" data-form-field="address" class="form-control" id="name-form7-15" placeholder="Address"></textarea>
                        </div>

                        <p><strong>  Birth Date</strong></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="date" name="bday"   class="form-control"  >
                        </div>
                        <p><strong> Department</strong></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <select   class="form-control" name="department" id="type"
                                <option value="">Select</option>
                                <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Department'");
                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                    <option><?= $row['value']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <p><strong> Schedule</strong></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <select   class="form-control" name="schedule" id="type"
                            <option value="">Select</option>
                            <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Schedule'");
                            for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                <option><?= $row['value']; ?></option>
                            <?php } ?>
                            </select>
                        </div>

                        <div class="md-form">
                            <label for="">Your Password<label style="color: red">*</label></label>
                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control" name="password" placeholder="Password" required>

                        </div>
                        <div class="md-form">
                            <label for="">Confirm Your Password<label style="color: red">*</label></label>
                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control" name="cpassword" placeholder="Confirm Password" required>

                        </div>

<br/>
                        <div class="col-auto mbr-section-btn align-center">
                            <button type="submit" name="btnregister" class="btn btn-danger display-4">Submit</button>
                            <a href="signin.php"   class="btn btn-info display-4">Signin</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/dropdown/js/nav-dropdown.js"></script>
<script src="assets/dropdown/js/navbar-dropdown.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/theme/js/script.js"></script>


</body>
</html>