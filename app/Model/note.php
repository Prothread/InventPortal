<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 30-3-2017
 * Time: 14:23
 */
class Note
{
    private $noteId;

    private $linkType;

    private $linkId;

    private $noteType;

    private $eventDate;

    private $description;

    private $user;

    private $creationDate;

    /**
     * @return mixed
     */
    public function getNoteId()
    {
        return $this->noteId;
    }

    /**
     * @param mixed $noteId
     */
    public function setNoteId($noteId)
    {
        $this->noteId = $noteId;
    }

    /**
     * @return mixed
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * @param mixed $linkType
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;
    }

    /**
     * @return mixed
     */
    public function getLinkId()
    {
        return $this->linkId;
    }

    /**
     * @param mixed $linkId
     */
    public function setLinkId($linkId)
    {
        $this->linkId = $linkId;
    }

    /**
     * @return mixed
     */
    public function getNoteType()
    {
        return $this->noteType;
    }

    /**
     * @param mixed $noteType
     */
    public function setNoteType($noteType)
    {
        $this->noteType = $noteType;
    }

    /**
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param mixed $eventDate
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function __construct()
    {
        $this->db = new DbNote();
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

    public function getNoteById($id)
    {
        return $this->db->getNoteById($id);
    }

    public function getNotesByLinkId($linkType, $linkId)
    {
        return $this->db->getNotesByLinkId($linkType, $linkId);
    }

    public function deleteNotesByLinkId($typeNumb,$id){
        return $this->db->deleteNotesByLinkId($typeNumb,$id);
    }
}