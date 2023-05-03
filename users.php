<?php include_once('layout/head.php'); ?>
<?php $title = 'User'; ?>
<?php if (isset($_GET['t'])) {
    $role   = $_GET['t'];
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
                                        <p></p>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewsched">
                                            View Schedules
                                        </button>
                                        
                                        <div class="modal fade" id="viewsched" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scheduleModalLabel">Schedules</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <?php  $userid = isset($_GET['id']) ?>
                                                <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th>Subject Code</th>
                                                    <th>Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                    <?php
                                                    // Fetch schedules from database and loop through them
                                                   
                                                     echo ">>>>>>>>>$userid";
                                                    $schedules = my_query("SELECT * FROM tbl_schedule WHERE userId='$userid'");
                                                    foreach ($schedules as $schedule) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $schedule['SubjectCode']; ?></td>
                                                        <td><?php echo $schedule['WorkDay']; ?></td>
                                                        <td><?php echo $schedule['StartTime']; ?></td>
                                                        <td><?php echo $schedule['EndTime']; ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>                        
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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scheduleModal">
                            Add Schedule
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Add Schedule</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <!-- Your form fields go here -->
                                    
                                    <?php  $userid = isset($_GET['id']) ?>
                                    <div class="form-group">
                                        <label for="day">Day</label>
                                        <select class="form-control" id="workDay" name="workDay">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option <?= (isset($workDay) ? (($workDay == $row['workDay']) ? 'selected' : '') : ''); ?> ><?= $row['workDay']; ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Subject Code</label>
                                        <select name="SubjectCode" class="form-control" required>
                                                <option></option>
                                                <?php $result = my_query("SELECT * FROM tbl_subject");
                                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                                    <option <?= (isset($SubjectCode) ? (($SubjectCode == $row['SubjectCode']) ? 'selected' : '') : ''); ?> ><?= $row['SubjectCode']; ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="startTime">Start Time:</label>
                                    <input type="time" class="form-control" name="startTime" id="startTime" value="<?= (isset($startTime) ? $startTime : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="endTime">End Time:</label>
                                    <input type="time" class="form-control" name="endTime" id="endTime" value="<?= (isset($endTime) ? $endTime: ''); ?>">
                                </div>                                 
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="func_param" value="<?= $title; ?>_Schedule" class="btn btn-success">Save Changes
                                </div>
                                </div>
                            </div>
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

    $(function(){
        var validation_el = $('<div>')
            validation_el.addClass('validation-err alert alert-danger my-2')
            validation_el.hide()
        $('input[name="userNo"]').on('input',function(){
            var userNo = $(this).val()
                $(this).removeClass("border-danger border-success")
                $(this).siblings(".validation-err").remove();
            var err_el = validation_el.clone()

                if(userNo == '')
                return false;

                $.ajax({
                    url:"validate.php",
                    method:'POST',
                    data:{userNo:userNo},
                    dataType:'json',
                    error:err=>{
                        console.error(err)
                        alert("An error occured while validating the data")
                    },
                    success:function(resp){
                        if(Object.keys(resp).length > 0 && resp.field_name == 'userNo'){
                            err_el.text(resp.msg)
                            $('input[name="userNo"]').addClass('border-danger')
                            $('input[name="userNo"]').after(err_el)
                            err_el.show('slideDown')
                            $('#submit').attr('disabled',true)
                        }else{
                            $('input[name="userNo"]').addClass('border-success')
                            $('#submit').attr('disabled',false)
                            
                        }
                    }
                })
        })

    })

</script>
<script>
  $('#saveBtn').click(function() {
    $.ajax({
      url: 'save-schedule.php',
      method: 'POST',
      data: $('#scheduleForm').serialize(),
      success: function(response) {
        // Code to handle successful response goes here
      },
      error: function(xhr, status, error) {
        // Code to handle error goes here
      }
    });
  });
</script>
<?php include_once('layout/footer.php'); ?>