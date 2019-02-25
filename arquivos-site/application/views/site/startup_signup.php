<section class="startup-signup">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 title">
                <h1><p><?= $this->lang->line('startup_signup_title') ?></p></h1>
            </div>
            <div class="col-12 startup-form">
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
                                <?
                                $code = $this->session->userdata('promotional_code');
                                if (!empty($code)) {
                                    ?>
                                    <p><?= ucfirst($this->lang->line('coupon_link')) ?>:<strong><?= $code ?></strong></p>
                                    <?
                                }
                                ?>
                                <span class="close-dialog">x</span>
                            </div>
                        </div>
                    </div>
                <? } ?>
                <?= form_open_multipart($this->lang->line('url_startup_submit')) ?>
                <div class="col-12 padding-bottom">
                    <h3><?= $this->lang->line('startup_data') ?></h3>
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="name_startup" value="<?= set_value('name_startup') ?>" placeholder="<?= $this->lang->line('startup_name') ?> *" class="input" required maxlength="100">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="company_name" value="<?= set_value('company_name') ?>" placeholder="<?= $this->lang->line('company_name') ?>" class="input" maxlength="100">
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="cnpj" value="<?= set_value('cnpj') ?>" placeholder="CNPJ" class="input cnpj" maxlength="30">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="tel" name="phone" value="<?= set_value('phone') ?>" placeholder="<?= $this->lang->line('landline') ?> *" class="input phone-input" required maxlength="50">
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="cep" value="<?= set_value('cep') ?>" placeholder="<?= $this->lang->line('zip_code') ?> *" class="input" required maxlength="20">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="address" value="<?= set_value('address') ?>" placeholder="<?= $this->lang->line('address') ?> *" class="input" required maxlength="150">
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="number" value="<?= set_value('number') ?>" placeholder="<?= $this->lang->line('number') ?> *" class="input" maxlength="10" required>
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="complement" value="<?= set_value('complement') ?>" placeholder="<?= $this->lang->line('complement') ?>" class="input" maxlength="100">
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="district" value="<?= set_value('district') ?>" placeholder="<?= $this->lang->line('district') ?> *" class="input" required maxlength="100">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="country" value="<?= set_value('country') ?>" placeholder="<?= $this->lang->line('country') ?> *" class="input" required maxlength="100">
                </div>
                <? if ($current_language == 1) { ?>
                    <div class="col-6 padding-bottom padding-right">
                        <?= form_dropdown('uf_id', $state_combo, set_value('uf_id'), 'required class="input" onchange="load_cities()" id="state_id"') ?>
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <?= form_dropdown('city_id', $city_combo, set_value('city_id'), 'required class="input" id="city_id"') ?>
                    </div>
                <? } else { ?>
                    <div class="col-6 padding-bottom padding-right">
                        <input type="text" name="uf" value="<?= set_value('uf') ?>" placeholder="<?= $this->lang->line('state') ?> *" class="input" required maxlength="100">
                    </div>
                    <div class="col-6 padding-bottom padding-left">
                        <input type="text" name="city" value="<?= set_value('city') ?>" placeholder="<?= $this->lang->line('city') ?>" class="input" required maxlength="100">
                    </div>
                <? } ?>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="foundation_date" value="<?= set_value('foundation_date') ?>" placeholder="<?= $this->lang->line('foundation_date') ?>" class="input date">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="email" name="email" value="<?= set_value('email') ?>" placeholder="<?= $this->lang->line('email') ?> *" required class="input" maxlength="100">
                </div>
                <!--  -->
                <div class="col-12 padding-bottom padding-top">
                    <h3><?= $this->lang->line('startup_profile') ?></h3>
                </div>
                <div class="col-12 padding-bottom logo">
                    <div class="col-1">
                        <div class="label-input">
                            Logo
                        </div>
                    </div>
                    <div class="col-11 padding-left-big">
                        <div class="logo-holder">
                            <input type="file" class="join-file" name="logo" id="logo-input" title="<?= $this->lang->line('selected_file') ?>">
                            <label for="logo-input"><?= $this->lang->line('choose_file') ?>...</label>
                            <span class="file-name"><?= $this->lang->line('empty_file') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 padding-bottom">
                    <textarea name="description" placeholder="<?= $this->lang->line('short_description') ?> *" class="input small" required><?= set_value('description') ?></textarea>
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="project_page" value="<?= set_value('project_page') ?>" placeholder="<?= $this->lang->line('placeholder_project_page') ?>" class="input">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="facebook" value="<?= set_value('facebook') ?>" placeholder="<?= $this->lang->line('placeholder_facebook') ?>" class="input">
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="twitter" value="<?= set_value('twitter') ?>" placeholder="<?= $this->lang->line('placeholder_twitter') ?>" class="input">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="linkedin" value="<?= set_value('linkedin') ?>" placeholder="<?= $this->lang->line('placeholder_linkedin') ?>" class="input">
                </div>
                <!--  -->
                <div class="col-12 padding-bottom padding-top">
                    <h3>Mais informações</h3>
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="text" name="met" value="<?= set_value('met') ?>" placeholder="<?= $this->lang->line('met') ?>" class="input" maxlength="150">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="text" name="annual_billing" value="<?= set_value('annual_billing') ?>" placeholder="<?= $this->lang->line('annual_billing') ?>" class="input money">
                </div>
                <div class="col-6 padding-bottom padding-right">
                    <input type="number" name="number_partners" value="<?= set_value('number_partners') ?>" placeholder="<?= $this->lang->line('number_partners') ?>" class="input">
                </div>
                <div class="col-6 padding-bottom padding-left">
                    <input type="number" name="number_team" value="<?= set_value('number_team') ?>" placeholder="<?= $this->lang->line('number_team') ?>" class="input">
                </div>
                <div class="col-12 padding-bottom">
                    <div class="recipe">
                        <div class="label-input">
                            <?= $this->lang->line('recipe_model') ?>
                        </div>
                        <? foreach ($recipes as $recipe) { ?>
                            <div class="recipe-input">
                                <input type="checkbox" name="recipe[]" value="<?= $recipe->id ?>" id="recipe-<?= $recipe->id ?>">
                                <label for="recipe-<?= $recipe->id ?>"><?= $recipe->name ?></label>
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div class="col-12 padding-bottom">
                    <input type="text" name="startup_stage" value="<?= set_value('startup_stage') ?>" placeholder="<?= $this->lang->line('startup_stage') ?>" class="input" maxlength="100">
                </div>
                <div class="col-12 padding-bottom">
                    <input type="text" name="market" value="<?= set_value('market') ?>" placeholder="<?= $this->lang->line('market') ?>" class="input" maxlength="100">
                </div>
                <div class="col-12 padding-bottom">
                    <input type="text" name="business_model" value="<?= set_value('business_model') ?>" placeholder="<?= $this->lang->line('business_model') ?>" class="input" maxlength="100">
                </div>
                <div class="col-12 padding-bottom contact-form_buttons secondary">
                    <div class="label">
                        <button type="submt" name="button"><?= $this->lang->line('send') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
