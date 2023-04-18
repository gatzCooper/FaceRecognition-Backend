<?php include_once('layout/head.php'); ?>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xl-9">
                    <h2 class="section-heading h1 pt-4">ABOUT US</h2>
                    <p><?= $_SESSION['CAboutIntro']; ?></p>
                    <p><?= $_SESSION['CAboutUs']; ?></p>
                </div>
                <div hidden class="col-md-4 col-xl-3">
                    <h3 class="section-heading">Mission</h3>
                    <br/>
                    <p><?= $_SESSION['Cmission']; ?></p>
                    <h3 class="section-heading">Vision</h3>
                    <br/>
                    <p><?= $_SESSION['CAboutUs']; ?></p>
                </div>
            </div>
        </div>
        <section hidden class="section">

            <!--Section heading-->
            <h2 class="section-heading h1 pt-4">CONTACT US</h2>
            <!--Section description-->
            <p class="section-description">Do you have any questions? Please do not hesitate to contact us directly. Our
                team will come back to you within
                matter of hours to help you.</p>

            <div class="row">

                <!--Grid column-->
                <div class="col-md-8 col-xl-9">
                    <form id="contact-form" name="contact-form" action="models/do.php?do=contactus" method="POST">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form">
                                    <label for="name" class="">Your name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form">
                                    <label for="email" class="">Your email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form">
                                    <label for="subject" class="">Contact</label>
                                    <input type="text" id="subject" name="contact" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->
                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <label for="message">Your message</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->

                    </form>

                    <div class="center-on-small-only">
                        <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
                    </div>
                    <div class="status"></div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 col-xl-3">
                    <ul class="contact-icons">
                        <li><i class="fa fa-map-marker fa-2x"></i>
                            <p><?= $_SESSION['Caddress']; ?></p>
                        </li>

                        <li><i class="fa fa-phone fa-2x"></i>
                            <p><?= $_SESSION['Ccontact']; ?></p>
                        </li>

                        <li><i class="fa fa-envelope fa-2x"></i>
                            <p><?= $_SESSION['Cemail']; ?></p>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

            </div>

        </section>
    </div>


<?php include_once('layout/footer.php'); ?>