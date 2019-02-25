(function ($) {
    "use strict";
    $(function () {

        $("#field_email_service").change(function(){

            var $selected_values = $( this ).val();
            var $find_parent = $( this ).parent().parent().parent().find($('tr'))
            var $show_field  = 'uf-show-field';
            var $hide_field  = 'uf-hide-field';
            var $child_0     = ':nth-child(1)';                                                                         // No selection
            var $child_1     = ':nth-child(1),:nth-child(2)';                                                           // MailChimp, Madmimi, Arpreach
            var $child_2     = ':nth-child(1),:nth-child(3),:nth-child(5),:nth-child(6)';                               // Aweber
            var $child_3     = ':nth-child(1),:nth-child(2),:nth-child(9)';                                             // Campaign Monitor
            var $child_4     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(7),:nth-child(8),:nth-child(9)';   // e-Goi
            var $child_5     = ':nth-child(1),:nth-child(7)';                                                           // Get Response
            var $child_6     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(5),:nth-child(7)';                 // Mailee.Me
            var $child_7     = ':nth-child(1),:nth-child(2),:nth-child(3)';                                             // Mail Relay, Sendy
            var $child_8     = ':nth-child(1),:nth-child(7)';                                                           // Klick Mail
            var $child_9     = ':nth-child(1),:nth-child(2),:nth-child(3),:nth-child(7)';                               // ActiveCampaign
            var $child_10    = ':nth-child(1),:nth-child(5),:nth-child(10)';                                            // RD Station, Benchmark
            var $child_11    = ':nth-child(1),:nth-child(4),:nth-child(5),:nth-child(7),:nth-child(16)';                // Mail2Easy
            var $child_12    = ':nth-child(1),:nth-child(5),:nth-child(8),:nth-child(11),:nth-child(14)';               // Trafficwave
            var $child_13    = ':nth-child(1),:nth-child(2),:nth-child(7),:nth-child(13)';                              // Infusionsoft
            var $child_14    = ':nth-child(1),:nth-child(2),:nth-child(5),:nth-child(9)';                               // Google Planilhas
            var $child_15    = ':nth-child(1),:nth-child(7),:nth-child(15)';                                            // MyMail
            var $child_16    = ':nth-child(1),:nth-child(2),:nth-child(7),:nth-child(12)';                              // LeadLovers
            var $child_17    = ':nth-child(1),:nth-child(3),:nth-child(5),:nth-child(12)';                              // MailPoet

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
        }).change();


    });
}(jQuery));