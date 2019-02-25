<!--<footer class="main-footer">
     To the right 
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
     Default to the left 
    <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
</footer>-->
<div class="control-sidebar-bg"></div>
</div>

<!-- REQUIRED JS SCRIPTS -->
<!-- jQueryUI -->
<script src="<?= base_url('assets/admin-lte/plugins/jQueryUI/jquery-ui.min.js') ?>"></script>
<script>
    /*** Handle jQuery plugin naming conflict between jQuery UI and Bootstrap ***/
    $.widget.bridge('uibutton', $.ui.button);
    $.widget.bridge('uitooltip', $.ui.tooltip);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="<?= base_url('assets/admin-lte/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/admin-lte/dist/js/app.min.js') ?>"></script>

<!-- iCheck -->
<script src="<?= base_url('assets/admin-lte/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- Noty -->
<script src="<?= base_url('assets/noty/packaged/jquery.noty.packaged.min.js') ?>"></script>

<!-- Validation-->
<script src="<?= base_url('assets/jquery-validate/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery-validate/additional-methods.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery-validate/localization/messages_pt_BR.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery-validate/localization/methods_pt.min.js') ?>"></script>

<!-- InputMask -->
<script src="<?= base_url('assets/admin-lte/plugins/input-mask/jquery.inputmask.min.js') ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.min.js') ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/input-mask/jquery.inputmask.extensions.min.js') ?>"></script>

<!-- Trumbowyg -->
<script src="<?= base_url('assets/trumbowyg/trumbowyg.min.js') ?>"></script>
<script src="<?= base_url('assets/trumbowyg/langs/pt.min.js') ?>"></script>

<!-- DatePicker -->
<script src="<?= base_url('assets/admin-lte/plugins/datepicker/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') ?>"></script>

<!-- Scripts General -->
<script src="<?= base_url('assets/cropper/src/cropper.js') ?>"></script>
<script src="<?= base_url('assets/cropper/js/docs.js') ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/chartjs/Chart.min.js')?>"></script>
<script src="<?= base_url('assets/fileUpload/jquery.uploadfile.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap3-editable/js/bootstrap-editable.min.js') ?>"></script>
<script src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/js/bootstrap.maxlength.js') ?>"></script>
<script src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/js/jquery.maskMoney.min.js') ?>"></script>
<script src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/js/scripts.js') ?>"></script>

<?
$successmsg = $this->session->flashdata('successmsg');
$errormsg = $this->session->flashdata('errormsg');
$warningmsg = $this->session->flashdata('warningmsg');
$infomsg = $this->session->flashdata('infomsg');
?>
<? if ($successmsg) { ?>
    <script>
        generate_message('success', '<?= $successmsg ?>');
    </script>
<? } if ($errormsg) { ?>
    <script>
        generate_message('error', '<?= $errormsg ?>');
    </script>
<? } if ($infomsg) { ?>
    <script>
        generate_message('information', '<?= $infomsg ?>');
    </script>
<? } if ($warningmsg) { ?>
    <script>
        generate_message('warning', '<?= $warningmsg ?>');
    </script>
<? } ?>
</body>
</html>