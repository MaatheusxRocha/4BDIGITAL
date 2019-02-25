<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-image"></i> Banners
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-image"></i> Banners
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open_multipart('admin/banner/' . $op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($banner) ? $banner->id : NULL ?>">
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
                            if (!$value && isset($banner)) {
                                $value = $banner->name;
                            }
                            ?>
                            <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                        </div>
                        <div class="form-group <?= form_error('button') ? 'has-error' : '' ?>">
                            <label class="control-label" for="button">Texto Botão</label><br>
                            <?
                            $value = set_value('button');
                            if (!$value && isset($banner)) {
                                $value = $banner->button;
                            }
                            ?>
                            <input name="button" id="button" type="text" value="<?= $value ?>" placeholder="Informe o texto do botão" class="form-control input-sm maxlength" maxlength="40">
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('link') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link">Link <i class="fa fa-info-circle title" title="Atenção: utilizar o link completo, incluindo http:// ou https:// antes do endereço"></i></label><br>
                                <?
                                $value = set_value('link');
                                if (!$value && isset($banner)) {
                                    $value = $banner->link;
                                }
                                ?>
                                <input name="link" id="link" type="url" value="<?= $value ?>" placeholder="Informe o link" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('image') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image">Imagem Desktop<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?=DESK_W?>px X <?=DESK_H?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($banner) ? $banner->image : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="image" id="image" onchange="$('#image_filename').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($banner) ? 'required' : NULL ?>>
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
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('image_mobile') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image_mobile">Imagem<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?=MOB_W?>px X <?=MOB_H?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($banner) ? $banner->image_mobile : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="image_mobile" id="image_mobile" onchange="$('#image_mobile_filename').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($banner) ? 'required' : NULL ?>>
                                </span>
                                <span id="image_mobile_filename"></span>
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
                            <i class="fa fa-bars"></i> Banners Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($banners) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-3">Imagem</th>
                                        <th class="col-sm-5">Nome</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($banners as $b) { ?>
                                        <tr style="cursor: n-resize">
                                    <input type="hidden" value="<?= $b->id ?>">
                                    <td>
                                        <img class="img img-thumbnail col-xs-10" src="<?= base_url($b->image) ?>">
                                    </td>
                                    <td><?=$b->name?></td>
                                    <td class="text-right">
                                        <? if ($b->status) { ?>
                                            <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/banner/toggle/' . $b->id) ?>', 'Tem certeza que deseja desativar este banner?')"></button>
                                        <? } else { ?>
                                            <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/banner/toggle/' . $b->id) ?>', 'Tem certeza que deseja ativar este banner?')"></button>
                                        <? } ?>
                                        <a title="Editar" href="<?= site_url('admin/banner/edit/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                        <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/banner/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este banner?')"></button>
                                    </td>
                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há banners cadastrados
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
                        ordenation(id, position, 'banner');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Banners ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
