<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-bookmark"></i> Cases
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-bookmark"></i> Cases
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open_multipart('admin/cases/' . $op, 'class="form-validate" autocomplete="off"') ?>
                    <input type="hidden" name="id" value="<?= isset($case) ? $case->id : NULL ?>">
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
                            if (!$value && isset($case)) {
                                $value = $case->name;
                            }
                            ?>
                            <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="30" required autofocus="">
                        </div>
                        <div class="form-group <?= form_error('description') ? 'has-error' : '' ?>">
                            <label class="control-label" for="description">Descrição<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('description');
                            if (!$value && isset($case)) {
                                $value = $case->description;
                            }
                            ?>
                            <textarea name="description" id="description" class="editor" required><?= $value ?></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 <?= form_error('image_logo') ? 'has-error' : '' ?>">
                                <label class="control-label" for="image_logo">Logomarca<em class="text-danger">*</em> <i class="fa fa-info-circle title" title="A imagem deve ser de <?= LOGO_W ?>px X <?= LOGO_H ?>px ou maior proporcionalmente. Tipos permitidos: jpg, png, gif e jpeg!"></i></label><br>
                                <?
                                $value = isset($case) ? $case->image_logo : NULL;
                                ?>
                                <span class="btn btn-sm btn-primary btn-file">
                                    <i class="fa fa-upload"></i> Enviar arquivo
                                    <input type="file" name="image_logo" id="image" onchange="$('#image_filename').html(get_name($(this).val()))" class="form-control input-sm" accept=".gif, .jpg, .png, .jpeg" <?= !isset($case) ? 'required' : NULL ?>>
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
                        <div data-min_width="<?= ENTERPRISE_W ?>" data-min_height="<?= ENTERPRISE_H ?>" class="row cropper_container <?= form_error('image_enterprise') ? 'has-error' : '' ?>">
                            <div class="col-xs-12">
                                <label class="control-label">
                                    Imagem Referente à empresa <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= ENTERPRISE_W ?>px X <?= ENTERPRISE_H ?>px ou maior proporcionalmente"></i>
                                </label><br>
                                <label class="btn btn-primary">
                                    <input class="hide" type="file" accept=".jpg, .png, .gif, .jpeg">
                                    Selecionar Imagem
                                </label>
                                <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                            </div>
                            <div class="col-xs-12" style="padding: 5px;">
                                <img src="">
                            </div>
                            <div class="col-xs-12">
                                <textarea hidden name="image_enterprise"></textarea>
                            </div>
                        </div>
                        <? $value = isset($case) ? $case->image_enterprise : NULL ?>
                        <? if ($value) { ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="<?= site_url($value) ?>" target="_blank">
                                        <img src="<?= base_url($case->image_enterprise) ?>" style="max-width: 100%; margin-top: 5px">
                                    </a>
                                </div>
                            </div>
                        <? } ?>
                        <div data-min_width="<?= PERSON_W ?>" data-min_height="<?= PERSON_H ?>" class="row cropper_container <?= form_error('image_person') ? 'has-error' : '' ?>">
                            <div class="col-xs-12">
                                <label class="control-label">
                                    Imagem da Pessoa <i class="fa fa-info-circle title" title="Tipos permitidos: jpg, png, gif e jpeg! A imagem deve ser de <?= PERSON_W ?>px X <?= PERSON_H ?>px ou maior proporcionalmente"></i>
                                </label><br>
                                <label class="btn btn-primary">
                                    <input class="hide" type="file" accept=".jpg, .png, .gif, .jpeg">
                                    Selecionar Imagem
                                </label>
                                <button class="btn btn-primary pull-right" type="button">Usar parte selecionada</button>
                            </div>
                            <div class="col-xs-12" style="padding: 5px;">
                                <img src="">
                            </div>
                            <div class="col-xs-12">
                                <textarea hidden name="image_person"></textarea>
                            </div>
                        </div>
                        <? $value = isset($case) ? $case->image_person : NULL ?>
                        <? if ($value) { ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="<?= site_url($value) ?>" target="_blank">
                                        <img src="<?= base_url($case->image_person) ?>" style="max-width: 100%; margin-top: 5px">
                                    </a>
                                </div>
                            </div>
                        <? } ?>
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
                            <i class="fa fa-bars"></i> Cases Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($cases) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-3">Logo</th>
                                        <th class="col-sm-5">Nome</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($cases as $b) { ?>
                                        <tr style="cursor: n-resize">
                                    <input type="hidden" value="<?= $b->id ?>">
                                    <td>
                                        <img class="img img-thumbnail col-xs-10" src="<?= base_url($b->image_logo) ?>">
                                    </td>
                                    <td><?= $b->name ?></td>
                                    <td class="text-right">
                                        <? if ($b->status) { ?>
                                            <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/cases/toggle/' . $b->id) ?>', 'Tem certeza que deseja desativar este case?')"></button>
                                        <? } else { ?>
                                            <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/cases/toggle/' . $b->id) ?>', 'Tem certeza que deseja ativar este case?')"></button>
                                        <? } ?>
                                        <a title="Editar" href="<?= site_url('admin/cases/edit/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                        <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/cases/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este case?')"></button>
                                    </td>
                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há cases cadastrados
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
                        ordenation(id, position, 'cases');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Cases ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>
