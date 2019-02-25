<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-cogs"></i> Itens de Configuração
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-cogs"></i> Itens de Configuração
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open('admin/config/' . $op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($config) ? $config->id : NULL ?>">
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
                            if (!$value && isset($config)) {
                                $value = $config->name;
                            }
                            ?>
                            <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="20" required>
                        </div>
                        <div class="form-group <?= form_error('abbreviation') ? 'has-error' : '' ?>">
                            <label class="control-label" for="abbreviation">Abreviação<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('abbreviation');
                            if (!$value && isset($config)) {
                                $value = $config->abbreviation;
                            }
                            ?>
                            <input name="abbreviation" id="abbreviation" type="text" value="<?= $value ?>" placeholder="Informe a abreviação" class="form-control input-sm maxlength" maxlength="10" required>
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
                            <i class="fa fa-bars"></i> Itens Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($configs) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-4">Nome</th>
                                        <th class="col-sm-4">Abreviação</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($configs as $b) { ?>
                                        <tr style="cursor: n-resize">
                                    <input type="hidden" value="<?= $b->id ?>">
                                    <td><?= $b->name ?></td>
                                    <td><?= $b->abbreviation ?></td>
                                    <td class="text-right">
                                        <? if ($b->status) { ?>
                                            <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/config/toggle/' . $b->id) ?>', 'Tem certeza que deseja desativar este item?')"></button>
                                        <? } else { ?>
                                            <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/config/toggle/' . $b->id) ?>', 'Tem certeza que deseja ativar este item?')"></button>
                                        <? } ?>
                                        <a title="Editar" href="<?= site_url('admin/config/edit/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                        <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/config/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este item?')"></button>
                                    </td>
                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há itens cadastrados
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
                        ordenation(id, position, 'config');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Itens ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
