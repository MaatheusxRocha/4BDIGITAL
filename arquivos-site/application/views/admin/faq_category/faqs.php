<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-list"></i> FAQ
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-list"></i> FAQ
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <?= form_open_multipart('admin/faq_category/' . $op, 'class="form-validate"') ?>
                    <input type="hidden" name="category_id" value="<?= isset($category) ? $category->id : NULL ?>">
                    <input type="hidden" name="id" value="<?= isset($faq) ? $faq->id : NULL ?>">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-plus"></i> Cadastro
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-info">
                            Categoria: <?=$category->name?>
                        </div>
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors() ?>
                            </div>
                        <? } ?>
                        <div class="form-group <?= form_error('question') ? 'has-error' : '' ?>">
                            <label class="control-label" for="question">Pergunta<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('question');
                            if (!$value && isset($faq)) {
                                $value = $faq->question;
                            }
                            ?>
                            <textarea name="question" id="question" class="editor-small" required="" placeholder="Informe a pergunta"><?=$value?></textarea>
                        </div>
                        <div class="form-group <?= form_error('answer') ? 'has-error' : '' ?>">
                            <label class="control-label" for="answer">Resposta<em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('answer');
                            if (!$value && isset($faq)) {
                                $value = $faq->answer;
                            }
                            ?>
                            <textarea name="answer" id="answer" class="editor" required="" placeholder="Informe a resposta"><?=$value?></textarea>
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
                            <i class="fa fa-bars"></i> Perguntas Cadastradas <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($faqs) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-8">Pergunta</th>
                                        <th class="col-xs-4"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($faqs as $b) { ?>
                                        <tr style="cursor: n-resize">
                                    <input type="hidden" value="<?= $b->id ?>">
                                    <td><?= $b->question ?></td>
                                    <td class="text-right">
                                        <? if ($b->status) { ?>
                                            <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/faq_category/toggle_faq/' . $b->id) ?>', 'Tem certeza que deseja desativar esta pergunta?')"></button>
                                        <? } else { ?>
                                            <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/faq_category/toggle_faq/' . $b->id) ?>', 'Tem certeza que deseja ativar esta pergunta?')"></button>
                                        <? } ?>
                                        <a title="Editar" href="<?= site_url('admin/faq_category/edit_faq/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                        <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/faq_category/delete_faq/' . $b->id) ?>', 'Tem certeza que deseja excluír esta pergunta?')"></button>
                                    </td>
                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há perguntas cadastradas
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
                        ordenation(id, position, 'faq_category','update_ordenation_faq');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Perguntas ordenadas com sucesso!');
            }
        }).disableSelection();
    });
</script>