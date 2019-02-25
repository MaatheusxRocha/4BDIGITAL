<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Por que criar uma conta?
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-user-plus"></i> Por que criar uma conta?
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
                    <?= form_open_multipart("admin/account_create/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors() ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title_one') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_one">Título Cinza<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('title_one');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->title_one;
                                }
                                ?>
                                <input type="text" name="title_one" id="title_one" class="input-sm form-control maxlength" maxlength="100" required placeholder="Por que criar uma conta" value="<?= $value ?>">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('title_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_two">Título Vermelho<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('title_two');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->title_two;
                                }
                                ?>
                                <input type="text" name="title_two" id="title_two" class="input-sm form-control maxlength" maxlength="100" required placeholder="Brascloud" value="<?= $value ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('title_left') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_left">Título Amarelo<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('title_left');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->title_left;
                                }
                                ?>
                                <textarea name="title_left" rows="3" id="title_left" class="input-sm form-control maxlength" maxlength="50" required placeholder="E o que a brascloud tem de diferente?"><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-9 <?= form_error('description') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description">Descrição<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('description');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->description;
                                }
                                ?>
                                <textarea name="description" id="description" class="editor" required placeholder="Nosso foco é a inovação e tecnologia. Entretanto..."><?= $value ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('on_demand_left') ? 'has-error' : '' ?>">
                                <label class="control-label" for="on_demand_left">Título On-Demand<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('on_demand_left');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->on_demand_left;
                                }
                                ?>
                                <textarea name="on_demand_left" rows="3" id="on_demand_left" class="input-sm form-control maxlength" maxlength="30" required placeholder="Por que somos On-Demand?"><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-9 <?= form_error('on_demand_right') ? 'has-error' : '' ?>">
                                <label class="control-label" for="on_demand_right">Descrição On-Demand<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('on_demand_right');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->on_demand_right;
                                }
                                ?>
                                <textarea name="on_demand_right" id="on_demand_right" class="editor-small" required placeholder="Somos movidos pelos 4 pilares que..."><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 <?= form_error('on_demand_image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="on_demand_image">Imagem "On-Demand"<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('on_demand_image');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->on_demand_image;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="on_demand_image" id="on_demand_image" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#on_demand_image_name').html(get_name($(this).val()))" <?= !isset($account_create) ? 'required' : '' ?>>
                                </label>
                                <span id="on_demand_image_name"></span><br>
                                <? if ($value) { ?>
                                    <img src="<?= base_url($value) ?>" style="max-width: 100%">
                                <? } ?>
                            </div>
                            <div class="col-md-5 <?= form_error('on_demand_image_mobile') ? 'has-error' : '' ?>">
                                <label class="control-label" for="on_demand_image_mobile">Imagem "On-Demand" Mobile<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('on_demand_image_mobile');
                                if (!$value && isset($account_create)) {
                                    $value = $account_create->on_demand_image_mobile;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="on_demand_image_mobile" id="on_demand_image_mobile" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#on_demand_image_mobile_name').html(get_name($(this).val()))" <?= !isset($account_create) ? 'required' : '' ?>>
                                </label>
                                <span id="on_demand_image_mobile_name"></span><br>
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
