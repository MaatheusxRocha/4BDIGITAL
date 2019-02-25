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
                    <?= form_open_multipart("admin/terms/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title">Título<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title')) {
                                    $value = set_value('title');
                                } else if (isset($terms)) {
                                    $value = $terms->title;
                                }
                                ?>
                                <input name="title" id="title" type="text" value="<?= $value ?>" placeholder="Termos legais" class="form-control input-sm maxlength" maxlength="50" required autofocus="">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('subtitle') ? 'has-error' : '' ?>">
                                <label class="control-label" for="subtitle">Subtítulo<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('subtitle')) {
                                    $value = set_value('subtitle');
                                } else if (isset($terms)) {
                                    $value = $terms->subtitle;
                                }
                                ?>
                                <input name="subtitle" id="subtitle" type="text" value="<?= $value ?>" placeholder="Leia os nossos termos legais" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-12 <?= form_error('description') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description">Descrição<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('description')) {
                                    $value = set_value('description');
                                } else if (isset($terms)) {
                                    $value = $terms->description;
                                }
                                ?>
                                <textarea name="description" id="description" class="editor" placeholder="Informe os termos legais" required><?=$value?></textarea>
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
