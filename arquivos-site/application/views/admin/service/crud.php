<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-wrench"></i> Página Serviços
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-wrench"></i> Página Serviços
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
                    <?= form_open_multipart("admin/service/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title_one') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_one">Título 1 (cinza)<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_one')) {
                                    $value = set_value('title_one');
                                } else if (isset($service)) {
                                    $value = $service->title_one;
                                }
                                ?>
                                <input name="title_one" id="title_one" type="text" value="<?= $value ?>" placeholder="Serviços para otimizar a" class="form-control input-sm maxlength" maxlength="50" required autofocus="">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('title_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_two">Título 2 (parte vermelha)<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_two')) {
                                    $value = set_value('title_two');
                                } else if (isset($service)) {
                                    $value = $service->title_two;
                                }
                                ?>
                                <input name="title_two" id="title_two" type="text" value="<?= $value ?>" placeholder="migração para a nuvem" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-12 <?= form_error('subtitle') ? 'has-error' : '' ?>">
                                <label class="control-label" for="subtitle">Subtítulo<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('subtitle')) {
                                    $value = set_value('subtitle');
                                } else if (isset($service)) {
                                    $value = $service->subtitle;
                                }
                                ?>
                                <textarea name="subtitle" id="subtitle" class="editor-small" placeholder="Na Brascloud, você tem apoio para DIAGNOSTICAR, PLANEJAR, EXECUTAR e MAXIMIZAR sua jornada na nuvem"><?=$value?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-12 <?= form_error('image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image">Imagem Desktop<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?= DESK_W ?>px X <?= DESK_H ?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($service) ? $service->image : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="image" id="image" onchange="$('#image_filename').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($service) ? 'required' : NULL ?>>
                                </span>
                                <span id="image_filename"></span>
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
                            <div class="form-group col-md-6 col-xs-12 <?= form_error('image_mobile') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image_mobile">Imagem Mobile<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?= MOB_W ?>px X <?= MOB_H ?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($service) ? $service->image_mobile : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="image_mobile" id="image" onchange="$('#image_filename_mobile').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($service) ? 'required' : NULL ?>>
                                </span>
                                <span id="image_filename_mobile"></span>
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
