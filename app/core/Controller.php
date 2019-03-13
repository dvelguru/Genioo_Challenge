<?php

class Controller
{
	protected function model($model)
	{
		require_once ROOT . DS . APP_DIR . DS . 'Models/'.ucfirst($model).'.php';
		return new $model();
	}

	public function view($view, $data = [])
	{
		require_once ROOT . DS . APP_DIR . DS . 'Views/'.$view.'.php';
	}
}