<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$start_at = format_date($daily_schedule->date . ' ' . $daily_schedule->start_at, 'Y-m-d H:i');
$end_at = format_date($daily_schedule->date . ' ' . $daily_schedule->end_at, 'Y-m-d H:i');
$current_date = !empty($checkup->date_in) ? format_date($checkup->date_in, 'Y-m-d H:i') : NULL;
$is_readonly = strtotime(date('Y-m-d H:i')) > strtotime($end_at) && (empty($checkup->flag) || $checkup->flag != 'pending') ? 'readonly' : 'required';
$alert = build_alert('warning', 'Peringatan!', 'Maaf Waktu Checkup tidak sesuai!');
?>

<form method="POST" id="formBooking">
    <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_value; ?>">
    <input type="hidden" name="id" value="<?php echo $checkup->id; ?>">
    <input type="hidden" name="poly_id" value="<?php echo $daily_schedule->poly_id; ?>">
    <input type="hidden" name="doctor_id" value="<?php echo $daily_schedule->doctor_id; ?>">
    <input type="hidden" name="patient_id" value="<?php echo $patient->id; ?>">
    <input type="hidden" name="date_in" value="<?php echo $daily_schedule->date; ?>">
    <?php
    if (strtotime(date('Y-m-d H:i')) > strtotime($end_at)) {
        echo $alert;
    }
    if (!empty($current_date)) {
        ?>
        <div class="form-group">
            <label for="booking_date">Waktu Booking : </label>
            <?php echo $current_date; ?>
        </div>
    <?php
        if ($checkup->flag == 'pending') {
            echo build_alert('warning', 'Peringatan!', 'Apakah Anda yakin akan mengubah data booking checkup?');
        } else {
            echo build_alert('warning', 'Peringatan!', 'Checkup sudah dikonfirmasi pihak Rumah Sakit, Anda tidak bisa mengubah data booking!');
        }
    }
    ?>
    <div class="form-group">
        <label for="patient_name">Nama Pasien : </label>
        <?php echo $patient->name; ?>
    </div>
    <div class="form-group">
        <label for="patient_name">Nama Poli : </label>
        <?php echo $daily_schedule->poly_name; ?>
    </div>
    <div class="form-group">
        <label for="patient_name">Nama Dokter : </label>
        <?php echo $daily_schedule->doctor_name; ?>
    </div>
    <div class="form-group">
        <label for="patient_name">Tanggal Checkup : </label>
        <?php echo indo_date($daily_schedule->date, 'd-m-Y'); ?>
    </div>
    <div class="form-group">
        <input type="hidden" name="medical_record_id" id="medical_record_id" class="form-control" placeholder="No. Rekam Medis" value="<?php echo $checkup->medical_record_id; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="time_in">Waktu Checkup (<?php echo format_date($start_at, 'H:i') . ' - ' . format_date($end_at, 'H:i'); ?>)</label>
        <input type="text" name="time_in" id="time_in" class="form-control datetimepicker" placeholder="Waktu Checkup" value="<?php echo format_date($checkup->date_in, 'H:i'); ?>" <?php echo $is_readonly; ?>>
    </div>
    <div class="form-group">
        <label for="complaint">Keluhan</label>
        <textarea name="complaint" id="complaint" cols="30" rows="10" class="form-control" placeholder="Keluhan" <?php echo $is_readonly; ?>><?php echo $checkup->complaint; ?></textarea>
    </div>
    <?php
    if ($is_readonly != 'readonly') {
        ?>
        <div class="modal-footer">
            <button type="reset" class="btn btn-warning btn-flat">Reset</button>
            <button type="submit" class="btn btn-primary btn-flat">Booking</button>
        </div>
    <?php
    }
    ?>
</form>

<script>
    $('.datetimepicker').datetimepicker({
        'format': 'hh:mm',
        'minDate': '<?php echo $start_at; ?>',
        'maxDate': '<?php echo $end_at; ?>',
    });
</script>