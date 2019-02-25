<section class="prices-table">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-2">
                &nbsp;
            </div>
            <div class="col-8">
                <div class="os-holder">
                    <? foreach ($operationals as $index => $os) { ?>
                        <div class="input-holder">
                            <input type="radio" name="os" onchange="load_plans_table_operational('<?= $os->id ?>')" value="<?= $os->id ?>" id="os_<?= $os->id ?>" <?= $index == 0 ? 'checked' : '' ?> required>
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
            <div class="col-2">
                &nbsp;
            </div>
            <div id="div-pricing-table">
                <div class="col-12 pricing-holder">
                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('plan') ?></th>
                                <? foreach ($configs as $c) { ?>
                                    <th><?= $c->name ?></th>
                                <? } ?>
                                <th><?= $this->lang->line('disk') ?></th>
                                <th><?= $this->lang->line('price') ?>/<span class="price-hour"><?= $this->lang->line('hour') ?></span><span class="price-month" style="display: none"><?= $this->lang->line('month') ?></span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <? foreach ($plans as $plan) { ?>
                                <tr>
                                    <td><?= $plan->name ?></td>
                                    <? foreach ($plan->configs as $p_c) { ?>
                                        <td><?= $p_c ?></td>
                                    <? } ?>
                                    <td><?= $plan->storage ?> GB</td>
                                    <td>
                                        <span class="price-hour">R$<?= number_format($plan->price_hour, 2, ',', '.') ?></span>
                                        <span class="price-month" style="display: none">R$<?= number_format($plan->price_month, 2, ',', '.') ?></span>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-12 pricing-responsive">
                    <table class="pricing-table-responsive">
                        <tbody>
                            <? foreach ($plans as $plan) { ?>
                                <tr>
                                    <th colspan="<?= count($plan->configs) + 2 ?>"><?= $plan->name ?></th>
                                </tr>
                                <tr>
                                    <? foreach ($plan->configs as $index => $p_c) { ?>
                                        <td><span><?= $plan->config_name[$index] ?></span> <?= $p_c ?></td>
                                    <? } ?>
                                    <td><span><?= $this->lang->line('disk') ?></span> <?= $plan->storage ?> GB</td>
                                    <td>
                                        <span><?= $this->lang->line('price') ?>/<span class="price-hour"><?= $this->lang->line('hour') ?></span>
                                            <span class="price-month" style="display: none"><?= $this->lang->line('month') ?></span>
                                        </span>
                                        <span class="price-hour">R$<?= number_format($plan->price_hour, 2, ',', '.') ?></span>
                                        <span class="price-month" style="display: none">R$<?= number_format($plan->price_month, 2, ',', '.') ?></span>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
