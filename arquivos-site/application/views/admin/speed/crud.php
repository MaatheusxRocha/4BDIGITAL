<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer"></i> Velocidade
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-tachometer"></i> Velocidade
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open('admin/speed/' . $op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($speed) ? $speed->id : NULL ?>">
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
                        <div class="form-group <?= form_error('name') ? 'has-error' : '' ?>">
                            <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('name');
                            if (!$value && isset($speed)) {
                                $value = $speed->name;
                            }
                            ?>
                            <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                        </div>
                        <div class="form-group <?= form_error('config') ? 'has-error' : '' ?>">
                            <label class="control-label" for="config">Item de refêrencia das configurações<em class="text-danger">*</em></label><br>
                            <?
                            $value = '';
                            if (set_value('config')) {
                                $value = set_value('config');
                            } else if (isset($speed)) {
                                $value = $speed->config_id;
                            }
                            echo form_dropdown('config', $configs, $value, 'class="form-control input-sm" id="config" required')
                            ?>
                        </div>
                        <div class="form-group <?= form_error('frequency') ? 'has-error' : '' ?>">
                            <label class="control-label" for="frequency">Frequência<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('frequency');
                            if (!$value && isset($speed)) {
                                $value = $speed->frequency;
                            }
                            ?>
                            <input name="frequency" id="frequency" type="text" value="<?= $value ?>" placeholder="Informe a frequência" class="form-control input-sm frequency" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('price_month') ? 'has-error' : '' ?>">
                                <label class="control-label" for="price_month">Valor mensal<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('price_month')) {
                                    $value = set_value('price_month');
                                } else if (isset($speed)) {
                                    $value = number_format($speed->price_month, 2, ',', '.');
                                }
                                ?>
                                <input name="price_month" id="price_month" onkeyup="calcule_value_hour()" type="text" value="<?= $value ?>" placeholder="Informe o valor mensal" class="form-control input-sm money" required>
                            </div>
                            <div class="form-group col-md-6 <?= form_error('price_hour') ? 'has-error' : '' ?>">
                                <label class="control-label" for="price_hour">Valor hora<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('price_hour')) {
                                    $value = set_value('price_hour');
                                } else if (isset($speed)) {
                                    $value = $speed->price_hour;
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
            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bars"></i> Velocidades Cadastradas
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($speeds) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-4">Nome</th>
                                        <th class="col-sm-4">Frequência</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($speeds as $b) { ?>
                                        <tr>
                                            <td><?= $b->name ?></td>
                                            <td><?= $b->frequency ?></td>
                                            <td class="text-right">
                                                <a title="Editar" href="<?= site_url('admin/speed/edit/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/speed/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír esta velocidade?')"></button>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há velocidades cadastradas
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
