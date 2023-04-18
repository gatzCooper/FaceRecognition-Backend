
<!-- Profile modal -->
<div
        class="modal fade"
        id="profileModal"
        tabindex="-1"
        aria-labelledby="profileModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center">
                <img
                        src="uploads/user/<?=$_SESSION['user_profile'];?>"
                        alt=""
                        width="100"
                        height="100"
                />
                <p class="mt-2"><?=$_SESSION['user_name'];?></p>
                <a href="models/do.php=logout" onclick="return  confirm('Are you sure ?')"
                   class="btn search-button my-2 my-sm-0 post-button"
                        type="submit"
                        data-dismiss="modal"
                >
                    SIGN OUT
                </a>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!-- Create post modal -->
<div
        class="modal fade"
        id="createPostModal"
        tabindex="-1"
        aria-labelledby="createPostModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="models/models.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="<?=$_SESSION['user_id'];?>" name="memberId">
                <input type="hidden" value="Pending" name="post_status">
                <input type="hidden" value="<?=$_SESSION['org_id'];?>" name="orgId">
            <div class="modal-body d-flex flex-column align-items-center">
            <textarea name="post_description"
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
            ></textarea>
                <div class="custom-file mt-4">
                    <input name="post_image" accept="image/x-png,image/gif,image/jpeg"
                            type="file"
                            class="custom-file-input"
                            id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01"
                    />
                    <label class="custom-file-label" for="inputGroupFile01"
                    >Choose file</label
                    >
                </div>
            </div>
            <div class="modal-footer">
                <button name="func_param" value="IUPost"
                        class="btn search-button post-button"
                        type="submit"  >
                    POST
                </button>
            </div>

            </form>
        </div>
    </div>
</div>

<?php
$result = my_query("SELECT *  FROM tbl_users ");
for ($i = 1;
$row = $result->fetch();
$i++) {  $id=$row['id']; ?>
<div class="modal fade"
        id="joinOrgModal<?=$id;?>"
        tabindex="-1"
        aria-labelledby="profileModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center">
                <img
                        src="uploads/org/<?=$row['logo'];?>"
                        alt=""
                        width="100"
                        height="100"
                />
                <h3> <?=$row['name'];?> </h3>
                <p class="mt-2">Do you want to join in this group?</p>

            </div>
            <div class="modal-footer container-center">
                <a href="models/do.php?do=joinGrp&id=<?=$id;?>"  class="btn search-button my-2 my-sm-0 post-button" onclick="return  confirm('Are you sure ?')"  type="submit"    >
                    Yes
                </a>
                <a  class="btn search-button my-2 my-sm-0 post-button"   data-dismiss="modal"    >
                    No
                </a>
            </div>
        </div>
    </div>
</div>

<?php }?>