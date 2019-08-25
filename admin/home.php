<style>
	#mapid { height: 480px; }
</style>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
	integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
	crossorigin="">

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Lokasi Persebaran</h3>
	</div>
		<div class="col-md-12 peta leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" id="mapid"> </div>
	</div>

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
	//window.onload = myMap();
	var mymap = L.map('mapid').setView([-6.9884791,110.3915757], 13);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox.streets',
		accessToken: 'pk.eyJ1IjoidGFxaW45OCIsImEiOiJjamx3YnJzeWQxNTV5M2xxcGsyZ3Zta2ljIn0.tG5e2XfsziniG8MHDpZyEA'
	}).addTo(mymap);

	var marker_red = '../assets/images/marker_red.png',
	marker_blue = '../assets/images/marker_blue.png',
	marker_green = '../assets/images/marker_green.png';

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
			"<img src='../assets/images/marker_red.png' width='20px'>  Kombinasi": kombinasi,
			"<img src='../assets/images/marker_blue.png' width='20px'>  Salafiyah": salafiyah,
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