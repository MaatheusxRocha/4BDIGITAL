<? if (count($banners)) { ?>
    <section class="top-slides">
        <div class="top-slider">
            <? foreach ($banners as $banner) { ?>
                <div class="top-slide">
                    <picture>
                        <source srcset="<?= base_url($banner->image_mobile) ?>" media="(max-width: 1025px)">
                        <img src="<?= base_url($banner->image) ?>" alt="<?= $banner->name ?>" draggable="false">
                    </picture>
                    <? if (!empty($banner->button) && !empty($banner->link)) { ?>
                        <a href="<?= $banner->link ?>" title="<?= $banner->button ?>"><?= $banner->button ?></a>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    </section>
<? } ?>
<? if (isset($plans) && count($plans)) { ?>
    <section class="pricing">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 title">
                    <h1><p><?= isset($text_home) ? $text_home->title_plans : '' ?></p></h1>
                </div>

                <div class="col-12">
                    <div class="col-3 label padding-left padding-right">
                        <a href="#simulator" class="nav-anchor"><?= $this->lang->line('simulate_plan') ?></a>
                    </div>
                    <div class="col-6 padding-left padding-right">
                        <div class="os-holder">
                            <? foreach ($operationals as $index => $os) { ?>
                                <div class="input-holder">
                                    <input type="radio" name="os" onchange="load_plans_operational('<?= $os->id ?>')" value="<?= $os->id ?>" id="os_<?= $os->id ?>" <?= $index == 0 ? 'checked' : '' ?> required>
                                    <label for="os_<?= $os->id ?>">
                                        <?= $os->name ?>
                                    </label>
                                </div>
                            <? } ?>
                        </div>
                        <div class="pricing-toggle">
                            <span onclick="$('#btn-toggle-switch').click()" style="cursor: pointer"><?= strtoupper($this->lang->line('hour')) ?></span>
                            <div class="pricing-toggle_holder">
                                <button type="button" id="btn-toggle-switch" class="pricing-toggle_switch">&nbsp;</button>
                            </div>
                            <span onclick="$('#btn-toggle-switch').click()" style="cursor: pointer"><?= mb_strtoupper($this->lang->line('month')) ?></span>
                        </div>
                    </div>
                    <div class="col-3 label padding-left padding-right">
                        <a href="<?= site_url($this->lang->line('url_prices_table')) ?>"><?= $this->lang->line('view_prices') ?></a>
                    </div>
                </div>

                <div class="col-12 pricing-slides">
                    <div class="pricing-slider">
                        <? foreach ($plans as $plan) { ?>
                            <div class="col-4 pricing-slide padding-left padding-right">
                                <a href="<?= isset($configuration) && !empty($configuration->link_new_account) ? $configuration->link_new_account : '#' ?>">
                                    <h4><?= $plan->name ?></h4>

                                    <div class="pricing-slide_prices">
                                        <? if ($plan->best_seller) { ?>
                                            <div class="promotion-seal">
                                                <span>
                                                    <?= $this->lang->line('best_seller') ?>
                                                    <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/star.svg') ?>" alt="Icon star">
                                                </span>
                                            </div>
                                        <? } else if (!empty($plan->price_month_promotion) && $plan->price_month_promotion > 0) { ?>
                                            <div class="promotion-seal">
                                                <span>
                                                    <?= $this->lang->line('offer') ?>
                                                </span>
                                            </div>
                                        <? } else if (!empty($plan->leaf_text)) { ?>
                                            <div class="promotion-seal">
                                                <span>
                                                    <?= $plan->leaf_text ?>
                                                </span>
                                            </div>
                                        <? } ?>
                                        <div class="pricing-slide_main">
                                            <div>
                                                <? if (!empty($plan->price_month_promotion) && $plan->price_month_promotion > 0) { ?>
                                                    <div class="price-promotion price-hour">
                                                        <span><?= strtoupper($this->lang->line('of')) ?>: <strong>R$<?= number_format($plan->price_hour, 2, ',', '.') ?></strong></span>
                                                        <span><?= strtoupper($this->lang->line('hour')) ?></span>
                                                    </div>
                                                    <div class="price price-hour">
                                                        <span><?= strtoupper($this->lang->line('by')) ?>: <strong>R$<?= number_format($plan->price_hour_promotion, 2, ',', '.') ?></strong></span>
                                                        <span><?= strtoupper($this->lang->line('hour')) ?></span>
                                                    </div>
                                                    <div class="price-promotion price-month" style="display: none">
                                                        <span><?= strtoupper($this->lang->line('of')) ?>: <strong>R$<?= number_format($plan->price_month, 2, ',', '.') ?></strong></span>
                                                        <span><?= mb_strtoupper($this->lang->line('month')) ?></span>
                                                    </div>
                                                    <div class="price price-month" style="display: none">
                                                        <span><?= strtoupper($this->lang->line('by')) ?>: <strong>R$<?= number_format($plan->price_month_promotion, 2, ',', '.') ?></strong></span>
                                                        <span><?= mb_strtoupper($this->lang->line('month')) ?></span>
                                                    </div>
                                                <? } else { ?>
                                                    <div class="price price-hour">
                                                        <span><?= strtoupper($this->lang->line('by')) ?>: <strong>R$<?= number_format($plan->price_hour, 2, ',', '.') ?></strong></span>
                                                        <span><?= strtoupper($this->lang->line('hour')) ?></span>
                                                    </div>
                                                    <div class="price price-month" style="display: none">
                                                        <span><?= strtoupper($this->lang->line('by')) ?>: <strong>R$<?= number_format($plan->price_month, 2, ',', '.') ?></strong></span>
                                                        <span><?= mb_strtoupper($this->lang->line('month')) ?></span>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="features">
                                        <? foreach ($plan->configs as $item) {
                                            ?>
                                            <p>
                                                <?
                                                $partials_value = explode('.', $item->value);
                                                if ($partials_value[1] > 0) {
                                                    echo number_format($item->value, 2, ',', '.');
                                                } else {
                                                    echo number_format($item->value, 0);
                                                }
                                                ?>
                                                <?= $item->measure != '.' ? $item->measure : '' ?>
                                                <?= ' ' . $item->name ?>
                                            </p>
                                        <? } ?>
                                        <p><?= $plan->storage ?> <?= $this->lang->line('storage_sufix') ?></p>
                                        <p><?= $plan->operational ?></p>
                                    </div>
                                    <? if (isset($configuration) && !empty($configuration->link_new_account)) { ?>
                                        <span class="pricing-account"><?= $this->lang->line('create_account') ?></span>
                                    <? } ?>
                                </a>
                            </div>
                        <? } ?>
                    </div>
                    <a href="<?= site_url($this->lang->line('url_prices_table')) ?>" class="all-prices"><span><?= $this->lang->line('view_prices') ?></span></a>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<section class="pricing-simulator" id="simulator">
    <div class="container clearfix">
        <div class="row">
            <div class="col-12 title title-left">
                <div class="col-8 padding-left">
                    <h1><p><?= isset($text_home) ? $text_home->title_rules : '' ?></p></h1>
                </div>
                <div class="col-4 label label-hover padding-left padding-right">
                    <div>
                        <?= $this->lang->line('how_tick') ?>
                        <div class="info">
                            <?= isset($text_home) ? $text_home->text_ticketing : '' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 simulator">
                <?= form_open($this->lang->line('url_proposal'), 'id="form-proposal"') ?>
                <div class="simulator-options">
                    <div class="">
                        <strong><?= strtoupper($this->lang->line('operational_system')) ?></strong>
                        <? foreach ($operationals as $index => $os) { ?>
                            <div class="input-holder">
                                <input type="radio" name="os_slider" onchange="calculate_value_plan()" value="<?= $os->id ?>" id="os_slider_<?= $os->id ?>" <?= $index == 0 ? 'checked' : '' ?> required>
                                <label for="os_slider_<?= $os->id ?>">
                                    <?= $os->name ?>
                                </label>
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div class="simulator-options">
                    <div class="">
                        <strong><?= mb_strtoupper($this->lang->line('transfer')) ?></strong>
                        <span><?= isset($text_home) ? $text_home->transfer : '' ?></span>
                    </div>
                </div>

                <div class="simulator-price_responsive">
                    <strong><?= strtoupper($this->lang->line('total_estimated')) ?></strong>
                    <span id="value-month-responsive"></span> | <span id="value-hour-responsive"></span>
                </div>

                <div class="col-12 simulator-sliders">
                    <? if (isset($processing)) { ?>
                        <div class="col-12 simulator-slider">
                            <h4><?= $processing->name ?></h4>
                            <div id="range-1"></div>
                            <div id="range-1-value" class="range-value"><?= number_format($processing->scale_max,0) ?> vCPU</div>
                        </div>
                        <input type="hidden" hidden="" name="processing" id="input-processing"/>
                    <? } ?>
                    <? if (count($speeds)) { ?>
                        <div class="col-12 simulator-slider">
                            <h4><?= $speeds[0]->name ?></h4>
                            <div id="range-2"></div>
                            <div id="range-2-value" class="range-value"><?= $speeds[count($speeds) - 1]->frequency ?> GHz</div>
                        </div>
                        <input type="hidden" hidden="" name="speed" id="input-speed"/>
                    <? } ?>
                    <? if (isset($memory)) { ?>
                        <div class="col-12 simulator-slider">
                            <h4><?= $memory->name ?></h4>
                            <div id="range-3"></div>
                            <div id="range-3-value" class="range-value"><?= $memory->scale_max ?> GB</div>
                        </div>
                        <input type="hidden" hidden="" name="memory" id="input-memory"/>
                    <? } ?>
                    <? if (isset($storage)) { ?>
                        <div class="col-12 simulator-slider">
                            <h4><?= $storage->name ?></h4>
                            <div id="range-4"></div>
                            <div id="range-4-value" class="range-value"><?= $storage->scale_max ?> GB</div>
                        </div>
                        <input type="hidden" hidden="" name="storage" id="input-storage"/>
                    <? } ?>
                    <div id="plan_exist" style="display: none">
                        <div class="col-12 simulator-slider config-info">
                            <span id="name_plan_exist"></span>
                        </div>
                    </div>
                    <div class="col-12 simulator-proposal">
                        <a href="#" onclick="generate_proposal()"><?= $this->lang->line('generate_pdf') ?></a>
                    </div>
                </div>

                <div class="col-12">
                    <div class="simulator-item">
                        <div class="label">
                            <? if (isset($configuration) && !empty($configuration->link_new_account)) { ?>
                                <a href="<?= $configuration->link_new_account ?>"><?= $this->lang->line('create_account') ?></a>
                            <? } ?>
                        </div>
                    </div>
                    <div class="simulator-item">
                        <div class="simulator-total">
                            <div>
                                <span><?= strtoupper($this->lang->line('total_estimated')) ?></span>
                                <strong id="value-month"></strong>
                                <strong id="value-hour"></strong>
                            </div>
                        </div>
                        <div class="simulator-billing">
                            <p><?= isset($text_home) ? $text_home->text_billing : '' ?></p>
                        </div>
                    </div>
                    <div class="simulator-item">
                        <div class="label">
                            <!-- ir para proposal.html  -->
                            <button type="button" onclick="generate_proposal()" name="button"><?= $this->lang->line('generate_pdf') ?></button>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>
<? if (count($performances)) { ?>
    <section class="table-home">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-12 title">
                    <h1><p><?= isset($text_plan) ? $text_plan->title_performance : '' ?></p></h1>
                </div>

                <div class="col-12 table-home_holder">
                    <table class="table-home_table">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('service') ?></th>
                                <th><?= $this->lang->line('value') ?>*</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($performances as $p) { ?>
                                <tr>
                                    <td><?= $p->name ?></td>
                                    <td>R$<?= number_format($p->price, 2, ',', '.') ?></td>
                                </tr>
                            <? } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">* <?= isset($text_plan) ? $text_plan->warning_performance : '' ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<? if (count($chooses)) { ?>
    <section class="content-items">
        <div class="container clearfix">
            <div class="row clearfix">

                <div class="col-12 title">
                    <h1>
                        <?= isset($text_home) ? $text_home->title_why_choose : '' ?>
                    </h1>
                </div>

                <div class="col-12 featuring">
                    <? foreach ($chooses as $choose) { ?>
                        <div class="col-twenty feature">
                            <img src="<?= base_url($choose->image) ?>" alt="<?= $choose->title ?>" draggable="false">
                            <strong><?= $choose->title ?></strong>
                            <p><?= $choose->description ?></p>
                        </div>
                    <? } ?>
                    <div class="col-12 plan-buttons label">
                        <a href="<?= site_url($this->lang->line('url_prices')) ?>#plans"><?= $this->lang->line('know_plan') ?></a>
                        <a href="<?= site_url($this->lang->line('url_prices')) ?>#custom"><?= $this->lang->line('custom_plan') ?></a>
                    </div>
                </div>
                <? if (isset($text_home) && !empty($text_home->video) && isset($configuration)) { ?>
                    <div class="col-12 tv">
                        <div class="tv-item">
                            <div class="tv-item_text">
                                <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/tv.png') ?>" alt="Icon TV" draggable="false">

                                <div>
                                    <h4><?= $this->lang->line('tv_brascloud') ?></h4>
                                    <span><?= $text_home->text_video ?></span>
                                    <? if (!empty($configuration->youtube)) { ?>
                                        <a href="<?= $configuration->youtube ?>"><?= $this->lang->line('button_video') ?></a>
                                    <? } ?>
                                </div>
                            </div>
                        </div>

                        <div class="tv-item">
                            <div class="tv-item_video">
                                <a href="https://www.youtube.com/watch?v=<?= $text_home->video ?>&rel=0" class="video">
                                    <? if (!empty($text_home->cover)) { ?>
                                        <img src="<?= base_url($text_home->cover) ?>" alt="<?= $text_home->video ?>" draggable="false">
                                    <? } else { ?>
                                        <img src="http://img.youtube.com/vi/<?= $text_home->video ?>/maxresdefault.jpg" alt="<?= $text_home->video ?>" draggable="false">
                                    <? } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>