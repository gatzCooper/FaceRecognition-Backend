<?php include_once('layout/head.php'); ?>
<?php $title = 'Advertisement'; ?>

    <br/>
    <div class="container">
        <div class="row">

            <div class="main">
                <div class="container" style="background-color: white">
                    <br/>
                    <h3><?= $title; ?> Management </h3>
                    <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                        <?php if (isset($_GET['id'])) { ?>
                            <input name="id" type="hidden" value="<?= $_GET['id']; ?>">
                        <?php } ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php if (isset($_GET['did'])) {
                                    $id = $_GET['did'];
                                    my_query("DELETE  FROM tbl_advertisements WHERE id='$id'   ORDER BY id DESC ");
                                } ?>

                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $result = my_query("SELECT *  FROM tbl_advertisements WHERE id='$id'    ORDER BY id DESC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $img = $row['img'];
                                        $url = $row['url'];
                                        $xtitle = $row['title'];
                                        $description = $row['description'];
                                    }
                                } ?>


                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <label for="" class="">Image</label>
                                            <input type="file" name="img"   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <label for="" class="">Url</label>
                                            <input type="text" name="url" placeholder="url" value="<?= (isset($url) ? $url : ''); ?>" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <label for="" class="">Title</label>
                                            <input type="text" name="title" placeholder="Title" value="<?= (isset($xtitle) ? $xtitle : ''); ?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <label for="" class="">Description</label>
                                            <input type="text" name="description" placeholder="Description" value="<?= (isset($description) ? $description : ''); ?>" class="form-control" required>
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
                                <a href="advertisements.php" class="btn btn-info">Cancel</a>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $result = my_query("SELECT *    FROM tbl_advertisements ORDER BY id DESC ");
                        for ($i = 1;
                             $row = $result->fetch();
                             $i++) {
                            $id = $row['id']; ?>
                            <tr>
                                <td> <?= $i; ?></td>
                                <td>
                                    <?php if($row['url']==''){ ?>
                                        <img src="assets/uploads/<?= $row['img']; ?>" width="80px">
                                  <?php   }else{  ?>
                                     <a target="_blank" href="models/do.php?url=<?=$row['url'];?>">   <img src="assets/uploads/<?= $row['img']; ?>" width="80px"></a>
                                    <?php } ?>
                                </td>
                                <td> <?= $row['title']; ?></td>
                                <td> <?= $row['description']; ?></td>
                                <td> <?= format_datetime($row['created_at']); ?></td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip"
                                       title="Edit">
                                        <a title="Edit" href="advertisements.php?id=<?= $id; ?>" class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span>
                                        </a>
                                    </p>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete"><a
                                                title="Delete?" href="advertisements.php?did=<?= $id; ?>" onclick="return  confirm('Are you Sure ?')"
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
    </div>
    <br/>
<?php include_once('layout/footer.php'); ?>