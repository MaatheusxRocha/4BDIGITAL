
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-language"></i> Idiomas
            <!--<small></small>-->
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-language"></i> Idiomas
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-plus"></i> Cadastro</h3>
                    </div><!-- /.box-header -->
                    <?= form_open_multipart("admin/language/$op", "class='form-validate' autocomplete='off'") ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <? if (count($languages) == 3 && $op == 'save') { ?>
                            <div class="alert alert-info">
                                Máximo de idiomas atingido
                            </div>
                        <? } ?>
                        <input type="text" hidden="" name="id" value="<?= isset($language) ? $language->id : '' ?>">
                        <div class="row">
                            <div class="form-group col-sm-12 <?= form_error('name') ? 'has-error' : '' ?>">
                                <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br />
                                <?
                                $value = '';
                                if (set_value('name')) {
                                    $value = set_value('name');
                                } else if (isset($language)) {
                                    $value = $language->name;
                                }
                                ?>
                                <input name="name" type="text" value="<?= $value ?>" placeholder="ex: Espanhol" class="form-control input-sm maxlength" maxlength="50" required autofocus="" <?= count($languages) == 3 && $op == 'save' ? 'disabled' : '' ?>>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" <?= (count($languages) == 3 && $op == 'save') ? 'disabled' : '' ?> class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
                            <button type="reset" <?= (count($languages) == 3 && $op == 'save') ? 'disabled' : '' ?> class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh"></span> Limpar</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bars"></i> Idiomas Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-hover">
                            <thead>
                            <th class="col-sm-9">Nome</th>
                            <th class="col-sm-3">&nbsp;</th>
                            </thead>
                            <tbody id="sortable">
                                <? foreach ($languages as $l) { ?>
                                    <tr style="cursor: n-resize">
                                        <input type="hidden" value="<?= $l->id ?>">
                                        <td><?= $l->name ?></td>
                                        <td>
                                            <span class="pull-right">
                                                <? if ($l->status) { ?>
                                                    <button type="button" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" title="Clique para desativar este idioma." onclick="confirm_dialog('<?= site_url("admin/language/toggle/$l->id") ?>', 'Tem certeza que deseja desativar este idioma?')"></button>
                                                <? } else { ?>
                                                    <button type="button" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" title="Clique para ativar este idioma." onclick="confirm_dialog('<?= site_url("admin/language/toggle/$l->id") ?>', 'Tem certeza que deseja ativar este idioma?')"></button>
                                                <? } ?>
                                                <button type="button" class="btn btn-sm btn-warning glyphicon glyphicon-edit title" title="Editar" onclick="window.location = '<?= site_url("admin/language/edit/$l->id") ?>'"></button>
                                            </span>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
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
                        ordenation(id, position, 'language');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Idioma ordenado com sucesso!');
            }
        }).disableSelection();
    });
</script>
