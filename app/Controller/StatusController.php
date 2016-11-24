<?php

class StatusController
{
	private $model;

	public function __construct()
    {
        $this->model = new Status();
    }

	public function create(array $statusinfo) {
		$this->model->setName($statusinfo['naam']);
		$this->model->setSubject($statusinfo['onderwerp']);
		$this->model->setDeadline($statusinfo['deadline']);
		$this->model->setCategory($statusinfo['category']);
		$this->model->setComment($statusinfo['comment']);

		if ($result = $this->model->create()) {
            Session::flash('message', 'Het item is succesvol aangemaakt.');
            return $result;
        }
	}
	public function update(array $statusinfo) {
		$this->model->setID($statusinfo['id']);
		$this->model->setName($statusinfo['naam']);
		$this->model->setSubject($statusinfo['onderwerp']);
		$this->model->setDeadline($statusinfo['deadline']);
		$this->model->setCategory($statusinfo['category']);
		$this->model->setComment($statusinfo['comment']);

		if ($result = $this->model->update()) {
            Session::flash('message', 'Het item is succesvol bijgewerkt.');
            return $result;
        }
	}

	public function deleteItemByID($id)
	{
		return $this->model->deleteItemByID($id);
	}

	public function getItems()
	{
		return $this->model->getItems();
	}
	
	public function getItemById($id)
	{
		return $this->model->getItemById($id);
	}

}