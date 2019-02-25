<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-font"></i> Preços - Textos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-font"></i> Preços - Textos
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
                    <?= form_open("admin/text_plan/save", 'class="form-validate" autocomplete="off"') ?>
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
                                } else if (isset($text_plan)) {
                                    $value = $text_plan->title;
                                }
                                ?>
                                <input name="title" id="title" type="text" value="<?= $value ?>" placeholder="Preços xx% mais econômicos que os principais concorrentes" class="form-control input-sm maxlength" maxlength="150" required autofocus="">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('subtitle') ? 'has-error' : '' ?>">
                                <label class="control-label" for="subtitle">Subtítulo<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('subtitle')) {
                                    $value = set_value('subtitle');
                                } else if (isset($text_plan)) {
                                    $value = $text_plan->subtitle;
                                }
                                ?>
                                <input name="subtitle" id="subtitle" type="text" value="<?= $value ?>" placeholder="Veja algumas opções de configuração" class="form-control input-sm maxlength" maxlength="150" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('title_simulation') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_simulation">Título Simulação<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_simulation')) {
                                    $value = set_value('title_simulation');
                                } else if (isset($text_plan)) {
                                    $value = $text_plan->title_simulation;
                                }
                                ?>
                                <input name="title_simulation" id="title_simulation" type="text" value="<?= $value ?>" placeholder="Simule um plano e crie sua conta brascloud" class="form-control input-sm maxlength" maxlength="150" required>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('title_performance') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title_performance">Título Performance<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('title_performance')) {
                                    $value = set_value('title_performance');
                                } else if (isset($text_plan)) {
                                    $value = $text_plan->title_performance;
                                }
                                ?>
                                <input name="title_performance" id="title_performance" type="text" value="<?= $value ?>" placeholder="Turbine a performance da sua cloud com serviços adicionais" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('description_performance') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description_performance">Descrição Performance<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('description_performance')) {
                                    $value = set_value('description_performance');
                                } else if (isset($text_plan)) {
                                    $value = $text_plan->description_performance;
                                }
                                ?>
                                <input name="description_performance" id="description_performance" type="text" value="<?= $value ?>" placeholder="Administre o consumo dos serviços no portal da cloud." class="form-control input-sm maxlength" maxlength="70" required>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('warning_performance') ? 'has-error' : '' ?>">
                                <label class="control-label" for="warning_performance">Texto Aviso Performance<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('warning_performance')) {
                                    $value = set_value('warning_performance');
                                } else if (isset($text_plan)) {
                                    $value = $text_plan->warning_performance;
                                }
                                ?>
                                <input name="warning_performance" id="warning_performance" type="text" value="<?= $value ?>" placeholder="Valor pode sofre variações em função do uso." class="form-control input-sm maxlength" maxlength="150" required>
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
