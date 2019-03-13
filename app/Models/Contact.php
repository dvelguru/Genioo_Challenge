<?php

class Contact
{
	/*There are methods with repetative strings that can be stored in a model helper.*/
	public function findByString($string)
	{
		$stmt = Database::getInstance()->getConnection()->prepare('
			SELECT contacts.id, contacts.firstname, contacts.lastname, contacts.email, contacts.phone, companies.name AS company
			FROM contacts
			LEFT JOIN companies ON companies.id = contacts.company_id
			WHERE contacts.firstname LIKE ?
			OR contacts.lastname LIKE ?
			OR contacts.email LIKE ?
			OR contacts.phone LIKE ?
			OR companies.name LIKE ?
		');
		$string = "%{$string}%";
		$stmt->bind_param("sssss", $string, $string, $string, $string, $string);
		$stmt->execute();
		$result = $stmt->get_result();

		return $this->fetch_all($result);
	}

	public function findById($id = null)
	{
		$result = Database::getInstance()->getConnection()->query(sprintf("
			SELECT contacts.id, contacts.firstname, contacts.lastname, contacts.email, contacts.phone, companies.name AS company
			FROM contacts
			LEFT JOIN companies ON companies.id = contacts.company_id
			WHERE contacts.id = '%s'
		", $id));

		return $this->fetch_all($result);
	}

	public function getAllContacts($offset = 0, $limit = 1000)
	{
		$result = Database::getInstance()->getConnection()->query(sprintf("
			SELECT contacts.id, contacts.firstname, contacts.lastname, contacts.email, contacts.phone, companies.name AS company
			FROM contacts
			LEFT JOIN companies ON companies.id = contacts.company_id
			LIMIT %d, %d
		", $offset, $limit));

		return $this->fetch_all($result);
	}

	public function create($data = [])
	{
		$new_id = $this->generateRandomString();
		$stmt = Database::getInstance()->getConnection()->prepare("
			INSERT INTO contacts
			(id,firstname,lastname,email,phone,company_id)
			VALUES (?, ?, ?, ?, ?, ?)
		");
		$stmt->bind_param("ssssss", $new_id, $data['firstname'], $data['lastname'], $data['email'], $data['phone'], $data['company_id']);
		$stmt->execute();

		return $new_id;
	}

	public function update($data = null)
	{
		$stmt = Database::getInstance()->getConnection()->prepare("
			UPDATE contacts
			SET id = ?, firstname = ?, lastname = ?, email = ?, phone = ?, company_id = ?
		");
		$stmt->bind_param("ssssss", $data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['phone'], $data['company_id']);
		$stmt->execute();
	}

	public function delete($id = null)
	{
		$stmt = Database::getInstance()->getConnection()->prepare("
			DELETE FROM contacts
			WHERE id = ?
		");
		$stmt->bind_param("s", $id);
		$stmt->execute();
	}

	private function fetch_all($result)
	{
		$rows = [];
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;
	}

	private function generateRandomString($length = 18) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

	    return $randomString;
	}
}