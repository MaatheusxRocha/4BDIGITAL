<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    private $language;

//    private $mobile;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('banner_model', 'configuration_model', 'language_model'));
        $language = $this->session->userdata('language_site');
        $language_text = $this->session->userdata('language_text');
        if (empty($language) || empty($language_text)) {
            $language = 1;
            $language_text = 'portuguese-br';
            $this->session->set_userdata('language_site', 1);
            $this->session->set_userdata('language_text', 'portuguese-br');
        }
        $this->language = $language;
        $this->load->language('internationalization', $language_text);
//        $this->mobile = new Mobile_Detect();
    }

    private function _header($header = array(), $og_properties = NULL) {
        $data = array();
        $configuration = $this->configuration_model->get($this->language);
        if ($configuration->num_rows()) {
            $data['configuration'] = $configuration->row();
        }
        $data += $header;
        $data['languages'] = $this->language_model->get_visible()->result();
        $data['current_language'] = $this->language;
        $data['og_properties'] = $og_properties;
        $this->load->view('site/partials/header', $data);
    }

    private function _footer($data = array()) {
        $this->load->view('site/partials/footer', $data);
    }

//    public function page_404() {
//        $header['title'] = $this->lang->line('page_not_found') . ' | Brascloud';
//        $this->_header($header);
//        $this->load->view('site/page_404');
//        $this->_footer();
//    }

    public function toggle_language($language_id = NULL) {
        if (empty($language_id) || !is_numeric($language_id)) {
            $this->session->set_userdata('language_site', 1);
            redirect();
        }
        $language = $this->language_model->get($language_id);
        if ($language->num_rows() && $language->row()->status) {
            if ($language_id == 2) {
                $this->session->set_userdata('language_text', 'english');
            } else if ($language_id == 3) {
                $this->session->set_userdata('language_text', 'spanish');
            } else {
                $this->session->set_userdata('language_text', 'portuguese-br');
            }
            $this->session->set_userdata('language_site', $language_id);
        } else {
            $this->session->set_userdata('language_text', 'portuguese-br');
            $this->session->set_userdata('language_site', 1);
        }
        redirect();
    }

    private function _search($search) {
        $this->load->model(array('faq_model', 'service_item_model', 'performance_model', 'account_create_model', 'about_model', 'architect_model', 'architect_item_model',
            'case_model', 'partner_page_model', 'partner_item_model', 'service_model', 'startup_model', 'startup_item_model', 'startup_slider_model',
            'text_case_model', 'text_contact_us_model', 'text_faq_model', 'text_plan_model', 'why_choose_model'));
        $header['title'] = $this->lang->line('search_results') . ' | Brascloud';
        $data['search'] = $search;
        $results = array();
//
        $questions = $this->faq_model->get_site_search($this->language, $search)->result();
        foreach ($questions as $item) {
            $results[] = array(
                'title' => strip_tags($item->question),
                'description' => strip_tags($item->answer),
                'link' => site_url($this->lang->line('url_faq') . '?search=' . $search)
            );
        }
        $service_items = $this->service_item_model->get_site($this->language, $search)->result();
        foreach ($service_items as $item) {
            $results[] = array(
                'title' => strip_tags($item->name),
                'description' => strip_tags($item->description),
                'link' => site_url($this->lang->line('url_prices_table'))
            );
        }
        $performance = $this->performance_model->get_site($this->language, $search)->result();
        foreach ($performance as $item) {
            $results[] = array(
                'title' => strip_tags($item->name),
                'description' => 'R$ ' . number_format($item->price, 2, ',', '.'),
                'link' => site_url($this->lang->line('url_prices'))
            );
        }
        $chooses = $this->why_choose_model->get_site($this->language, $search)->result();
        foreach ($chooses as $item) {
            $results[] = array(
                'title' => strip_tags($item->title),
                'description' => strip_tags($item->description),
                'link' => site_url($this->lang->line('url_why_create'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search);
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $this->lang->line('menu_about'),
                'description' => strip_tags($about->row()->text_brascloud),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'text_box_red');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $this->lang->line('menu_about'),
                'description' => strip_tags($about->row()->text_box_red),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'title_vision', 'vision');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->title_vision,
                'description' => strip_tags($about->row()->vision),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'title_mission', 'mission');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->title_mission,
                'description' => strip_tags($about->row()->mission),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'on_demand_title', 'on_demand_text');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->on_demand_title,
                'description' => strip_tags($about->row()->on_demand_text),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'believe_title', 'believe_text');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->believe_title,
                'description' => strip_tags($about->row()->believe_text),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'infrastructure_title', 'infrastructure_text');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->infrastructure_title,
                'description' => strip_tags($about->row()->infrastructure_text),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'different_title', 'different_text');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->different_title,
                'description' => strip_tags($about->row()->different_text),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'video_title', 'video_text_one');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->video_title,
                'description' => strip_tags($about->row()->video_text_one),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $about = $this->about_model->get_search($this->language, $search, 'vpc_title', 'vpc_text');
        if ($about->num_rows()) {
            $results[] = array(
                'title' => $about->row()->vpc_title,
                'description' => strip_tags($about->row()->vpc_text),
                'link' => site_url($this->lang->line('url_about'))
            );
        }
        $account_create = $this->account_create_model->get_search($this->language, $search);
        if ($account_create->num_rows()) {
            $results[] = array(
                'title' => $account_create->row()->title_one . ' ' . $account_create->row()->title_two,
                'description' => strip_tags($account_create->row()->description),
                'link' => site_url($this->lang->line('url_why_create'))
            );
        }
        $account_create = $this->account_create_model->get_search($this->language, $search, 'title_left');
        if ($account_create->num_rows()) {
            $results[] = array(
                'title' => $account_create->row()->title_one . ' ' . $account_create->row()->title_two,
                'description' => strip_tags($account_create->row()->title_left),
                'link' => site_url($this->lang->line('url_why_create'))
            );
        }
        $account_create = $this->account_create_model->get_search($this->language, $search, 'on_demand_left', 'on_demand_right');
        if ($account_create->num_rows()) {
            $results[] = array(
                'title' => strip_tags($account_create->row()->on_demand_left),
                'description' => strip_tags($account_create->row()->on_demand_right),
                'link' => site_url($this->lang->line('url_why_create'))
            );
        }
        $architect = $this->architect_model->get_search($this->language, $search, 'title', 'advantage_title');
        if ($architect->num_rows()) {
            $results[] = array(
                'title' => strip_tags($architect->row()->title),
                'description' => strip_tags($architect->row()->advantage_title),
                'link' => site_url($this->lang->line('url_architect'))
            );
        }
        $architect_items = $this->architect_item_model->get_site($this->language, $search)->result();
        foreach ($architect_items as $item) {
            $results[] = array(
                'title' => strip_tags($item->title),
                'description' => strip_tags($item->description),
                'link' => site_url($this->lang->line('url_architect'))
            );
        }
        $cases = $this->case_model->get_site($this->language, $search)->result();
        foreach ($cases as $item) {
            $results[] = array(
                'title' => strip_tags($item->name),
                'description' => strip_tags($item->description),
                'link' => site_url($this->lang->line('url_case_details') . '/' . $item->id . '/' . simple_url($item->name))
            );
        }
        $partner_page = $this->partner_page_model->get_search($this->language, $search, 'title', 'description');
        if ($partner_page->num_rows()) {
            $results[] = array(
                'title' => strip_tags($partner_page->row()->title),
                'description' => strip_tags($partner_page->row()->description),
                'link' => site_url($this->lang->line('url_partners'))
            );
        }
        $partner_page = $this->partner_page_model->get_search($this->language, $search, 'commercial_description_one', 'commercial_description_two');
        if ($partner_page->num_rows()) {
            $results[] = array(
                'title' => strip_tags($partner_page->row()->commercial_description_one),
                'description' => strip_tags($partner_page->row()->commercial_description_two),
                'link' => site_url($this->lang->line('url_partners'))
            );
        }
        $partner_page = $this->partner_page_model->get_search($this->language, $search, 'advantage_title', 'easy_title');
        if ($partner_page->num_rows()) {
            $results[] = array(
                'title' => strip_tags($partner_page->row()->advantage_title),
                'description' => strip_tags($partner_page->row()->easy_title),
                'link' => site_url($this->lang->line('url_partners'))
            );
        }

        $items = $this->partner_item_model->get_site($this->language, $search)->result();
        foreach ($items as $item) {
            $results[] = array(
                'title' => strip_tags($item->name),
                'description' => strip_tags($item->description),
                'link' => site_url($this->lang->line('url_partners'))
            );
        }

        $service = $this->service_model->get_search($this->language, $search);
        if ($service->num_rows()) {
            $results[] = array(
                'title' => $service->row()->title_one . ' ' . $service->row()->title_two,
                'description' => strip_tags($service->row()->subtitle),
                'link' => site_url($this->lang->line('url_service'))
            );
        }
        $startup = $this->startup_model->get_search($this->language, $search);
        if ($startup->num_rows()) {
            $results[] = array(
                'title' => strip_tags($startup->row()->title),
                'description' => strip_tags($startup->row()->title_offer),
                'link' => site_url($this->lang->line('url_startup'))
            );
        }

        $items = $this->startup_item_model->get_site($this->language, $search)->result();
        foreach ($items as $item) {
            $results[] = array(
                'title' => $this->lang->line('menu_startup'),
                'description' => strip_tags($item->text),
                'link' => site_url($this->lang->line('url_startup'))
            );
        }
        $items = $this->startup_slider_model->get_site($this->language, $search)->result();
        foreach ($items as $item) {
            $results[] = array(
                'title' => $this->lang->line('menu_startup'),
                'description' => strip_tags($item->text),
                'link' => site_url($this->lang->line('url_startup'))
            );
        }

        $text = $this->text_case_model->get_search($this->language, $search);
        if ($text->num_rows()) {
            $results[] = array(
                'title' => $text->row()->title_one . ' ' . $text->row()->title_two,
                'description' => strip_tags($text->row()->subtitle),
                'link' => site_url($this->lang->line('url_cases'))
            );
        }
        $text = $this->text_contact_us_model->get_search($this->language, $search, 'title', 'description');
        if ($text->num_rows()) {
            $results[] = array(
                'title' => strip_tags($text->row()->title),
                'description' => strip_tags($text->row()->description),
                'link' => site_url($this->lang->line('url_contact'))
            );
        }
        $text = $this->text_contact_us_model->get_search($this->language, $search, 'title_two', 'description_two');
        if ($text->num_rows()) {
            $results[] = array(
                'title' => strip_tags($text->row()->title_two),
                'description' => strip_tags($text->row()->description_two),
                'link' => site_url($this->lang->line('url_contact'))
            );
        }
        $text = $this->text_faq_model->get_search($this->language, $search);
        if ($text->num_rows()) {
            $results[] = array(
                'title' => $text->row()->title_one . ' ' . $text->row()->title_two,
                'description' => $text->row()->title_three . '<br>' . strip_tags($text->row()->text_contact_us),
                'link' => site_url($this->lang->line('url_faq'))
            );
        }

        $text = $this->text_plan_model->get_search($this->language, $search, 'title', 'subtitle', 'title_simulation');
        if ($text->num_rows()) {
            $results[] = array(
                'title' => strip_tags($text->row()->title),
                'description' => strip_tags($text->row()->subtitle) . ' ' . strip_tags($text->row()->title_simulation),
                'link' => site_url($this->lang->line('url_prices'))
            );
        }

        $text = $this->text_plan_model->get_search($this->language, $search, 'title_performance', 'description_performance', 'warning_performance');
        if ($text->num_rows()) {
            $results[] = array(
                'title' => strip_tags($text->row()->title_performance),
                'description' => strip_tags($text->row()->description_performance) . '<br>' . strip_tags($text->row()->warning_performance),
                'link' => site_url($this->lang->line('url_prices'))
            );
        }

        $data['results'] = $results;
        $this->_header($header);
        $this->load->view('site/search_result', $data);
        $this->_footer();
    }

    public function index() {
        $search = trim(strip_tags($this->input->get('search')));
        if (!empty($search)) {
            $this->_search($search);
        } else {
            $this->load->model(array('banner_model', 'text_home_model',
                'why_choose_model', 'plan_model', 'operational_model', 'storage_model', 'speed_model', 'processing_model',
                'memory_model', 'messaging_model', 'performance_model', 'text_plan_model'));
            $banners = $this->banner_model->get_site($this->language)->result();
            $data['banners'] = $banners;
            $data['chooses'] = $this->why_choose_model->get_site($this->language)->result();
            $text_home = $this->text_home_model->get($this->language);
            if ($text_home->num_rows()) {
                $data['text_home'] = $text_home->row();
            }
            $messaging = $this->messaging_model->get_site_current($this->language);
            if ($messaging->num_rows()) {
                $data['messaging'] = $messaging->row();
            } else {
                $messaging = $this->messaging_model->get_site_permanent($this->language);
                if ($messaging->num_rows()) {
                    $data['messaging'] = $messaging->row();
                }
            }
            $operationals = $this->operational_model->get_site()->result();
            $data['operationals'] = $operationals;
            if (count($operationals)) {
                $plans = $this->plan_model->get_site_operational($this->language, $operationals[0]->id)->result();
                foreach ($plans as $plan) {
                    $plan->configs = $this->plan_model->get_configs($plan->id)->result();
                }
                $data['plans'] = $plans;
            }
            $processing = $this->processing_model->get($this->language);
            if ($processing->num_rows()) {
                $data['processing'] = $processing->row();
            }
            $memory = $this->memory_model->get($this->language);
            if ($memory->num_rows()) {
                $data['memory'] = $memory->row();
            }
            $storage = $this->storage_model->get($this->language);
            if ($storage->num_rows()) {
                $data['storage'] = $storage->row();
            }
            $data['speeds'] = $this->speed_model->get($this->language)->result();
            $og_properties = array();
            if (count($banners)) {
                $og_properties['title'] = 'Brascloud';
                $og_properties['description'] = $banners[0]->name;
                $og_properties['image'] = base_url($banners[0]->image);
            }
            $data['performances'] = $this->performance_model->get_site($this->language)->result();
            $text_plan = $this->text_plan_model->get($this->language);
            if ($text_plan->num_rows()) {
                $data['text_plan'] = $text_plan->row();
            }
            //$header['title'] = 'Brascloud';
			$header = array();
            $footer['range_slider'] = TRUE;
            $this->_header($header, $og_properties);
            $this->load->view('site/index', $data);
            $this->_footer($footer);
        }
    }

    //via ajax
    public function load_plans_slider() {
        $method = $this->input->method(TRUE);
        if ($method !== 'POST') {
            echo json_encode(array('status' => 'error'));
            return;
        }
        $os_id = trim(strip_tags($this->input->post('os_id')));
        if (empty($os_id) || !is_numeric($os_id)) {
            echo json_encode(array('status' => 'error'));
            return;
        } else {
            $this->load->model(array('operational_model', 'plan_model'));
            $operational = $this->operational_model->get($os_id);
            if (!$operational->num_rows()) {
                echo json_encode(array('status' => 'error'));
                return;
            }
            $plans = $this->plan_model->get_site_operational($this->language, $operational->row()->id)->result();
            foreach ($plans as $plan) {
                $plan->configs = $this->plan_model->get_configs($plan->id)->result();
            }
            $data['plans'] = $plans;
            $configuration = $this->configuration_model->get($this->language);
            if ($configuration->num_rows()) {
                $data['configuration'] = $configuration->row();
            }
            $html = $this->load->view('site/partials/pricing_slider', $data, TRUE);
            echo json_encode(array('status' => 'success', 'html' => $html));
            return;
        }
    }

    //via ajax
    public function calculate_value_plan() {
        $method = $this->input->method(TRUE);
        if ($method !== 'POST') {
            echo json_encode(array('status' => 'error'));
            return;
        }
        $this->load->model(array('plan_model', 'operational_model', 'storage_model', 'speed_model', 'processing_model', 'memory_model'));
        $processing = number_format($this->input->post('processing'), 2);
        $speed = number_format($this->input->post('speed'), 2);
        $memory = number_format($this->input->post('memory'), 2);
        $storage = $this->input->post('storage');
        $os = $this->input->post('os');

        $operational_base = $this->operational_model->get_site_details($os)->row();
        $processing_base = $this->processing_model->get($this->language)->row();
        $memory_base = $this->memory_model->get($this->language)->row();
        $storage_base = $this->storage_model->get($this->language)->row();
        $speed_base = $this->speed_model->get_speed($this->language, $speed)->row();

        $has_plan = FALSE;
        $plan_details = NULL;
        $search_plan = $this->plan_model->get_plan_custom($this->language, $os);
        if ($search_plan->num_rows()) {
            foreach ($search_plan->result() as $plan) {
                $has_memory = $this->plan_model->get_config_item($plan->id, $memory_base->config_id, $memory);
                $has_speed = $this->plan_model->get_config_item($plan->id, $speed_base->config_id, $speed);
                $has_processing = $this->plan_model->get_config_item($plan->id, $processing_base->config_id, $processing);
                if ($has_memory->num_rows() && $has_speed->num_rows() && $has_processing->num_rows()) {
                    $has_plan = TRUE;
                    $plan_details = $plan;
                    break;
                }
            }
        }

        if ($has_plan) {
            $plan_operational = $this->plan_model->get_plan_operational($plan_details->id, $operational_base->id)->row();
            $value_storage = ($storage * $storage_base->price_month);
            $value_total_month = $plan_operational->price_month + $value_storage;
            $value_total_hour = $value_total_month / 720;
            $array_return = array(
                'status' => 'success',
                'value_month' => 'R$' . number_format($value_total_month, 2, ',', '.') . ' ' . mb_strtoupper($this->lang->line('month')),
                'value_hour' => 'R$' . number_format($value_total_hour, 2, ',', '.') . ' ' . mb_strtoupper($this->lang->line('hour')),
                'has_plan' => $has_plan,
                'plan' => $plan_details->plan_exist_1 .'<strong>'.$plan_details->name.'</strong>'.$plan_details->plan_exist_2
            );
        } else {
            $value_total_month = $operational_base->price_month;
            $value_total_month += ($speed_base->price_month * $processing);
            $value_total_month += ($storage * $storage_base->price_month);
            $value_total_month += ($memory * $memory_base->price_month);
            $value_total_hour = $value_total_month / 720;
            $array_return = array(
                'status' => 'success',
                'value_month' => 'R$' . number_format($value_total_month, 2, ',', '.') . ' ' . mb_strtoupper($this->lang->line('month')),
                'value_hour' => 'R$' . number_format($value_total_hour, 2, ',', '.') . ' ' . mb_strtoupper($this->lang->line('hour')),
                'has_plan' => $has_plan,
            );
        }
        echo json_encode($array_return);
    }

    public function prices() {
        $data = array();
        $this->load->model(array('plan_model', 'operational_model', 'storage_model', 'speed_model', 'processing_model', 'memory_model', 'text_home_model', 'performance_model', 'text_plan_model'));
        $text_home = $this->text_home_model->get($this->language);
        if ($text_home->num_rows()) {
            $data['text_home'] = $text_home->row();
        }
        $text_plan = $this->text_plan_model->get($this->language);
        $og_properties = array();
        if ($text_plan->num_rows()) {
            $data['text_plan'] = $text_plan->row();
            $og_properties['title'] = $this->lang->line('menu_prices') . ' | Brascloud';
            $og_properties['description'] = strip_tags($text_plan->row()->title);
        }
        $operationals = $this->operational_model->get_site()->result();
        $data['operationals'] = $operationals;
        if (count($operationals)) {
            $plans = $this->plan_model->get_site_operational($this->language, $operationals[0]->id)->result();
            foreach ($plans as $plan) {
                $plan->configs = $this->plan_model->get_configs($plan->id)->result();
            }
            $data['plans'] = $plans;
        }
        $processing = $this->processing_model->get($this->language);
        if ($processing->num_rows()) {
            $data['processing'] = $processing->row();
        }
        $memory = $this->memory_model->get($this->language);
        if ($memory->num_rows()) {
            $data['memory'] = $memory->row();
        }
        $storage = $this->storage_model->get($this->language);
        if ($storage->num_rows()) {
            $data['storage'] = $storage->row();
        }
        $data['speeds'] = $this->speed_model->get($this->language)->result();
        $data['performances'] = $this->performance_model->get_site($this->language)->result();

        $header['title'] = $this->lang->line('menu_prices') . ' | Brascloud';
        $footer['range_slider'] = TRUE;
        $this->_header($header, $og_properties);
        $this->load->view('site/prices', $data);
        $this->_footer($footer);
    }

    public function pricing() {
        $this->load->model(array('plan_model', 'operational_model', 'config_model'));
        $operationals = $this->operational_model->get_site()->result();
        $data['operationals'] = $operationals;
        $configs = $this->config_model->get_site($this->language)->result();
        $data['configs'] = $configs;
        if (count($operationals)) {
            $plans = $this->plan_model->get_site_operational($this->language, $operationals[0]->id)->result();
            foreach ($plans as $plan) {
                $plan->configs = array();
                foreach ($configs as $c) {
                    $plan_config = $this->plan_model->get_plan_config($plan->id, $c->id);
                    if ($plan_config->num_rows()) {
                        $partials_value = explode('.', $plan_config->row()->value);
                        if ($partials_value[1] > 0) {
                            $value = number_format($plan_config->row()->value, 2, ',', '.');
                        } else {
                            $value = number_format($plan_config->row()->value, 0);
                        }
                        $plan->configs[$c->id] = $value . ' ' . ($plan_config->row()->measure != '.' ? $plan_config->row()->measure : '');
                    } else {
                        $plan->configs[$c->id] = ' - ';
                    }
                    $plan->config_name[$c->id] = $c->name;
                }
            }
            $data['plans'] = $plans;
        }
        $og_properties = array();
        $og_properties['title'] = $this->lang->line('prices_table') . ' | Brascloud';
        $og_properties['description'] = $this->lang->line('prices_table');
        $header['title'] = $this->lang->line('prices_table') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/pricing', $data);
        $this->_footer();
    }

    //via ajax
    public function load_plans_table() {
        $method = $this->input->method(TRUE);
        if ($method !== 'POST') {
            echo json_encode(array('status' => 'error'));
            return;
        }
        $os_id = trim(strip_tags($this->input->post('os_id')));
        if (empty($os_id) || !is_numeric($os_id)) {
            echo json_encode(array('status' => 'error'));
            return;
        } else {
            $this->load->model(array('operational_model', 'plan_model', 'config_model'));
            $operational = $this->operational_model->get($os_id);
            if (!$operational->num_rows()) {
                echo json_encode(array('status' => 'error'));
                return;
            }
            $configs = $this->config_model->get_site($this->language)->result();
            $data['configs'] = $configs;
            $plans = $this->plan_model->get_site_operational($this->language, $operational->row()->id)->result();
            foreach ($plans as $plan) {
                $plan->configs = array();
                foreach ($configs as $c) {
                    $plan_config = $this->plan_model->get_plan_config($plan->id, $c->id);
                    if ($plan_config->num_rows()) {
                        $partials_value = explode('.', $plan_config->row()->value);
                        if ($partials_value[1] > 0) {
                            $value = number_format($plan_config->row()->value, 2, ',', '.');
                        } else {
                            $value = number_format($plan_config->row()->value, 0);
                        }
                        $plan->configs[$c->id] = $value . ' ' . ($plan_config->row()->measure != '.' ? $plan_config->row()->measure : '');
                    } else {
                        $plan->configs[$c->id] = ' - ';
                    }
                    $plan->config_name[$c->id] = $c->name;
                }
            }
            $data['plans'] = $plans;
            $html = $this->load->view('site/partials/pricing_table', $data, TRUE);
            echo json_encode(array('status' => 'success', 'html' => $html));
            return;
        }
    }

    public function proposal() {
        $method = $this->input->method(TRUE);
        if ($method !== 'POST') {
            redirect();
        }
        $this->load->model(array('text_home_model', 'plan_model', 'operational_model', 'storage_model', 'speed_model', 'processing_model', 'memory_model', 'proposal_model'));
        $proposal = $this->proposal_model->get($this->language);
        if (!$proposal->num_rows()) {
            redirect();
        }
        $texts = $this->text_home_model->get($this->language);
        if ($texts->num_rows()) {
            $data['text_home'] = $texts->row();
        }
        $data['proposal'] = $proposal->row();
        $os = $this->input->post('os_slider');
        $processing = $this->input->post('processing');
        $speed = $this->input->post('speed');
        $memory = $this->input->post('memory');
        $storage = $this->input->post('storage');


        $operational_base = $this->operational_model->get_site_details($os)->row();
        $processing_base = $this->processing_model->get($this->language)->row();
        $memory_base = $this->memory_model->get($this->language)->row();
        $storage_base = $this->storage_model->get($this->language)->row();
        $speed_base = $this->speed_model->get_speed($this->language, $speed)->row();

        $has_plan = FALSE;
        $plan_details = NULL;
        $search_plan = $this->plan_model->get_plan_custom($this->language, $os);
        if ($search_plan->num_rows()) {
            foreach ($search_plan->result() as $plan) {
                $has_memory = $this->plan_model->get_config_item($plan->id, $memory_base->config_id, $memory);
                $has_speed = $this->plan_model->get_config_item($plan->id, $speed_base->config_id, $speed);
                $has_processing = $this->plan_model->get_config_item($plan->id, $processing_base->config_id, $processing);
                if ($has_memory->num_rows() && $has_speed->num_rows() && $has_processing->num_rows()) {
                    $has_plan = TRUE;
                    $plan_details = $plan;
                    break;
                }
            }
        }

        if ($has_plan) {
            $plan_operational = $this->plan_model->get_plan_operational($plan_details->id, $operational_base->id)->row();
            $value_storage = ($storage * $storage_base->price_month);
            $value_total_month = $plan_operational->price_month + $value_storage;
            $value_total_hour = $value_total_month / 720;
            $data['value_month'] = $value_total_month;
            $data['value_hour'] = $value_total_hour;
        } else {
            $value_total_month = $operational_base->price_month;
            $value_total_month += ($speed_base->price_month * $processing);
            $value_total_month += ($storage * $storage_base->price_month);
            $value_total_month += ($memory * $memory_base->price_month);
            $value_total_hour = $value_total_month / 720;
            $data['value_month'] = $value_total_month;
            $data['value_hour'] = $value_total_hour;
        }
        $og_properties = array();
        $header['title'] = $this->lang->line('proposal') . ' | Brascloud';
        $data['storage_value'] = $storage;
        $data['memory_value'] = $memory;
        $data['speed'] = $speed_base;
        $data['processing_value'] = $processing;
        $data['processing'] = $processing_base;
        $data['memory'] = $memory_base;
        $data['storage'] = $storage_base;
        $data['operational'] = $operational_base;
        $this->_header($header, $og_properties);
        $this->load->view('site/proposal', $data);
        $this->_footer();
    }

    public function partners() {
        $this->load->model(array('partner_page_model', 'partner_item_model'));
        $data = array();
        $page = $this->partner_page_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $og_properties = array();
        $og_properties['title'] = $this->lang->line('menu_partners') . ' | Brascloud';
        $og_properties['description'] = strip_tags($page->row()->title);
        $og_properties['image'] = base_url($page->row()->image_top);
        $data['page'] = $page->row();
        $data['items'] = $this->partner_item_model->get_site($this->language)->result();
        $header['title'] = $this->lang->line('menu_partners') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/partners', $data);
        $this->_footer();
    }

    public function startup() {
        $this->load->model(array('startup_model', 'startup_slider_model', 'startup_item_model'));
        $data = array();
        $page = $this->startup_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $og_properties = array();
        $og_properties['title'] = $this->lang->line('menu_startup') . ' | Brascloud';
        $og_properties['description'] = strip_tags($page->row()->title);
        $og_properties['image'] = base_url($page->row()->image);
        $data['page'] = $page->row();
        $data['sliders'] = $this->startup_slider_model->get_site($this->language)->result();
        $data['items'] = $this->startup_item_model->get_site($this->language)->result();
        $header['title'] = $this->lang->line('menu_startup') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/startup', $data);
        $this->_footer();
    }

    public function why_create() {
        $this->load->model(array('account_create_model', 'account_item_model'));
        $data = array();
        $page = $this->account_create_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $og_properties = array();
        $og_properties['title'] = $page->row()->title_one . ' ' . $page->row()->title_two;
        $og_properties['description'] = strip_tags($page->row()->description);
//        $og_properties['image'] = base_url($page->row()->image);
        $header['title'] = $this->lang->line('menu_why_create') . ' | Brascloud';
        $data['page'] = $page->row();
        $data['items'] = $this->account_item_model->get_site($this->language)->result();

        $this->_header($header, $og_properties);
        $this->load->view('site/why_create', $data);
        $this->_footer();
    }

    public function community() {
        $this->load->model(array('community_model'));
        $data = array();
        $page = $this->community_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $data['page'] = $page->row();
        $og_properties = array();
        $og_properties['title'] = $page->row()->title_one . ' ' . $page->row()->title_two;
        $og_properties['description'] = strip_tags($page->row()->subtitle);
//        $og_properties['image'] = base_url($page->row()->image);
        $header['title'] = $this->lang->line('menu_community') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/community', $data);
        $this->_footer();
    }

    public function cases() {
        $this->load->model(array('case_model', 'text_case_model'));
        $data = array();
        $page = $this->text_case_model->get($this->language);
        $cases = $this->case_model->get_site($this->language);
        if (!$cases->num_rows()) {
            redirect();
        }
        $og_properties = array();
        if ($page->num_rows()) {
            $data['page'] = $page->row();
            $og_properties['title'] = $page->row()->title_one . ' ' . $page->row()->title_two;
            $og_properties['description'] = strip_tags($page->row()->subtitle);
        }
        $data['cases'] = $cases->result();

//        $og_properties['image'] = base_url($page->row()->image);
        $header['title'] = $this->lang->line('menu_cases') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/cases', $data);
        $this->_footer();
    }

    public function case_details($id = NULL, $name = NULL) {
        if (empty($id) || !is_numeric($id)) {
            redirect($this->lang->line('url_cases'));
        }
        $this->load->model(array('case_model'));
        $data = array();
        $details = $this->case_model->get_site_details($this->language, $id);
        if (!$details->num_rows()) {
            redirect($this->lang->line('url_cases'));
        }
        $data['details'] = $details->row();
        $og_properties = array();
        $og_properties['title'] = $details->row()->name;
        $og_properties['description'] = strip_tags($details->row()->description);
        $og_properties['image'] = base_url($details->row()->image_logo);
        $header['title'] = $details->row()->name . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/case_details', $data);
        $this->_footer();
    }

    public function about() {
        $this->load->model(array('about_model', 'partner_model'));
        $about = $this->about_model->get($this->language);
        if ($about->num_rows()) {
            $og_properties = array();
            $data['about'] = $about->row();
            $og_properties['title'] = $this->lang->line('menu_about') . ' | Brascloud';
            $og_properties['description'] = strip_tags($about->row()->text_brascloud);
            $og_properties['image'] = !empty($about->row()->image_brascloud) ? base_url($about->row()->image_brascloud) : NULL;
            $partners = $this->partner_model->get_site($this->language)->result();
            $partners_array = array_chunk($partners, 6);
            $data['partners'] = $partners_array;
            $header['title'] = $this->lang->line('menu_about') . ' | Brascloud';
            $this->_header($header, $og_properties);
            $this->load->view('site/about', $data);
            $this->_footer();
        } else {
            redirect();
        }
    }

    public function send_join_us() {
        $this->load->model(array('join_us_model'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'strip_tags|trim|required|max_length[100]|valid_email');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('job', $this->lang->line('intended_position'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('message', $this->lang->line('message'), 'strip_tags|trim|required');
        if (!$this->form_validation->run()) {
            $this->about();
            return;
        }

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $job = $this->input->post('job');
        $message = $this->input->post('message');
        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'job' => $job,
            'message' => $message,
            'status' => FALSE,
            'created_at' => date('Y-m-d H:i:s')
        );

        $path = 'archives/';
        $config = array(
            'upload_path' => $path,
            'file_name' => 'curriculum_' . simple_filename(str_replace(' ', '_', substr(strip_tags($this->input->post('name')), 0, 20))),
            'allowed_types' => 'pdf|doc|docx|odt|rtf',
        );
        $this->load->library('upload', $config);
        $archive = NULL;
        $url_email = NULL;
        if ($this->upload->do_upload('file')) {
            $archive = $path . $this->upload->data('file_name');
            $url_email = $this->upload->data('full_path');
            $data['archive'] = $archive;
        } else {
            $this->form_validation->set_message('file', $this->lang->line('empty_file'));
            $this->about();
            return;
        }
        if ($this->join_us_model->save($data)) {
            $configuration = $this->configuration_model->get($this->language);
            if ($configuration->num_rows()) {
                $configuration = $configuration->row();
                $message_final = "Olá. Você recebeu um novo pedido de vaga de trabalho pelo site BRASCLOUD\n\n";
                $message_final .= "Nome: $name\n\n";
                $message_final .= "Email: $email\n\n";
                $message_final .= "Telefone: $phone\n\n";
                $message_final .= "Cargo pretendido: $job\n\n";
                $message_final .= "Mensagem\n: $message\n\n";
                $this->load->library('email');
                $this->email->clear();
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from(NO_REPLY, 'Brascloud - Site');
                $this->email->to($configuration->email);
                $this->email->subject('Pedido Vaga Trabalho - BRASCLOUD');
                $this->email->message($message_final);
                $this->email->attach($url_email);
                if ($this->email->send()) {
                    log_message('error', 'E-mail de vaga de trabalho enviado com sucesso');
                } else {
                    log_message('error', 'Falha no envio de vaga de trabalho ' . json_encode($this->email->print_debugger()));
                }
            }
            $this->session->set_flashdata('success_join_us', TRUE);
        }
        redirect($this->lang->line('url_about'));
    }

    public function terms() {
        $this->load->model('terms_model');
        $page = $this->terms_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $data['terms'] = $page->row();
        $header['title'] = $this->lang->line('menu_terms') . ' | Brascloud';
        $this->_header($header);
        $this->load->view('site/terms', $data);
        $this->_footer();
    }

    public function services() {
        $this->load->model(array('service_model', 'service_item_model'));
        $page = $this->service_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $data['service'] = $page->row();
        $data['items'] = $this->service_item_model->get_site($this->language)->result();
        $og_properties = array();
        $og_properties['title'] = $page->row()->title_one . ' ' . $page->row()->title_two;
        $og_properties['description'] = strip_tags($page->row()->subtitle);
        $og_properties['image'] = base_url($page->row()->image);
        $header['title'] = $this->lang->line('menu_services') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/services', $data);
        $this->_footer();
    }

    public function architects() {
        $this->load->model(array('architect_model', 'architect_item_model'));
        $page = $this->architect_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $data['architect'] = $page->row();
        $data['items'] = $this->architect_item_model->get_site($this->language)->result();
        $og_properties = array();
        $og_properties['title'] = $page->row()->title;
        $og_properties['description'] = strip_tags($page->row()->advantage_title);
        $og_properties['image'] = base_url($page->row()->image);
        $header['title'] = $this->lang->line('menu_architects') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/architects', $data);
        $this->_footer();
    }

    public function faq() {
        $this->load->model(array('faq_model', 'faq_category_model', 'text_faq_model'));
        $page = $this->text_faq_model->get($this->language);
        if (!$page->num_rows()) {
            redirect();
        }
        $search = trim(strip_tags($this->input->get('search')));
        $categories = $this->faq_category_model->get_site($this->language)->result();
        foreach ($categories as $index => $c) {
            $questions = $this->faq_model->get_category_site($c->id, $search);
            if ($questions->num_rows()) {
                $categories[$index]->questions = $questions->result();
            } else {
                unset($categories[$index]);
            }
        }
        $data['search'] = $search;
        $data['texts'] = $page->row();
        $data['categories'] = array_values($categories);
        $og_properties = array();
        $og_properties['title'] = $page->row()->title_one . ' ' . $page->row()->title_two;
        $og_properties['description'] = strip_tags($page->row()->text_contact_us);
        $header['title'] = $this->lang->line('menu_faq') . ' | Brascloud';
        $this->_header($header, $og_properties);
        $this->load->view('site/faq', $data);
        $this->_footer();
    }

    public function get_cities($state_id = NULL) {
        $this->load->model(array('state_model', 'city_model'));
        if (empty($state_id) || !is_numeric($state_id)) {
            echo '<option value="">Selecione...</option>';
            return;
        }
        $cities = $this->city_model->get(NULL, $state_id);
        if (!$cities->num_rows()) {
            set_status_header(400); //Bad request
            return;
        }

        $city_combo = $this->_get_city_combo($state_id);
        foreach ($city_combo as $id => $name) {
            echo "<option value='$id'>$name</option>";
        }
    }

    private function _get_state_combo() {
        $this->load->model('state_model');
        $states = $this->state_model->get()->result();
        $state_combo[''] = $this->lang->line('state');
        foreach ($states as $state) {
            $state_combo[$state->id] = $state->name;
        }
        return $state_combo;
    }

    private function _get_city_combo($state_id = NULL) {
        $this->load->model('city_model');

        if (!$state_id) {
            return array('' => $this->lang->line('city'));
        }

        $cities = $this->city_model->get(NULL, $state_id);
        if (!$cities->num_rows()) {
            return array('' => $this->lang->line('city'));
        }
        $cities = $cities->result();

        $city_combo[''] = $this->lang->line('city');
        foreach ($cities as $city) {
            $city_combo[$city->id] = $city->name;
        }
        return $city_combo;
    }

    public function startup_signup() {
        $this->load->model(array('recipe_model', 'city_model', 'state_model'));

        $og_properties['title'] = $this->lang->line('title_about');
        $og_properties['description'] = NULL;
        $og_properties['image'] = NULL;

        $header['title'] = $this->lang->line('startup_signup_title') . ' | Brascloud';

        $data = array(
            'recipes' => $this->recipe_model->get($this->language)->result(),
            'state_combo' => $this->_get_state_combo(),
            'city_combo' => $this->_get_city_combo(set_value('uf_id'))
        );

        if ($this->session->userdata('submit_success')) {
            $this->session->unset_userdata('submit_success');
            $data['submit_success'] = TRUE;
        }

        $this->_header($header, $og_properties);
        $this->load->view('site/startup_signup', $data);
        $this->_footer();
    }

    public function startup_submit() {
        $this->load->model(array('startup_contact_model', 'city_model', 'startup_model'));
        if (!$this->_startup_validation()) {
            return $this->startup_signup();
        }

        $name_startup = $this->input->post('name_startup');
        $company_name = $this->input->post('company_name');
        $cnpj = $this->input->post('cnpj');
        $phone = $this->input->post('phone');
        $cep = $this->input->post('cep');
        $address = $this->input->post('address');
        $number = $this->input->post('number');
        $complement = $this->input->post('complement');
        $district = $this->input->post('district');
        $country = $this->input->post('country');
        $foundation_date = $this->input->post('foundation_date');
        $description = $this->input->post('description');
        $project_page = $this->input->post('project_page');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $linkedin = $this->input->post('linkedin');
        $met = $this->input->post('met');
        $annual_billing = $this->input->post('annual_billing');
        $number_partners = $this->input->post('number_partners');
        $number_team = $this->input->post('number_team');
        $startup_stage = $this->input->post('startup_stage');
        $market = $this->input->post('market');
        $business_model = $this->input->post('business_model');
        $email = $this->input->post('email');
        if ($this->language == 1) {
            $city_id = $this->input->post('city_id');
            $city_details = $this->city_model->get_details($city_id)->row();
        } else {
            $state = $this->input->post('state');
            $city = $this->input->post('city');
        }
        $startup_page = $this->startup_model->get($this->language);

        $data = array(
            'name_startup' => $name_startup,
            'company_name' => $company_name,
            'cnpj' => $cnpj,
            'phone' => $phone,
            'cep' => $cep,
            'address' => $address,
            'number' => $number,
            'complement' => $complement,
            'district' => $district,
            'country' => $country,
            'foundation_date' => format_date($foundation_date),
            'email' => $email,
            'description' => $description,
            'project_page' => $project_page,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'met' => $met,
            'annual_billing' => money_american($annual_billing),
            'number_partners' => $number_partners,
            'number_team' => $number_team,
            'startup_stage' => $startup_stage,
            'market' => $market,
            'business_model' => $business_model,
            'status' => FALSE,
            'coupon' => $startup_page->num_rows() ? $startup_page->row()->code : NULL,
            'created_at' => date('Y-m-d H:i:s')
        );
        if ($this->language == 1) {
            $data['city_id'] = $city_id;
        } else {
            $data['city'] = $city;
            $data['state'] = $state;
        }

        $this->load->library('upload', array(
            'upload_path' => UPLOAD_PATH,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_width' => 6000,
            'max_heigth' => 6000
        ));
        if ($this->upload->do_upload('logo')) {
            $upload = $this->upload->data();
            $pattern_desktop = IMAGES_PATH . 'startup_contact/';
            $ext = $upload['file_ext'];
            $file_name = $pattern_desktop . archive_filename($pattern_desktop, $ext, $upload['raw_name']);
            if (rename($upload['full_path'], $file_name)) {
                $data['logo'] = $file_name;
            }
        }

        $recipes = $this->input->post('recipe');
        if (!is_array($recipes)) {
            $recipes = array();
        }

        if ($this->startup_contact_model->save($data, $recipes)) {

            $configuration = $this->configuration_model->get($this->language);
            if ($configuration->num_rows()) {
                $configuration = $configuration->row();

                $message_final = "Olá. Você recebeu um novo cadastro de startup pelo site BRASCLOUD\n\n";
                $message_final .= "Nome startup: $name_startup\n\n";
                if (!empty($company_name)) {
                    $message_final .= "Empresa: $company_name\n\n";
                }
                if (!empty($cnpj)) {
                    $message_final .= "CNPJ: $cnpj\n\n";
                }
                $message_final .= "Cupom: $cnpj\n\n";
                $message_final .= "Telefone: $phone\n\n";
                $message_final .= "E-mail: $email\n\n";
                $message_final .= "País: $country\n\n";
                if ($this->language == 1) {
                    $message_final .= "Estado: $city_details->state\n\n";
                    $message_final .= "Cidade: $city_details->name\n\n";
                } else {
                    $message_final .= "Estado: $state\n\n";
                    $message_final .= "Cidade: $city\n\n";
                }
                $message_final .= "CEP: $cep\n\n";
                $message_final .= "Bairro: $district\n\n";
                $message_final .= "Endereço: $address\n\n";
                $message_final .= "Número: $number\n\n";
                $message_final .= "Complemento: $complement\n\n";
                $message_final .= "Data fundação: $foundation_date\n\n";
                $message_final .= "Descrição: $description\n\n";
                $message_final .= "Página do projeto: $project_page\n\n";
                $message_final .= "Facebook: $facebook\n\n";
                $message_final .= "Twitter: $twitter\n\n";
                $message_final .= "Linkedin: $linkedin\n\n";
                $message_final .= "Como conheceu?: $met\n\n";
                $message_final .= "Ganho anual: R$ $annual_billing\n\n";
                $message_final .= "Qtd Parceiros: $number_partners\n\n";
                $message_final .= "Membros na equipe: $number_team\n\n";
                $message_final .= "Estágio da startup: $startup_stage\n\n";
                $message_final .= "Mercado: $market\n\n";
                $message_final .= "Modelo de negócio: $business_model\n\n";
                $this->load->library('email');
                $this->email->clear();
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from(NO_REPLY, 'Brascloud - Site');
                $this->email->to($configuration->email);
                $this->email->subject('Cadastro Startup - BRASCLOUD');
                $this->email->message($message_final);
                if ($this->email->send()) {
                    log_message('error', 'E-mail de startup enviado com sucesso');
                } else {
                    log_message('error', 'Falha no envio de cadastro de startup ' . json_encode($this->email->print_debugger()));
                }
            }

            $startup_page = $this->startup_model->get($this->language);
            if ($startup_page->num_rows()) {
                $this->session->set_userdata('promotional_code', $startup_page->row()->code);
            }
            $this->session->set_userdata('submit_success', TRUE);
        }
        redirect($this->lang->line('url_startup_signup'));
    }

    private function _startup_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_message('valid_cnpj', $this->lang->line('valid_cnpj'));
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('name_startup', $this->lang->line('startup_name'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('company_name', $this->lang->line('company_name'), 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'strip_tags|trim|remove_space|exact_length[18]' . ($this->language == 1 ? '|callback_valid_cnpj' : ''));
        $this->form_validation->set_rules('phone', $this->lang->line('landline'), 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('cep', $this->lang->line('zip_code'), 'strip_tags|trim|required|max_length[20]');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'strip_tags|trim|required|max_length[150]');
        $this->form_validation->set_rules('number', $this->lang->line('number'), 'strip_tags|trim|required|max_length[10]');
        $this->form_validation->set_rules('complement', $this->lang->line('complement'), 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('district', $this->lang->line('district'), 'strip_tags|trim|required|max_length[100]');
        if ($this->language == 1) {
            $this->form_validation->set_rules('uf_id', $this->lang->line('state'), 'strip_tags|trim|required|integer');
            $this->form_validation->set_rules('city_id', $this->lang->line('city'), 'strip_tags|trim|required|integer');
        } else {
            $this->form_validation->set_rules('uf', $this->lang->line('state'), 'strip_tags|trim|required|max_length[100]');
            $this->form_validation->set_rules('city', $this->lang->line('city'), 'strip_tags|trim|required|max_length[100]');
        }
        $this->form_validation->set_rules('country', $this->lang->line('country'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('foundation_date', $this->lang->line('foundation_date'), 'strip_tags|trim|remove_space|exact_length[10]');
        $this->form_validation->set_rules('description', $this->lang->line('short_description'), 'strip_tags|trim');
        $this->form_validation->set_rules('project_page', $this->lang->line('project_page'), 'strip_tags|trim');
        $this->form_validation->set_rules('facebook', 'Facebook', 'strip_tags|trim');
        $this->form_validation->set_rules('twitter', 'Twitter', 'strip_tags|trim');
        $this->form_validation->set_rules('linkedin', 'LinkedIn', 'strip_tags|trim');
        $this->form_validation->set_rules('met', $this->lang->line('met'), 'strip_tags|trim|max_length[150]');
        $this->form_validation->set_rules('annual_billing', $this->lang->line('annual_billing'), 'strip_tags|trim');
        $this->form_validation->set_rules('number_partners', $this->lang->line('number_partners'), 'strip_tags|trim|integer');
        $this->form_validation->set_rules('number_team', $this->lang->line('number_team'), 'strip_tags|trim|integer');
        $this->form_validation->set_rules('startup_stage', $this->lang->line('startup_stage'), 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('market', $this->lang->line('market'), 'strip_tags|trim|max_length[100]');
        $this->form_validation->set_rules('business_model', $this->lang->line('business_model'), 'strip_tags|trim|max_length[100]');
        return $this->form_validation->run();
    }

    public function valid_cnpj($cnpj) {
        if (!empty($cnpj)) {
            return validate_cnpj($cnpj);
        }
        return TRUE;
    }

    public function partner_signup() {
        $this->load->model(array('recipe_model', 'city_model', 'state_model'));

        $og_properties['title'] = $this->lang->line('title_about');
        $og_properties['description'] = NULL;
        $og_properties['image'] = NULL;

        $header['title'] = $this->lang->line('partner_signup_title') . ' | Brascloud';

        $data = array(
            'state_combo' => $this->_get_state_combo(),
            'city_combo' => $this->_get_city_combo(set_value('state_id'))
        );

        if ($this->session->userdata('submit_success')) {
            $this->session->unset_userdata('submit_success');
            $data['submit_success'] = TRUE;
        }

        $this->_header($header, $og_properties);
        $this->load->view('site/partner_signup', $data);
        $this->_footer();
    }

    public function partner_submit() {
        $this->load->model(array('partner_contact_model', 'city_model'));
        if (!$this->_partner_validation()) {
            return $this->partner_signup();
        }

        $site = $this->input->post('site');
        $enterprise = $this->input->post('enterprise');
        $address = $this->input->post('address');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $country = $this->input->post('country');
        $cpf_cnpj = $this->input->post('cpf_cnpj');
        $email = $this->input->post('email');
        $cep = $this->input->post('cep');
        if ($this->language == 1) {
            $city_id = $this->input->post('city_id');
            $city_details = $this->city_model->get_details($city_id)->row();
        } else {
            $state = $this->input->post('state');
            $city = $this->input->post('city');
        }

        $data = array(
            'site' => $site,
            'enterprise' => $enterprise,
            'address' => $address,
            'name' => $name,
            'phone' => $phone,
            'country' => $country,
            'cpf_cnpj' => $cpf_cnpj,
            'email' => $email,
            'cep' => $cep,
            'status' => FALSE,
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->language == 1) {
            $data['city_id'] = $city_id;
        } else {
            $data['city'] = $city;
            $data['state'] = $state;
        }

        if ($this->partner_contact_model->save($data)) {
            $configuration = $this->configuration_model->get($this->language);
            if ($configuration->num_rows()) {
                $configuration = $configuration->row();
                $message_final = "Olá. Você recebeu um novo pedido de parceria pelo site BRASCLOUD\n\n";
                $message_final .= "Nome: $name\n\n";
                $message_final .= "Email: $email\n\n";
                $message_final .= "Telefone: $phone\n\n";
                $message_final .= "País: $country\n\n";
                if ($this->language == 1) {
                    $message_final .= "Estado: $city_details->state\n\n";
                    $message_final .= "Cidade: $city_details->name\n\n";
                } else {
                    $message_final .= "Estado: $state\n\n";
                    $message_final .= "Cidade: $city\n\n";
                }
                $message_final .= "CPF/CNPJ: $cpf_cnpj\n\n";
                $message_final .= "Site: $site\n\n";
                $message_final .= "Empresa: $enterprise\n\n";
                $this->load->library('email');
                $this->email->clear();
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from(NO_REPLY, 'Brascloud - Site');
                $this->email->to($configuration->email);
                $this->email->subject('Pedido Parceria - BRASCLOUD');
                $this->email->message($message_final);
                if ($this->email->send()) {
                    log_message('error', 'E-mail de parceria enviado com sucesso');
                } else {
                    log_message('error', 'Falha no envio de contato de parceria ' . json_encode($this->email->print_debugger()));
                }
            }

            $this->session->set_userdata('submit_success', TRUE);
        }
        redirect($this->lang->line('url_partner_register'));
    }

    private function _partner_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_message('valid_cpf_cnpj', 'O CPF/CNPJ informado não é válido.');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('site', $this->lang->line('site'), 'strip_tags|trim|required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'strip_tags|trim|required|max_length[100]|valid_email');
        $this->form_validation->set_rules('enterprise', $this->lang->line('enterprise_name'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('cpf_cnpj', 'CPF/CNPJ', 'strip_tags|trim|remove_space' . ($this->language == 1 ? '|callback_valid_cpf_cnpj' : ''));
        $this->form_validation->set_rules('name', $this->lang->line('full_name'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'strip_tags|trim|required|max_length[50]');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'strip_tags|trim|required|max_length[100]');
        if ($this->language == 1) {
            $this->form_validation->set_rules('state_id', $this->lang->line('state'), 'strip_tags|trim|required|integer');
            $this->form_validation->set_rules('city_id', $this->lang->line('city'), 'strip_tags|trim|required|integer');
        } else {
            $this->form_validation->set_rules('state', $this->lang->line('state'), 'strip_tags|trim|required|max_length[100]');
            $this->form_validation->set_rules('city', $this->lang->line('city'), 'strip_tags|trim|required|max_length[100]');
        }
        $this->form_validation->set_rules('cep', $this->lang->line('zip_code'), 'strip_tags|trim|required|max_length[10]');
        $this->form_validation->set_rules('country', $this->lang->line('country'), 'strip_tags|trim|required|max_length[100]');
        return $this->form_validation->run();
    }

    public function valid_cpf_cnpj($cpf_cnpj) {
        return !$cpf_cnpj || validate_CPF($cpf_cnpj) || validate_cnpj($cpf_cnpj);
    }

    public function contact() {
        $this->load->model(array('configuration_model', 'text_contact_us_model'));

        $og_properties['title'] = $this->lang->line('title_about');
        $og_properties['description'] = NULL;
        $og_properties['image'] = NULL;

        $header['title'] = $this->lang->line('contact') . ' | Brascloud';

        $configuration = $this->configuration_model->get($this->language);
        $text_contact_us = $this->text_contact_us_model->get($this->language);
        $data = array(
            'configuration' => $configuration->num_rows() ? $configuration->row() : NULL,
            'text_contact_us' => $text_contact_us->num_rows() ? $text_contact_us->row() : NULL,
            'state_combo' => $this->_get_state_combo(),
            'city_combo' => $this->_get_city_combo(set_value('state_id')),
            'department_combo' => $this->_get_department_combo()
        );

        if ($this->session->userdata('submit_success')) {
            $this->session->unset_userdata('submit_success');
            $data['submit_success'] = TRUE;
        }

        $this->_header($header, $og_properties);
        $this->load->view('site/contact', $data);
        $this->_footer();
    }

    private function _get_department_combo() {
        $this->load->model('department_model');
        $departments = $this->department_model->get_active($this->language)->result();
        $department_combo[''] = $this->lang->line('talk_with');
        foreach ($departments as $department) {
            $department_combo[$department->id] = $department->name;
        }
        return $department_combo;
    }

    public function contact_submit() {
        $this->load->model(array('contact_us_model', 'department_model', 'city_model'));
        if (!$this->_contact_validation()) {
            return $this->contact();
        }

        $department_id = $this->input->post('department_id');
        $department = $this->department_model->get($this->language, $department_id);
        if (!$department->num_rows()) {
            redirect($this->lang->line('url_contact'));
        }
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        $country = $this->input->post('country');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        if ($this->language == 1) {
            $city_id = $this->input->post('city_id');
            $city_details = $this->city_model->get_details($city_id)->row();
        } else {
            $state = $this->input->post('state');
            $city = $this->input->post('city');
        }
        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'country' => $country,
            'subject' => $subject,
            'message' => $message,
            'department_id' => $department_id,
            'status' => FALSE,
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->language == 1) {
            $data['city_id'] = $city_id;
        } else {
            $data['city'] = $city;
            $data['state'] = $state;
        }

        if ($this->contact_us_model->save($data)) {

            $configuration = $this->configuration_model->get($this->language);
            if ($configuration->num_rows()) {
                $message_final = "Olá. Você recebeu um novo contato pelo site BRASCLOUD\n\n";
                $message_final .= "Nome: $name\n\n";
                $message_final .= "Email: $email\n\n";
                $message_final .= "Telefone: $phone\n\n";
                $message_final .= "País: $country\n\n";
                if ($this->language == 1) {
                    $message_final .= "Estado: $city_details->state\n\n";
                    $message_final .= "Cidade: $city_details->name\n\n";
                } else {
                    $message_final .= "Estado: $state\n\n";
                    $message_final .= "Cidade: $city\n\n";
                }
                $message_final .= "Assunto: $subject\n\n";
                $message_final .= "Mensagem\n: $message\n\n";
                $configuration = $configuration->row();
                $this->load->library('email');
                $this->email->clear();
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from(NO_REPLY, 'Brascloud - Site');
                $this->email->to($configuration->email);
                $this->email->subject($subject);
                $this->email->message($message_final);
                $this->email->bcc($department->row()->email);
                if ($this->email->send()) {
                    log_message('error', 'E-mail de contato enviado com sucesso');
                } else {
                    log_message('error', 'Falha no envio de contato' . json_encode($this->email->print_debugger()));
                }
            }

            $this->session->set_userdata('submit_success', TRUE);
        }
        redirect($this->lang->line('url_contact'));
    }

    private function _contact_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'strip_tags|trim|required|max_length[100]|valid_email');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'strip_tags|trim|required|max_length[50]');
        if ($this->language == 1) {
            $this->form_validation->set_rules('state_id', $this->lang->line('state'), 'strip_tags|trim|required|integer');
            $this->form_validation->set_rules('city_id', $this->lang->line('city'), 'strip_tags|trim|required|integer');
        } else {
            $this->form_validation->set_rules('state', $this->lang->line('state'), 'strip_tags|trim|required|max_length[100]');
            $this->form_validation->set_rules('city', $this->lang->line('city'), 'strip_tags|trim|required|max_length[100]');
        }
        $this->form_validation->set_rules('country', $this->lang->line('country'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'strip_tags|trim|required|max_length[150]');
        $this->form_validation->set_rules('department_id', $this->lang->line('talk_with'), 'strip_tags|trim|required|integer');
        $this->form_validation->set_rules('message', $this->lang->line('message'), 'strip_tags|trim|required');
        return $this->form_validation->run();
    }

    public function call_submit() {
        $this->load->model(array('call_model'));
        if (!$this->_call_validation()) {
            return $this->contact();
        }

        $name = $this->input->post('call_name');
        $phone = $this->input->post('call_phone');
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'status' => FALSE,
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->call_model->save($data)) {
            $configuration = $this->configuration_model->get($this->language);
            if ($configuration->num_rows()) {
                $configuration = $configuration->row();
                $message_final = "Olá. Você recebeu um novo pedido de ligação pelo site BRASCLOUD\n\n";
                $message_final .= "Nome: $name\n\n";
                $message_final .= "Telefone: $phone\n\n";
                $this->load->library('email');
                $this->email->clear();
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from(NO_REPLY, 'Brascloud - Site');
                $this->email->to($configuration->email);
                $this->email->subject('Pedido de Ligação - BRASCLOUD');
                $this->email->message($message_final);
                if ($this->email->send()) {
                    log_message('error', 'E-mail de ligue-me enviado com sucesso');
                } else {
                    log_message('error', 'Falha no envio de ligue-me ' . json_encode($this->email->print_debugger()));
                }
            }
            $this->session->set_userdata('submit_success', TRUE);
        }
        redirect($this->lang->line('url_contact'));
    }

    private function _call_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->set_rules('call_name', $this->lang->line('name'), 'strip_tags|trim|required|max_length[100]');
        $this->form_validation->set_rules('call_phone', $this->lang->line('phone'), 'strip_tags|trim|required|max_length[50]');
        return $this->form_validation->run();
    }

}
