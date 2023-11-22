<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/fav.png" />
  <!-- Author Meta -->
  <meta name="author" content="colorlib" />
  <!-- Meta Description -->
  <meta name="description" content="" />
  <!-- Meta Keyword -->
  <meta name="keywords" content="" />
  <!-- meta character set -->
  <meta charset="UTF-8" />
  <!-- Site Title -->
  <title>Website E-Voting</title>

  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|Roboto:400,400i,500,700" rel="stylesheet" />
  <!--
      CSS
      =============================================
    -->
  <link rel="stylesheet" href="../css/linearicons.css" />
  <link rel="stylesheet" href="../css/font-awesome.min.css" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <link rel="stylesheet" href="../css/magnific-popup.css" />
  <link rel="stylesheet" href="../css/owl.carousel.css" />
  <link rel="stylesheet" href="../css/nice-select.css">
  <link rel="stylesheet" href="../css/hexagons.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" />
  <link rel="stylesheet" href="../css/main.css" />
</head>

<body>
  <!-- ================ Start Header Area ================= -->
  <header class="default-header">
    <nav class="navbar navbar-expand-lg  navbar-light">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <!--<img src="img/logo.png" alt="" />-->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="lnr lnr-menu"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="#prosedur-pemilihan">Prosedur Pemilih</a></li>
            <li><a href="#input-token">Input Token</a></li>
            <li><a href="#teknologi">Teknologi</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- ================ End Header Area ================= -->

  <!-- ================ start banner Area ================= -->
  <section class="home-banner-area">
    <div class="container">
      <div class="row justify-content-center fullscreen align-items-center">
        <div class="col-lg-5 col-md-8 home-banner-left">
          <h1 class="text-white">
            Selamat Datang<br />
            Website E-Voting 
          </h1>
          <p class="mx-auto text-white  mt-20 mb-40">
            Website Evote adalah platform online untuk pemilihan elektronik, yang mempermudah pemungutan suara melalui perangkat komputer atau seluler. 
            Tujuannya adalah untuk memfasilitasi proses pemungutan suara digital.
          </p>
        </div>
        <div class="offset-lg-2 col-lg-5 col-md-12 home-banner-right">
          <img class="img-fluid" src="img/header-img.png" alt="" />
        </div>
      </div>
    </div>
  </section>
  <!-- ================ End banner Area ================= -->

  <!-- ================ Start Feature Area ================= -->
  <section class="feature-area">
    <div class="container-fluid">
      <div class="feature-inner row">
        <div class="col-lg-2 col-md-6">
          <div class="feature-item d-flex">
            <i class="ti-book"></i>
            <div class="ml-20">
              <h4>Registrasi dan Verifikasi</h4>
              <p>
                Proses registrasi ini dapat mencakup verifikasi identitas untuk memastikan bahwa setiap pemilih adalah individu yang sah.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="feature-item d-flex">
            <i class="ti-user"></i>
            <div class="ml-20">
              <h4>Pemilihan dan Kandidat</h4>
              <p>
                Website Evote memberikan informasi tentang kandidat, platform, dan program mereka, serta gambar atau video kampanye.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="feature-item d-flex border-right-0">
            <i class="ti-desktop"></i>
            <div class="ml-20">
              <h4>Pemilihan Online</h4>
              <p>
                Mereka dapat memilih kandidat pilihan mereka dengan mengklik tombol atau tindakan serupa.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ End Feature Area ================= -->
 <section id="input-token" class="input-token-area section-gap">
    <section class="popular-course-area section-gap">
        <div class="container-fluid">
            <div class="row justify-content-center section-title">
                <div class="col-lg-12">
                    <form action="{{ route('user.submit-vote') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_event" value="{{ $idEvent }}">
                        <input type="hidden" name="kuota_vote" value="{{ $kuotaVote }}">
                        <p class="remaining-votes">Remaining Votes: <span id="remainingVotes">{{ $kuotaVote }}</span></p>
                        <h2>Pemilihan</h2>

                        <div class="owl-carousel popuar-course-carusel">
                            @if(count($data) > 0)
                                @foreach ($data as $kandidat)
                                    @if ($idEvent == $kandidat->id_event)
                                        <div class="single-popular-course">
                                            <div class="thumb">
                                                @if($kandidat->foto)
                                                    <img class="f-img img-fluid mx-auto" src="{{ asset('storage/foto/' . $kandidat->foto) }}" alt="" />
                                                @else
                                                    <img class="f-img img-fluid mx-auto" src="img/popular-course/default-image.jpg" alt="" />
                                                @endif
                                            </div>
                                            <div class="details">
                                                <div class="d-flex justify-content-between mb-20">
                                                    <p class="name">{{ $kandidat->posisi == 'ketua' ? 'Ketua Section' : 'Member Section' }}</p>
                                                    <p class="value">{{ $loop->iteration }}</p>
                                                </div>
                                                <a href="#">
                                                    <h4>{{ $kandidat->nama_kandidat }}</h4>
                                                </a>
                                                <label>
                                                    <input type="checkbox" name="selected_candidates[]" value="{{ $kandidat->id }}" class="vote-checkbox">
                                                    Select
                                                </label>
                                                <div class="bottom d-flex mt-15">
                                                    <ul class="list">
                                                        <li>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                        </li>
                                                    </ul>
                                                    <p class="ml-20">25 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p>No data available</p>
                            @endif
                        </div>

                        <button type="submit">Submit Vote</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
  <!-- ================ End Popular Course Area ================= -->
  <!-- ================ End Feature Area ================= -->


  
  <section id="kontak" class="kontak-area section-gap">
  <!-- ================ start footer Area ================= -->
  <footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Top Products</h4>
					<ul>
						<li><a href="#">Managed Website</a></li>
						<li><a href="#">Manage Reputation</a></li>
						<li><a href="#">Power Tools</a></li>
						<li><a href="#">Marketing Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Quick Links</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Features</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Resources</h4>
					<ul>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Research</a></li>
						<li><a href="#">Experts</a></li>
						<li><a href="#">Agencies</a></li>
					</ul>
				</div>
				<div class="col-lg-4 col-md-6 single-footer-widget">
					<h4>Newsletter</h4>
					<p>You can trust us. we only send promo offers,</p>
					<div class="form-wrap" id="mc_embed_signup">
						<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
						 method="get" class="form-inline">
							<input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"
							 required="" type="email">
							<button class="click-btn btn btn-default text-uppercase">subscribe</button>
							<div style="position: absolute; left: -5000px;">
								<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
							</div>

							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="footer-bottom row align-items-center">
			</div>
		</div>
	</footer>
  </section>
  
  <!-- ================ End footer Area ================= -->

  <script src="../js/vendor/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="../js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  <script src="../js/jquery.ajaxchimp.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/parallax.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.sticky.js"></script>
  <script src="../js/hexagons.min.js"></script>
  <script src="../js/jquery.counterup.min.js"></script>
  <script src="../js/waypoints.min.js"></script>
  <script src="../js/jquery.nice-select.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>