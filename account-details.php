<?php include_once('layout/head.php'); ?>
<div class="container">
    <div class="row">

        <div class="col-12">
            <div class="card bg-light mb-3">
                <div class="card-header bg-info text-white text-uppercase"><i class="fa fa-user"></i> Account Details
                </div>
                <div class="card-body">
                    <?php
                     $id=$_SESSION['user_id'];
                    $result = my_query("SELECT *,CONCAT(fname,' ' ,lname,' ' ,mname)name  FROM tbl_users WHERE id='$id'   ");
                    if ($row = $result->fetch()) { ?>
                        <p>IDNo. : <?=$row['userNo'];?></p>
                        <p>Role : <?=$row['role'];?></p>
                        <p>Name : <?=$row['name'];?></p>
                        <p>Email : <?=$row['email'];?></p>
                        <p>Address : <?=$row['address'];?></p>
                        <p>Username : <?=$row['username'];?></p>
                        <p>Status : <?=$row['status'];?></p>
                        <p>Department : <?=$row['department'];?></p>
                        <p>Schedule : <?=$row['schedule'];?></p>

<!-- `bday`, `age`, `gender`,  `pic` -->
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include_once('layout/footer.php'); ?>