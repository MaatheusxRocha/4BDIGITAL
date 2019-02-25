function uf_epico_randomUUID() {
        var s = [], itoh = '0123456789ABCDEF';
        for (var i = 0; i <6; i++) s[i] = Math.floor(Math.random()*0x10);
        return s.join('');
}
var uf_epico_field_callbacks = [];

(function ($) {
    "use strict";
    $(function () {
        $('body').on('click', '.uf-epico-add-group-row', function(){
            var clicked = $( this ),
                rowid = uf_epico_randomUUID(),
                template = $( '#' + clicked.data('rowtemplate')).html().replace(/{{id}}/g, rowid);
                if(clicked.data('field')){
                    var ref = clicked.data('field').split('-');
                    template = template.replace(/\_\_i\_\_/g, ref[ref.length-2]);
                }
                template = template.replace(/\_\_count\_\_/g, clicked.parent().parent().find('.groupitems').length);
                clicked.parent().before(template);

                for(var callback in uf_epico_field_callbacks){
                    if( typeof window[uf_epico_field_callbacks[callback]] === 'function'){
                        window[uf_epico_field_callbacks[callback]]();
                    }
                }

        });
        $('body').on('click', '.uf-epico-removeRow', function(){
            $(this).next().remove();
            $(this).remove();
        });
        // tabs
        $('body').on('click', '.uf-epico-metabox-config-nav li a, .uf-epico-shortcode-config-nav li a, .uf-epico-settings-config-nav li a, .uf-epico-widget-config-nav li a', function(){
            $(this).parent().parent().find('.current').removeClass('current');
            $(this).parent().parent().parent().parent().find('.group').hide();
            $(''+$(this).attr('href')+'').show();
            $(this).parent().addClass('current');
            if($(this).data('tabset').length){
                $('#'+$(this).data('tabset')).val($(this).data('tabkey'));
            }
            return false;
        });


        // Caixa de selecao persistente

        // 1. JQuery Plugin para ativar a opcao atual do select

        $.fn.selectChange = function() {
            var $selected_values = this.val();
            var $find_parent = this.parent().parent().find($('div.uf-epico-field-row'));
            var $show_field  = 'uf-show-field';
            var $hide_field  = 'uf-hide-field';
            var $child_0     = ':nth-child(1)';                                                                        // No selection
            var $child_1     = ':nth-child(1),:nth-child(2)';                                                          // MailChimp, Madmimi, Arpreach
            var $child_2     = ':nth-child(1),:nth-child(3),:nth-child(5),:nth-child(6)';                              // Aweber
            var $child_3     = ':nth-child(1),:nth-child(2),:nth-child(9)';                                            // Campaign Monitor
            var $child_4     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(7),:nth-child(8),:nth-child(9)';  // e-Goi
            var $child_5     = ':nth-child(1),:nth-child(7)';                                                          // Get Response
            var $child_6     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(5),:nth-child(7)';                // Mailee.Me
            var $child_7     = ':nth-child(1),:nth-child(2),:nth-child(3)';                                            // Mail Relay, Sendy
            var $child_8     = ':nth-child(1),:nth-child(7)';                                                          // Klick Mail
            var $child_9     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(7)';                              // ActiveCampaign
            var $child_10    = ':nth-child(1),:nth-child(5),:nth-child(10)';                                           // RD Station, Benchmark
            var $child_11    = ':nth-child(1),:nth-child(4),:nth-child(5),:nth-child(7),:nth-child(16)';               // Mail2Easy
            var $child_12    = ':nth-child(1),:nth-child(5),:nth-child(8),:nth-child(11),:nth-child(14)';              // Trafficwave
            var $child_13    = ':nth-child(1),:nth-child(2),:nth-child(7),:nth-child(13)';                             // Infusionsoft
            var $child_14    = ':nth-child(1),:nth-child(2),:nth-child(5),:nth-child(9)';                              // Google Planilhas
            var $child_15    = ':nth-child(1),:nth-child(7),:nth-child(15)';                                           // MyMail
            var $child_16    = ':nth-child(1),:nth-child(2),:nth-child(7),:nth-child(12)';                             // LeadLovers
            var $child_17    = ':nth-child(1),:nth-child(3),:nth-child(5),:nth-child(12)';                             // MailPoet


            if( $selected_values == 1 || $selected_values == 3 || $selected_values == 10 ){
                $find_parent.filter($child_1).addClass($show_field).removeClass($hide_field); // MailChimp, Madmimi, Arpreach
                $find_parent.not($child_1).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 2 ){
                $find_parent.filter($child_2).addClass($show_field).removeClass($hide_field); // Aweber
                $find_parent.not($child_2).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 4 ){
                $find_parent.filter($child_3).addClass($show_field).removeClass($hide_field); // Campaign Monitor
                $find_parent.not($child_3).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 5 ){
                $find_parent.filter($child_4).addClass($show_field).removeClass($hide_field); // e-Goi
                $find_parent.not($child_4).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 6 ){
                $find_parent.filter($child_5).addClass($show_field).removeClass($hide_field); // Get Response
                $find_parent.not($child_5).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 7 ){
                $find_parent.filter($child_6).addClass($show_field).removeClass($hide_field); // Mailee.Me
                $find_parent.not($child_6).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 8 || $selected_values == 14 ){
                $find_parent.filter($child_7).addClass($show_field).removeClass($hide_field); // Mail Relay, Sendy
                $find_parent.not($child_7).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 9 ){
                $find_parent.filter($child_8).addClass($show_field).removeClass($hide_field); // Klick Mail
                $find_parent.not($child_8).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 11 ){
                $find_parent.filter($child_9).addClass($show_field).removeClass($hide_field); // ActiveCampaign
                $find_parent.not($child_9).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 12 || $selected_values == 15 ){
                $find_parent.filter($child_10).addClass($show_field).removeClass($hide_field); // RD Station, Benchmark
                $find_parent.not($child_10).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 13 ){
                $find_parent.filter($child_16).addClass($show_field).removeClass($hide_field); // Mail2Easy
                $find_parent.not($child_16).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 16 ){
                $find_parent.filter($child_11).addClass($show_field).removeClass($hide_field); // Trafficwave
                $find_parent.not($child_11).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 17 ){
                $find_parent.filter($child_15).addClass($show_field).removeClass($hide_field); // Infusionsoft
                $find_parent.not($child_15).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 18 ){
                $find_parent.filter($child_12).addClass($show_field).removeClass($hide_field); // Google Planilhas
                $find_parent.not($child_12).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 19 ){
                $find_parent.filter($child_13).addClass($show_field).removeClass($hide_field); // MyMail
                $find_parent.not($child_13).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 20 ){
                $find_parent.filter($child_14).addClass($show_field).removeClass($hide_field); // LeadLovers
                $find_parent.not($child_14).addClass($hide_field).removeClass($show_field);
            } else if( $selected_values == 21 ){
                $find_parent.filter($child_17).addClass($show_field).removeClass($hide_field); // MailPoet
                $find_parent.not($child_17).addClass($hide_field).removeClass($show_field);
            }  else  {
                $find_parent.filter($child_0).addClass($show_field).removeClass($hide_field); // Sem selecao
                $find_parent.not($child_0).addClass($hide_field).removeClass($show_field);
            }
          return this;
        }

        // 2. Funcao de inicializacao, com opcao para o customizer

        function initSelect(widget) {
            widget.find('select[name*=email_service]').selectChange({
                change: _.throttle(function() { // para o Customizer
                    $(this).trigger('change');
                }, 3000)
            });
        }

        // 3. Funcao de atualizacao

        function onSelectUpdate(event, widget) {
            initSelect(widget);
        }

        // 4. Atualiza o select quando o widget e criado ou atualizado

        $(document).on('widget-added widget-updated', onSelectUpdate);


        // 5. Atualiza o select quando o documento e carregado

        $(document).ready(function() {
            $('#widgets-right .widget:has(select[name*=email_service])').each(function() {
                initSelect($(this));
            });
        });

        // 6. Atualiza o select quando o select e alterado. Ao atualizar o widget, as demais funcoes sao ativadas

        $('body').on('change', '#widgets-right select[name*=email_service]', function(){

            var $selected_values = $( this ).val();
            var $find_parent = $( this ).parent().parent().find($('div.uf-epico-field-row'));
            var $show_field  = 'uf-show-field';
            var $hide_field  = 'uf-hide-field';
            var $child_0     = ':nth-child(1)';                                                                        // No selection
            var $child_1     = ':nth-child(1),:nth-child(2)';                                                          // MailChimp, Madmimi, Arpreach
            var $child_2     = ':nth-child(1),:nth-child(3),:nth-child(5),:nth-child(6)';                              // Aweber
            var $child_3     = ':nth-child(1),:nth-child(2),:nth-child(9)';                                            // Campaign Monitor
            var $child_4     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(7),:nth-child(8),:nth-child(9)';  // e-Goi
            var $child_5     = ':nth-child(1),:nth-child(7)';                                                          // Get Response
            var $child_6     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(5),:nth-child(7)';                // Mailee.Me
            var $child_7     = ':nth-child(1),:nth-child(2),:nth-child(3)';                                            // Mail Relay, Sendy
            var $child_8     = ':nth-child(1),:nth-child(7)';                                                          // Klick Mail
            var $child_9     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(7)';                              // ActiveCampaign
            var $child_10    = ':nth-child(1),:nth-child(5),:nth-child(10)';                                           // RD Station, Benchmark
            var $child_11    = ':nth-child(1),:nth-child(4),:nth-child(5),:nth-child(7),:nth-child(16)';               // Mail2Easy
            var $child_12    = ':nth-child(1),:nth-child(5),:nth-child(8),:nth-child(11),:nth-child(14)';              // Trafficwave
            var $child_13    = ':nth-child(1),:nth-child(2),:nth-child(7),:nth-child(13)';                             // Infusionsoft
            var $child_14    = ':nth-child(1),:nth-child(2),:nth-child(5),:nth-child(9)';                              // Google Planilhas
            var $child_15    = ':nth-child(1),:nth-child(7),:nth-child(15)';                                           // MyMail
            var $child_16    = ':nth-child(1),:nth-child(2),:nth-child(7),:nth-child(12)';                             // LeadLovers
            var $child_17    = ':nth-child(1),:nth-child(3),:nth-child(5),:nth-child(12)';                             // MailPoet

            switch ($(this).val()) {
                case '1':
                case '3':
                case '10':  // MailChimp, Madmimi, Arpreach
                    $find_parent.filter($child_1).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_1).addClass($hide_field).removeClass($show_field);
                    break;
                case '2':  // Aweber
                    $find_parent.filter($child_2).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_2).addClass($hide_field).removeClass($show_field);
                    break;
                case '4': // Campaign Monitor
                    $find_parent.filter($child_3).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_3).addClass($hide_field).removeClass($show_field);
                    break;
                case '5': // e-Goi
                    $find_parent.filter($child_4).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_4).addClass($hide_field).removeClass($show_field);
                    break;
                case '6': // Get Response
                    $find_parent.filter($child_5).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_5).addClass($hide_field).removeClass($show_field);
                    break;
                case '7': // Mailee.Me
                    $find_parent.filter($child_6).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_6).addClass($hide_field).removeClass($show_field);
                    break;
                case '8':
                case '14':  // Mail Relay, Sendy
                    $find_parent.filter($child_7).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_7).addClass($hide_field).removeClass($show_field);
                    break;
                case '9':  // Klick Mail
                    $find_parent.filter($child_8).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_8).addClass($hide_field).removeClass($show_field);
                    break;
                case '11':  // ActiveCampaign
                    $find_parent.filter($child_9).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_9).addClass($hide_field).removeClass($show_field);
                    break;
                case '12':
                case '15':  // RD Station, Benchmark
                    $find_parent.filter($child_10).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_10).addClass($hide_field).removeClass($show_field);
                    break;
                case '13':  // Lead Lovers
                    $find_parent.filter($child_16).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_16).addClass($hide_field).removeClass($show_field);
                    break;
                case '16':  // Mail2Easy
                    $find_parent.filter($child_11).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_11).addClass($hide_field).removeClass($show_field);
                    break;
                case '17':  // MyMail
                    $find_parent.filter($child_15).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_15).addClass($hide_field).removeClass($show_field);
                    break;
                case '18': // Trafficwave
                    $find_parent.filter($child_12).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_12).addClass($hide_field).removeClass($show_field);
                    break;
                case '19': // Infusionsoft
                    $find_parent.filter($child_13).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_13).addClass($hide_field).removeClass($show_field);
                    break;
                case '20': // Google Planilhas
                    $find_parent.filter($child_14).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_14).addClass($hide_field).removeClass($show_field);
                    break;
                case '21': // MailPoet
                    $find_parent.filter($child_17).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_17).addClass($hide_field).removeClass($show_field);
                    break;
                default:   // Sem selecao
                    $find_parent.filter($child_0).addClass($show_field).removeClass($hide_field);
                    $find_parent.not($child_0).addClass($hide_field).removeClass($show_field);
                }
        });

        // initcallbacks
        setInterval(function(){
            $('.uf-epico-init-callback').each(function(k,v){
                var callback = $(this);
                if( typeof window[callback.data('init')] === 'function'){
                    console.log(callback.data('init'));
                    window[callback.data('init')]();
                    callback.removeClass('uf-epico-init-callback');
                }
            });
        }, 100);
    });
}(jQuery));