<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-font"></i> Home - Textos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-font"></i> Home - Textos
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-plus"></i> Cadastro
                        </h3>
                    </div>
                    <?= form_open_multipart("admin/text_home/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-6 col-md-push-3 <?= form_error('title_plans') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_plans">Título Planos<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_plans')) {
                                    $value = set_value('title_plans');
                                } else if (isset($text_home)) {
                                    $value = $text_home->title_plans;
                                }
                                ?>
                                <input name="title_plans" id="title_plans" type="text" value="<?= $value ?>" placeholder="Escolha o plano e crie sua conta Brascloud" class="form-control input-sm maxlength" maxlength="100" required autofocus="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('title_rules') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_rules">Título Simular<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_rules')) {
                                    $value = set_value('title_rules');
                                } else if (isset($text_home)) {
                                    $value = $text_home->title_rules;
                                }
                                ?>
                                <input name="title_rules" id="title_rules" type="text" value="<?= $value ?>" placeholder="Simule um plano" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('transfer') ? 'has-error' : '' ?>">
                                <label class="control-label" for="transfer">Transferência<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('transfer')) {
                                    $value = set_value('transfer');
                                } else if (isset($text_home)) {
                                    $value = $text_home->transfer;
                                }
                                ?>
                                <input name="transfer" id="transfer" type="text" value="<?= $value ?>" placeholder="Ex.: 1 TB" class="form-control input-sm maxlength" maxlength="10" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('text_billing') ? 'has-error' : '' ?>">
                                <label class="control-label" for="text_billing">Texto Billing<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('text_billing')) {
                                    $value = set_value('text_billing');
                                } else if (isset($text_home)) {
                                    $value = $text_home->text_billing;
                                }
                                ?>
                                <input name="text_billing" id="text_billing" type="text" value="<?= $value ?>" placeholder="Valor pode sofrer modificações...." class="form-control input-sm maxlength" maxlength="55" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title_why_choose') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_why_choose">Título "Por que escolher"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_why_choose')) {
                                    $value = set_value('title_why_choose');
                                } else if (isset($text_home)) {
                                    $value = $text_home->title_why_choose;
                                }
                                ?>
                                <textarea name="title_why_choose" id="title_why_choose" required placeholder="Por que escolher a Brascloud como sua nuvem?" class="editor"><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('text_ticketing') ? 'has-error' : '' ?>">
                                <label class="control-label" for="text_ticketing">Hover 'Como bilhetamos sua conta'<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('text_ticketing')) {
                                    $value = set_value('text_ticketing');
                                } else if (isset($text_home)) {
                                    $value = $text_home->text_ticketing;
                                }
                                ?>
                                <textarea name="text_ticketing" id="text_ticketing" required placeholder="Hover do botão 'Como bilhetamos sua conta'" class="editor"><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('video') ? 'has-error' : '' ?>">
                                <label class="control-label" for="video">Vídeo <i class="fa fa-info-circle title" title="O código do vídeo pode ser encontrado no final da URL"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('video')) {
                                    $value = set_value('video');
                                } else if (isset($text_home)) {
                                    $value = $text_home->video;
                                }
                                ?>
                                <div class="input-group">
                                    <span class="input-group-addon">https://youtube.com/watch?v=</span>
                                    <input name="video" id="video" type="text" value="<?= $value ?>" placeholder="Código do vídeo" class="form-control input-sm maxlength" maxlength="30" onchange="$('iframe').prop('src', 'https://youtube.com/embed/' + $(this).val()).show()">
                                </div>
                                <iframe style="width: 100%; height: 250px" frameborder="0" <?= $value ? "src=\"https://youtube.com/embed/$value\"" : 'hidden' ?>></iframe>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('text_video') ? 'has-error' : '' ?>">
                                <label class="control-label" for="text_video">Texto Vídeo</label><br>
                                <?
                                $value = '';
                                if (set_value('text_video')) {
                                    $value = set_value('text_video');
                                } else if (isset($text_home)) {
                                    $value = $text_home->text_video;
                                }
                                ?>
                                <input name="text_video" id="text_video" type="text" value="<?= $value ?>" placeholder="Texto lateral ao vídeo" class="form-control input-sm maxlength" maxlength="55">
                            </div>
                            <div class="form-group col-md-4">
                                <div data-min_width="<?= DESK_W ?>" data-min_height="<?= DESK_H ?>" class="row cropper_container <?= form_error('image') ? 'has-error' : '' ?>">
                                    <div class="col-xs-12">
                                        <label class="control-label">
                                            Imagem <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?=DESK_W?>px X <?=DESK_H?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" type="file" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="image" ></textarea>
                                    </div>
                                </div>
                                <? $value = isset($text_home) ? $text_home->cover : NULL ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($text_home->cover) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </button>
                            <button type="reset" class="btn btn-warning btn-sm">
                                <span class="glyphicon glyphicon-refresh"></span> Limpar
                            </button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
