<section class="contact">
    <div class="container clearfix">
        <div class="row clearfix">
            <? if ($text_contact_us) { ?>
                <div class="col-12 title">
                    <h1><?= strpos($text_contact_us->title, '<p>') === FALSE ? "<p>$text_contact_us->title</p>" : $text_contact_us->title ?></h1>
                </div>
                <div class="col-12 contact-text">
                    <h3><?= $text_contact_us->title_two ?></h3>
                    <p><?= $text_contact_us->description ?></p>
                </div>
            <? } ?>
            <? if ($configuration) { ?>
                <div class="col-12 contact-address">
                    <address>
                        <p><img src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/site/images/building-01.png') ?>" alt="Icon address"> <?= $configuration->address ?> | CEP <?= $configuration->cep ?> | <?= $configuration->city ?> - <?= $configuration->uf ?> <?= $configuration->cnpj ? "| CNPJ $configuration->cnpj" : '' ?></p>
                        <p><img src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/site/images/mail-01.png') ?>" alt="Icon email"><?=$this->lang->line('email')?>: <a href="mailto:<?= $configuration->email ?>"><?= $configuration->email ?></a></p>
                        <p><img src="<?= base_url('assets/'.SCRIPTS_FOLDER.'/site/images/tel-01.png') ?>" alt="Icon phone"><?=$this->lang->line('comercial_phone')?>: <a href="tel:+55<?= clean_phone($configuration->phone) ?>">+55 <?= str_replace(array(')'),array(') '),$configuration->phone) ?></a></p>
                    </address>
                </div>
            <? } ?>
            <div class="col-12 contact-form">
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
                <?= form_open($this->lang->line('url_send_contact')) ?>
                    <div class="col-12 padding-bottom">
                        <input type="text" name="name" value="<?= set_value('name') ?>" placeholder="<?= $this->lang->line('name') ?>" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-right">
                        <input type="email" name="email" value="<?= set_value('email') ?>" placeholder="<?= $this->lang->line('email') ?>" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <input type="tel" name="phone" value="<?= set_value('phone') ?>" placeholder="<?= $this->lang->line('phone') ?>" class="input <?= $current_language == 1 ? 'phone-input' : '' ?>" required maxlength="50">
                    </div>
                    <div class="col-6 padding-bottom padding-right">
                        <? if ($current_language == 1) { ?>
                            <?= form_dropdown('state_id', $state_combo, set_value('state_id'), 'required class="input" id="state_id" onchange="load_cities()"') ?>
                        <? } else { ?>
                            <input type="text" name="state" value="<?= set_value('state') ?>" placeholder="<?= $this->lang->line('state') ?>" class="input" required maxlength="100">
                        <? } ?>
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <? if ($current_language == 1) { ?>
                            <?= form_dropdown('city_id', $city_combo, set_value('city_id'), 'required class="input" id="city_id"') ?>
                        <? } else { ?>
                            <input type="text" name="city" value="<?= set_value('city') ?>" placeholder="<?= $this->lang->line('city') ?>" class="input" required maxlength="100">
                        <? } ?>
                    </div>
                    <div class="col-12 padding-bottom">
                        <input type="text" name="country" value="<?= set_value('country') ?>" placeholder="<?= $this->lang->line('country') ?>" class="input" required maxlength="100">
                    </div>
                    <div class="col-12 padding-bottom">
                        <input type="text" name="subject" value="<?= set_value('subject') ?>" placeholder="<?= $this->lang->line('subject') ?>" class="input" required maxlength="150">
                    </div>
                    <div class="col-12 padding-bottom">
                        <?= form_dropdown('department_id', $department_combo, set_value('department_id'), 'required class="input"') ?>
                    </div>
                    <div class="col-12 padding-bottom">
                        <textarea name="message" placeholder="<?= $this->lang->line('message') ?>" class="input" required><?= set_value('message') ?></textarea>
                    </div>
                    <div class="col-12 padding-bottom contact-form_buttons half">
                        <div class="label">
                            <button type="submit" name="button"><?= $this->lang->line('send') ?></button>
                        </div>
                        <? if (isset($configuration) && !empty($configuration->link_portal)) { ?>
                            <div class="label">
                                <a href="<?= $configuration->link_portal ?>"><?=$this->lang->line('call_portal')?></a>
                            </div>
                        <? } ?>
                    </div>
                <?= form_close() ?>
            </div>
            <? if ($text_contact_us) { ?>
                <div class="col-12 contact-text">
                    <h3><?= $text_contact_us->title_three ?></h3>
                    <?= str_replace('<p>', '<p><img src="'.base_url('assets/'.SCRIPTS_FOLDER.'/site/images/tel-01.png').'">', $text_contact_us->description_two) ?>
                </div>
            <? } ?>
            <div class="col-12 contact-form phone">
                <?= form_open($this->lang->line('url_call_submit')) ?>
                    <div class="col-12 padding-bottom">
                        <input type="text" name="call_name" value="<?= set_value('call_name') ?>" placeholder="<?= $this->lang->line('name') ?>" class="input" required maxlength="100">
                    </div>
                    <div class="col-12 padding-bottom padding-right">
                        <input type="tel" name="call_phone" value="<?= set_value('call_phone') ?>" placeholder="<?= $this->lang->line('phone') ?>" class="input phone-input" required maxlength="50">
                    </div>
                    <div class="col-12 padding-bottom contact-form_buttons">
                        <div class="label">
                            <button type="submit" name="button"><?= $this->lang->line('send') ?></button>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>
