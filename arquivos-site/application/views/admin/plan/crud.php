<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-th-large"></i> Planos 
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-th-large"></i> Planos
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <?= form_open('admin/plan/' . $op, 'class="form-validate"') ?>
                    <input type="hidden" name="id" value="<?= isset($plan) ? $plan->id : NULL ?>">
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
                            if (!$value && isset($plan)) {
                                $value = $plan->name;
                            }
                            ?>
                            <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="115" required autocomplete="off" autofocus="">
                        </div>
                        <div class="form-group <?= form_error('leaf_text') ? 'has-error' : '' ?>">
                            <label class="control-label" for="leaf_text">Texto da Folha</label><br>
                            <?
                            $value = set_value('leaf_text');
                            if (!$value && isset($plan)) {
                                $value = $plan->leaf_text;
                            }
                            ?>
                            <input name="leaf_text" id="leaf_text" type="text" value="<?= $value ?>" placeholder="Informe o texto da folha" class="form-control input-sm maxlength" maxlength="15" autocomplete="off">
                        </div>
                        <div class="form-group <?= form_error('best_seller') ? 'has-error' : '' ?>">
                            <label class="control-label" for="best_seller">Mais Vendido?</label><br>
                            <?
                            $value = set_value('best_seller');
                            if (!$value && isset($plan)) {
                                $value = $plan->best_seller;
                            }
                            ?>
                            <input name="best_seller" id="best_seller" type="checkbox" <?= $value ? 'checked' : '' ?> class="form-control input-sm" autocomplete="off"> Sim
                        </div>
                        <div class="form-group <?= form_error('plan_exist_1') ? 'has-error' : '' ?>">
                            <label class="control-label" for="plan_exist_1">Plano encontrado (1ª parte) <em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('plan_exist_1');
                            if (!$value && isset($plan)) {
                                $value = $plan->plan_exist_1;
                            }
                            ?>
                            <input name="plan_exist_1" id="plan_exist_1" type="text" value="<?= $value ?>" required placeholder="Informe a parte 1 do texto quando o plano é encontrado" class="form-control input-sm" autocomplete="off">
                        </div>
                        <div class="form-group <?= form_error('plan_exist_2') ? 'has-error' : '' ?>">
                            <label class="control-label" for="plan_exist_2">Plano encontrado (2ª parte) <em class="text-danger">*</em></label><br>
                            <?
                            $value = set_value('plan_exist_2');
                            if (!$value && isset($plan)) {
                                $value = $plan->plan_exist_2;
                            }
                            ?>
                            <input name="plan_exist_2" id="plan_exist_2" type="text" value="<?= $value ?>" required placeholder="Informe a parte 2 do texto quando o plano é encontrado" class="form-control input-sm" autocomplete="off">
                        </div>
                        <hr>
                        <? foreach ($operationals as $so) { ?>
                            <h4><?= $so->name ?></h4>
                            <div class="row">
                                <div class="form-group col-md-6 <?= form_error('price_month_' . $so->id) ? 'has-error' : '' ?>">
                                    <label class="control-label" for="price_month_"<?= $so->id ?>>Valor mensal<em class="text-danger">*</em></label><br>
                                    <?
                                    $value = '';
                                    if (set_value('price_month_'.$so->id)) {
                                        $value = set_value('price_month_'.$so->id);
                                    } else if (isset($so->price_month)) {
                                        $value = number_format($so->price_month, 2, ',', '.');
                                    }
                                    ?>
                                    <input name="price_month_<?= $so->id ?>" id="price_month_<?= $so->id ?>" onkeyup="calcule_value_hour_so('<?= $so->id ?>')" type="text" value="<?= $value ?>" placeholder="Informe o valor mensal" class="form-control input-sm money" required>
                                </div>
                                <div class="form-group col-md-6 <?= form_error('price_hour_' . $so->id) ? 'has-error' : '' ?>">
                                    <label class="control-label" for="price_hour_<?= $so->id ?>">Valor hora<em class="text-danger">*</em></label><br>
                                    <?
                                    $value = '';
                                    if (set_value('price_hour')) {
                                        $value = set_value('price_hour');
                                    } else if (isset($so->price_hour)) {
                                        $value = $so->price_hour;
                                    }
                                    ?>
                                    <input name="price_hour_<?= $so->id ?>" id="price_hour_<?= $so->id ?>" type="text" readonly value="<?= $value ?>" placeholder="Valor por hora" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 <?= form_error('price_month_promotion_' . $so->id) ? 'has-error' : '' ?>">
                                    <label class="control-label" for="price_month_promotion_"<?= $so->id ?>>Valor mensal Promocional</label><br>
                                    <?
                                    $value = '';
                                    if (set_value('price_month_promotion_'.$so->id)) {
                                        $value = set_value('price_month_promotion_'.$so->id);
                                    } else if (isset($so->price_month_promotion)) {
                                        $value = number_format($so->price_month_promotion, 2, ',', '.');
                                    }
                                    ?>
                                    <input name="price_month_promotion_<?= $so->id ?>" id="price_month_promotion_<?= $so->id ?>" onkeyup="calcule_value_hour_so('<?= $so->id ?>','promotion')" type="text" value="<?= $value ?>" placeholder="Informe o valor mensal" class="form-control input-sm money">
                                </div>
                                <div class="form-group col-md-6 <?= form_error('price_hour_promotion_' . $so->id) ? 'has-error' : '' ?>">
                                    <label class="control-label" for="price_hour_<?= $so->id ?>">Valor hora Promocional</label><br>
                                    <?
                                    $value = '';
                                    if (set_value('price_hour_promotion_'.$so->id)) {
                                        $value = set_value('price_hour_promotion_'.$so->id);
                                    } else if (isset($so->price_hour_promotion)) {
                                        $value = number_format($so->price_hour_promotion, 2, ',', '.');
                                    }
                                    ?>
                                    <input name="price_hour_promotion_<?= $so->id ?>" id="price_hour_promotion_<?= $so->id ?>" type="text" readonly value="<?= $value ?>" placeholder="Valor por hora" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group <?= form_error('storage_'.$so->id) ? 'has-error' : '' ?>">
                                <label class="control-label" for="storage_<?=$so->id?>">Armazenamento GB<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('storage_'.$so->id)) {
                                    $value = set_value('storage_'.$so->id);
                                } else if (isset($so->storage)) {
                                    $value = $so->storage;
                                }
                                ?>
                                <input name="storage_<?= $so->id ?>" id="storage_<?= $so->id ?>" type="number" value="<?= $value ?>" placeholder="Armazenamento" class="form-control input-sm" min="1" required>
                            </div>
                            <hr>
                        <? } ?>
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
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-bars"></i> Planos Cadastrados <i class="fa fa-info-circle title" title="Para ordenar, clique e arraste!"></i>
                        </h3>
                    </div>
                    <div class="box-body">
                        <? if ($plans) { ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-7">Nome</th>
                                        <th class="col-xs-5"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <? foreach ($plans as $b) { ?>
                                        <tr style="cursor: n-resize">
                                            <input type="hidden" value="<?= $b->id ?>">
                                            <td><?= $b->name ?></td>
                                            <td class="text-right">
                                                <a title="Adicionar Itens" href="<?= site_url('admin/plan/config/' . $b->id) ?>" class="btn btn-sm btn-primary glyphicon glyphicon-cog title"></a>
                                                <? if ($b->status) { ?>
                                                    <button title="Desativar" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/plan/toggle/'.$b->id) ?>', 'Tem certeza que deseja desativar este plano?')"></button>
                                                <? } else { ?>
                                                    <button title="Ativar" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/plan/toggle/'.$b->id) ?>', 'Tem certeza que deseja ativar este plano?')"></button>
                                                <? } ?>
                                                <a title="Editar" href="<?= site_url('admin/plan/edit/' . $b->id) ?>" class="btn btn-sm btn-warning glyphicon glyphicon-edit title"></a>
                                                <button title="Excluir" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" onclick="confirm_dialog('<?= site_url('admin/plan/delete/' . $b->id) ?>', 'Tem certeza que deseja excluír este plano?')"></button>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                            </table>
                        <? } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-exclamation-triangle"></i> Não há planos cadastrados
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
                        ordenation(id, position, 'plan');
                    }
                });
            },
            stop: function (event, ui) {
                generate_message('success', 'Planos ordenados com sucesso!');
            }
        }).disableSelection();
    });
</script>