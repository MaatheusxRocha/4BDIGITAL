<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-font"></i> Cases - Textos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-font"></i> Cases - Textos
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
                    <?= form_open("admin/text_case/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('title_one') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_one">Título 1 (cinza)<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_one')) {
                                    $value = set_value('title_one');
                                } else if (isset($text_case)) {
                                    $value = $text_case->title_one;
                                }
                                ?>
                                <input name="title_one" id="title_one" type="text" value="<?= $value ?>" placeholder="Somos cloud com" class="form-control input-sm maxlength" maxlength="50" required autofocus="">
                            </div>
                            <div class="form-group col-md-4 <?= form_error('title_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_two">Título 2 (parte vermelha)<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_two')) {
                                    $value = set_value('title_two');
                                } else if (isset($text_case)) {
                                    $value = $text_case->title_two;
                                }
                                ?>
                                <input name="title_two" id="title_two" type="text" value="<?= $value ?>" placeholder="histórias brasileiras" class="form-control input-sm maxlength" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('subtitle') ? 'has-error' : '' ?>">
                                <label class="control-label" for="subtitle">Subtítulo<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('subtitle')) {
                                    $value = set_value('subtitle');
                                } else if (isset($text_case)) {
                                    $value = $text_case->subtitle;
                                }
                                ?>
                                <input name="subtitle" id="subtitle" type="text" value="<?= $value ?>" placeholder="Conheça quem nos faz assim" class="form-control input-sm maxlength" maxlength="150" required>
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
