<footer>
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-2 footer-logo">
                <div class="footer-aligner">
                    <img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/logo.png') ?>" alt="Logo Brascloud" draggable="false">
                </div>
            </div>
            <div class="col-7 footer-menus">
                <div class="footer-aligner">
                    <div class="footer-menu">
                        <strong><?= $this->lang->line('enterprise') ?></strong>
                        <ul>
                            <li><a href="<?= site_url($this->lang->line('url_about')) ?>"><?= $this->lang->line('menu_about') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_why_create')) ?>"><?= $this->lang->line('menu_why_create') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_community')) ?>"><?= $this->lang->line('menu_community') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_cases')) ?>"><?= $this->lang->line('menu_cases') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_terms')) ?>"><?= $this->lang->line('menu_terms') ?></a></li>
                        </ul>
                    </div>

                    <div class="footer-menu">
                        <strong><?= $this->lang->line('offers') ?></strong>
                        <ul>
                            <li><a href="<?= site_url($this->lang->line('url_prices')) ?>"><?= $this->lang->line('menu_prices') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_services')) ?>"><?= $this->lang->line('menu_services') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_partners')) ?>"><?= $this->lang->line('menu_partners') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_startup')) ?>"><?= $this->lang->line('menu_startup') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_architects')) ?>"><?= $this->lang->line('menu_architects') ?></a></li>
                        </ul>
                    </div>

                    <div class="footer-menu">
                        <strong><?= $this->lang->line('know_more') ?></strong>
                        <ul>
                            <li><a href="<?= site_url($this->lang->line('url_faq')) ?>"><?= $this->lang->line('menu_faq') ?></a></li>
                            <li><a href="<?= site_url($this->lang->line('url_contact')) ?>"><?= $this->lang->line('menu_contact') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-3 footer-social">
                <? if (isset($configuration)) { ?>
                    <? if (!empty($configuration->facebook)) { ?>
                        <a href="<?= $configuration->facebook ?>"><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/fb.svg') ?>" alt="Facebook"></a>
                    <? } ?>
                    <? if (!empty($configuration->twitter)) { ?>
                        <a href="<?= $configuration->twitter ?>"><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/tw.svg') ?>" alt="Twitter"></a>
                    <? } ?>
                    <? if (!empty($configuration->youtube)) { ?>
                        <a href="<?= $configuration->youtube ?>"><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/yt.svg') ?>" alt="Youtube"></a>
                    <? } ?>
                    <? if (!empty($configuration->google_plus)) { ?>
                        <a href="<?= $configuration->google_plus ?>"><img src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/images/g+.svg') ?>" alt="Google+"></a>
                    <? } ?>
                <? } ?>
            </div>
        </div>
    </div>
</footer>

<a href="#top" class="back-top nav-anchor"><?= $this->lang->line('back_top') ?></a>

</div>
<? if (isset($messaging)) { ?>
    <div class="alert-dialog">
        <div class="alert-box alert-home">
            <div class="alert-content">
                <? if (!empty($messaging->link)) { ?>
                    <a href="<?= $messaging->link ?>" title="<?= $messaging->title ?>">
                        <img src="<?= base_url($messaging->image) ?>" alt="<?= $messaging->title ?>" draggable="false">
                        <h3><?= $messaging->title ?></h3>
                        <span><?= $messaging->description ?></span>
                    </a>
                <? } else { ?>
                    <img src="<?= base_url($messaging->image) ?>" alt="<?= $messaging->title ?>" draggable="false">
                    <h3><?= $messaging->title ?></h3>
                    <span><?= $messaging->description ?></span>
                <? } ?>

                <span class="close-dialog">x</span>
            </div>
        </div>
    </div>
<? } ?>

<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/jquery.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/slick.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/nouislider.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/wNumb.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/inputmask.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/jqueryinputmask.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/fancybox.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/js/jquery.maskMoney.min.js') ?>" charset="utf-8"></script>
<script src="<?= base_url('assets/' . SCRIPTS_FOLDER . '/site/javascripts/tools.js?v=' . VERSION) ?>" charset="utf-8"></script>
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/adf5ea6e-46b2-4c44-9631-aed2814b6453-loader.js" ></script>
<? if (isset($range_slider)) { ?>
    <script type="text/javascript">
        var slider_processing = document.getElementById('range-1');
        var slider_processing_value = document.getElementById('range-1-value');
        var slider_speed = document.getElementById('range-2');
        var slider_speed_value = document.getElementById('range-2-value');
        var slider_memory = document.getElementById('range-3');
        var slider_memory_value = document.getElementById('range-3-value');
        var slider_storage = document.getElementById('range-4');
        var slider_storage_value = document.getElementById('range-4-value');
        $(function () {
    <? if (isset($processing)) { ?>
                noUiSlider.create(slider_processing, {
                    start: [<?= $processing->scale_min ?>],
                    connect: 'lower',
                    step: <?= $processing->scale ?>,
                    format: wNumb({
                        decimals: 0
                    }),
                    tooltips: wNumb({postfix: ' vCPU', decimals: 0}),
                    range: {
                        'min': [<?= $processing->scale_min ?>],
                        'max': [<?= $processing->scale_max ?>]
                    }
                });
                slider_processing.noUiSlider.on('change', function () {
                    calculate_value_plan();
                });
    <? } ?>
    <? if (isset($speeds)) { ?>
                var values = [
        <?
        foreach ($speeds as $index => $speed) {
            echo $speed->frequency;
            if ($index < (count($speeds) - 1)) {
                echo ',';
            }
        }
        ?>
                ];
                var rangers = {};
                for (i = 0; i < values.length; ++i) {
                    var interval = values[values.length - 1] - values[0];
                    if (i == 0) {
                        rangers['min'] = [values[i], values[i + 1] - values[i]];
                    } else {
                        var percent = Math.ceil(((values[i] - values[0]) / interval) * 100);
                        if (i < values.length - 1) {
                            rangers[percent + '%'] = [values[i], (values[i + 1] - values[i]).toFixed(2)];
                        }
                    }
                    if (i == values.length - 1) {
                        rangers['max'] = [values[values.length - 1]];
                    }
                }
                noUiSlider.create(slider_speed, {
                    start: [values[0]],
                    connect: 'lower',
                    format: wNumb({
                        decimals: 1
                    }),
                    tooltips: wNumb({postfix: ' GHz', decimals: 1}),
                    range: rangers
                });
                slider_speed.noUiSlider.on('change', function () {
                    calculate_value_plan();
                });
    <? } ?>
    <? if (isset($memory)) { ?>
                noUiSlider.create(slider_memory, {
                    start: [<?= $memory->scale_min ?>],
                    connect: 'lower',
                    step: <?= $memory->scale ?>,
                    format: wNumb({
                        decimals: 0
                    }),
                    tooltips: wNumb({postfix: ' GB', decimals: 0}),
                    range: {
                        'min': [<?= $memory->scale_min ?>],
                        'max': [<?= $memory->scale_max ?>]
                    }
                });
                slider_memory.noUiSlider.on('change', function () {
                    calculate_value_plan();
                });
    <? } ?>
    <? if (isset($storage)) { ?>
                noUiSlider.create(slider_storage, {
                    start: [<?= $storage->scale_min ?>],
                    connect: 'lower',
                    step: <?= $storage->scale ?>,
                    format: wNumb({
                        decimals: 0
                    }),
                    tooltips: wNumb({postfix: ' GB', decimals: 0}),
                    range: {
                        'min': [<?= $storage->scale_min ?>],
                        'max': [<?= $storage->scale_max ?>]
                    }
                });
                slider_storage.noUiSlider.on('change', function () {
                    calculate_value_plan();
                });
    <? } ?>

            calculate_value_plan();
        });
        function calculate_value_plan() {
            $("#plan_exist").hide();
            $(".simulator-total").removeClass('disabled');
            $(".simulator-billing").removeClass('disabled');
            var processing = slider_processing.noUiSlider.get();
            var speed = slider_speed.noUiSlider.get();
            var memory = slider_memory.noUiSlider.get();
            var storage = slider_storage.noUiSlider.get();
            var os = $("input[name=os_slider]:checked").val();
            $.ajax({
                type: 'POST',
                data: {processing: processing, speed: speed, memory: memory, storage: storage, os: os},
                url: "/home/calculate_value_plan",
                success: function (data, textStatus, jqXHR) {
                    try {
                        result = JSON.parse(data);
                        if (result.status == 'success') {
                            $("#value-month").html(result.value_month);
                            $("#value-hour").html(result.value_hour);
                            $("#value-month-responsive").html(result.value_month);
                            $("#value-hour-responsive").html(result.value_hour);
                            if (result.has_plan) {
                                $("#name_plan_exist").html(result.plan);
                                $("#plan_exist").show();
                            }
                        }
                    } catch (e) {
                        console.log('erro na leitura do json');
                    }

                },
                error: function (response) {
                    console.log(response.responseText);
                }

            });
        }
        function generate_proposal() {
            var processing = slider_processing.noUiSlider.get();
            var speed = slider_speed.noUiSlider.get();
            var memory = slider_memory.noUiSlider.get();
            var storage = slider_storage.noUiSlider.get();
            $("#input-processing").val(processing);
            $("#input-speed").val(speed);
            $("#input-memory").val(memory);
            $("#input-storage").val(storage);
            $("#form-proposal").submit();
        }
    </script>
<? } ?>
</body>
</html>
