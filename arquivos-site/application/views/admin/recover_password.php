<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=PROJECT?> | Recuperar Senha</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/admin-lte/dist/css/AdminLTE.min.css') ?>">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= site_url() ?>">
                    <img src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/images/logo.png') ?>" style="max-width: 70%">
                </a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Informe o e-mail cadastrado</p>
                <?= form_open('admin/login/send_email_recovery', 'class="form-validate" autocomplete="off"') ?>
                <div class="form-group has-feedback">
                    <input class="form-control" placeholder="E-mail" name="email" type="email" required="" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
                    </div>
                </div>
                <?= form_close() ?>
                <a href="<?= site_url('admin') ?>">Voltar</a><br>
            </div>
        </div>
        <script src="<?= base_url('assets/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
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
        <script src="<?= base_url('assets/jquery-validate/jquery.validate.min.js') ?>"></script>
        <script src="<?= base_url('assets/jquery-validate/localization/messages_pt_BR.js') ?>"></script>

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
        <script src="<?= base_url('assets/admin-lte/plugins/chartjs/Chart.min.js') ?>"></script>
        <script src="<?= base_url('assets/fileUpload/jquery.uploadfile.min.js') ?>"></script>
        <script src="<?= base_url('assets/bootstrap3-editable/js/bootstrap-editable.min.js') ?>"></script>
        <script src="<?= base_url('assets/numeral-js/numeral.min.js') ?>"></script>
        <script src="<?= base_url('assets/numeral-js/languages/pt-br.min.js') ?>"></script>
        <script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/js/bootstrap.maxlength.js') ?>"></script>
        <script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/js/jquery.maskMoney.min.js') ?>"></script>
        <script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/js/scripts.js') ?>"></script>
        <?
        $msg = $this->session->flashdata('successmsg');
        if ($msg) {
            ?>
            <script>
                generate_message('success', '<?= $msg ?>');
            </script>
            <?
        }
        $msg = $this->session->flashdata('errormsg');
        if ($msg) {
            ?>
            <script>
                generate_message('error', '<?= $msg ?>');
            </script>
            <?
        }
        $msg = $this->session->flashdata('infomsg');
        if ($msg) {
            ?>
            <script>
                generate_message('information', '<?= $msg ?>');
            </script>
        <? } ?>
    </body>
</html>
