<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-bolt"></i> Startup
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-bolt"></i> Startup
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
                    <?= form_open_multipart("admin/startup/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-7">
                                <div data-min_width="<?= DESK_W ?>" data-min_height="<?= DESK_H ?>" class="row cropper_container <?= form_error('image') ? 'has-error' : '' ?>">
                                    <div class="col-md-10">
                                        <label class="control-label" for="image">
                                            Imagem<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= DESK_W ?>px X <?= DESK_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" id="image" type="file" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar Imagem
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="" style="max-width: 100%">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="image" <?= !isset($startup) ? 'required' : '' ?>><?= set_value('image') ?></textarea>
                                    </div>
                                </div>
                                <? $value = isset($startup) ? $startup->image : '' ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="form-group col-md-5">
                                <div data-min_width="<?= MOB_W ?>" data-min_height="<?= MOB_H ?>" class="row cropper_container <?= form_error('image_mobile') ? 'has-error' : '' ?>">
                                    <div class="col-xs-12">
                                        <label class="control-label" for="image_mobile">
                                            Imagem Mobile<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= MOB_W ?>px X <?= MOB_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" id="image_mobile" type="file" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar Imagem
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="" style="max-width: 100%">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="image_mobile" <?= !isset($startup) ? 'required' : '' ?>><?= set_value('image_mobile') ?></textarea>
                                    </div>
                                </div>
                                <? $value = isset($startup) ? $startup->image_mobile : '' ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title">Título<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title')) {
                                    $value = set_value('title');
                                } else if (isset($startup)) {
                                    $value = $startup->title;
                                }
                                ?>
                                <textarea name="title" id="title" class="editor-small" placeholder="Acreditamos no potencial das startups porque um dia..." required><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('title_offer') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_offer">Título Oferta<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_offer')) {
                                    $value = set_value('title_offer');
                                } else if (isset($startup)) {
                                    $value = $startup->title_offer;
                                }
                                ?>
                                <textarea name="title_offer" id="title_offer" class="editor-small" placeholder="O que a Brascloud tem a oferecer? Benefícios" required><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('code') ? 'has-error' : '' ?>">
                                <label class="control-label" for="code">Cupom promocional<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('code')) {
                                    $value = set_value('code');
                                } else if (isset($startup)) {
                                    $value = $startup->code;
                                }
                                ?>
                                <input name="code" id="code" type="number" class="input-sm form-control" placeholder="Informe o código promocional" required value="<?= $value ?>">
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
