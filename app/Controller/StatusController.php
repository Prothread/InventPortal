<?php

class StatusController
{
	private $model;

	public function create(array $statusinfo) {
		$this->model->setName($statusinfo['naam']);
		$this->model->setSubject($statusinfo['onderwerp']);
		$this->model->setDeadline($statusinfo['deadline']);
		$this->model->setCategory($statusinfo['category']);

		if ($result = $this->model->create()) {
            Session::flash('message', 'Het item is succesvol aangemaakt.');
            return $result;
        }
	}

}