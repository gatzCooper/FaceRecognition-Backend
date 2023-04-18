<?php include_once('layout/head.php'); ?>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-white"><i class="fa fa-lock"></i> Update Password
                    </div>
                    <div class="card-body">

                        <form action="models/do.php?do=updatePassword" method="POST" enctype="multipart/form-data">
                            <input name="user_id" type="hidden" value="<?= $_SESSION['user_id']; ?>">
                            <input type="hidden" name="curpass" value="<?= db_get_result('tbl_users', 'password', ['id' =>  $_SESSION['user_id']]); ?>" required>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <label for="" class="">Old Password</label>
                                                <input type="password" name="oldpass" placeholder="Input old password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <label for="" class="">New Password</label>
                                                <input type="password" name="newpass" placeholder="Input new password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <label for="" class="">Confirm New Password</label>
                                                <input type="password" name="conpass" placeholder="Input confirm new password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">.</div>
                                        <div class="col-md-11"></div>
                                        <div class="col-md-1">
                                            <button type="submit" name="func_param" value="updatePassword" class="btn btn-success">
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