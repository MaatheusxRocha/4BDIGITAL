<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-male"></i> Página Arquiteto
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-male"></i> Página Arquiteto
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
                    <?= form_open_multipart("admin/architect/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title">Título<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title')) {
                                    $value = set_value('title');
                                } else if (isset($architect)) {
                                    $value = $architect->title;
                                }
                                ?>
                                <textarea name="title" id="title" required placeholder="Quer otimizar o desempenho da sua aplicação na nuvem? fale com nossos arquitetos de cloud" class="editor-small"><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('advantage_title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_rules">Título Vantagens<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('advantage_title')) {
                                    $value = set_value('advantage_title');
                                } else if (isset($architect)) {
                                    $value = $architect->advantage_title;
                                }
                                ?>
                                <input name="advantage_title" id="advantage_title" type="text" value="<?= $value ?>" placeholder="Principais vantagens dos nossos arquitetos" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('topic_title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="topic_title">Título Tópicos<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('topic_title')) {
                                    $value = set_value('topic_title');
                                } else if (isset($architect)) {
                                    $value = $architect->topic_title;
                                }
                                ?>
                                <input name="topic_title" id="topic_title" type="text" value="<?= $value ?>" placeholder="Escolha qual o tópico corresponde à sua dúvida" class="form-control input-sm maxlength" maxlength="80" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div data-min_width="<?= DESK_W ?>" data-min_height="<?= DESK_H ?>" class="row cropper_container <?= form_error('image') ? 'has-error' : '' ?>">
                                    <div class="col-md-11">
                                        <label class="control-label">
                                            Imagem de topo da página <em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= DESK_W ?>px X <?= DESK_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" type="file" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar Imagem
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="image" <?= !isset($architect) ? 'required' : NULL ?>></textarea>
                                    </div>
                                </div>
                                <? $value = isset($architect) ? $architect->image : NULL ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($architect->image) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('topic_image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="topic_image">Imagem de tópico<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?= TOPIC_W ?>px X <?= TOPIC_H ?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($architect) ? $architect->topic_image : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="topic_image" id="image" onchange="$('#image_filename').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($architect) ? 'required' : NULL ?>>
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
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('video_title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="video_title">Título Vídeo</label><br>
                                <?
                                $value = '';
                                if (set_value('video_title')) {
                                    $value = set_value('video_title');
                                } else if (isset($architect)) {
                                    $value = $architect->video_title;
                                }
                                ?>
                                <input name="video_title" id="video_title" type="text" value="<?= $value ?>" placeholder="Assista a uma demonstração técnica do uso da cloud" class="form-control input-sm maxlength" maxlength="100">
                            </div>
                            <div class="form-group col-md-4 <?= form_error('video') ? 'has-error' : '' ?>">
                                <label class="control-label" for="video">Vídeo <i class="fa fa-info-circle title" title="O código do vídeo pode ser encontrado no final da URL"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('video')) {
                                    $value = set_value('video');
                                } else if (isset($architect)) {
                                    $value = $architect->video;
                                }
                                ?>
                                <div class="input-group">
                                    <span class="input-group-addon">https://youtube.com/watch?v=</span>
                                    <input name="video" id="video" type="text" value="<?= $value ?>" placeholder="Código do vídeo" class="form-control input-sm maxlength" maxlength="30" onchange="$('iframe').prop('src', 'https://youtube.com/embed/' + $(this).val()).show()">
                                </div>
                                <iframe style="width: 100%; height: 250px" frameborder="0" <?= $value ? "src=\"https://youtube.com/embed/$value\"" : 'hidden' ?>></iframe>
                            </div>
                            <div class="form-group col-md-4">
                                <div data-min_width="<?= VIDEO_W ?>" data-min_height="<?= VIDEO_H ?>" class="row cropper_container <?= form_error('video_cover') ? 'has-error' : '' ?>">
                                    <div class="col-xs-12">
                                        <label class="control-label">
                                            Imagem de capa Vídeo<i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= VIDEO_W ?>px X <?= VIDEO_H ?>px ou maior proporcionalmente"></i>
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
                                        <textarea hidden name="video_cover" ></textarea>
                                    </div>
                                </div>
                                <? $value = isset($architect) ? $architect->video_cover : NULL ?>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($architect->video_cover) ?>" style="max-width: 100%; margin-top: 5px">
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
