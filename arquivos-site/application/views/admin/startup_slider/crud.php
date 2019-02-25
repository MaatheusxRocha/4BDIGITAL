<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-sliders"></i> Startup - Sliders
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-sliders"></i> Startup - Sliders
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open_multipart('admin/startup_slider/'.$op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($startup_slider) ? $startup_slider->id : NULL ?>">
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
                            <div class="form-group col-xs-12 <?= form_error('text') ? 'has-error' : '' ?>">
                                <label class="control-label" for="text">Texto<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('text')) {
                                    $value = set_value('text');
                                } else if (isset($startup_slider)) {
                                    $value = $startup_slider->text;
                                }
                                ?>
                                <textarea name="text" id="text" placeholder="Profissionais à disposição para estar ao seu lado na..." class="editor" required><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('button') ? 'has-error' : '' ?>">
                                <label class="control-label" for="button">Botão<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('button')) {
                                    $value = set_value('button');
                                } else if (isset($startup_slider)) {
                                    $value = $startup_slider->button;
                                }
                                ?>
                                <input name="button" id="button" placeholder="Cadastre-se como startup" class="input-sm form-control maxlength" required maxlength="50" value="<?= $value ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('link') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link">Link<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('link')) {
                                    $value = set_value('link');
                                } else if (isset($startup_slider)) {
                                    $value = $startup_slider->link;
                                }
                                ?>
                                <input name="link" id="link" placeholder="Link completo, incluindo https://" class="input-sm form-control" required value="<?= $value ?>">
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
                            <i class="fa fa-bars"></i> Sliders Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($startup_sliders) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-8">Nome</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($startup_sliders as $b) { ?>
                                        <tr style="cursor: n-resize">
                                            <input type="hidden" value="<?= $b->id ?>">
                                            <td><?= strip_tags($b->text) ?></td>
                                            <td class="text-right">
                                                <? if ($b->status) { ?>
                                                    <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/startup_slider/toggle/'.$b->id) ?>', 'Tem certeza que deseja desativar este slider?')"></button>
                                                <? } else { ?>
                                                    <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/startup_slider/toggle/'.$b->id) ?>', 'Tem certeza que deseja ativar este slider?')"></button>
                                                <? } ?>
                                                <a title="Editar" href="<?= site_url('admin/startup_slider/edit/'.$b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/startup_slider/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este slider?')"></button>
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
                        ordenation(id, position, 'startup_slider');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Itens ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
