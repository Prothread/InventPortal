<?php

class Status
{
	$private $db;

	private $StatusName;
	private $StatusSubject;
	private $StatusDeadline;
	private $StatusCategory;

	public function setName($value)
	{
		$this->StatusName = $value;
	}

	public function setSubject($value)
	{
		$this->StatusSubject = $value;
	}

	public function setDeadline($value)
	{
		$this->StatusDeadline = $value;
	}

	public function setCategory($value)
	{
		$this->StatusCategory = $value;
	}

	public function getName()
	{
		return $this->StatusName;
	}

	public function getSubject()
	{
		return $this->StatusSubject;
	}

	public function getDeadline()
	{
		return $this->StatusDeadline;
	}

	public function getCategoryName()
	{
		return $this->StatusCategory;
	}

	public function create()
	{
		return $this->db->create();
	}
}