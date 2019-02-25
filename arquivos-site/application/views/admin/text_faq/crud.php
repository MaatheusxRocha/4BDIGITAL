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
                    <?= form_open("admin/text_faq/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('title_one') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_one">Título Cinza<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_one')) {
                                    $value = set_value('title_one');
                                } else if (isset($text_faq)) {
                                    $value = $text_faq->title_one;
                                }
                                ?>
                                <input name="title_one" id="title_one" type="text" value="<?= $value ?>" placeholder="Tem alguma dúvida?" class="form-control input-sm maxlength" maxlength="100" required autofocus="">
                            </div>
                            <div class="form-group col-md-4 <?= form_error('title_two') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_two">Título Vermelho<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_two')) {
                                    $value = set_value('title_two');
                                } else if (isset($text_faq)) {
                                    $value = $text_faq->title_two;
                                }
                                ?>
                                <input name="title_two" id="title_two" type="text" value="<?= $value ?>" placeholder="A resposta pode estar aqui." class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('title_three') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_three">Título Laranja<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_three')) {
                                    $value = set_value('title_three');
                                } else if (isset($text_faq)) {
                                    $value = $text_faq->title_three;
                                }
                                ?>
                                <input name="title_three" id="title_three" type="text" value="<?= $value ?>" placeholder="Perguntas frequentes" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('text_contact_us') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_one">Texto "Fale Conosco"<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('text_contact_us')) {
                                    $value = set_value('text_contact_us');
                                } else if (isset($text_faq)) {
                                    $value = $text_faq->text_contact_us;
                                }
                                ?>
                                <textarea name="text_contact_us" placeholder="Informe o texto" class="editor" required=""><?=$value?></textarea>
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
