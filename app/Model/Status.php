<?php

class Status
{
	private $db;

	public function __construct()
    {
        $this->db = new DbStatus();
    }

    private $StatusID;
	private $StatusName;
	private $StatusSubject;
	private $StatusDeadline;
	private $StatusCategory;
	private $StatusComment;

	public function setID($value)
	{
		$this->StatusID = $value;
	}

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

	public function setComment($value)
	{
		$this->StatusComment = $value;
	}

	public function getID()
	{
		return $this->StatusID;
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

	public function getComment()
	{
		return $this->StatusComment;
	}

	public function create()
	{
		return $this->db->create($this);
	}

	public function update() 
	{
		return $this->db->update($this);
	}

	public function deleteItemByID($id)
	{
		return $this->db->deleteItemByID($id);
	}

	public function getItems()
	{
		return $this->db->getItems();
	}

	public function getItemById($id)
	{
		return $this->db->getItemById($id);
	}

}