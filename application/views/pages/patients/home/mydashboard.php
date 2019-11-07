<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master';
$colors = ['default', 'primary', 'success', 'info', 'warning', 'danger'];
shuffle($colors);
$alert = build_alert('success', 'Mohon Maaf', 'Jadwal Dokter Untuk hari Ini Kosong');
?>

<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<h3 class="title text-center">
		Update Jadwal Dokter Hari Ini <?php echo ' [ ' . indo_date(date('d-m-Y')) . ' ]'; ?>
	</h3>
	<div class="row">
		<?php
		if ($daily_schedules == null) {
			echo $alert;
		} else {
			foreach ($daily_schedules as $daily_schedule) {
				?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-aqua" style="font-size: 15px;">
							<?php
									echo $daily_schedule->nama_poli;
									?>
						</span>
						<div class="info-box-content">
							<span class="info-box-number"><?php echo $daily_schedule->nama_dokter; ?></span>
							<span><u>Jam Praktek :</u></span>
							<span class="info-box-text">
								<?php echo format_date($daily_schedule->start_at, 'H.i') . ' s/d '; ?>
								<?php echo format_date($daily_schedule->end_at, 'H.i'); ?>
							</span>
						</div>
					</div>
				</div>
		<?php
			}
		}
		?>
	</div>

	<div class="view-container">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title" style="text-transform: capitalize;">Profil Pasien <?php echo $patient->name; ?></h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-8">
								<div class="row">
									<label for="patient_code" class="col-xs-4">Kode Pasien :</label>
									<div class="col-xs-8"><?php echo $patient->patient_code; ?></div>
								</div>
								<div class="row">
									<label for="civilian_id" class="col-xs-4">NIK :</label>
									<div class="col-xs-8"><?php echo $patient->civilian_id; ?></div>
								</div>
								<div class="row">
									<label for="name" class="col-xs-4">Nama :</label>
									<div class="col-xs-8"><?php echo $patient->name; ?></div>
								</div>
								<div class="row">
									<label for="religion" class="col-xs-4">Agama :</label>
									<div class="col-xs-8"><?php echo $patient->religion; ?></div>
								</div>
								<div class="row">
									<label for="gender" class="col-xs-4">Jenis Kelamin : </label>
									<div class="col-xs-8"><?php echo indo_gender($patient->gender); ?></div>
								</div>
								<div class="row">
									<label for="address" class="col-xs-4">Alamat :</label>
									<div class="col-xs-8"><?php echo $patient->address; ?></div>
								</div>
								<div class="row">
									<label for="blood_type" class="col-xs-4">Golongan Darah :</label>
									<div class="col-xs-8"><?php echo empty_string(strtoupper($patient->blood_type), '-'); ?></div>
								</div>
								<div class="row">
									<label for="place_of_birth" class="col-xs-4">Tempat, Tanggal Lahir :</label>
									<div class="col-xs-8"><?php echo $patient->place_of_birth . ', ' . indo_date($patient->date_of_birth, 'd-m-Y'); ?></div>
								</div>
								<div class="row">
									<label for="telephone" class="col-xs-4">No. Telepon :</label>
									<div class="col-xs-8"><?php echo $patient->telephone; ?></div>
								</div>
								<div class="row">
									<label for="email" class="col-xs-4">Email :</label>
									<div class="col-xs-8"><?php echo empty_string($patient->email, '-'); ?></div>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group text-center">
											<?php
											$img_dir = 'assets/uploads/img/patients/' . $patient->image;
											$img = empty($patient->image) || !file_exists($img_dir) ? 'assets/admin_lte/dist/img/avatar.png' : $img_dir;
											?>
											<img src="<?php echo base_url($img); ?>" alt="" srcset="" class="img-thumbnail">
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div>
							<h4 class="box-title" style="text-align: center;">Rekam Medis Pasien <?php echo $patient->name; ?></h4>
							<hr>
							<table class="table table-striped table-hover">
								<thead>
									<tr style="background-color:turquoise">
										<th>No</th>
										<th>Tanggal Periksa</th>
										<th>Poli</th>
										<th>Dokter</th>
										<th>Komplain</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 0;
									foreach ($checkups as $checkup) {
										$no++; ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo format_date($checkup->date_in, 'd-m-Y H:i'); ?></td>
											<td><?php echo $checkup->poly_name; ?></td>
											<td><?php echo $checkup->doctor_name; ?></td>
											<td><?php echo $checkup->complaint; ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>