<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-font"></i> Proposta
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-font"></i> Proposta
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
                    <?= form_open_multipart("admin/proposal/save", 'class="form-validate" autocomplete="off"') ?>
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
                                } else if (isset($proposal)) {
                                    $value = $proposal->title;
                                }
                                ?>
                                <input name="title" id="title" type="text" value="<?= $value ?>" placeholder="Modelo de proposta" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                            </div>
                            <div class="form-group col-md-4 <?= form_error('name') ? 'has-error' : '' ?>">
                                <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('name')) {
                                    $value = set_value('name');
                                } else if (isset($proposal)) {
                                    $value = $proposal->name;
                                }
                                ?>
                                <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Nome do responsável" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('job') ? 'has-error' : '' ?>">
                                <label class="control-label" for="job">Cargo<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('job')) {
                                    $value = set_value('job');
                                } else if (isset($proposal)) {
                                    $value = $proposal->job;
                                }
                                ?>
                                <input name="job" id="job" type="text" value="<?= $value ?>" placeholder="Cargo do responsável" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('subtitle') ? 'has-error' : '' ?>">
                                <label class="control-label" for="subtitle">Sub-título<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('subtitle')) {
                                    $value = set_value('subtitle');
                                } else if (isset($proposal)) {
                                    $value = $proposal->subtitle;
                                }
                                ?>
                                <textarea name="subtitle" id="subtitle" class="editor" required><?= $value ?></textarea>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('description') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description">Descrição<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('description')) {
                                    $value = set_value('description');
                                } else if (isset($proposal)) {
                                    $value = $proposal->description;
                                }
                                ?>
                                <textarea name="description" id="description" class="editor" required><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('image_signature') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image_signature">Imagem Assinatura <em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?=DESK_W?>px X <?=DESK_H?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = '';
                                if (set_value('image_signature')) {
                                    $value = set_value('image_signature');
                                } else if (isset($proposal)) {
                                    $value = $proposal->image_signature;
                                }
                                ?>
                                <label class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Selecionar imagem
                                    <input type="file" name="image_signature" id="image_signature" class="hidden" accept=".jpg,.png,.gif,.jpeg" onchange="$('#image_signature_name').html(get_name($(this).val()))" <?= !isset($proposal) ? 'required' : '' ?>>
                                </label>
                                <span id="image_signature_name"></span>
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
