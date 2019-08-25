<?php include "admin/config.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mapbox</title>
	<link type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
	integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
	crossorigin="">
	<link rel="stylesheet" href="admin/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">



	<style>
		html, body {
			color: #757575;
			font-family : 'Open Sans', sans-serif;
			font-style : normal;
			font-weight : 400;
		}
		#mapid { height: 580px; }
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-success" id="navbar_hight">
		<div class="container">
			<!-- Just an image -->
			<nav class="navbar navbar-light">
				<a class="navbar-brand" href="#">
					<img src="assets/images/kemenag.png" width="50px" height="auto" alt="">
				</a>
				<div class="row">
					<div class="col-md-12 text-light"><h4>Sistem Informasi Geografis</h4></div>
					<div class="col-md-12 text-light"><h4>Persebaran Pondok Pesantren Se-Kota Semarang</h4></div>
				</div>
			</nav>
		</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="navbar_hight">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?page=profile">Profile</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Informasi Pondok Pesantren
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="?page=kombinasi">Kombinasi</a>
							<a class="dropdown-item" href="?page=salafiyah">Salafiyah</a>
							<div class="dropdown-divider"></div>
						</div>
					</li>
				</ul>
				<?php
				if (!isset($_SESSION['users'])) {
					# code...
					?>
					<a class="btn btn-outline-success my-2 my-sm-0" href="admin">Login</a>
					<?php
				} else {
					?>
					<a class="btn btn-outline-success mr-3 my-2 my-sm-0"  href="admin"><?= $_SESSION['users']['username'] ?></a>
					<a class="btn btn-outline-success my-2 my-sm-0 fa fa-sign-out rounded" title="Sign Out" href="admin/logout.php"></a>
					<?php
				}
				?>
			</div>
		</div>
	</nav>
	<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

	switch ($_GET['page']) {
		case 'profile':
			include 'profile.php';
			break;
		case 'kombinasi':
			include 'data/kombinasi.php';
			break;
		case 'salafiyah':
			include 'data/salafiyah.php';
			break;
		
		default:
			include 'home.php';
			break;
	}
	?>
	


	<script src="assets/js/jquery-3.3.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	

	<script type="text/javascript" src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
	integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
	crossorigin=""></script>
	<script type="text/javascript">
		function myMap() {
			var winH = $(window).height();
			var winW = $(window).width();
			var navbar_hight = $('#navbar_hight').height();
			var total = winH - navbar_hight - navbar_hight;
			$('#mapid').css( {'height' : total+'px',});
		};
		window.onload = myMap();
		var mymap = L.map('mapid').setView([-6.9884791,110.3915757], 13);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
			id: 'mapbox.streets',
			accessToken: 'pk.eyJ1IjoidGFxaW45OCIsImEiOiJjamx3YnJzeWQxNTV5M2xxcGsyZ3Zta2ljIn0.tG5e2XfsziniG8MHDpZyEA'
		}).addTo(mymap);

		var marker_red = 'assets/images/marker_red.png',
			marker_blue = 'assets/images/marker_blue.png',
			marker_green = 'assets/images/marker_green.png';

		var redIcon = L.icon({
			iconUrl: marker_red,
		    iconSize:     [38, 38], // size of the icon
		}), blueIcon = L.icon({
			iconUrl: marker_blue,
			iconSize: [38, 38],
		});



		var kombinasi = L.layerGroup();
		var salafiyah = L.layerGroup();

		var overlays = {
			"<img src='assets/images/marker_red.png' width='20px'>  Kombinasi": kombinasi,
			"<img src='assets/images/marker_blue.png' width='20px'>  Salafiyah": salafiyah,
		};
		mymap.addLayer(kombinasi);
		mymap.addLayer(salafiyah);
		<?php
		$query = $conn->query("SELECT * FROM ponpes");
		while ($data = $query->fetch_assoc()) {
			# code...
			?>
			var dataPop = 
			'<b>NSPP</b> : <?= $data['nspp'] ?><br>' +
			'<b>Nama Ponpes</b> : <?= $data['nama'] ?><br>' +
			'<b>Telp</b> : <?= $data['telp'] ?><br>' +
			'<b>Alamat</b> : <?= $data['alamat'] ?><br>' +
			'<b>Kecamatan</b> : <?= $data['kec'] ?><br>' +
			'<b>Kabupaten</b> : <?= $data['kabkota'] ?><br>' +
			'<b>Provinsi</b> : <?= $data['prov'] ?><br>';

			L.marker([<?= $data['lat'] . ", " . $data['lng'] ?>], <?php if ($data['tipe'] == "kombinasi") { echo "{icon: redIcon}";} else {echo "{icon: blueIcon}";} ?>).bindPopup(dataPop).addTo(<?= $data['tipe']; ?>);
			<?php
		}
		?>
		// L.marker([-6.988366, 110.381141], {icon: redIcon}).bindPopup('<h3>sdsd</h3>').addTo(kombinasi),
		// L.marker([-6.9940, 110.385680]).bindPopup('This is Littleton, CO.').addTo(salafiyah),
		// L.marker([-6.999867, 110.392857], {icon: redIcon}).bindPopup('This is Littleton, CO.').addTo(kombinasi);
		// L.marker([-6.9990, 110.395680]).bindPopup('This is Littleton, CO.').addTo(salafiyah),
		L.control.layers({},overlays).addTo(mymap);

		// var marker = L.marker([-6.984277, 110.409636]).addTo(mymap);


		var popup = L.popup();
		function onMapClick(e) {
			popup
			.setLatLng(e.latlng)
			.setContent("Lokasi yang dipilih: " + e.latlng.toString())
			.openOn(mymap);
		}
		mymap.on('click', onMapClick);
	</script>
	<!--Datatables-->
	<script src="admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#example1').DataTable();
	</script>
</body>
</html>