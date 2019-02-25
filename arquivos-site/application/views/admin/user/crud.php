<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Usuários
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-user"></i> Usuários
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-plus"></i> Cadastro
                        </h3>
                    </div>
                    <?= form_open("admin/user/$op/$page", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <input type="text" hidden="" name="id" value="<?= isset($user) ? $user->id : '' ?>">
                        <div class="form-group <?= form_error('name') ? 'has-error' : '' ?>">
                            <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br>
                            <?
                            $value = '';
                            if (set_value('name')) {
                                $value = set_value('name');
                            } else if (isset($user)) {
                                $value = $user->name;
                            }
                            ?>
                            <input name="name" type="text" value="<?= $value ?>" placeholder="Informe o nome" class="form-control input-sm maxlength" maxlength="100" required autofocus="">
                        </div>
                        <div class="form-group <?= form_error('email') ? 'has-error' : '' ?>">
                            <label class="control-label" for="email">E-mail<em class="text-danger">*</em> <i class="fa fa-info-circle title" data-placement="rigth" title="O e-mail é necessário para recuperação da senha!"></i></label><br>
                            <?
                            $value = '';
                            if (set_value('email')) {
                                $value = set_value('email');
                            } else if (isset($user)) {
                                $value = $user->email;
                            }
                            ?>
                            <input name="email" value="<?= $value ?>" type="email"  placeholder="Informe o e-mail" class="form-control input-sm maxlength" required maxlength="100">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6 <?= form_error('password') ? 'has-error' : '' ?>">
                                <label class="control-label" for="password">Senha<em class="text-danger">*</em></label><br>
                                <input name="password" type="password" id="password" required="" placeholder="Informe a senha" maxlength="50" class="form-control input-sm maxlength">
                            </div>
                            <div class="form-group col-sm-6 <?= form_error('password') || form_error('re_password') ? 'has-error' : '' ?>">
                                <label class="control-label" for="re_password">Repita a senha<em class="text-danger">*</em></label><br>
                                <input name="re_password" type="password" id="re_password" required="" placeholder="Confirme a senha informada" maxlength="50" class="form-control input-sm">
                            </div>
                        </div>
                        <?
                            $is_admin = FALSE;
                            if (isset($user)) {
                                if ($user->id == 1) {
                                    $is_admin = TRUE;
                                }
                            }
                        ?>
                        <? if ($list && !$is_admin) { ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Permissões</h4>
                                    <? foreach ($permissions as $permission) { ?>
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="<?= $permission->id ?>" <?= isset($user_permissions) && in_array($permission->id, $user_permissions) ? 'checked' : '' ?>> <?= $permission->name ?>
                                            </label>
                                        </div>
                                    <? } ?>
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
            <? if ($list) { ?>
                <div class="col-md-7">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bars"></i> Usuários Cadastrados
                            </h3>
                        </div>
                        <div class="box-body">
                            <? if ($users) { ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-xs-5">Nome</th>
                                            <th class="col-xs-3">E-mail</th>
                                            <th class="col-xs-4">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? foreach ($users as $u) { ?>
                                            <tr>
                                                <td><?= $u->name ?></td>
                                                <td><?= $u->email ?></td>
                                                <td class="text-right">
                                                    <? if ($u->id > 1) { ?>
                                                        <? if ($u->status) { ?>
                                                            <button type="button" class="btn btn-sm btn-success glyphicon glyphicon-eye-open title" title="Desativar" onclick="confirm_dialog('<?= site_url("admin/user/toggle/$u->id/$page") ?>', 'Tem certeza que deseja desativar este usuário?')"></button>
                                                        <? } else { ?>
                                                            <button type="button" class="btn btn-sm btn-danger glyphicon glyphicon-eye-close title" title="Ativar" onclick="confirm_dialog('<?= site_url("admin/user/toggle/$u->id/$page") ?>', 'Tem certeza que deseja ativar este usuário?')"></button>
                                                        <? } ?>
                                                    <? } ?>
                                                    <a class="btn btn-sm btn-warning glyphicon glyphicon-edit title" title="Editar" href="<?= site_url("admin/user/edit/$u->id/$page") ?>"></a>
                                                    <? if ($u->id > 1) { ?>
                                                        <button type="button" class="btn btn-sm btn-danger glyphicon glyphicon-trash title" title="Excluir" onclick="confirm_dialog('<?= site_url("admin/user/delete/$u->id/$page") ?>', 'Tem certeza que deseja excluír este usuário?')"></button>
                                                    <? } ?>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                Mostrando de <b><?= $display_start ?></b> até <b><?= $display_end ?></b> de <b><?= $total_rows ?></b> registros
                                            </td>
                                        </tr>
                                        <? if ($this->pagination->create_links()) { ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="pagination pagination-centered"><?= $this->pagination->create_links() ?></div>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    </tfoot>
                                </table>
                            <? } else { ?>
                                <div class="alert alert-info text-center">
                                    <i class="fa fa-exclamation-triangle"></i> Não há usuários para mostrar
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </section>
</div>
