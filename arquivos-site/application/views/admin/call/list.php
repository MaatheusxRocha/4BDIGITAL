<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-phone"></i> Ligue-me
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-phone"></i> Ligue-me
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <? if (validation_errors()) { ?>
                                    <div class="alert alert-danger">
                                        <?= validation_errors() ?>
                                    </div>
                                <? } ?>
                                <?= form_open_multipart('admin/call', 'class="form-validate" autocomplete="off"') ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="start_date" class="control-label">Data Inicial</label><br>
                                        <input type="text" id="start_date" name="start_date" class="input-sm form-control date datepicker" value="<?= unformat_date($start_date) ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_date" class="control-label">Data Final</label><br>
                                        <input type="text" id="end_date" name="end_date" class="input-sm form-control date datepicker" value="<?= unformat_date($end_date) ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">&nbsp;</label><br>
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> Buscar
                                        </button>
                                        <button type="reset" class="btn btn-warning btn-sm">
                                            <span class="glyphicon glyphicon-refresh"></span> Limpar
                                        </button>
                                    </div>
                                </div>
                                <?= form_close() ?>
                                <hr>
                                <? if ($calls) { ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>Data</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($calls as $l) { ?>
                                                <tr>
                                                    <td><?= $l->name ?></td>
                                                    <td><?= $l->phone ?></td>
                                                    <? $date = new DateTime($l->created_at) ?>
                                                    <td><?= $date->format('d/m/Y') ?> às <?= $date->format('H:i') ?></td>
                                                    <td class="text-right">
                                                        <? if ($l->status) { ?>
                                                            <button title="Marcar como não lido" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/call/toggle/' . $l->id) ?>', 'Tem certeza que deseja marcar este contato como não lido?')"></button>
                                                        <? } else { ?>
                                                            <button title="Marcar como lido" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/call/toggle/' . $l->id) ?>', 'Tem certeza que deseja marcar este contato como lido?')"></button>
                                                        <? } ?>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    Mostrando de <b><?= $display_start ?></b> até <b><?= $display_end ?></b> de <b><?= $total_rows ?></b> registros
                                                </td>
                                            </tr>
                                            <? if ($this->pagination->create_links()) { ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="pagination pagination-centered"><?= $this->pagination->create_links() ?></div>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tfoot>
                                    </table>
                                <? } else { ?>
                                    <div class="alert alert-info text-center col-md-6 col-md-push-3">
                                        <i class="fa fa-exclamation-triangle"></i> Não há contatos para listar
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
