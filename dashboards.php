<?php include_once('layout/head.php'); ?>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="container">
            <div class="row">

                <?php
                $ttTeacher=0;
                $ttUtility=0;
                $ttRegistrar=0;
                $ttDeans=0;
                $ttGC=0;
                $ttSN=0;
                $ttLibrarian =0;

                $result = $db->prepare("SELECT  
(SELECT COUNT(*) FROM tbl_users WHERE role='Teacher') AS ttTeacher,  
(SELECT COUNT(*) FROM tbl_users WHERE role='Utility') AS ttUtility, 
(SELECT COUNT(*) FROM tbl_users WHERE role='Registrar') AS ttRegistrar, 
(SELECT COUNT(*) FROM tbl_users WHERE role='Deans Staff') AS ttDeans, 
(SELECT COUNT(*) FROM tbl_users WHERE role='Guidance Counselor ') AS ttGC, 
(SELECT COUNT(*) FROM tbl_users WHERE role='School Nurse') AS ttSN, 
(SELECT COUNT(*) FROM tbl_users WHERE role='Librarian') AS ttLibrarian");

                ?>
 
            </div>


        </div>
        <section class="section">
            <h2 class="section-heading h1 pt-4">Dashboard</h2>
<a href="constants.php">Add Schedule</a>

            <div class="row">

                <!--Grid column-->
                <div class="col-md-12 col-xl-12">


                <div class="col-md-6 col-xl-6">

                    <script type="text/javascript"  src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
                    <?php include_once('fusioncharts.php'); ?>
                    <?php
                    $strQuery = "SELECT CONCAT(role) as lbl, COUNT(role) as c    FROM tbl_users GROUP BY role ";
// Execute the query, or else return the error message.
$result = $db->query($strQuery) or exit("Error code ({$db->errno}): {$db->error}");

// If the query returns a valid response, prepare the JSON string
if ($result) {
    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
        "chart" => array(
            "caption" => "Users ",
            "showValues" => "0",
            "theme" => "zune"
        )
    );

    $arrData["data"] = array();

    for ($i = 1; $row = $result->fetch(); $i++) {
        array_push($arrData["data"], array(
                "label" => $row["lbl"]. ' = '.$row["c"],
                "value" => $row["c"]
            )
        );
    }
    $jsonEncodedData = json_encode($arrData);
    $columnChart = new FusionCharts("pie2d", "myFirstChart", 600, 300, "chart-1", "json", $jsonEncodedData);

    // Render the chart
    $columnChart->render();

}
 
?>
                    <div id="chart-1"><!-- Fusion Charts will render here--></div>
<!--                    <div id="chart_div"></div>-->

                </div>


                <div class="col-md-6 col-xl-6">

<div id="chart-2"></div>
</div>


                <!--Grid column-->
            </div>

        </section>
    </div>

<br/><br/>

<?php include_once('layout/footer.php'); ?>