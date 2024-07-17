<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Meilinia</title>
    <link rel="stylesheet" href="<?= base_url(); ?>/users/style/styles.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/users/style/all.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/users/style/owl.carousel.min.css" />
    <script src="<?= base_url(); ?>/users/js/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url(); ?>/users/js/typed.min.js"></script>
    <script src="<?= base_url(); ?>/users/js/waypoints.min.js"></script>
    <script src="<?= base_url(); ?>/users/js/owl.carousel.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/favicon.png" />
</head>
<style>
    .status {
        height: 50px;
    }

    @media only screen and (max-width: 445px) {
        .mobile {
            visibility: hidden;
        }
    }
</style>
<body>
    <div class="scroll-up-btn">
        <i class="fa fa-angle-up"></i>
    </div>

    <!-- navbar -->
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Laundry<span>Meilinia.</span></a></div>
            <div class="logo-mobile"><img src="users/images/logo.png" alt=""></div>
            <ul class="menu" id="nav-menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#service" class="menu-btn">Layanan</a></li>
                <li><a href="#about" class="menu-btn">Tentang Kami</a></li>
                <li><a href="#contact" class="menu-btn">Kontak Kami</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Hi, Selamat Datang di</div>
                <div class="text-2">Laundry Meilinia</div>
                <div class="text-3">Kami Siap Mencuci <span class="typing"></span></div>
                <form action="" action="GET">
                    <input type=" text" name="keyword" placeholder="TRX-09xxxxxxxxxxxx"><button class="phone" onclick="myFunction()">Cari</button>
                    <br>
                    <span>*Harap Memasukkan No.Invoice anda</span>
                </form>
            </div>
        </div>
    </section>

    <!-- invoice section -->
    <?php
    foreach ($laundry as $laundry) { ?>
        <section class="invoice" id="invoice">
            <div class="max-width">
                <h2 class="title">Invoice</h2>
                <div class="invoice-content">
                    <div class="column right">
                        <div class="text"><?= $laundry['invoice']; ?></div>
                        <div class="box-body">
                            <div class="card">
                                <div class="text-card">
                                    <div class="row">
                                        <div class="column">
                                            <h4>Nama Pelanggan:</h4>
                                            <p><?= $laundry['name_customer']; ?></p>
                                        </div>
                                        <div class="column">
                                            <h4>Status:</h4>
                                            <?php
                                            if ($laundry['name_activity'] == "Sudah diambil") {
                                            ?>
                                                <span class="label label-success"><?= $laundry['name_activity']; ?></span>
                                            <?php } else if ($laundry['name_activity'] == "Dalam Proses") { ?>
                                                <span class="label label-warning"><?= $laundry['name_activity']; ?></span>
                                            <?php  } else if ($laundry['name_activity'] == "Selesai") { ?>
                                                <span class="label label-info"><?= $laundry['name_activity']; ?></span>
                                            <?php } else { ?>
                                                <span class="label label-danger"><?= $laundry['name_activity']; ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <h4>Layanan:</h4>
                                    <p><?= $laundry['name_service']; ?></p>
                                    <h4>Harga:</h4>
                                    <p>Rp. <?= $laundry['price']; ?></p>
                                    <h4>Status Pembayaran</h4>
                                    <?php
                                    if ($laundry['status'] == "Lunas") {
                                    ?>
                                        <p><?= $laundry['status']; ?></p>
                                    <?php } else { ?>
                                        <p><?= $laundry['status']; ?></p>
                                        <h4>Tagihan:</h4>
                                        <p>Rp. <?= $laundry['paid']; ?></p>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="column">
                                            <h4>Tanggal Masuk:</h4>
                                            <p><?= date('d M y h:i', strtotime($laundry['created_at'])); ?></p>
                                        </div>
                                        <div class="column">
                                            <h4>Tanggal Selesai:</h4>
                                            <p><?= date('d M y h:i', strtotime($laundry['finished_at'])); ?></p>
                                        </div>
                                    </div>
                                    <h4>Tanggal Update:</h4>
                                    <p><?= date('d M y h:i', strtotime($laundry['updated_at'])); ?></p>
                                    <a href="detail/<?= $laundry['invoice']; ?>">Selengkapnya <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    } ?>

    <!-- service section -->
    <section class="service" id="service">
        <div class="max-width">
            <h2 class="title">Layanan</h2>
            <div class="carousel owl-carousel">
                <?php
                foreach ($service as $s) { ?>
                    <div class="card">

                        <div class="box">
                            <div class="text"><?= $s['name']; ?></div>
                            <h3>Rp. <?= $s['price']; ?>/Kg</h3>
                            <p><?= $s['day']; ?> Hari</p>
                        </div>

                        <a href="https://wa.me/6285158031022/?text=*Laundry Meilinia*%0A=======================%0A%0AJl. Cardiact No.38 (belakang RSUP H. Adam Malik), Medan Tuntungan%0ANo Tlp : 085158031022%0A=======================%0AMohon Untuk Mengisi Data Berikut ini%0A%0ANama :%0AAlamat :%0ANo.Tlp :%0A%0ALayanan Yang Dipilih:%0A*<?= $s['name']; ?> Rp. <?= $s['price'];?>/KG*%0A*Waktu Est. <?= $s['day']; ?>*%0AJika Anda Mengalami kendala anda dapat menghubungi kamu%0ATerima Kasih" target="_blank"> <button>PILIH</button> </a>
                        
                    </div>

                <?php
                } ?>
            </div>
        </div>
    </section>

    <!-- about section -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">Tentang</h2>
            <div class="about-content">
                <div class="column right">
                    <div class="text">Laundry Melinia<br>melayani <span class="typing-2"></span></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut voluptatum eveniet doloremque
                        autem excepturi eaque, sit laboriosam voluptatem nisi delectus. Facere explicabo hic minus
                        accusamus alias fuga nihil dolorum quae. Explicabo illo unde, odio consequatur ipsam possimus
                        veritatis, placeat, ab molestiae velit inventore exercitationem consequuntur blanditiis omnis
                        beatae. Dolor iste excepturi ratione soluta quas culpa voluptatum repudiandae harum non.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Hubungi</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Kontak Kami</div>
                    <p>Jika anda mengalami kendala atau keluhan anda dapat menghubungi kontak yang ada berada dibawa ini terima kasih</p>
                    <div class="icons">
                        <div class="row">
                            <i class="fa fa-user"></i>
                            <div class="info">
                                <div class="head">Nama</div>
                                <div class="sub-title">Admin Laundry Meilinia</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fa fa-map-marker"></i>
                            <div class="info">
                                <div class="head">Alamat</div>
                                <div class="sub-title">Jl. Cardiact No. 38 (Belakang RSUP H. Adam Malik), Medan Tuntungan</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fa fa-phone"></i>
                            <div class="info">
                                <div class="head">No. Tlp</div>
                                <div class="sub-title">085158031022</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Lokasi Kami</div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d995.5764949482339!2d98.6081593!3d3.5165506!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312526b0a33865%3A0xca2d31a8aa52b4fa!2sLaundry%20Meilinia!5e0!3m2!1sen!2sid!4v1656500326532!5m2!1sen!2sid" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section -->
    <footer>
        <span>Created By <a href="#">MyMango.Id</a> | <span class="fa fa-copyright"></span> 2022 All rights reserved.</span>
    </footer>
    <script src="<?= base_url(); ?>/users/js/scrollreveal.js"></script>
    <script src="<?= base_url(); ?>/users/js/script.js"></script>
</body>

</html>