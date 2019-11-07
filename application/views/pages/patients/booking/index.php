<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$title = isset($page) ? ucwords($page) : 'Master' ;
?>

<section class="content view-container">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-alert" style="display: none;"></div>
            <div class="box-loader text-center" style="display: none;">
                <i class="fa fa-spinner fa-2x fa-pulse text-primary"></i>
            </div>
            <input type="hidden" name="base_url" value="<?php echo base_url(); ?>">
            <input type="hidden" name="url" value="<?php echo base_url($class_link); ?>">
            <input type="hidden" name="page" value="<?php echo $class_link; ?>">
            <input type="hidden" name="date_now" value="<?php echo date('Y-m-d'); ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-schedule-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="scheduleModalLabel">Form Booking Checkup</h4>
            </div>
            <div class="modal-body">
                <div class="modal-alert" style="display: none;"></div>
                <div class="modal-loader text-center">
                    <i class="fa fa-spinner fa-2x fa-pulse text-primary"></i>
                </div>
                <div class="modal-container" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>
