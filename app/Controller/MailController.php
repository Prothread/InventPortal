<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 30-Sep-16
 * Time: 12:34
 */

class MailController
{
    private $model;

    public function __construct()
    {
        $this->model = new Mail();
    }

    /**
     * Get mail information and send it to the Mail model
     *
     * @param array $mailinfo
     * @return bool|mixed
     */
    public function create(array $mailinfo)
    {
        $this->model->setMailSubject($mailinfo['title']);
        $this->model->setMailSender($mailinfo['sender']);
        $this->model->setMailDescription($mailinfo['description']);
        $this->model->setMailName($mailinfo['name']);
        $this->model->setMailEmail($mailinfo['email']);
        $this->model->setToken($mailinfo['token']);
        $this->model->setFakeImage($mailinfo['imgname']);
        $this->model->setImage($mailinfo['images']);
        $this->model->setDatum($mailinfo['datum']);
        $this->model->setVerified($mailinfo['verified']);
        if ($result = $this->model->create()) {
            echo('Success, de mail is succesvol verzonden.');
            return $result;
        }
        return false;
    }

    /**
     * Update mail information
     * If: Als er een antwoord is (accordering.php), dan verstuur je userid, id, answer, token en verified
     * Else: Verstuur alle informatie voor het updaten van de mail
     *
     * @param array $mailinfo
     * @return bool
     */
    public function update(array $mailinfo)
    {
        if(isset($mailinfo['answer'])){
            $this->model->setMailUserId($mailinfo['userid']);
            $this->model->setMailId($mailinfo['id']);
            $this->model->setAnswer($mailinfo['answer']);
            $this->model->setToken($mailinfo['key']);
            $this->model->setVerified($mailinfo['verified']);
        }
        else {
            $this->model->setMailId($mailinfo['id']);
            $this->model->setMailSubject($mailinfo['title']);
            $this->model->setMailSender($mailinfo['sender']);
            $this->model->setMailDescription($mailinfo['description']);
            $this->model->setMailName($mailinfo['name']);
            $this->model->setMailEmail($mailinfo['email']);
            $this->model->setToken($mailinfo['token']);
            $this->model->setFakeImage($mailinfo['imgname']);
            $this->model->setImage($mailinfo['images']);
            $this->model->setDatum($mailinfo['datum']);
            $this->model->setVerified($mailinfo['verified']);
        }
        if ($result = $this->model->update()) {
            return $result;
        }
        return false;
    }

    /**
     * Haal mail op met een mail id
     *
     * @param $id
     * @return mixed
     */
    public function getMailById($id)
    {
        return $this->model->getMailById($id);
    }

    /**
     * Haal meerdere mails op met een mail id
     *
     * @param $ids
     * @return mixed
     */
    public function getMailsById($ids)
    {
        return $this->model->getMailsById($ids);
    }

    /**
     * Haal mail van gebruikers op met een mail id
     *
     * @param $status
     * @return mixed
     */
    public function getUserMailByStatus($status)
    {
        return $this->model->getUserMailByStatus($status);
    }

    /**
     * Tel het aantal mails van de gebruiker met de status en hun id
     *
     * @param $id, $status
     * @return mixed
     */
    public function CountUserMailbyIdStatus($id, $status)
    {
        return $this->model->CountUserMailbyIdStatus($id, $status);
    }

    /**
     * Haal alle mail van het meegegeven id van de gebruiker op
     *
     * @return mixed
     */

    public function getUserMailByUserId($id, $limit = null, $offset = null)
    {
        return $this->model->getUserMailByUserId($id, $limit, $offset);
    }

    /**
     * Tel het aantal mails van de user
     *
     * @return mixed
     */

    public function countUserMailByUserId($id)
    {
        return $this->model->countUserMailByUserId($id);
    }

    /**
     * Haal alle mail van de meegegeven gebruiker en de status op
     *
     * @return mixed
     */

    public function getUserMail($id, $status)
    {
        return $this->model->getUserMail($id, $status);
    }

    /**
     * Zoeken in een tabel
     *
     * @return mixed
     */

    public function searchTable($term, $limit = null, $offset = null, $table = null, $filter = null, $ids = null, $status = null)
    {
        return $this->model->searchTable($term, $limit , $offset, $table, $filter, $ids, $status);
    }

}