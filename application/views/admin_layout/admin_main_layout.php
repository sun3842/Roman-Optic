<?php
$this->load->view('admin_layout/admin_header');
$this->load->view('admin_layout/admin_topbar');
$this->load->view('admin_layout/admin_sidebar');
$this->load->view('others/flashMessage');
$this->load->view($content);
$this->load->view('admin_layout/admin_footer');
$this->load->view('admin_layout/admin_main_js');