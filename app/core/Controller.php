<?php

class Controller
{
	protected function model($model)
	{
		require_once '../app/Models/'.ucfirst($model).'.php';
		return new $model();
	}

	public function view($view, $data = [])
	{
		require_once '../app/Views/'.$view.'.php';
	}
}