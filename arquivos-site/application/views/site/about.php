<section class="about">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-5">
                <div class="about-text">
                    <div>
                        <h2><p><?= $this->lang->line('title_about') ?></p></h2>
                        <img src="<?= base_url($about->image_brascloud) ?>" alt="<?= strip_tags($this->lang->line('title_about')) ?>" draggable="false" class="about-image-resp">
                        <?= $about->text_brascloud ?>
                    </div>
                </div>
            </div>
            <? if (!empty($about->image_brascloud)) { ?>
                <div class="col-7 about-image">
                    <img src="<?= base_url($about->image_brascloud) ?>" alt="<?= strip_tags($this->lang->line('title_about')) ?>" draggable="false">
                </div>
            <? } ?>
            <div class="col-12 about-gradient">
                <?= $about->text_box_red ?>
            </div>
        </div>
    </div>
</section>

<section class="vision">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-4 padding-left padding-right">
                <div class="grey-box">
                    <div>
                        <div class="vision-item">
                            <h3><?= $about->title_vision ?></h3>
                            <p><?= $about->vision ?></p>
                        </div>
                        <div class="vision-item">
                            <h3><?= $about->title_mission ?></h3>
                            <p><?= $about->mission ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 padding-left padding-right">
                <div class="grey-box">
                    <div class="vision-item">
                        <h3><?= $about->on_demand_title ?></h3>
                        <p><?= $about->on_demand_text ?></p>
                        <img src="<?= base_url($about->on_demand_image) ?>" alt="<?= $about->on_demand_title ?>" class="demand-image">
                    </div>
                </div>
            </div>
            <div class="col-4 padding-left padding-right">
                <div class="text-box">
                    <div>
                        <h3><?= $about->believe_title ?></h3>
                        <p><?= $about->believe_text ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="infra">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-4 padding-left padding-right infra-img">
                <img src="<?= base_url($about->infrastructure_image) ?>" alt="<?= $about->infrastructure_title ?>">
            </div>

            <div class="col-8 padding-left padding-right infra-text">
                <div class="about-gradient">
                    <h3><?= $about->infrastructure_title ?></h3>
                    <p><?= $about->infrastructure_text ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="differ">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-4 padding-left padding-right differ-text">
                <div class="text-box">
                    <div>
                        <h3><?= $about->different_title ?></h3>
                        <p><?= $about->different_text ?></p>
                    </div>
                </div>
            </div>
            <div class="col-8 padding-left padding-right differ-img">
                <img src="<?= base_url($about->different_image) ?>" alt="<?= $about->different_title ?>">
            </div>
        </div>
    </div>
</section>
<? if (!empty($about->video)) { ?>
    <section class="about-media">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-8 padding-left padding-right about-video">
                    <h3><?= $about->video_title ?></h3>
                    <div class="tv-item_video">
                        <a href="https://www.youtube.com/watch?v=<?= $about->video ?>&rel=0" class="video">
                            <? if (!empty($about->video_cover)) { ?>
                                <img src="<?= base_url($about->video_cover) ?>" alt="<?= $this->lang->line('title_about') ?>" draggable="false">
                            <? } else { ?>
                                <img src="http://img.youtube.com/vi/<?= $about->video ?>/maxresdefault.jpg" alt="<?= $this->lang->line('title_about') ?>" draggable="false">
                            <? } ?>
                        </a>
                    </div>
                </div>
                <? if (!empty($about->video_text_one) || !empty($about->video_text_two)) { ?>
                    <div class="col-4 padding-left padding-right about-media_text">
                        <div class="grey-box">
                            <div>
                                <div class="vision-item">
                                    <h3><?= $about->video_text_one ?></h3>
                                </div>
                                <div class="vision-item">
                                    <h3><?= $about->video_text_two ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>
<? if (!empty($about->vpc_title) && !empty($about->vpc_text)) { ?>
    <section class="vpc-solution">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-5 solution-image">
                    <? if (!empty($about->vpc_image_left)) { ?>
                        <img src="<?= base_url($about->vpc_image_left) ?>" alt="<?= $about->vpc_title ?>" draggable="false">
                    <? } ?>
                </div>
                <div class="col-7 solution-text padding-right">
                    <h3><?= $about->vpc_title ?></h3>
                    <?= $about->vpc_text ?>
                    <? if (!empty($about->vpc_image_right)) { ?>
                        <img src="<?= base_url($about->vpc_image_right) ?>" alt="<?= $about->vpc_title ?>" draggable="false">
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<? if (count($partners)) { ?>
    <section class="partners">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 partners-title">
                    <h3><?= $about->title_partner ?></h3>
                </div>
                <? foreach ($partners as $array) { ?>
                    <div class="partners-list">
                        <? foreach ($array as $partner) { ?>
                            <div class="partner">
                                <a href="<?= !empty($partner->link) ? $partner->link : '#' ?>"><img src="<?= base_url($partner->image) ?>" alt="<?= $partner->name ?>" draggable="false"></a>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>
<section class="join-us">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-12 join-us_title">
                <h3><?= $this->lang->line('join_us') ?></h3>
                <p><?= $this->lang->line('subtitle_join_us') ?></p>
            </div>

            <div class="col-12 join-us_form">
                <?= form_open_multipart($this->lang->line('url_send_join_us')) ?>
                <? if (validation_errors()) { ?>
                    <div class="col-12 padding">
                        <div class="col-12 alert alert-danger">
                            <?= validation_errors() ?>
                        </div>
                    </div>
                <? } ?>
                <div class="col-6 padding-left padding-right">
                    <input type="text" name="name" required value="<?= set_value('name') ?>" placeholder="<?= $this->lang->line('name') ?>">
                </div>
                <div class="col-6 padding-left padding-right">
                    <input type="email" name="email" required value="<?= set_value('email') ?>" placeholder="<?= $this->lang->line('email') ?>">
                </div>

                <div class="col-6 padding-left padding-right">
                    <input type="tel" class="tel" required name="phone" value="<?= set_value('phone') ?>" placeholder="<?= $this->lang->line('phone') ?>">
                </div>
                <div class="col-6 padding-left padding-right">
                    <input type="text" name="job" required value="<?= set_value('job') ?>" placeholder="<?= $this->lang->line('intended_position') ?>">
                </div>

                <div class="col-12 padding-left padding-right">
                    <textarea name="message" rows="8" required placeholder="<?= $this->lang->line('message') ?>"><?= set_value('message') ?></textarea>
                </div>

                <div class="col-9 padding-right">
                    <div class="col-4 padding-left">
                        <label for="join-file" class="join-file_button"><?= $this->lang->line('choose_file') ?></label>
                        <input type="file" name="file" required accept=".pdf,.doc,.docx,.rtf" value="" id="join-file" class="join-file" title="">
                    </div>
                    <div class="join-file_texts">
                        <div>
                            <strong class="file-name"><?= $this->lang->line('empty_file') ?></strong>
                            <span>* <?= $this->lang->line('accept_files') ?>: .pdf, .doc, .docx, .rtf</span>
                        </div>
                    </div>
                </div>
                <div class="col-3 padding-right">
                    <button type="submit" name="button"><?= $this->lang->line('send') ?></button>
                </div>
                <?= form_close() ?>
            </div>
            <?
            $submit_join_us = $this->session->flashdata('success_join_us');
            if ($submit_join_us) {
                ?>
                <div class="alert-dialog">
                    <div class="alert-box">
                        <div class="alert-content">
                            <h2><?= $this->lang->line('success_join_us') ?></h2>
                            <span class="close-dialog">x</span>
                        </div>
                    </div>
                </div>
                <?
            }
            ?>
        </div>
    </div>
</section>
<? if ($configuration) { ?>
    <section class="about-contact">
        <div class="container clearfix">
            <h2><?= $this->lang->line('contact') ?></h2>
            <address>
                <p><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/building-01.png') ?>" alt="Icon address"> <?= $configuration->address ?> | CEP <?= $configuration->cep ?> | <?= $configuration->city ?> - <?= $configuration->uf ?> <?= $configuration->cnpj ? "| CNPJ $configuration->cnpj" : '' ?></p>
                <p><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/mail-01.png') ?>" alt="Icon email"><?= $this->lang->line('email') ?>: <a href="mailto:<?= $configuration->email ?>"><?= $configuration->email ?></a></p>
                <p><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/tel-01.png') ?>" alt="Icon phone"><?= $this->lang->line('comercial_phone') ?>: <a href="tel:+55<?= clean_phone($configuration->phone) ?>">+55 <?= str_replace(array(')'), array(') '), $configuration->phone) ?></a></p>
            </address>
        </div>
    </section>
<? } ?>