
<div class="container">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-body">

							<br><br>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>NSPP</th>
										<th>Tipe</th>
										<th>Nama</th>
										<th>Telp</th>
										<th>Alamat</th>
										<th>Latitude</th>
										<th>Longtitude</th>
										<th width="200px">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 

        			//Query
									$sql = $conn->query("SELECT * from ponpes WHERE tipe='salafiyah' order by nspp desc");
									$nomor=1;

									while ($data = $sql->fetch_assoc()) {            
										?>
										<tr>
											<td><?php echo $nomor++; ?></td>
											<td><?php echo $data['nspp']; ?></td>
											<td><?php echo $data['tipe']; ?></td>
											<td><?php echo $data['nama']; ?></td>
											<td><?php echo $data['telp']; ?></td>
											<td><?php echo $data['alamat']; ?></td>
											<td><?php echo $data['lat']; ?></td>
											<td><?php echo $data['lng']; ?></td>
											<td>
												<a href="?page=delete&nspp=<?php echo $data['nspp'] ?>" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i> hapus</a>
												<a href="?page=edit&nspp=<?php echo $data['nspp'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
											</td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			</div>
			<!-- /.row -->
		</div>
	</div>
</div>
      <!-- /.row -->