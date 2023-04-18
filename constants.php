<?php include_once('layout/head.php'); ?>
<?php $title = 'Constant'; ?>

    <!--    <div class="container">-->
    <div class="row">
        <div class="col-7">
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-car"></i> Constant</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>Category</th>
                                <th>Value</th>
                               
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $result = my_query("SELECT *   FROM tbl_constants    ORDER BY id DESC ");
                            for ($i = 1;
                                 $row = $result->fetch();
                                 $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td> <?= $i; ?></td>
                                    <td> <?= $row['category']; ?></td>
                                    <td> <?= $row['value']; ?></td> 
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip"
                                           title="Edit">
                                            <a title="Edit" href="constants.php?id=<?=$id; ?>" class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span>
                                            </a>
                                        </p>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete"><a
                                                title="Delete?"     href="constants.php?did=<?= $id; ?>" onclick="return  confirm('Are you Sure ?')"
                                                class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                                        </p>
                                    </td>
                                </tr>

                            <?php } ?>

                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header bg-primary text-white"><i class="fa fa-<?=(isset($_GET['id']) ? 'pencil' : 'plus');  ?>"></i>  <?=$title;?> <?=(isset($_GET['id']) ? 'Update' : 'Add');  ?>
                </div>
                <div class="card-body">

                    <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                        <?php if (isset($_GET['id'])) { ?>
                            <input name="id" type="hidden" value="<?= $_GET['id']; ?>">
                        <?php } ?>
                        <input type="hidden" id="" name="role" value="<?=$role;?>">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php if (isset($_GET['did'])) {
                                    $id = $_GET['did'];
                                    my_query("DELETE  FROM tbl_constants WHERE id='$id'   ORDER BY id DESC ");
                                } ?>

                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $result = my_query("SELECT *  FROM tbl_constants WHERE id='$id'    ORDER BY id DESC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $category = $row['category'];
                                        $value = $row['value'];
                                        $sub_value = $row['sub_value'];
                                    }
                                } ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <label for="name" class="">Category</label>
                                            <input type="text" id="category" name="category" value="<?= (isset($category) ? $category : ''); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <label for="" class="">Value</label>
                                            <input type="text" name="value" value="<?= (isset($value) ? $value : ''); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                            <input type="hidden" name="sub_value" value="<?= (isset($sub_value) ? $sub_value : ''); ?>" class="form-control"  >
                                       
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
                                        <a href="constants.php" class="btn btn-info">Cancel</a>
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
                </div>
            </div>
        </div>

    </div>
    </div>

<?php include_once('layout/footer.php'); ?>