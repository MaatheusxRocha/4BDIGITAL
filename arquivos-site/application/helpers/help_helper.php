<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function sanitize_dropdown($dropdown) {
    return $dropdown === '' ? NULL : (bool) $dropdown;
}

function wbr_link($link) {
    return str_replace(array('/', '.', '?', '=', '&'), array('/<wbr>', '.<wbr>', '?<wbr>', '=<wbr>', '&<wbr>'), trim($link));
}

function csv_to_array($filename = '', $delimiter = ';') {
    if (!file_exists($filename) || !is_readable($filename)) {
        return FALSE;
    }

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (!$header) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return $data;
}

function format_date($date) {
    $date = str_replace('/', '-', $date);
    if ($date != '0000-00-00' && $date != "" && $date != null && (strlen($date) == 10)) {
        $date = explode("-", $date);
        $return_date = $date[2] . "-" . $date[1] . "-" . $date[0];
        if ($return_date == "0000-00-00" || $return_date == "00-00-0000") {
            return NULL;
        } else {
            return $return_date;
        }
    } else {
        return NULL;
    }
}

function unformat_date($date) {
    $date = str_replace('-', '/', $date);
    if ($date != '0000/00/00' && $date != "" && $date != null && (strlen($date) == 10)) {
        $date = explode("/", $date);
        $return_date = $date[2] . "/" . $date[1] . "/" . $date[0];
        if ($return_date == "0000/00/00" || $return_date == "00/00/0000") {
            return NULL;
        } else {
            return $return_date;
        }
    } else {
        return NULL;
    }
}

function validate_CPF($cpf = null) {
    if (empty($cpf)) {
        return FALSE;
    }

    $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return FALSE;
    } else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
        return FALSE;
    } else {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return FALSE;
            }
        }
        return TRUE;
    }
}

function validate_cnpj($cnpj = NULL) {
    if (empty($cnpj)) {
        return FALSE;
    }
    // Deixa o CNPJ com apenas números
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    // Garante que o CNPJ é uma string
    $cnpj = (string) $cnpj;

    // O valor original
    $cnpj_original = $cnpj;

    // Captura os primeiros 12 números do CNPJ
    $primeiros_numeros_cnpj = substr($cnpj, 0, 12);

    /**
     * Multiplicação do CNPJ
     *
     * @param string $cnpj Os digitos do CNPJ
     * @param int $posicoes A posição que vai iniciar a regressão
     * @return int O
     *
     */
    function multiplica_cnpj($cnpj, $posicao = 5) {
        // Variável para o cálculo
        $calculo = 0;

        // Laço para percorrer os item do cnpj
        for ($i = 0; $i < strlen($cnpj); $i++) {
            // Cálculo mais posição do CNPJ * a posição
            $calculo = $calculo + ( $cnpj[$i] * $posicao );

            // Decrementa a posição a cada volta do laço
            $posicao--;

            // Se a posição for menor que 2, ela se torna 9
            if ($posicao < 2) {
                $posicao = 9;
            }
        }
        // Retorna o cálculo
        return $calculo;
    }

    // Faz o primeiro cálculo
    $primeiro_calculo = multiplica_cnpj($primeiros_numeros_cnpj);

    // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
    // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
    $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 : 11 - ( $primeiro_calculo % 11 );

    // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
    // Agora temos 13 números aqui
    $primeiros_numeros_cnpj .= $primeiro_digito;

    // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    $segundo_calculo = multiplica_cnpj($primeiros_numeros_cnpj, 6);
    $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 : 11 - ( $segundo_calculo % 11 );

    // Concatena o segundo dígito ao CNPJ
    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

    // Verifica se o CNPJ gerado é idêntico ao enviado
    if ($cnpj === $cnpj_original) {
        return true;
    } else {
        return false;
    }
}

function money_american($value) {
    $val = str_replace('R$ ', '', $value);
    $valorAmericano = str_replace('.', '', $val);
    $valorAmericano = str_replace(',', '.', $valorAmericano);
    return floatval($valorAmericano);
}

function remove_accent($text) {
    $accent = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', 'Ÿ',);
    $no_accent = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'Y',);
    $clear_text = str_replace($accent, $no_accent, $text);
    return $clear_text;
}

function simple_url($text) {
    $text = str_replace(array('+', '#', '/'), "-", urlencode(preg_replace("/[^a-zA-Z0-9\s]/", " ", strtolower(remove_accent($text)))));
    while (strpos($text, '--')) {
        $text = str_replace('--', '-', $text);
    }
    return $text;
}

function clean_phone($phone) {
    return preg_replace("/[^0-9]/", '', $phone);
}

function strposa($haystack, $needle, $offset = 0) {
    if (!is_array($needle)) {
        $needle = array($needle);
    }
    foreach ($needle as $query) {
        if (strpos($haystack, $query, $offset) !== false) {
            return true;
        } // stop on first true result
    }
    return false;
}

function archive_filename($path, $file_ext, $filename) {
    $max_filename_increment = 100;
    $path = str_replace("\\", "/", realpath($path)) . '/';
    if (!file_exists($path . $filename . $file_ext)) {
        return $filename . $file_ext;
    }

    $filename = str_replace($file_ext, '', $filename);

    $new_filename = '';
    for ($i = 1; $i < $max_filename_increment; $i++) {
        if (!file_exists($path . $filename . $i . $file_ext)) {
            $new_filename = $filename . $i . $file_ext;
            break;
        }
    }

    if ($new_filename === '') {
        $new_filename = $filename . time() . rand(0, 100) . $file_ext;
    } else {
        return $new_filename;
    }
}

function abbreviated_month($month) {
    $months = array(
        '01' => 'JAN',
        '02' => 'FEV',
        '03' => 'MAR',
        '04' => 'ABR',
        '05' => 'MAI',
        '06' => 'JUN',
        '07' => 'JUL',
        '08' => 'AGO',
        '09' => 'SET',
        '10' => 'OUT',
        '11' => 'NOV',
        '12' => 'DEZ',
    );
    return $months[$month];
}

function month($month) {
    $months = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro',
    );
    return $months[$month];
}

function normalize_string($str = '') {
    return strtolower(preg_replace("/[^a-zA-Z0-9]/", '', $str));
}

function simple_filename($text) {
    return str_replace(array('--', '---', '----'), '-', str_replace(array('+', '#', '/', ' ', '_'), '-', urlencode(strtolower(simple_url($text)))));
}

function title_case($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI", "e", "a","em")) {
    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
    }//foreach
    return $string;
}

function remove_space($string) {
    return str_replace(' ', '', $string);
}
