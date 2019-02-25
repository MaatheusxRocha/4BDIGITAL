<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-cog"></i> Configurações
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= site_url('admin') ?>"><i class="fa fa-dashboard"></i> <?= PROJECT ?></a>
            </li>
            <li class="active">
                <i class="fa fa-cog"></i> Configurações
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-plus"></i> Cadastro
                        </h3>
                    </div>
                    <?= form_open("admin/configuration/save", 'class="form-validate" autocomplete="off"') ?>
                    <div class="box-body">
                        <? if (validation_errors()) { ?>
                            <div class="alert alert-danger">
                                <?= validation_errors(); ?>
                            </div>
                        <? } ?>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('name') ? 'has-error' : '' ?>">
                                <label class="control-label" for="name">Nome<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('name')) {
                                    $value = set_value('name');
                                } else if (isset($configuration)) {
                                    $value = $configuration->name;
                                }
                                ?>
                                <input name="name" id="name" type="text" value="<?= $value ?>" placeholder="Nome da empresa" class="form-control input-sm maxlength" maxlength="100" required autofocus="">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('email') ? 'has-error' : '' ?>">
                                <label class="control-label" for="email">E-mail<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('email')) {
                                    $value = set_value('email');
                                } else if (isset($configuration)) {
                                    $value = $configuration->email;
                                }
                                ?>
                                <input name="email" id="email" type="email" value="<?= $value ?>" placeholder="E-mail para contato" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-3 <?= form_error('phone') ? 'has-error' : '' ?>">
                                <label class="control-label" for="phone">Telefone<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('phone')) {
                                    $value = set_value('phone');
                                } else if (isset($configuration)) {
                                    $value = $configuration->phone;
                                }
                                ?>
                                <input name="phone" id="phone" type="text" value="<?= $value ?>" placeholder="Telefone" class="form-control input-sm phone" maxlength="14" minlength="13" required>
                            </div>
                            <div class="form-group col-md-3 <?= form_error('contacts') ? 'has-error' : '' ?>">
                                <label class="control-label" for="contacts">Contatos</label><br>
                                <?
                                $value = '';
                                if (set_value('contacts')) {
                                    $value = set_value('contacts');
                                } else if (isset($configuration)) {
                                    $value = $configuration->contacts;
                                }
                                ?>
                                <input name="contacts" id="contacts" type="text" value="<?= $value ?>" placeholder="Separados por vírgula" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('cnpj') ? 'has-error' : '' ?>">
                                <label class="control-label" for="cnpj">CNPJ</label><br>
                                <?
                                $value = '';
                                if (set_value('cnpj')) {
                                    $value = set_value('cnpj');
                                } else if (isset($configuration)) {
                                    $value = $configuration->cnpj;
                                }
                                ?>
                                <input name="cnpj" id="cnpj" type="text" value="<?= $value ?>" placeholder="CNPJ" class="form-control input-sm cnpj" maxlength="20">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('uf') ? 'has-error' : '' ?>">
                                <label class="control-label" for="uf">Estado<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('uf')) {
                                    $value = set_value('uf');
                                } else if (isset($configuration)) {
                                    $value = $configuration->uf;
                                }
                                ?>
                                <input name="uf" id="uf" type="text" value="<?= $value ?>" placeholder="UF" class="form-control input-sm maxlength" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-3 <?= form_error('city') ? 'has-error' : '' ?>">
                                <label class="control-label" for="city">Cidade<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('city')) {
                                    $value = set_value('city');
                                } else if (isset($configuration)) {
                                    $value = $configuration->city;
                                }
                                ?>
                                <input name="city" id="city" type="text" value="<?= $value ?>" placeholder="Cidade" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-3 <?= form_error('cep') ? 'has-error' : '' ?>">
                                <label class="control-label" for="cep">CEP<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('cep')) {
                                    $value = set_value('cep');
                                } else if (isset($configuration)) {
                                    $value = $configuration->cep;
                                }
                                ?>
                                <input name="cep" id="cep" type="text" value="<?= $value ?>" placeholder="CEP" class="form-control input-sm cep" maxlength="10" minlength="10" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('district') ? 'has-error' : '' ?>">
                                <label class="control-label" for="district">Bairro<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('district')) {
                                    $value = set_value('district');
                                } else if (isset($configuration)) {
                                    $value = $configuration->district;
                                }
                                ?>
                                <input name="district" id="district" type="text" value="<?= $value ?>" placeholder="Bairro" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-3 <?= form_error('address') ? 'has-error' : '' ?>">
                                <label class="control-label" for="address">Endereço<em class="text-danger">*</em></label><br>
                                <?
                                $value = '';
                                if (set_value('address')) {
                                    $value = set_value('address');
                                } else if (isset($configuration)) {
                                    $value = $configuration->address;
                                }
                                ?>
                                <input name="address" id="address" type="text" value="<?= $value ?>" placeholder="Rua, número, etc" class="form-control input-sm maxlength" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-3 <?= form_error('twitter') ? 'has-error' : '' ?>">
                                <label class="control-label" for="twitter">Twitter</label><br>
                                <?
                                $value = '';
                                if (set_value('twitter')) {
                                    $value = set_value('twitter');
                                } else if (isset($configuration)) {
                                    $value = $configuration->twitter;
                                }
                                ?>
                                <input name="twitter" id="twitter" type="url" value="<?= $value ?>" placeholder="https://twitter.com/usuario" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('facebook') ? 'has-error' : '' ?>">
                                <label class="control-label" for="facebook">Facebook</label><br>
                                <?
                                $value = '';
                                if (set_value('facebook')) {
                                    $value = set_value('facebook');
                                } else if (isset($configuration)) {
                                    $value = $configuration->facebook;
                                }
                                ?>
                                <input name="facebook" id="facebook" type="url" value="<?= $value ?>" placeholder="https://facebook.com/usuario" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('youtube') ? 'has-error' : '' ?>">
                                <label class="control-label" for="youtube">YouTube</label><br>
                                <?
                                $value = '';
                                if (set_value('youtube')) {
                                    $value = set_value('youtube');
                                } else if (isset($configuration)) {
                                    $value = $configuration->youtube;
                                }
                                ?>
                                <input name="youtube" id="youtube" type="url" value="<?= $value ?>" placeholder="https://youtube.com/usuario" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('instagram') ? 'has-error' : '' ?>">
                                <label class="control-label" for="instagram">Instagram</label><br>
                                <?
                                $value = '';
                                if (set_value('instagram')) {
                                    $value = set_value('instagram');
                                } else if (isset($configuration)) {
                                    $value = $configuration->instagram;
                                }
                                ?>
                                <input name="instagram" id="instagram" type="url" value="<?= $value ?>" placeholder="https://instagram.com/usuario" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('linkedin') ? 'has-error' : '' ?>">
                                <label class="control-label" for="linkedin">LinkedIn</label><br>
                                <?
                                $value = '';
                                if (set_value('linkedin')) {
                                    $value = set_value('linkedin');
                                } else if (isset($configuration)) {
                                    $value = $configuration->linkedin;
                                }
                                ?>
                                <input name="linkedin" id="linkedin" type="url" value="<?= $value ?>" placeholder="https://linkedin.com/usuario" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('google_plus') ? 'has-error' : '' ?>">
                                <label class="control-label" for="google_plus">Google+</label><br>
                                <?
                                $value = '';
                                if (set_value('google_plus')) {
                                    $value = set_value('google_plus');
                                } else if (isset($configuration)) {
                                    $value = $configuration->google_plus;
                                }
                                ?>
                                <input name="google_plus" id="google_plus" type="url" value="<?= $value ?>" placeholder="https://plus.google.com/usuario" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('link_maps') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link_maps">Link Google Maps</label><br>
                                <?
                                $value = '';
                                if (set_value('link_maps')) {
                                    $value = set_value('link_maps');
                                } else if (isset($configuration)) {
                                    $value = $configuration->link_maps;
                                }
                                ?>
                                <input name="link_maps" id="link_maps" type="url" value="<?= $value ?>" placeholder="https://maps.google.com/location...." class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('link_entry') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link_entry">Link "Entrar"</label><br>
                                <?
                                $value = '';
                                if (set_value('link_entry')) {
                                    $value = set_value('link_entry');
                                } else if (isset($configuration)) {
                                    $value = $configuration->link_entry;
                                }
                                ?>
                                <input name="link_entry" id="link_entry" type="url" value="<?= $value ?>" placeholder="https://restrito.brascloud.com" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('link_blog') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link_blog">Link Blog</label><br>
                                <?
                                $value = '';
                                if (set_value('link_blog')) {
                                    $value = set_value('link_blog');
                                } else if (isset($configuration)) {
                                    $value = $configuration->link_blog;
                                }
                                ?>
                                <input name="link_blog" id="link_blog" type="url" value="<?= $value ?>" placeholder="https://blog.brascloud.com" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('link_new_account') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link_new_account">Link "Crie uma Conta"</label><br>
                                <?
                                $value = '';
                                if (set_value('link_new_account')) {
                                    $value = set_value('link_new_account');
                                } else if (isset($configuration)) {
                                    $value = $configuration->link_new_account;
                                }
                                ?>
                                <input name="link_new_account" id="link_new_account" type="url" value="<?= $value ?>" placeholder="https://cadastro.brascloud.com" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 <?= form_error('link_wiki') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link_wiki">Link Wiki</label><br>
                                <?
                                $value = '';
                                if (set_value('link_wiki')) {
                                    $value = set_value('link_wiki');
                                } else if (isset($configuration)) {
                                    $value = $configuration->link_wiki;
                                }
                                ?>
                                <input name="link_wiki" id="link_wiki" type="url" value="<?= $value ?>" placeholder="https://wiki.brascloud.com" class="form-control input-sm">
                            </div>
                            <div class="form-group col-md-3 <?= form_error('link_portal') ? 'has-error' : '' ?>">
                                <label class="control-label" for="link_portal">Link Portal</label><br>
                                <?
                                $value = '';
                                if (set_value('link_portal')) {
                                    $value = set_value('link_portal');
                                } else if (isset($configuration)) {
                                    $value = $configuration->link_portal;
                                }
                                ?>
                                <input name="link_portal" id="link_portal" type="url" value="<?= $value ?>" placeholder="https://portal.brascloud.com" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?= form_error('attendance') ? 'has-error' : '' ?>">
                                <label class="control-label" for="attendance">Horário de Atendimento</label><br>
                                <?
                                $value = '';
                                if (set_value('attendance')) {
                                    $value = set_value('attendance');
                                } else if (isset($configuration)) {
                                    $value = $configuration->attendance;
                                }
                                ?>
                                <textarea name="attendance" id="attendance" placeholder="Horário de atendimento" class="editor"><?= $value ?></textarea>
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
        </div>
    </section>
</div>
