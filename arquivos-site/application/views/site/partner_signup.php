<section class="partner-signup">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 title">
                <h1><p><?= $this->lang->line('partner_signup_title') ?></p></h1>
            </div>
            <div class="col-12 partner-form">
                <? if (validation_errors()) { ?>
                    <div class="col-12 padding">
                        <div class="col-12 alert alert-danger">
                            <?= validation_errors() ?>
                        </div>
                    </div>
                <? } ?>
                <? if (isset($submit_success)) { ?>
                    <div class="alert-dialog">
                        <div class="alert-box">
                            <div class="alert-content">
                                <h2><?= $this->lang->line('success_send_contact') ?></h2>
                                <span class="close-dialog">x</span>
                            </div>
                        </div>
                    </div>
                <? } ?>
                <?= form_open($this->lang->line('url_partner_submit')) ?>
                    <div class="col-6 padding-bottom padding-right">
                        <input type="text" name="site" value="<?= set_value('site') ?>" placeholder="<?= $this->lang->line('placeholder_site') ?> *" class="input" required>
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <input type="email" name="email" value="<?= set_value('email') ?>" placeholder="<?= $this->lang->line('email') ?> *" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-right">
                        <input type="text" name="enterprise" value="<?= set_value('enterprise') ?>" placeholder="<?= $this->lang->line('enterprise_name') ?>" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <input type="text" name="cpf_cnpj" value="<?= set_value('cpf_cnpj') ?>" placeholder="CPF/CNPJ" class="input">
                    </div>
                    <div class="col-12 padding-bottom">
                        <input type="text" name="name" value="<?= set_value('name') ?>" placeholder="<?= $this->lang->line('full_name') ?> *" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-right">
                        <input type="tel" name="phone" value="<?= set_value('phone') ?>" placeholder="<?= $this->lang->line('phone') ?> *" class="input phone-input" required maxlength="50">
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <input type="text" name="address" value="<?= set_value('address') ?>" placeholder="<?= $this->lang->line('address') ?> *" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-right">
                        <? if ($current_language == 1) { ?>
                            <?= form_dropdown('state_id', $state_combo, set_value('state_id'), 'required id="state_id" onchange="load_cities()" class="input"') ?>
                        <? } else { ?>
                            <input type="text" name="state" value="<?= set_value('state') ?>" placeholder="<?= $this->lang->line('state') ?> *" class="input" required maxlength="100">
                        <? } ?>
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <? if ($current_language == 1) { ?>
                            <?= form_dropdown('city_id', $city_combo, set_value('city_id'), 'required id="city_id" class="input"') ?>
                        <? } else { ?>
                            <input type="text" name="city" value="<?= set_value('city') ?>" placeholder="<?= $this->lang->line('city') ?> *" class="input" required maxlength="100">
                        <? } ?>
                    </div>
                    <div class="col-6 padding-bottom padding-right">
                        <input type="text" name="cep" value="<?= set_value('cep') ?>" placeholder="<?= $this->lang->line('zip_code') ?> *" class="input" required maxlength="10">
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <input type="text" name="country" value="<?= set_value('country') ?>" placeholder="<?= $this->lang->line('country') ?> *" class="input" required maxlength="100">
                    </div>
                    <div class="col-12 padding-bottom contact-form_buttons secondary">
                        <div class="label">
                            <button type="submt" name="button"><?= $this->lang->line('send') ?></button>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>