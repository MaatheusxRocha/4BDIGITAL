<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-font"></i> Contato - Textos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-font"></i> Contato - Textos
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
                    <?= form_open_multipart("admin/text_contact_us/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title">Título da Página<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title')) {
                                    $value = set_value('title');
                                } else if (isset($text_contact_us)) {
                                    $value = $text_contact_us->title;
                                }
                                ?>
                                <textarea name="title" id="title" placeholder="A Brascloud está sempre pronta para falar com você" class="editor-small" required><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group <?= form_error('title_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_two">Título "Fale conosco"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_two')) {
                                    $value = set_value('title_two');
                                } else if (isset($text_contact_us)) {
                                    $value = $text_contact_us->title_two;
                                }
                                ?>
                                <input type="text" name="title_two" id="title_two" class="form-control input-sm maxlength" maxlength="50" placeholder="Fale conosco" required value="<?= $value ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group <?= form_error('description') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description">Texto "Fale conosco"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('description')) {
                                    $value = set_value('description');
                                } else if (isset($text_contact_us)) {
                                    $value = $text_contact_us->description;
                                }
                                ?>
                                <textarea name="description" id="description" required class="editor" placeholder="Relacionamento é parte indispensável da nossa...." required><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group <?= form_error('title_three') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_three">Título "Ligaremos para você"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_three')) {
                                    $value = set_value('title_three');
                                } else if (isset($text_contact_us)) {
                                    $value = $text_contact_us->title_three;
                                }
                                ?>
                                <input type="text" name="title_three" id="title_three" class="form-control input-sm maxlength" maxlength="50" placeholder="Ligaremos para você" required value="<?= $value ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group <?= form_error('description_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description_two">Texto "Ligaremos para você"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('description_two')) {
                                    $value = set_value('description_two');
                                } else if (isset($text_contact_us)) {
                                    $value = $text_contact_us->description_two;
                                }
                                ?>
                                <textarea name="description_two" id="description_two" required class="editor" placeholder="Se você preferir, deixe seu..." required><?= $value ?></textarea>
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
