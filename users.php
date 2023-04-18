<?php include_once('layout/head.php'); ?>
<?php $title = 'User'; ?>
<?php if (isset($_GET['t'])) {
    $role = $_GET['t'];
    $sqlWhere = " AND role='$role'";
} else {
    $sqlWhere = '';
}
?>


<?php if (isset($_GET['unlockid'])) {
    $id = $_GET['unlockid'];
    my_query("UPDATE tbl_users SET attempt_no='0'    WHERE id='$id'   ");
} ?>

    <br/>
    <div class="container">
        <div class="row">

            <div class="main">
                <div class="container" style="background-color: white">
                    <br/>
                    <h3><?= $title; ?> Management </h3>
                    <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?php if (isset($_GET['id'])) { ?>
                            <input name="id" type="hidden" value="<?= $_GET['id']; ?>">
                        <?php } ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php if (isset($_GET['did'])) {
                                    $id = $_GET['did'];
                                    my_query("DELETE  FROM tbl_users WHERE id='$id' $sqlWhere ORDER BY id DESC ");
                                } ?>

                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $result = my_query("SELECT *  FROM tbl_users WHERE id='$id'  $sqlWhere ORDER BY id DESC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $role = $row['role'];
                                        $userNo = $row['userNo'];
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
                                        $pic = $row['pic'];
                                        $status = $row['status'];
                                        $schedule = $row['schedule'];
                                        $department = $row['department'];
                                    }
                                } ?>


                                <div class="row">

                                    <div   class="col-md-6">
                                        <div class="md-form">
                                            <label for="" class="">ID No. </label>
                                            <input type="text" name="userNo" value="<?= (isset($userNo) ? $userNo : ''); ?>" class="form-control" placeholder="User IDNo"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <label for="" class="">Job Description</label>

                                            <select name="role" class="form-control" required>
                                                <option></option>
                                                <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Role'");
                                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                                    <option <?= (isset($role) ? (($role == $row['value']) ? 'selected' : '') : ''); ?> ><?= $row['value']; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="md-form">
                                            <label for="name" class="">Firstname</label>
                                            <input type="text" id="fname" name="fname" value="<?= (isset($fname) ? $fname : ''); ?>" onkeydown="return /[a-z, ]/i.test(event.key)"
                                                   onblur="if (this.value == '') {this.value = '';}"
                                                   onfocus="if (this.value == '') {this.value = '';}" placeholder="Firstname" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="md-form">
                                            <label for="" class="">Lastname</label>
                                            <input id="lname" onchange="setPassword(this.value)"    type="text" name="lname" value="<?= (isset($lname) ? $lname : ''); ?>" onkeydown="return /[a-z, ]/i.test(event.key)"
                                                   onblur="if (this.value == '') {this.value = '';}"
                                                   onfocus="if (this.value == '') {this.value = '';}" class="form-control" placeholder="Lastname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="md-form">
                                            <label for="" class="">Middlename</label>
                                            <input type="text" name="mname" placeholder="Middlename" value="<?= (isset($mname) ? $mname : ''); ?>" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix"></div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <label for="" class="">Contact</label>
                                            <input type="text" name="contact" value="<?= (isset($contact) ? $contact : ''); ?>" placeholder="(ex. 09 502 *** ***)" minlength="11" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="[0-9]+.{10,}" title="Must contain at least 11 digit" class="form-control" placeholder="Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <label for="" class="">Email </label>
                                            <input type="email" name="email" value="<?= (isset($email) ? $email : ''); ?>" class="form-control" required placeholder="Email"
                                                <?= (isset($_GET['id']) ? 'readonly' : ''); ?>
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <label for="message">Address</label>
                                            <textarea id="address" name="address" placeholder="Address" rows="2" class="form-control md-textarea"><?= (isset($address) ? $address : ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div hidden class="col-md-4">
                                        <div class="md-form">
                                            <label for="" class="">Username </label>
                                            <input type="text" name="username" value="<?= (isset($username) ? $username : ''); ?>" class="form-control" placeholder="Username"
                                                <?= (isset($_GET['id']) ? 'readonly' : ''); ?>
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <label for="" class="">Password</label>

                                            <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                                            Show
                                            <input type="password" id="password" name="password" value="<?= (isset($password) ? endecrypt($password, 'd') : 'NC2023cruz'); ?>" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <label for="" class="">Status</label>
                                            <select name="status" class="form-control" required>
                                                <option></option>
                                                <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Status'");
                                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                                    <option <?= (isset($status) ? (($status == $row['value']) ? 'selected' : '') : ''); ?> ><?= $row['value']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <label for="" class="">  Department</label>
                                            <select name="department" class="form-control" required>
                                                <option></option>
                                                <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Department'");
                                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                                    <option <?= (isset($department) ? (($department == $row['value']) ? 'selected' : '') : ''); ?> ><?= $row['value']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <label for="" class="">  Schedule</label>

                                            <select name="schedule" class="form-control" required>
                                                <option></option>
                                                <?php $result = my_query("SELECT * FROM tbl_constants WHERE category='Schedule'");
                                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                                    <option <?= (isset($schedule) ? (($schedule == $row['value']) ? 'selected' : '') : ''); ?> ><?= $row['value']; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                </div>
                                <?php if (isset($_GET['id'])) { ?>
                                    <div class="col-md-2">
                                        <button type="submit" name="func_param" value="IU<?= $title; ?>" class="btn btn-success">
                                            Update
                                        </button>
                                        <a href="users.php" class="btn btn-info">Cancel</a>
                                    </div>

                                <?php } else { ?>
                                    <div class="col-md-2">
                                        <button type="submit" name="func_param" value="IU<?= $title; ?>" class="btn btn-success">
                                            Save
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>

                    <!-- LIST -->
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <!--<th>Username</th>-->
                                <!--<th>Picture</th>-->
                                <th>Reg. Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            //  `mname`, `bday`, `age`, `gender`, `address`,
                            $result = my_query("SELECT *,CONCAT(fname,' ',lname)name   FROM tbl_users WHERE id>0 $sqlWhere ORDER BY id DESC ");
                            for ($i = 1;
                                 $row = $result->fetch();
                                 $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td> <?= $i; ?></td>
                                    <td> <?= $row['role']; ?></td>
                                    <td> <?= $row['name']; ?></td>
                                    <td> <?= $row['email']; ?></td>
                                    <td> <?= $row['contact']; ?></td>
                                    <!--<td> <?= $row['username']; ?></td>-->
                                    <!--<td><img src="assets/uploads/<?= $row['pic']; ?>" width="80px"></td>-->
                                    <td> <?= format_datetime($row['created_at']); ?></td>
                                    <td> <?= $row['status']; ?></td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip"
                                           title="Edit">
                                            <a title="Edit" href="users.php?id=<?=  $id; ?>" class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span>
                                            </a>
                                        </p>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete"><a
                                                    title="Delete?" href="users.php?did=<?= $id; ?>" onclick="return  confirm('Are you Sure ?')"
                                                    class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                                        </p>
                                        <p data-placement="top" data-toggle="tooltip"
                                           title="Edit">
                                            <a title="View Travel History" href="users.php?id=<?= $id; ?>&viewTravel" class="btn btn-warning btn-xs"><span class="fa fa-search"></span>
                                            </a>
                                        </p>


                                        <?php if (($row['attempt_no'] >= 3)) { ?>
                                            <p data-placement="top" data-toggle="tooltip">
                                                <a title="Unlock Account" href="users.php?unlockid=<?= $id; ?>" onclick="return  confirm('Are you Sure ?')" class="btn btn-info btn-xs"><span class="fa fa-unlock"></span>
                                                </a>
                                            </p>
                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php } ?>

                            <tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <br/>


<script >

    function setPassword() {
        var x = document.getElementById("lname").value;
        document.getElementById("password").value = "NC2023" + x;
         
    }
</script>
<?php include_once('layout/footer.php'); ?>