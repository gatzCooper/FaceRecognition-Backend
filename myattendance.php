<?php include_once('layout/head.php'); ?>
<?php $title = 'Attendance'; ?>


    <div class="container">
        <div class="row">
 
        <div class="col-md-12 col-lg-12 col-sm-12">
           
            <div class="main">
                <div class="container" style="background-color: white">
                    <br/>
                    <h3>DTR Report</h3>

                    <div align="center">
                        <form action="" method="GET">
                          From :   <input type="date" name="dtFrom" value="<?php if (isset($_GET['dtFrom'])) {
                                echo $_GET['dtFrom'];
                            } ?>">
                          To :   <input type="date" name="dtTo" value="<?php if (isset($_GET['dtTo'])) {
                                echo $_GET['dtTo'];
                            } ?>">
                            <input type="submit" value="Search">
                            <input type="submit" value="Print" onclick="printDiv('printableArea')">
                        </form>

                    </div>
                    <!-- LIST -->
                    <div class="table-responsive"  id="printableArea">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr align="center">
                                <td>#</td>
                                <th> </th>
                                <th colspan="2"> AM </th>
                                <th colspan="2">  PM </th>
                                <th  >   </th>
                                <th  colspan="2">Daily</th>
                            </tr>
                            <tr>
                                <td>#</td>
                                <th colspan="1">Date</th>
                                <th>Arrival</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Departure</th>
                                <th> UNDERTIME </th>
                                <th>TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if(isset($_GET['dtFrom'])){
                                $dtfrom = $_GET['dtFrom'];
                                $dtto = $_GET['dtTo'];
                                $date="  AND  a.created_at BETWEEN '$dtfrom' AND '$dtto' ";
                            }else{
                                $date='';
                            }


                            $result = my_query("SELECT *,CONCAT(fname,' ',lname)name   FROM tbl_attendances a INNER JOIN tbl_users u ON u.id=a.user_id  WHERE user_id='$user_id'  $date ORDER BY a.id DESC "); //WHERE user_id='$user_id'
                            for ($i = 1;
                                 $row = $result->fetch();
                                 $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td> <?= $i; ?></td>
                                    <td> <?= $row['date']; ?></td>
                                    <td> <?=format_time($row['clock_in']); ?></td>
                                    <td> <?=format_time($row['lunch_start']); ?></td>
                                    <td> <?= format_time($row['lunch_end']); ?></td>
                                    <td> <?= format_time($row['clock_out']); ?></td>
                                    <?php


                                     if(strtotime($row['total_hours']) > strtotime('8:00') ) {
                                         $ot=  (strtotime($row['total_hours']) - strtotime('8:00')) /60 ;
                                         $tt="08:00:00";
                                    }else{
                                         $ot= 0;
                                         $tt= $row['total_hours'];
                                     }

                                    ?>

                                    <td> <?= $ot; ?></td>
                                    <td> <?= $tt; ?></td>

                                </tr>

                            <?php } ?>

                            <tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

<?php include_once('layout/footer.php'); ?>