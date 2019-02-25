<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-list"></i> Contato - Departamentos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Contato - Departamentos
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open_multipart('admin/department/'.$op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($department) ? $department->id : NULL ?>">
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
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('name') ? 'has-error' : '' ?>">
                                <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('name');
                                if (!$value && isset($department)) {
                                    $value = $department->name;
                                }
                                ?>
                                <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Ex.: Financeiro" class="form-control input-sm maxlength" maxlength="50" required autofocus="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('email') ? 'has-error' : '' ?>">
                                <label class="control-label" for="email">E-mail<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('email');
                                if (!$value && isset($department)) {
                                    $value = $department->email;
                                }
                                ?>
                                <input name="email" id="email" type="email" value="<?= $value ?>" placeholder="Ex.: financeiro@brascloud.com.br" class="form-control input-sm maxlength" maxlength="100" required>
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
                            <i class="fa fa-bars"></i> Departamentos Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($departments) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-8">Nome</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($departments as $b) { ?>
                                        <tr style="cursor: n-resize">
                                            <input type="hidden" value="<?= $b->id ?>">
                                            <td><?= $b->name ?></td>
                                            <td class="text-right">
                                                <? if ($b->status) { ?>
                                                    <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/department/toggle/'.$b->id) ?>', 'Tem certeza que deseja desativar este departamento?')"></button>
                                                <? } else { ?>
                                                    <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/department/toggle/'.$b->id) ?>', 'Tem certeza que deseja ativar este departamento?')"></button>
                                                <? } ?>
                                                <a title="Editar" href="<?= site_url('admin/department/edit/'.$b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/department/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este departamento?')"></button>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há departamentos cadastrados
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
                        ordenation(id, position, 'department');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Departamentos ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
