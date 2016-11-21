<?php

class Status
{
	private $db;

	public function __construct()
    {
        $this->db = new DbStatus();
    }

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

	public function getCategory()
	{
		return $this->StatusCategory;
	}

	public function create()
	{
		return $this->db->create($this);
	}

	public function getItems()
	{
		return $this->db->getItems();
	}
}