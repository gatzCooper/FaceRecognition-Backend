
<!-- Footer -->
<footer   class="text-light bg-primary p-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6">
                <h5>About</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <p class="mb-0">
                  Text Here
                </p>
            </div>

            <div hidden class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                <h5>Informations</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><a href="">Link 1</a></li>
                    <li><a href="">Link 2</a></li>
                    <li><a href="">Link 3</a></li>
                    <li><a href="">Link 4</a></li>
                </ul>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6">
                <h5>Contact</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><i class="fa fa-globe mr-2"><a href="https://norzagaraycollege.edu.ph"></i>norzagaraycollege.edu.ph</li>
                    <li><i class="fa fa-facebook mr-2"><a href="https://facebook.com/norzagaraycollege2007"></i>Norzagaray College, Norzagaray Bulacan</li>
                    <li><i class="fa fa-phone mr-2"></i> (461) 699-8071</li>
                    
                </ul>
            </div>
            <div class="col-4 copyright mt-1">
                <p class="float-left">
                    <a href="#">Back to top</a>
                </p>
                <p hidden class="text-right text-light">created with <i class="fa fa-heart"></i> by <a href=""><i> Student </i> <?=date('Y');?></a> | <span>v. 1.0</span></p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable(
            {

                "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
                "iDisplayLength": 5
            }
        );
    });


    function checkAll(bx) {
        var cbs = document.getElementsByTagName('input');
        for (var i = 0; i < cbs.length; i++) {
            if (cbs[i].type == 'checkbox') {
                cbs[i].checked = bx.checked;
            }
        }
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

<script>
    $('.select').select2({
        width: "100%",
        placeholder: "Select",
        maximumSelectionSize: 1,
        allowClear: true,
    });
    $('.selectTag').select2({
        width: "100%",
        placeholder: "Select",
        maximumSelectionSize: 1,
        allowClear: true,
        tags: true
    });

</script>

</body>
</html>
