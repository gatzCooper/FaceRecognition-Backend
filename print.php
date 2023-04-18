<?php
require_once "config.php";
$category = $_GET['c'];  

 ?>

    <body onload="window.print();">
    <!--onload="window.print();"-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->


    <!--    <button onclick="printDiv('printableArea')">Print</button>-->
    <div class="container" id="printableArea">

 <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Brgy.</th>
                                    <th>Contact</th>
                                    <th>Temperature</th>
                                    <th>Symptoms</th> 
                                    <th>Vaccine Status</th>
                                    <th>Created At</th> 
                                </tr>
                                </thead>
                                <tbody> 
                                <?php 
                                // `, `userInfo`, `xagree`, ` `pic`, `status`, `update_status`, `covid_status`, `created_at`, swab_result` FROM `` WHERE 1
                                if ($category =='Positive'){
                                $result = my_query("SELECT *,CONCAT(fname, ' ',lname)name   FROM tbl_users  WHERE covid_status='Positive'  ORDER BY id DESC ");
                                }elseif($category=='Vaccinated'){
                                $result = my_query("SELECT * ,CONCAT(fname, ' ',lname)name   FROM tbl_users  WHERE vaccine_status<>'Unvaccinated'  ORDER BY id DESC ");
                                }else{
                                $result = my_query("SELECT *,CONCAT(fname, ' ',lname)name    FROM tbl_users  ORDER BY id DESC ");
                                }
                                for ($i = 1;
                                     $row = $result->fetch();
                                     $i++) {
                                    $id = $row['id']; ?>
                                    <tr>
                                        <td> <?= $i; ?></td>
                                        <td> <?= $row['name']; ?></td>
                                        <td> <?= $row['gender']; ?></td>
                                        <td> <?= $row['age']; ?></td>
                                        <td> <?= $row['address']; ?></td>
                                        <td> <?= $row['brgy']; ?></td>
                                        <td> <?= $row['contact']; ?></td>
                                        
                                        
                                        <td> <?= $row['temperature']; ?></td>
                                        <td> <?= $row['symptoms']; ?></td>
                                        <td> <?= $row['brgy']; ?></td>
                                        <td> <?= $row['vaccine_status']; ?></td>
                                        <td> <?= format_datetime($row['created_at']); ?></td>
                                       
                                    </tr>

                                <?php } ?>
  <tbody>
                        </table>
             

    </div>


    </body>

 
    </style>

    <script language="javascript">
        window.onafterprint = function (e) {
            closePrintView();
        };

        function myFunction() {
            window.print();
        }

        function closePrintView() {
            window.location.href = '<?=$backTo;?>';
        }


    </script>

    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>


<?php //echo '<script>self.location = "pr.php";</script>'; ?>