<?php include_once('layout/head.php');
$t=$_GET['t'];
?>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="card">

                    <?php if ($t == 'updateAccount') { ?>
                        <div class="card-header bg-warning text-white"><i class="fa fa-envelope"></i> Update Account Details
                        </div>

                    <?php } ?>

                    <div class="card-body">

                        <form action="models/do.php?do=<?=$t;?>" method="POST" enctype="multipart/form-data">
                            <input name="user_id" type="hidden" value="<?= $_SESSION['user_id']; ?>">
                            <input name="t" type="hidden" value="<?= $t; ?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $id = $_SESSION['user_id'];
                                    $result = my_query("SELECT *  FROM tbl_users WHERE id='$id'    ORDER BY id DESC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $userNo = $row['userNo'];
                                        $role = $row['role'];
                                        $fname = $row['fname'];
                                        $lname = $row['lname'];
                                        $mname = $row['mname'];

                                        $bday = $row['bday'];
                                        $age = $row['age'];
                                        $gender = $row['gender'];
                                        $address = $row['address'];
                                        $email = $row['email'];
                                        $contact = $row['contact'];
                                        $username = $row['username'];
                                        $password = $row['password'];
                                        $status = $row['status'];
                                        $schedule = $row['schedule'];
                                        $department = $row['department'];
                                        $pic = $row['pic'];
//
                                        $is_teaching = $row['is_teaching'];
                                    }
                                    ?>


                                    <div class="clearfix"></div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="name" class="">IDNo.</label>
                                                    <input type="text"  name="userNo" value="<?= (isset($userNo) ? $userNo : ''); ?>"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="" class="">Job Description</label>

                                                    <select name="role" class="form-control" required>
                                                        <option></option>
                                                        <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Job'");
                                                        for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                                            <option <?= (isset($role) ? (($role == $row['value']) ? 'selected' : '') : ''); ?> ><?= $row['value']; ?></option>
                                                        <?php } ?>
                                                    </select>


                                                </div>
                                            </div>

                                         

                                            <div class="col-md-4">
                                                <div class="md-form">
                                                    <label for="name" class="">Firstname</label>
                                                    <input type="text" id="fname" name="fname" value="<?= (isset($fname) ? $fname : ''); ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="md-form">
                                                    <label for="" class="">Lastname</label>
                                                    <input type="text" name="lname" value="<?= (isset($lname) ? $lname : ''); ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="md-form">
                                                    <label for="" class="">Middlename</label>
                                                    <input type="text" name="mname" value="<?= (isset($mname) ? $mname : ''); ?>" class="form-control" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="md-form">
                                                    <label for="" class="">Contact</label>
                                                    <input type="number" name="contact" value="<?= (isset($contact) ? $contact : ''); ?>" class="form-control" placeholder="(ex. 09 502 *** ***)" minlength="11" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="[0-9]+.{10,}" title="Must contain at least 11 digit"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="md-form">
                                                    <label for="" class="">Email</label>
                                                    <input type="email" name="email" value="<?= (isset($email) ? $email : ''); ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="message">Address</label>
                                                    <textarea id="address" name="address" rows="2" class="form-control md-textarea"><?= (isset($address) ? $address : ''); ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="" class="">Department  </label>
                                                    <select name="department"  class="form-control" >
                                                        <option></option>
                                                        <?php      $result = my_query("SELECT * FROM tbl_constants WHERE category='Department'");
                                                        for($i=1; $row = $result->fetch(); $i++){  ?>
                                                            <option <?= (isset($department) ? (($department==$row['value']) ? 'selected' : '') : ''); ?> ><?=$row['value'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <label for="" class="">Schedule  </label>
                                                    <select name="schedule"  class="form-control" >
                                                        <option></option>
                                                        <?php      $result = my_query("SELECT * FROM tbl_constants WHERE category='Schedule'");
                                                        for($i=1; $row = $result->fetch(); $i++){  ?>
                                                            <option <?= (isset($schedule) ? (($schedule==$row['value']) ? 'selected' : '') : ''); ?> ><?=$row['value'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    <div class="row">
                                        <br/>
                                        <div class="col-md-12"></div>
                                        <div class="col-md-11"> &nbsp;</div>
                                        <div class="col-md-1">
                                            <button type="submit" name="" value="" class="btn btn-success">
                                                Save
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once('layout/footer.php'); ?>