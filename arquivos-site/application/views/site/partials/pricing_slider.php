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