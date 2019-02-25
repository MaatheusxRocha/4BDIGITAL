<?php

/**
 * Allows to clean uploaded file name
 * @author Korri
 * Class MY_Upload
 */
class MY_Upload extends CI_Upload {

    /**
     * Clean filename ? Default is true, because it should, and I assume that if
     * you added this class it's in order to use it.
     * @var bool
     */
    public $clean_name = TRUE;

    public function set_filename($path, $filename) {
        if ($this->clean_name) {

            //Load need helpers, just to be shure
            $CI = get_instance();
            $CI->load->helper('text');
            $CI->load->helper('url');

            //Force lowercase ext
            $this->file_ext = strtolower($this->file_ext);

            //Clean filename
            $filename = str_replace($this->file_ext, '', $filename);
            $filename = url_title(convert_accented_characters($filename), '-', TRUE);
            $filename .= $this->file_ext;
        }
        return parent::set_filename($path, $filename);
    }

}
