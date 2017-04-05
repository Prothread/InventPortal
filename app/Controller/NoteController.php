<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 30-3-2017
 * Time: 14:22
 */
class NoteController
{
    private $model;

    public function __construct()
    {
        $this->model = new Note();
    }

    public function create(array $noteinfo)
    {
        $this->model->setLinkType($noteinfo['linkType']);
        $this->model->setLinkId($noteinfo['linkId']);
        $this->model->setNoteType($noteinfo['noteType']);
        $this->model->setEventDate($noteinfo['eventDate']);
        $this->model->setDescription($noteinfo['description']);
        $this->model->setUser($noteinfo['user']);
        $this->model->setCreationDate($noteinfo['creationDate']);
        $result = $this->model->create();
        return $result;
    }

    public function update(array $noteinfo)
    {
        $this->model->setNoteId($noteinfo['id']);
        $this->model->setLinkType($noteinfo['linkType']);
        $this->model->setLinkId($noteinfo['linkId']);
        $this->model->setNoteType($noteinfo['noteType']);
        $this->model->setEventDate($noteinfo['eventDate']);
        $this->model->setDescription($noteinfo['description']);
        $this->model->setUser($noteinfo['user']);
        $this->model->setCreationDate($noteinfo['creationDate']);
        $result = $this->model->update();
        return $result;
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function getNoteById($id)
    {
        return $this->model->getNoteById($id);
    }

    public function getNotesByLinkId($linkType, $linkId)
    {
        return $this->model->getNotesByLinkId($linkType, $linkId);
    }
}