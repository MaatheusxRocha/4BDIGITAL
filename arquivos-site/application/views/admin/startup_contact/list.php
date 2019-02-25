<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Startups
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-user-plus"></i> Startups
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
                                <?= form_open_multipart('admin/startup_contact', 'class="form-validate" autocomplete="off"') ?>
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
                                <? if ($startup_contacts) { ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Cidade - UF</th>
                                                <th>Fundação</th>
                                                <th>Mercado</th>
                                                <th>Data</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($startup_contacts as $l) { ?>
                                                <tr>
                                                    <td><?= $l->name_startup ?></td>
                                                    <td><?= $l->city_id ? "$l->city_name - $l->state_uf" : "$l->city - $l->state" ?></td>
                                                    <td><?= unformat_date($l->foundation_date) ?></td>
                                                    <td><?= $l->market ?></td>
                                                    <? $date = new DateTime($l->created_at) ?>
                                                    <td><?= $date->format('d/m/Y') ?> às <?= $date->format('H:i') ?></td>
                                                    <td class="text-right">
                                                        <? if ($l->status) { ?>
                                                            <button title="Marcar como não visto" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" onclick="confirm_dialog('<?= site_url('admin/startup_contact/toggle/' . $l->id) ?>', 'Tem certeza que deseja marcar esta startup como não vista?')"></button>
                                                        <? } else { ?>
                                                            <button title="Marcar como visto" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" onclick="confirm_dialog('<?= site_url('admin/startup_contact/toggle/' . $l->id) ?>', 'Tem certeza que deseja marcar esta startup como vista?')"></button>
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
                                        <i class="fa fa-exclamation-triangle"></i> Não há startups para listar
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
<? foreach ($startup_contacts as $contact) { ?>
    <div class="modal fade" id="contact-<?= $contact->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Startup</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <td><?= $contact->name_startup ?></td>
                                </tr>
                                <tr>
                                    <th>Razão social</th>
                                    <td><?= $contact->company_name ? $contact->company_name : ' - ' ?></td>
                                </tr>
                                <? if ($contact->cnpj) { ?>
                                    <tr>
                                        <th>CNPJ</th>
                                        <td><?= $contact->cnpj ?></td>
                                    </tr>
                                <? } ?>
                                <tr>
                                    <th>E-mail</th>
                                    <td><?= $contact->email ?></td>
                                </tr>
                                <tr>
                                    <th>País - UF - Estado</th>
                                    <td><?= $contact->country ?> - <?= $contact->city_id ? "$contact->state_uf - $contact->city_name" : "$contact->state - $contact->city" ?></td>
                                </tr>
                                <tr>
                                    <th>Endereço</th>
                                    <td>n° <?= $contact->number ?>, <?= $contact->address ?> (<?= $contact->complement ?>), bairro <?= $contact->district ?></td>
                                </tr>
                                <tr>
                                    <th>CEP</th>
                                    <td><?= $contact->cep ?></td>
                                </tr>
                                <tr>
                                    <th>Fundação</th>
                                    <td><?= unformat_date($contact->foundation_date) ?></td>
                                </tr>
                                <tr>
                                    <th>Data</th>
                                    <? $date = new DateTime($l->created_at) ?>
                                    <td><?= $date->format('d/m/Y') ?> às <?= $date->format('H:i') ?></td>
                                </tr>
                                <tr>
                                    <th>Cupom</th>
                                    <td><?= $contact->coupon ? $contact->coupon : ' - ' ?></td>
                                </tr>
                                <? if ($contact->logo) { ?>
                                    <tr>
                                        <th>Logo</th>
                                        <td><img src="<?= base_url($contact->logo) ?>" style="max-width: 100%; max-height: 100px"></td>
                                    </tr>
                                <? } ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <? if ($contact->project_page) { ?>
                                    <tr>
                                        <th>Página do projeto</th>
                                        <td><?= $contact->project_page ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->facebook || $contact->twitter || $contact->linkedin) { ?>
                                    <tr>
                                        <th>Redes sociais</th>
                                        <td>
                                            <? if ($contact->facebook) { ?>
                                                <a href="<?= $contact->facebook ?>" target="_blank">Facebook</a>
                                            <? } ?>
                                            <? if ($contact->twitter) { ?>
                                                <a href="<?= $contact->twitter ?>" target="_blank">Twitter</a>
                                            <? } ?>
                                            <? if ($contact->linkedin) { ?>
                                                <a href="<?= $contact->linkedin ?>" target="_blank">LinkedIn</a>
                                            <? } ?>
                                        </td>
                                    </tr>
                                <? } ?>
                                <tr>
                                    <th>Telefone</th>
                                    <td><?= $contact->phone ?></td>
                                </tr>
                                <? if ($contact->met) { ?>
                                    <tr>
                                        <th>Como conheceu a Brascloud?</th>
                                        <td><?= $contact->met ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->annual_billing) { ?>
                                    <tr>
                                        <th>Faturamento anual</th>
                                        <td>R$ <?= number_format($contact->annual_billing, 2, ',', '.') ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->number_partners) { ?>
                                    <tr>
                                        <th>Sócios</th>
                                        <td><?= $contact->number_partners ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->number_team) { ?>
                                    <tr>
                                        <th>Tamanho do time</th>
                                        <td><?= $contact->number_team ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->startup_stage) { ?>
                                    <tr>
                                        <th>Estágio</th>
                                        <td><?= $contact->startup_stage ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->market) { ?>
                                    <tr>
                                        <th>Mercado</th>
                                        <td><?= $contact->market ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->annual_billing) { ?>
                                    <tr>
                                        <th>Modelo de negócio</th>
                                        <td><?= $contact->business_model ?></td>
                                    </tr>
                                <? } ?>
                                <? if ($contact->recipes) { ?>
                                    <tr>
                                        <th>Modelo de receita</th>
                                        <td><? foreach ($contact->recipes as $k => $recipe) {
                                echo ($k ? ', ' : '') . $recipe->name;
                            } ?></td>
                                    </tr>
    <? } ?>
                            </table>
                        </div>
                    </div>
                    <h4>Descrição</h4>
    <?= str_replace("\n", '<br>', $contact->description) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<? } ?>
