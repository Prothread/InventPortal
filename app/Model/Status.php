<?php

class Status
{
	/**
	 * Variabele db
	 *
	 * @var DbStatus
	 */
	private $db;

	/**
	 * Link dbstatus aan de db veriabele
	 *
	 * Status constructor.
	 */

	public function __construct()
	{
		$this->db = new DbStatus();
	}

	/**
	 * Variabele om StatusID in op te slaan
	 *
	 * @var $StatusID
	 */

	private $StatusID;

	/**
	 * Variabele om StatusName in op te slaan
	 *
	 * @var $StatusName
	 */

	private $StatusName;

	/**
	 * Variabele om StatusSubject in op te slaan
	 *
	 * @var $StatusSubject
	 */

	private $StatusSubject;

	/**
	 * Variabele om StatusDeadline in op te slaan
	 *
	 * @var $StatusDeadline
	 */

	private $StatusDeadline;

	/**
	 * Variabele om StatusCategory in op te slaan
	 *
	 * @var $StatusCategory
	 */

	private $StatusCategory;

	/**
	 * Variabele om StatusComment in op te slaan
	 *
	 * @var $StatusComment
	 */

	private $StatusComment;

	/**
	 * Set de StatudID variabele met de value die meegegeven is in de setID functie
	 *
	 * @param $value
	 */

	public function setID($value)
	{
		$this->StatusID = $value;
	}

	/**
	 * Set de StatusName variabele met de value die meegegeven is in de setName functie
	 *
	 * @param $value
	 */

	public function setName($value)
	{
		$this->StatusName = $value;
	}

	/**
	 * Set de StatusSubject variabele met de value die meegegeven is in de setSubject functie
	 *
	 * @param $value
	 */

	public function setSubject($value)
	{
		$this->StatusSubject = $value;
	}

	/**
	 * Set de StatusDeadline variabele met de value die meegegeven is in de setDeadline functie
	 *
	 * @param $value
	 */

	public function setDeadline($value)
	{
		$this->StatusDeadline = $value;
	}

	/**
	 * Set de StatusCategory variabele met de value die meegegeven is in de setCategory functie
	 *
	 * @param $value
	 */

	public function setCategory($value)
	{
		$this->StatusCategory = $value;
	}

	/**
	 * Set de StatusComment variabele met de value die meegegeven is in de setComment functie
	 *
	 * @param $value
	 */

	public function setComment($value)
	{
		$this->StatusComment = $value;
	}

	/**
	 * Haal de value van de variabele statusID op
	 *
	 * @return mixed
	 */

	public function getID()
	{
		return $this->StatusID;
	}

	/**
	 * Haal de value van de variabele statusID op
	 *
	 * @return mixed
	 */

	public function getName()
	{
		return $this->StatusName;
	}

	/**
	 * Haal de value van de variabele StatusSubject op
	 *
	 * @return mixed
	 */

	public function getSubject()
	{
		return $this->StatusSubject;
	}

	/**
	 * Haal de value van de variabele StatusDeadline op
	 *
	 * @return mixed
	 */

	public function getDeadline()
	{
		return $this->StatusDeadline;
	}

	/**
	 * Haal de value van de variabele StatusCategory op
	 *
	 * @return mixed
	 */

	public function getCategory()
	{
		return $this->StatusCategory;
	}

	/**
	 * Haal de value van de variabele StatusComment op
	 *
	 * @return mixed
	 */

	public function getComment()
	{
		return $this->StatusComment;
	}

	/**
	 * Haal alle informatie op en neem deze mee in de create functie
	 *
	 * @return bool
	 */

	public function create()
	{
		return $this->db->create($this);
	}

	/**
	 * Haal alle informatie op en neem deze mee in de udpate functie
	 *
	 * @return bool
	 */

	public function update()
	{
		return $this->db->update($this);
	}

	/**
	 * Delete item met een (meegegeven) id
	 *
	 * @param $id
	 * @return bool
	 */

	public function deleteItemByID($id)
	{
		return $this->db->deleteItemByID($id);
	}

	/**
	 * Haal alle items op
	 *
	 * @return array|null
	 */

	public function getItems()
	{
		return $this->db->getItems();
	}

	/**
	 * Haal item op (meegegeven) id op
	 *
	 * @param $id
	 * @return array|null
	 */

	public function getItemById($id)
	{
		return $this->db->getItemById($id);
	}

}