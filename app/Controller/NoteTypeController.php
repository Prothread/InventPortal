<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 3-4-2017
 * Time: 08:37
 */
class NoteTypeController
{
    private $model;

    public function __construct()
    {
        $this->model = new NoteType();
    }

    public function create(array $noteTypeinfo)
    {
        $this->model->setNoteTypeName($noteTypeinfo['name']);
        $result = $this->model->create();
        return $result;
    }

    public function update(array $noteTypeinfo)
    {
        $this->model->setNoteTypeId($noteTypeinfo['id']);
        $this->model->setNoteTypeName($noteTypeinfo['name']);
        $result = $this->model->update();
        return $result;
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function getNoteById($id)
    {
        return $this->model->getNoteTypeById($id);
    }

    public function getNoteTypes()
    {
        return $this->model->getNoteTypes();
    }
}