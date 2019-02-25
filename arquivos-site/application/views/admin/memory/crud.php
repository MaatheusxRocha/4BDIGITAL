<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-laptop"></i> Memória
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-laptop"></i> Memória
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
                    <?= form_open("admin/memory/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('name') ? 'has-error' : '' ?>">
                                <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('name')) {
                                    $value = set_value('name');
                                } else if (isset($memory)) {
                                    $value = $memory->name;
                                }
                                ?>
                                <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Memória | vRAM" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('config') ? 'has-error' : '' ?>">
                                <label class="control-label" for="config">Item de refêrencia das configurações<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('config')) {
                                    $value = set_value('config');
                                } else if (isset($memory)) {
                                    $value = $memory->config_id;
                                }
                                echo form_dropdown('config',$configs, $value, 'class="form-control input-sm" id="config" required')
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('scale_min') ? 'has-error' : '' ?>">
                                <label class="control-label" for="scale_min">Valor/quantidade Mínima GB<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('scale_min')) {
                                    $value = set_value('scale_min');
                                } else if (isset($memory)) {
                                    $value = $memory->scale_min;
                                }
                                ?>
                                <input name="scale_min" id="scale_min" type="number" value="<?= $value ?>" placeholder="Informa o valor/quantidade mínima" class="form-control input-sm" min="1" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('scale_max') ? 'has-error' : '' ?>">
                                <label class="control-label" for="scale_max">Valor/quantidade Máxima GB<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('scale_max')) {
                                    $value = set_value('scale_max');
                                } else if (isset($memory)) {
                                    $value = $memory->scale_max;
                                }
                                ?>
                                <input name="scale_max" id="scale_max" type="number" value="<?= $value ?>" placeholder="Informe o valor/quantidade máxima" class="form-control input-sm" min="1" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('scale') ? 'has-error' : '' ?>">
                                <label class="control-label" for="scale">Escala<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('scale')) {
                                    $value = set_value('scale');
                                } else if (isset($memory)) {
                                    $value = $memory->scale;
                                }
                                ?>
                                <input name="scale" id="scale" type="number" value="<?= $value ?>" placeholder="Escala" class="form-control input-sm" min="1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('price_month') ? 'has-error' : '' ?>">
                                <label class="control-label" for="price_month">Valor mensal por GB<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('price_month')) {
                                    $value = set_value('price_month');
                                } else if (isset($memory)) {
                                    $value = number_format($memory->price_month, 2, ',', '.');
                                }
                                ?>
                                <input name="price_month" id="price_month" onkeyup="calcule_value_hour()" type="text" value="<?= $value ?>" placeholder="Informe o valor mensal" class="form-control input-sm money" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('price_hour') ? 'has-error' : '' ?>">
                                <label class="control-label" for="price_hour">Valor hora por GB<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('price_hour')) {
                                    $value = set_value('price_hour');
                                } else if (isset($memory)) {
                                    $value = $memory->price_hour;
                                }
                                ?>
                                <input name="price_hour" id="price_hour" type="text" readonly value="<?= $value ?>" placeholder="Valor por hora" class="form-control input-sm" required>
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
