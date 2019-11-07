<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>

<div class="code-generator-view">
    <div class="col-xs-12">
        <div class="row">
            <label for="name" class="col-xs-2">Nama Kode</label>
            <div class="col-xs-10"><?php echo empty_string($row->name, '-'); ?></div>
        </div>
        <div class="row">
            <label for="table" class="col-xs-2">Nama Tabel</label>
            <div class="col-xs-10"><?php echo empty_string($row->table, '-'); ?></div>
        </div>
        <div class="row">
            <label for="column" class="col-xs-2">Nama Kolom</label>
            <div class="col-xs-10"><?php echo empty_string($row->column, '-'); ?></div>
        </div>
        <div class="row">
            <label for="code_format" class="col-xs-2">Format Kode</label>
            <div class="col-xs-10"><?php echo empty_string($row->code_format, '-'); ?></div>
        </div>
        <div class="row">
            <label for="code_reset" class="col-xs-2">Direset Tiap</label>
            <div class="col-xs-10"><?php echo empty_string(ucwords($row->code_reset), '-'); ?></div>
        </div>
        <div class="row">
            <label for="code_sample" class="col-xs-2">Contoh Kode</label>
            <div class="col-xs-10"><?php echo empty_string($code_sample, '-'); ?></div>
        </div>
        <div class="row">
            <label for="created_at" class="col-xs-2">Dibuat Pada</label>
            <div class="col-xs-10"><?php echo empty_string($row->created_at, '-'); ?></div>
        </div>
        <div class="row">
            <label for="updated_at" class="col-xs-2">Diubah Pada</label>
            <div class="col-xs-10"><?php echo empty_string($row->updated_at, '-'); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-2 col-xs-offset-10">
                <button class="btn btn-info btn-flat btn-update" title="Ubah Format Kode" data-toggle="tooltip">
                    <i class="fa fa-pencil"></i> Ubah Format Kode
                </button>
            </div>
        </div>
    </div>
</div>
