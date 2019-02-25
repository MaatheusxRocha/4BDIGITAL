<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-windows"></i> Sistema Operacional
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-windows"></i> Sistema Operacional
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open('admin/operational/' . $op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($operational) ? $operational->id : NULL ?>">
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
                            if (!$value && isset($operational)) {
                                $value = $operational->name;
                            }
                            ?>
                            <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('price_month') ? 'has-error' : '' ?>">
                                <label class="control-label" for="price_month">Valor mensal<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('price_month')) {
                                    $value = set_value('price_month');
                                } else if (isset($operational)) {
                                    $value = number_format($operational->price_month, 2, ',', '.');
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
                                } else if (isset($operational)) {
                                    $value = $operational->price_hour;
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
                            <i class="fa fa-bars"></i> Sistemas Operacionais Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($operationals) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-4">Nome</th>
                                        <th class="col-sm-4">Valor Mensal</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($operationals as $b) { ?>
                                        <tr style="cursor: n-resize">
                                            <input type="hidden" value="<?= $b->id ?>">
                                            <td><?= $b->name ?></td>
                                            <td>R$ <?= number_format($b->price_month, 2, ',', '.') ?></td>
                                            <td class="text-right">
                                                <? if ($b->status) { ?>
                                                    <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/operational/toggle/' . $b->id) ?>', 'Tem certeza que deseja desativar este sistema operacional?')"></button>
                                                <? } else { ?>
                                                    <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/operational/toggle/' . $b->id) ?>', 'Tem certeza que deseja ativar este sistema operacional?')"></button>
                                                <? } ?>
                                                <a title="Editar" href="<?= site_url('admin/operational/edit/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/operational/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír esta velocidade?')"></button>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há sistemas cadastrados
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(function () {
        var fixHelper = function (e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };

        $('#sortable').sortable({helper: fixHelper,
            update: function (event, ui) {
                $('table tr').each(function () {
                    var position = $(this).index() + 1;
                    var id = $(this).children('input').val();
                    if (id != undefined) {
                        ordenation(id, position, 'operational');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Sistemas ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
