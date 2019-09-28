<?php
$this->load->view('agent_layout/agent_header');
$this->load->view('agent_layout/agent_topbar');
$this->load->view('agent_layout/agent_sidebar');
$this->load->view('agent_others/flashMessage');
$this->load->view($content);
$this->load->view('agent_layout/agent_footer');
$this->load->view('agent_layout/agent_main_js');