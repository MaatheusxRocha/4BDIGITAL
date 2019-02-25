<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-th-large"></i> Planos - Configurações
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li>
                <a href="<?= site_url('admin/plan') ?>"><i class="fa fa-th-large"></i> Planos</a>
            </li>
            <li class="active">
                <i class="fa fa-th-large"></i> Planos - Configurações
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open('admin/plan/' . $op, 'class="form-validate"') ?>
                    <input type="hidden" name="plan_id" value="<?= isset($plan) ? $plan->id : NULL ?>">
                    <input type="hidden" name="id" value="<?= isset($plan_config) ? $plan_config->id : NULL ?>">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-plus"></i> Cadastro
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors() ?>
                            </div>
                        <? } ?>
                        <div class="alert alert-info">
                            <p>Plano: <?= $plan->name ?></p>
                        </div>
                        <div class="form-group  <?= form_error('config') ? 'has-error' : '' ?>">
                            <label class="control-label" for="config">Item de Configuração<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('config');
                            if (!$value && isset($plan_config)) {
                                $value = $plan_config->config_id;
                            }
                            echo form_dropdown('config', $configs, $value, 'class="form-control input-sm" required id="config"')
                            ?>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('value') ? 'has-error' : '' ?>">
                                <label class="control-label" for="value">Valor/Quantidade <em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('value');
                                if (!$value && isset($plan_config)) {
                                    $value = number_format($plan_config->value,2,',','.');
                                }
                                ?>
                                <input name="value" id="value" type="text" value="<?= $value ?>" placeholder="Valor/Quantidade" class="form-control input-sm value-config" required autocomplete="off">
                            </div>
                            <div class="form-group col-md-6 <?= form_error('measure') ? 'has-error' : '' ?>">
                                <label class="control-label" for="measure">Un. Medida <em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('measure');
                                if (!$value && isset($plan_config)) {
                                    $value = $plan_config->measure;
                                }
                                ?>
                                <input name="measure" id="measure" type="text" value="<?= $value ?>" placeholder="Unidade de Medida" class="form-control input-sm maxlength" maxlength="5" required autocomplete="off">
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
            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bars"></i> Configurações Adicionadas
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($plan_configs) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-3">Item</th>
                                        <th class="col-sm-3">Valor</th>
                                        <th class="col-sm-3">Un. Medida</th>
                                        <th class="col-xs-3"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($plan_configs as $b) { ?>
                                        <tr>
                                            <td><?= $b->name ?></td>
                                            <td><?= $b->value ?></td>
                                            <td><?= $b->measure ?></td>
                                            <td class="text-right">
                                                <a title="Editar" href="<?= site_url('admin/plan/edit_config/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/plan/delete_config/' . $b->id) ?>', 'Tem certeza que deseja excluír esta configuração?')"></button>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há configurações adicionadas
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>