<?php include "header_v.php" ?>

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/vokasi1.jpg" class="d-block w-100" alt="...">
            <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100%" height="570" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text></svg> -->
            <div class="carousel-caption d-none d-md-block">
                <h5>GEDUNG IPB CILIBENDE</h5>
                <p>Sekolah Vokasi IPB University</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/sb1.jpg" class="d-block w-100" alt="...">
            <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100%" height="570" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Second slide"><title>Placeholder</title><rect width="100%" height="100%" fill="#666" /><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text></svg> -->
            <div class="carousel-caption d-none d-md-block">
                <h5>GEDUNG IPB BARANANGSIANG</h5>
                <p>SEKOLAH VOKASI IPB University</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/bs1.jpg" class="d-block w-100" alt="...">
            <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100%" height="570" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Third slide"><title>Placeholder</title><rect width="100%" height="100%" fill="#555" /><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg> -->
            <div class="carousel-caption d-none d-md-block">
                <h5>GEDUNG GUNUNG GEDE</h5>
                <p>SEKOLAH VOKASI IPB University</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section>
    <br>
    <div class="container">
        <h2> Login </h2>
        <?php if (!empty($session)) {
        ?>
            <div class="alert alert-<?php echo $session['status'] ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $session['message']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php
        }

        if (!empty($isLogin)) {
        ?>

            <a href="<?php echo site_url('Beranda/logout') ?>" class="btn btn-danger"> Logout </a>
        <?php

        } else {

        ?>

            <form method="POST" action="<?php echo site_url('Beranda/login') ?>">

                <div class="form-group">
                    <label for="exampleInputEmail1"> Username </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Masukkan username Anda" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Masukkan password Anda" required>
                </div>
                <button type="submit" class="btn btn-primary"> Login </button>
            </form>

        <?php } ?>
    </div>
    <br>
</section>

<!-- 
            <section>
                <div class="row">
                    <div class="col-md-3 bg-danger">
                        Hello 1
                    </div>
                    <div class="col-md-3 bg-success">
                        Hello 2
                    </div>
                    <div class="col-md-3 bg-info d-none d-md-block ">
                        Hello 3
                    </div>
                    <div class="col-md-3 bg-warning d-none d-md-block ">
                        Hello 4
                    </div>
                </div>
            </section>

            -->

<?php include "footer_v.php" ?>

</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<!-- Customs JS -->
<script src="<?php echo base_url('assets/js/script.js') ?>"></script>

</body>

</html>