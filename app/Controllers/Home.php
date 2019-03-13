<?php

class Home extends Controller
{
	public function index()
	{
		$contact = $this->model('Contact');
		$company = $this->model('Company');
		$data = [
			'contacts' => $contact->getAllContacts(),
			'companies' => $company->getAllCompanies()
		];
		$this->view('home/index', $data);
	}
}