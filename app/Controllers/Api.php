<?php

class Api extends Controller
{
	public function search()
	{
		if (isset($_POST['query'])) {
			$contact = $this->model('Contact');
			$contacts = [];

			if (!empty($_POST['query'])) {
				$contacts = $contact->findByString($_POST['query']);
			} else {
				$contacts = $contact->getAllContacts();
			}
			echo json_encode($contacts);
		}
		exit();
	}

	public function create()
	{
		if (isset($_POST['query'])) {
			$contact = $this->model('Contact');
			$formData = json_decode($_POST['query'], true);

			if ($formData['id'] !== '') {
				if (count($contact->findById($formData['id'])) == 1) {
					$id = $contact->update($formData);
				}
			} else {
				$id = $contact->create($formData);
			}

			echo json_encode($contact->findById($id));
		}
		exit();
	}

	public function delete()
	{
		if (isset($_POST['query'])) {
			$contact = $this->model('Contact');
			if (count($contact->findById($_POST['query'])) == 1) {
				$contact->delete($_POST['query']);
			}
		}
		exit();
	}
}