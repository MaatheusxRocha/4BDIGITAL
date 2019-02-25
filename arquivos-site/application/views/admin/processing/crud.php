<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-microchip"></i> Processamento
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-microchip"></i> Processamento
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
                    <?= form_open("admin/processing/save", 'class="form-validate" autocomplete="off"') ?>
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
                                } else if (isset($processing)) {
                                    $value = $processing->name;
                                }
                                ?>
                                <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Processamento | vCPU" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('config') ? 'has-error' : '' ?>">
                                <label class="control-label" for="config">Item de refêrencia das configurações<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('config')) {
                                    $value = set_value('config');
                                } else if (isset($processing)) {
                                    $value = $processing->config_id;
                                }
                                echo form_dropdown('config', $configs, $value, 'class="form-control input-sm" id="config" required')
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 <?= form_error('scale_min') ? 'has-error' : '' ?>">
                                <label class="control-label" for="scale_min">Valor/quantidade Mínima<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('scale_min')) {
                                    $value = set_value('scale_min');
                                } else if (isset($processing)) {
                                    $value = $processing->scale_min;
                                }
                                ?>
                                <input name="scale_min" id="scale_min" type="number" value="<?= $value ?>" placeholder="Informa o valor/quantidade mínima" class="form-control input-sm" min="0.5" required>
                            </div>
                            <div class="form-group col-md-4 <?= form_error('scale_max') ? 'has-error' : '' ?>">
                                <label class="control-label" for="scale_max">Valor/quantidade Máxima<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('scale_max')) {
                                    $value = set_value('scale_max');
                                } else if (isset($processing)) {
                                    $value = $processing->scale_max;
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
                                } else if (isset($processing)) {
                                    $value = $processing->scale;
                                }
                                ?>
                                <input name="scale" id="scale" type="number" value="<?= $value ?>" placeholder="Escala" class="form-control input-sm" min="0.5" required>
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
