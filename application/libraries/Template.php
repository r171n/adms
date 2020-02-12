<?php

class template
{
	private $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
	}

	public function render($view, $data = array(), $return = false)
	{
		$data['__content'] = $this->ci->load->view($view, $data, true);
		$data['__header']  = $this->ci->load->view('header', $data, true);
		$data['__footer']  = $this->ci->load->view('footer', $data, true);
		$data['__menu']  = $this->ci->load->view('menu', $data, true);
		// $data['__menu']    = !$this->ci->session->userdata('login')?null :
		// 	$this->ci->load->view('back/menu', $data, true);
		if ($return)
			return $this->ci->load->view('template', $data, true);
		$this->ci->load->view('template', $data);
	}
}
