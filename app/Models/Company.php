<?php

class Company
{
	public function getAllCompanies()
	{
		$query = Database::getInstance()->getConnection()->query("
			SELECT companies.id, companies.name AS company
			FROM companies
			ORDER BY companies.name ASC
		");
		
		return $query->fetch_all(MYSQLI_ASSOC);
	}
}