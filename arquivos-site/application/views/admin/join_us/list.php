<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-briefcase"></i> Trabalhe Conosco
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-briefcase"></i> Trabalhe Conosco
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
                                <?= form_open_multipart('admin/join_us', 'class="form-validate" autocomplete="off"') ?>
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
                                <? if ($join_uss) { ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Cargo</th>
                                                <th>E-mail</th>
                                                <th>Telefone</th>
                                                <th>Data</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($join_uss as $l) { ?>
                                                <tr>
                                                    <td><?= $l->name ?></td>
                                                    <td><?= $l->job ?></td>
                                                    <td><?= $l->email ?></td>
                                                    <td><?= $l->phone ?></td>
                                                    <? $date = new DateTime($l->created_at) ?>
                                                    <td><?= $date->format('d/m/Y') ?> às <?= $date->format('H:i') ?></td>
                                                    <td class="text-right">
                                                        <? if ($l->status) { ?>
                                                            <button title="Marcar como não visto" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/join_us/toggle/' . $l->id) ?>', 'Tem certeza que deseja marcar este currículo como não visto?')"></button>
                                                        <? } else { ?>
                                                            <button title="Marcar como visto" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/join_us/toggle/' . $l->id) ?>', 'Tem certeza que deseja marcar este currículo como visto?')"></button>
                                                        <? } ?>
                                                        <a href="#contact-<?= $l->id ?>" class="btn btn-primary btn-sm title" title="Detalhes" data-toggle="modal">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    Mostrando de <b><?= $display_start ?></b> até <b><?= $display_end ?></b> de <b><?= $total_rows ?></b> registros
                                                </td>
                                            </tr>
                                            <? if ($this->pagination->create_links()) { ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="pagination pagination-centered"><?= $this->pagination->create_links() ?></div>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tfoot>
                                    </table>
                                <? } else { ?>
                                    <div class="alert alert-info text-center col-md-6 col-md-push-3">
                                        <i class="fa fa-exclamation-triangle"></i> Não há currículos para listar
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
<? foreach ($join_uss as $contact) { ?>
    <div class="modal fade" id="contact-<?= $contact->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Trabalhe Conosco</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <td><?= $contact->name ?></td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td><?= $contact->email ?></td>
                                </tr>
                                <tr>
                                    <th>Telefone</th>
                                    <td><?= $contact->phone ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Cargo</th>
                                    <td><?= $contact->job ?></td>
                                </tr>
                                <tr>
                                    <th>Data</th>
                                    <? $date = new DateTime($l->created_at) ?>
                                    <td><?= $date->format('d/m/Y') ?> às <?= $date->format('H:i') ?></td>
                                </tr>
                                <tr>
                                    <th>Currículo</th>
                                    <td>
                                        <a href="<?= site_url($contact->archive) ?>" target='_blank'>Ver arquivo</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?= str_replace("\n", '<br>', $contact->message) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<? } ?>
