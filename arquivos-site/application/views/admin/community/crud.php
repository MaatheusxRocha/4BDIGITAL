<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Comunidade
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-users"></i> Comunidade
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
                    <?= form_open_multipart("admin/community/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title_one') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_one">Título Cinza<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_one')) {
                                    $value = set_value('title_one');
                                } else if (isset($community)) {
                                    $value = $community->title_one;
                                }
                                ?>
                                <input type="text" name="title_one" id="title_one" class="form-control input-sm maxlength" maxlength="50" placeholder="Diversas plataformas para" required value="<?= $value ?>" autofocus>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('title_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_two">Título Vermelho<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_two')) {
                                    $value = set_value('title_two');
                                } else if (isset($community)) {
                                    $value = $community->title_two;
                                }
                                ?>
                                <input type="text" name="title_two" id="title_two" class="form-control input-sm maxlength" maxlength="50" placeholder="despertar curiosidade e esclarecer suas dúvidas" required value="<?= $value ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('subtitle') ? 'has-error' : '' ?>">
                                <label class="control-label" for="subtitle">Subtítulo<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('subtitle')) {
                                    $value = set_value('subtitle');
                                } else if (isset($community)) {
                                    $value = $community->subtitle;
                                }
                                ?>
                                <textarea name="subtitle" id="subtitle" class="form-control input-sm" placeholder="Além de profissionais despoiníveis quando você precisar, a Brascloud..." required><?= $value ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('video_text') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="video_text">Texto do Vídeo</label><br>
                                        <?
                                        $value = '';
                                        if (set_value('video_text')) {
                                            $value = set_value('video_text');
                                        } else if (isset($community)) {
                                            $value = $community->video_text;
                                        }
                                        ?>
                                        <input type="text" name="video_text" id="video_text" class="form-control input-sm maxlength" maxlength="70" placeholder="Veja mais vídeos técnicos de como operar nossa cloud." value="<?= $value ?>">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <div data-min_width="<?= VIDEO_W ?>" data-min_height="<?= VIDEO_H ?>" class="row cropper_container <?= form_error('video_cover') ? 'has-error' : '' ?>">
                                            <div class="col-md-10">
                                                <label class="control-label" for="video_cover">
                                                    Imagem de Capa <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= VIDEO_W ?>px X <?= VIDEO_H ?>px ou maior proporcionalmente"></i>
                                                </label><br>
                                                <label class="btn btn-primary">
                                                    <input class="hide" id="video_cover" type="file" accept=".jpg, .png, .gif, .jpeg">
                                                    Selecionar Imagem
                                                </label>
                                                <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-xs-12">
                                                <img src="" style="max-width: 100%">
                                            </div>
                                            <div class="col-xs-12">
                                                <textarea hidden name="video_cover"><?= set_value('video_cover') ?></textarea>
                                            </div>
                                        </div>
                                        <? $value = isset($community) ? $community->video_cover : '' ?>
                                        <? if ($value) { ?>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <a href="<?= site_url($value) ?>" target="_blank">
                                                        <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                                    </a>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('video') ? 'has-error' : '' ?>">
                                <label class="control-label" for="video">Código do Vídeo</label><br>
                                <?
                                $value = set_value('video');
                                if (!$value && isset($community)) {
                                    $value = $community->video;
                                }
                                ?>
                                <div class="input-group">
                                    <span class="input-group-addon">https://youtube.com/watch?v=</span>
                                    <input name="video" id="video" type="text" title="O código é a parte final da URL" value="<?= $value ?>" placeholder="Complete o link" class="form-control input-sm title maxlength" maxlength="30" onchange="$('iframe').prop('src', 'https://youtube.com/embed/'+$(this).val()).show()">
                                </div>
                                <iframe style="width: 100%; height: 300px" frameborder="0" <?= isset($community) && $community->video ? "src=\"https://youtube.com/embed/$community->video\"" : 'hidden' ?>></iframe>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('blog_text') ? 'has-error' : '' ?>">
                                <label class="control-label" for="blog_text">Texto "Blog"</label><br>
                                <?
                                $value = '';
                                if (set_value('blog_text')) {
                                    $value = set_value('blog_text');
                                } else if (isset($community)) {
                                    $value = $community->blog_text;
                                }
                                ?>
                                <textarea name="blog_text" id="blog_text" rows="3" class="form-control input-sm maxlength" maxlength="130" placeholder="Quer saber mais sobre o universo das clouds e..."><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('wiki_text') ? 'has-error' : '' ?>">
                                <label class="control-label" for="wiki_text">Texto "Wiki"</label><br>
                                <?
                                $value = '';
                                if (set_value('wiki_text')) {
                                    $value = set_value('wiki_text');
                                } else if (isset($community)) {
                                    $value = $community->wiki_text;
                                }
                                ?>
                                <textarea name="wiki_text" id="wiki_text" rows="3" class="form-control input-sm maxlength" maxlength="130" placeholder="Texto sobre a wiki"><?= $value ?></textarea>
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
