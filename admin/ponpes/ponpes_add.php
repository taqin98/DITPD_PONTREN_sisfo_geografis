<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Data Lokasi Pondok Pesantren</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
		<div class="box-body">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">NSPP </label>

				<div class="col-sm-6">
					<input type="text" name="nspp" class="form-control" placeholder="Nomor NSPP" required="">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tipe</label>

				<div class="col-sm-6">
					<select class="form-control" name="tipe">
						<option>Tipe Ponpes</option>
						<option value="kombinasi">Kombinasi</option>
						<option value="salafiyah">Salafiyah</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama </label>

				<div class="col-sm-6">
					<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Telepon/Hp</label>

				<div class="col-sm-6">
					<input type="text" name="telp" class="form-control" placeholder="Nomer Telepon/Hp">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

				<div class="col-sm-6">
					<input type="text" name="alm" class="form-control" placeholder="Alamat Lengkap">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>

				<div class="col-sm-6">
					<input type="text" name="kec" class="form-control" placeholder="Provinsi" required="">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Kab/kota</label>

				<div class="col-sm-6">
					<input type="text" name="kab" class="form-control" placeholder="Provinsi" required="">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>

				<div class="col-sm-6">
					<input type="text" name="prov" class="form-control" placeholder="Provinsi" required="">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Latitude Longtitude</label>

				<div class="col-sm-3">
					<input type="text" name="lat" id="lat" class="form-control" placeholder="Latitude" required="">
				</div>
				<div class="col-sm-3">
					<input type="text" name="lng" id="lng" class="form-control" placeholder="Longtitude" required="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-6">
					<div id="googleMap" style="width:100%;height:380px;"></div>
				</div>
			</div>

			
			
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<input type="reset" class="btn btn-default" value="Cancel" />
			<input type="submit" name="save" class="btn btn-info pull-right" value="Simpan" />
		</div>
		<!-- /.box-footer -->
	</form>
	<?php
	if (isset($_POST['save'])) {

		$nspp     = $_POST['nspp'];
		$tipe    = $_POST['tipe'];
		$nama     = $_POST['nama'];
		$telp = $_POST['telp'];
		$alm      = $_POST['alm'];
		$kec     = $_POST['kec'];
		$kab      = $_POST['kab'];
		$prov      = $_POST['prov'];
		$lat      = $_POST['lat'];
		$lng      = $_POST['lng'];

		$sql = $conn->query("INSERT INTO ponpes (nspp, tipe, nama, telp, alamat, kec, kabkota, prov, lat, lng) VALUES('$nspp', '$tipe', '$nama', '$telp', '$alm', '$kec', '$kab', '$prov', '$lat', '$lng')");
		if ($sql) {

			?>
			<script type="text/javascript">
				alert("Data Berhasil disimpan."); document.location = '?page=view';
			</script>
			<?php

		} else {

			?>
			<script type="text/javascript">
				alert("Data gagal disimpan."); document.location = '?page=view';
			</script>
			<?php

		}
		
	}
	?>
</div>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PFwjCKMLJR-uSQ9Ijg8LLgBKteINOqE&callback=initMap"
  type="text/javascript"></script>
<script>
function initMap() {
  var propertiPeta = {
    center:new google.maps.LatLng(-6.990618951127306,110.42310721409126),
    zoom:13,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  
  // membuat Marker
  // var marker=new google.maps.Marker({
  //     position: new google.maps.LatLng(-8.5830695,116.3202515),
  //     map: peta,
  //     animation: google.maps.Animation.BOUNCE
  // });

  // even listner ketika peta diklik
  google.maps.event.addListener(peta, 'click', function(event) {
    taruhMarker(this, event.latLng);
  });

}
    var marker;
function taruhMarker(peta, posisiTitik){

     if(marker){
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }

     // isi nilai koordinat ke form
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();
}



// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initMap);
</script>


