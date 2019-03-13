<?php

class Company
{
	public function getAllCompanies()
	{
		$result = Database::getInstance()->getConnection()->query("
			SELECT companies.id, companies.name AS company
			FROM companies
			ORDER BY companies.name ASC
		");
		
		$rows = [];
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;
	}
}