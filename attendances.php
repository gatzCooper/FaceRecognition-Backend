<?php include_once('layout/head.php'); ?>
<?php $title = 'Attendance'; ?>


<br/>
    <div class="container">
        <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="main">
                <div class="container" style="background-color: white">
                    <br/>
                    <h3> DTR Reports </h3>

                    <div align="center">
                        <form action="" method="GET">
                            Name :
                            <select name="user_id">
                                <option></option>
                                <?php $result = my_query("SELECT * FROM tbl_users ");
                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['fname']; ?></option>
                                <?php } ?>
                            </select>
						From :
                            <input type="date" name="dtFrom" value="<?php if (isset($_GET['dtFrom'])) {
                                echo $_GET['dtFrom'];
                            } ?>">
							To :
                            <input type="date" name="dtTo" value="<?php if (isset($_GET['dtTo'])) {
                                echo $_GET['dtTo'];
                            } ?>">
                            <input type="submit" value="Search">
                            <input type="submit" value="Print" onclick="printDiv('printableArea')">
                        </form>
                        </div>

                    <!-- LIST -->

                    <div class="table-responsive" id="printableArea">
                        <?php if (isset($_GET['user_id'])) {
                            $id = $_GET['user_id'];
                            $result = my_query("SELECT * FROM tbl_users WHERE id='$id' ");
                            if ($row = $result->fetch()) {
                                echo "<br/>NAME : ";
                                echo $row['fname'] . ' ' . $row['lname'].'<br/><br/>';
                            }
                        } ?>

                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr align="center">
                                <td>#</td>
                                <?php if (!isset($_GET['user_id'])) { ?>
                                    <th></th>
                                <?php } ?>
                                <th></th>
                                <th colspan="2"> A.M. </th>
                                <th colspan="2">  P.M. </th>
                                <th colspan="2">  Undertime</th>
                                <th  colspan="1">Daily</th>
                            </tr>
                            <tr>
                                <td>#</td>
                                <th colspan="1">Date</th>
                                <?php if (!isset($_GET['user_id'])) { ?>
                                    <th colspan="1">Name</th>
                                <?php } ?>

                                <th>Arrival</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Departure</th>
                                <th>Hours</th>
                                <th>Minutes</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if (isset($_GET['dtFrom'])) {
                                $dtfrom = $_GET['dtFrom'];
                                $dtto = $_GET['dtTo'];
                                $date = "  WHERE   a.created_at BETWEEN '$dtfrom' AND '$dtto' ";
                            } else {
                                $date = '';
                            }
                            

                            $result = my_query("SELECT *,CONCAT(fname,' ',lname)name   FROM tbl_attendances a INNER JOIN tbl_users u ON u.id=a.user_id $date  ORDER BY a.id DESC "); //WHERE user_id='$user_id'

                            
                            for ($i = 1;
                                 $row = $result->fetch();
                                 $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td> <?= $i; ?></td>
                                    <td> <?= $row['date']; ?></td>
                                    <?php if (!isset($_GET['user_id'])) { ?>
                                        <td> <?= $row['name']; ?></td>
                                    <?php } ?>                               
                                    <td><?= (date('a', strtotime($row['clock_in'])) === 'pm') ? '' : format_time($row['clock_in']) ?></td> 
                                    <td><?= (date('a', strtotime($row['clock_out'])) === 'pm') ? '' : format_time($row['clock_out']) ?></td>
                                    <td><?= (date('a', strtotime($row['clock_in'])) === 'am') ? '' : format_time($row['clock_in']) ?></td>
                                    <td><?= (date('a', strtotime($row['clock_out'])) === 'am') ? '' : format_time($row['clock_out']) ?></td>
                                    <td><?= ltrim(date('H', strtotime($row['undertime'])), '0'); ?></td>
                                    
                                    <?php
                                    if(strtotime($row['total_hours']) > strtotime('8:00') ) {
                                        $tt="08:00:00";
                                        $ot=  (strtotime($row['total_hours']) - strtotime('8:00')) /60 ;

                                        $xsplit = explode(".", $ot);
                                        $ot=$xsplit[0];
                                        $min=  substr($xsplit[1], 0, 2);;
                                    }else{
                                        $ot= 0;
                                        $min=0;
                                        $tt= ltrim(date('H', strtotime($row['total_hours'])), '0');
                                    }
                                    ?>

                                    <td> <?= $ot; ?></td>
                                    <td> <?= $min; ?></td>
                                    <td><?= $tt; ?></td>

                                </tr>

                            <?php } ?>


                            <tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td><?=$i-1 .' day(s)';?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            </div>

        </div>
    </div>
    <br/>
<?php include_once('layout/footer.php'); ?>