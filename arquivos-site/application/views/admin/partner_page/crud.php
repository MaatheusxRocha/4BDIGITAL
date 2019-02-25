<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-star"></i> Página Parceiros
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-star"></i> Página Parceiros
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
                    <?= form_open_multipart("admin/partner_page/save", 'class="form-validate" autocomplete="off"') ?>
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
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->title;
                                }
                                ?>
                                <textarea name="title" id="title" placeholder="O sucesso se constroi em conjunto. Seja um parceiro da Brascloud." class="editor-small" required><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-8">
                                <div data-min_width="<?= TOP_W ?>" data-min_height="<?= TOP_H ?>" class="row cropper_container <?= form_error('image_top') ? 'has-error' : '' ?>">
                                    <div class="col-md-10">
                                        <label class="control-label" for="image_top">
                                            Imagem do Topo<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= TOP_W ?>px X <?= TOP_H ?>px ou maior proporcionalmente"></i>
                                        </label><br>
                                        <label class="btn btn-primary">
                                            <input class="hide" id="image_top" type="file" accept=".jpg, .png, .gif, .jpeg">
                                            Selecionar Imagem
                                        </label>
                                        <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12" style="padding: 5px;">
                                        <img src="" style="max-width: 100%">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea hidden name="image_top" <?= !isset($partner_page) ? 'required' : '' ?>><?= set_value('image_top') ?></textarea>
                                    </div>
                                </div>
                                <? $value = isset($partner_page) ? $partner_page->image_top : '' ?>
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
                        <div class="row">
                            <div class="form-group col-md-12 <?= form_error('description') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description">Descrição<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('description')) {
                                    $value = set_value('description');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->description;
                                }
                                ?>
                                <textarea name="description" id="description" class="editor" placeholder="Construímos nossa própria cloud pública e desenvolvemos uma..." required><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image">Imagem Principal<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= DESK_W ?>px X <?= DESK_H ?>px ou maior proporcionalmente"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('image')) {
                                    $value = set_value('image');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->image;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="image" id="image" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#image_name').html(get_name($(this).val()))" <?= !isset($partner_page) ? 'required' : '' ?>>
                                </label>
                                <span id="image_name"></span>
                                <? if ($value) { ?>
                                    <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                <? } ?>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('image_mobile') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image_mobile">Imagem Mobile<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= MOB_W ?>px X <?= MOB_H ?>px ou maior proporcionalmente"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('image_mobile')) {
                                    $value = set_value('image_mobile');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->image_mobile;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="image_mobile" id="image_mobile" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#image_mobile_name').html(get_name($(this).val()))" <?= !isset($partner_page) ? 'required' : '' ?>>
                                </label>
                                <span id="image_mobile_name"></span>
                                <? if ($value) { ?>
                                    <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                <? } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="form-group col-md-6 <?= form_error('commercial_image') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="commercial_image">Imagem Comercial<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= COMMERCIAL_W ?>px X <?= COMMERCIAL_H ?>px ou maior proporcionalmente"></i></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('commercial_image')) {
                                            $value = set_value('commercial_image');
                                        } else if (isset($partner_page)) {
                                            $value = $partner_page->commercial_image;
                                        }
                                        ?>
                                        <label class="btn btn-sm btn-primary">
                                            <i class="fa fa-upload"></i> Selecionar imagem
                                            <input type="file" name="commercial_image" id="commercial_image" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#commercial_image_name').html(get_name($(this).val()))" <?= !isset($partner_page) ? 'required' : '' ?>>
                                        </label>
                                        <span id="commercial_image_name"></span>
                                        <? if ($value) { ?>
                                            <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                        <? } ?>
                                    </div>
                                    <div class="form-group col-md-6 <?= form_error('commercial_image_mobile') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="commercial_image_mobile">Imagem Comercial Mobile<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= COMMERCIAL_MOB_W ?>px X <?= COMMERCIAL_MOB_H ?>px ou maior proporcionalmente"></i></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('commercial_image_mobile')) {
                                            $value = set_value('commercial_image_mobile');
                                        } else if (isset($partner_page)) {
                                            $value = $partner_page->commercial_image_mobile;
                                        }
                                        ?>
                                        <label class="btn btn-sm btn-primary">
                                            <i class="fa fa-upload"></i> Selecionar imagem
                                            <input type="file" name="commercial_image_mobile" id="commercial_image_mobile" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#commercial_image_mobile_name').html(get_name($(this).val()))" <?= !isset($partner_page) ? 'required' : '' ?>>
                                        </label>
                                        <span id="commercial_image_mobile_name"></span>
                                        <? if ($value) { ?>
                                            <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="form-group col-xs-12 <?= form_error('commercial_description_one') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="commercial_description_one">Comercial Cinza<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('commercial_description_one')) {
                                            $value = set_value('commercial_description_one');
                                        } else if (isset($partner_page)) {
                                            $value = $partner_page->commercial_description_one;
                                        }
                                        ?>
                                        <textarea name="commercial_description_one" id="commercial_description_one" rows="4" required class="form-control input-sm maxlength" placeholder="Nossa relação comercial com nossos parceiros..." maxlength="200" required><?= $value ?></textarea>
                                    </div>
                                    <div class="form-group col-xs-12 <?= form_error('commercial_description_two') ? 'has-error' : '' ?>">
                                        <label class="control-label" for="commercial_description_two">Comercial Vermelho<em class="text-danger">*</em></label><br>
                                        <?
                                        $value = '';
                                        if (set_value('commercial_description_two')) {
                                            $value = set_value('commercial_description_two');
                                        } else if (isset($partner_page)) {
                                            $value = $partner_page->commercial_description_two;
                                        }
                                        ?>
                                        <textarea name="commercial_description_two" id="commercial_description_two" rows="4" required class="form-control input-sm maxlength" placeholder="Utilize nossa cloud, conquiste seus..." maxlength="200" required><?= $value ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-md-push-3 <?= form_error('advantage_title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="advantage_title">Título Vantagens<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('advantage_title')) {
                                    $value = set_value('advantage_title');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->advantage_title;
                                }
                                ?>
                                <input type="text" name="advantage_title" id="advantage_title" class="form-control input-sm maxlength" placeholder="Vantagens de ser parceiro" maxlength="100" required value="<?= $value ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-md-push-3 <?= form_error('easy_title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="easy_title">Título Facilidade<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('easy_title')) {
                                    $value = set_value('easy_title');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->easy_title;
                                }
                                ?>
                                <input type="text" name="easy_title" id="easy_title" class="form-control input-sm maxlength" placeholder="Veja como é fácil ser um parceiro BRASCLOUD" maxlength="100" required value="<?= $value ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('easy_image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="easy_image">Imagem Facilidade<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= EASY_W ?>px X <?= EASY_H ?>px ou maior proporcionalmente"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('easy_image')) {
                                    $value = set_value('easy_image');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->easy_image;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="easy_image" id="easy_image" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#easy_image_name').html(get_name($(this).val()))" <?= !isset($partner_page) ? 'required' : '' ?>>
                                </label>
                                <span id="easy_image_name"></span>
                                <? if ($value) { ?>
                                    <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                <? } ?>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('easy_image_mobile') ? 'has-error' : '' ?>">
                                <label class="control-label" for="easy_image_mobile">Imagem Facilidade Mobile<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= EASY_MOB_W ?>px X <?= EASY_MOB_H ?>px ou maior proporcionalmente"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('easy_image_mobile')) {
                                    $value = set_value('easy_image_mobile');
                                } else if (isset($partner_page)) {
                                    $value = $partner_page->easy_image_mobile;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="easy_image_mobile" id="easy_image_mobile" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#easy_image_mobile_name').html(get_name($(this).val()))" <?= !isset($partner_page) ? 'required' : '' ?>>
                                </label>
                                <span id="easy_image_mobile_name"></span>
                                <? if ($value) { ?>
                                    <img src="<?= base_url($value) ?>" style="max-width: 100%">
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
