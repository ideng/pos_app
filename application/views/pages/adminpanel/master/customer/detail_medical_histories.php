<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master' ;
$colors = ['default', 'primary', 'success', 'info', 'warning', 'danger'];
shuffle($colors);
?>

<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
<div class="panel box box-<?php echo $colors[0]; ?>">
	<div class="box-header with-border">
		<h4 class="box-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id; ?>">
				Checkup #<?php echo $medical_record_id; ?>
			</a>
		</h4>
	</div>
	<div id="collapse<?php echo $id; ?>" class="panel-collapse collapse <?php echo $is_in; ?>">
		<div class="box-body">
			<!-- START CUSTOM TABS -->
			<div class="row">
				<div class="col-md-12">
					<!-- Custom Tabs -->
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1<?php echo $id; ?>" data-toggle="tab">Checkup</a></li>
							<li><a href="#tab_2<?php echo $id; ?>" data-toggle="tab">Diagnosa</a></li>
							<li><a href="#tab_3<?php echo $id; ?>" data-toggle="tab">Obat</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1<?php echo $id; ?>">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="poly_name">Nama Poli : </label>
											<?php echo $poly_name; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="doctor_name">Nama Dokter : </label>
											<?php echo $doctor_name; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="date_in">Tanggal Checkup : </label>
											<?php echo format_date($date_in, 'd-m-Y H:i:s'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="complaint">Keluhan : </label>
											<?php echo $complaint; ?>
										</div>
									</div>
								</div>
							</div><!-- /.tab-pane -->
							<div class="tab-pane" id="tab_2<?php echo $id; ?>">
								<?php
                                if (!empty($diagnose_id)) {
                                    ?>
									<div class="row">
										<div class="col-xs-12">
											<div class="form-group">
												<label for="diagnose_date">Tanggal Diagnosa : </label>
												<?php echo format_date($diagnose_date, 'd-m-Y'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<div class="form-group">
												<label for="description">Deskripsi : </label>
												<?php echo $description; ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<div class="form-group">
												<label for="diagnose_date">Total Bayar : </label>
												<?php echo number_format((float) $total_price, '2', ',', '.'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<div class="form-group">
												<label for="diagnose_date">Status : </label>
												<?php echo checkup_flag($flag); ?>
											</div>
										</div>
									</div>
									<?php
                                } else {
                                    ?>
									<div class="row">
										<div class="col-xs-12">
											<div class="form-group">
												<label for="diagnose_date">Belum Ada Data Diagnosa...</label><br>
												<?php echo checkup_flag(''); ?>
											</div>
										</div>
									</div>
									<?php
                                }
                                ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane" id="tab_3<?php echo $id; ?>">
								<?php
                                if (!empty($diagnose_id)) {
                                    ?>
									<table class="table table-bordered table-striped table-hover">
										<thead>	
											<tr>
												<th>Nama</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<?php
                                        $drug_sale[$diagnose_id] = false;
                                    foreach ($diagnosedrug_sales as $diagnosedrug_sale) {
                                        if ($diagnosedrug_sale->diagnose_id == $diagnose_id) {
                                            $drug_sale[$diagnose_id] = true; ?>
												<tr>
													<div class="row">
														<td>
															<div class="col xs-3">
																<?php echo $diagnosedrug_sale->name; ?>
															</div>
														</td>
														<td>
															<div class="col xs-3">
																<?php echo number_format((float) $diagnosedrug_sale->price, '2', ',', '.'); ?>
															</div>
														</td>
														<td>
															<div class="col xs-3">
																<?php echo $diagnosedrug_sale->quantity; ?>
															</div>
														</td>
														<td>
															<div class="col xs-3">
																<?php echo number_format((float) $diagnosedrug_sale->subtotal, '2', ',', '.'); ?>
															</div>
														</td>
													</div>
												</tr>
												<?php
                                        }
                                    }

                                    if (!$drug_sale[$diagnose_id]) {
                                        foreach ($diagnose_drugs as $diagnose_drug) {
                                            if ($diagnose_drug->diagnose_id == $diagnose_id) {
                                                $drug_sale[$diagnose_id] = true; ?>
													<tr>
														<div class="row">
															<td>
																<div class="col xs-3">
																	<?php echo $diagnose_drug->drug_name; ?>
																</div>
															</td>
															<td>
																<div class="col xs-3">
																	<?php echo number_format((float) $diagnose_drug->price, '2', ',', '.'); ?>
																</div>
															</td>
															<td>
																<div class="col xs-3">
																	<?php echo $diagnose_drug->quantity; ?>
																</div>
															</td>
															<td>
																<div class="col xs-3">
																	<?php
                                                                    $subtotal = $diagnose_drug->price * $diagnose_drug->quantity;
                                                echo number_format((float) $subtotal, '2', ',', '.'); ?>
																</div>
															</td>
														</div>
													</tr>
													<?php
                                            }
                                        }
                                    } ?>
									</table>
									<?php
                                } else {
                                    ?>
									<div class="row">
										<div class="col-xs-12">
											<div class="form-group">
												<label for="diagnose_date">Belum Ada Data Diagnosa...</label><br>
												<?php echo checkup_flag(''); ?>
											</div>
										</div>
									</div>
									<?php
                                }
                                ?>
							</div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
					</div><!-- nav-tabs-custom -->
				</div><!-- /.col -->
			</div> <!-- /.row -->
			<!-- END CUSTOM TABS -->
		</div>
	</div>
</div>
