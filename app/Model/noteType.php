<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 3-4-2017
 * Time: 08:37
 */
class NoteType
{
    private $db;

    private $noteTypeId;

    private $noteTypeName;

    /**
     * @return mixed
     */
    public function getNoteTypeId()
    {
        return $this->noteTypeId;
    }

    /**
     * @param mixed $noteTypeId
     */
    public function setNoteTypeId($noteTypeId)
    {
        $this->noteTypeId = $noteTypeId;
    }

    /**
     * @return mixed
     */
    public function getNoteTypeName()
    {
        return $this->noteTypeName;
    }

    /**
     * @param mixed $noteTypeName
     */
    public function setNoteTypeName($noteTypeName)
    {
        $this->noteTypeName = $noteTypeName;
    }

    public function __construct()
    {
        $this->db = new DbNoteType();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function update()
    {
        return $this->db->update($this);
    }

    public function delete($id)
    {
        return $this->db->delete($id);
    }

    public function getNoteTypeById($id)
    {
        return $this->db->getNoteTypeById($id);
    }

    public function getNoteTypes()
    {
        return $this->db->getNoteTypes();
    }
}