<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-list"></i> Por que criar - Itens
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Por que criar - Itens
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open_multipart('admin/account_item/'.$op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($account_item) ? $account_item->id : NULL ?>">
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
                            <div class="form-group col-xs-12 <?= form_error('title') ? 'has-error' : '' ?>">
                                <label class="control-label" for="title">Título<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('title');
                                if (!$value && isset($account_item)) {
                                    $value = $account_item->title;
                                }
                                ?>
                                <input name="title" id="title" type="text" value="<?= $value ?>" placeholder="Ex.: On-Demand" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('description') ? 'has-error' : '' ?>">
                                <label class="control-label" for="description">Descrição<em class="text-danger">*</em></label><br>
                                <?
                                $value = set_value('description');
                                if (!$value && isset($account_item)) {
                                    $value = $account_item->description;
                                }
                                ?>
                                <textarea name="description" id="description" placeholder="Ex.: Você escolhe como autosserviço..." class="form-control input-sm maxlength" maxlength="150"><?= $value ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image">Imagem<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?=DESK_W?>px X <?=DESK_H?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($account_item) ? $account_item->image : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="image" id="image" onchange="$('#image_filename').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($account_item) ? 'required' : NULL ?>>
                                </span>
                                <span id="image_filename"></span>
                                <? if ($value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="<?= site_url($value) ?>" target="_blank">
                                                <img src="<?= base_url($value) ?>" style="max-width: 100%; margin-top: 5px">
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
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
                            <i class="fa fa-bars"></i> Itens Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($account_items) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-8">Título</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($account_items as $b) { ?>
                                        <tr style="cursor: n-resize">
                                            <input type="hidden" value="<?= $b->id ?>">
                                            <td>
                                                <?= $b->title ?>
                                            </td>
                                            <td class="text-right">
                                                <? if ($b->status) { ?>
                                                    <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/account_item/toggle/'.$b->id) ?>', 'Tem certeza que deseja desativar este item?')"></button>
                                                <? } else { ?>
                                                    <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/account_item/toggle/'.$b->id) ?>', 'Tem certeza que deseja ativar este item?')"></button>
                                                <? } ?>
                                                <a title="Editar" href="<?= site_url('admin/account_item/edit/'.$b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/account_item/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este item?')"></button>
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
                        ordenation(id, position, 'account_item');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Itens ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
