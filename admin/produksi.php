<?php 
include 'header.php';
$sortage = mysqli_query($conn, "SELECT * FROM produksi where cek = '1'");
$cek_sor = mysqli_num_rows($sortage);
?>

<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
	<br>
	<h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;"><marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee></h5>
	<a href="produksi.php" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
	<br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Invoice</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Status</th>
				<th scope="col">Tanggal</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			<?php 
			$result = mysqli_query($conn, "SELECT DISTINCT invoice, kode_customer, status, kode_produk, qty,terima,tolak, cek, tgl FROM produksi group by invoice");
			$no = 1;
			$array = 0;
			while($row = mysqli_fetch_assoc($result)){
				$kodep = $row['kode_produk'];
				$inv = $row['invoice'];
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $row['invoice']; ?></td>
					<td><?= $row['kode_customer']; ?></td>
					<?php if($row['terima'] == 1){ ?>
						<td style="color: green;font-weight: bold;">Pesanan Diterima (Siap Kirim)
							<?php
						}else if($row['tolak'] == 1){
							?>
							<td style="color: red;font-weight: bold;">Pesanan Ditolak
								<?php 
							}else if($row['terima'] == 0 && empty($row['images'])){
							?>
								<td style="color: warning;font-weight: bold;">Pesanan Baru 

							<?php
							}
								?>

							
					
						</td>
						<td><?= $row['tgl']; ?></td>
						<td>
							<?php if( $row['terima']==0 && $row['tolak']==0){ ?>
								<a href="proses/terima.php?inv=<?= $row['invoice']; ?>&kdp=<?= $row['kode_produk']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Terima</a> 
								<a href="proses/tolak.php?inv=<?= $row['invoice']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menolak ?')"><i class="glyphicon glyphicon-remove-sign"></i> Tolak</a> 
							<?php } ?>

							<a href="detailorder.php?inv=<?= $row['invoice']; ?>&cs=<?= $row['kode_customer']; ?>" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan</a>
						</td>
					</tr>
					<?php
					$no++; 
				}
				?>

			</tbody>
		</table>

	</div>

	



	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>


	<?php 
	include 'footer.php';
	?>