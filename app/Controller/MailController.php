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
        $this->model->setClientID($mailinfo['clientid']);
        $this->model->setMailSubject($mailinfo['title']);
        $this->model->setMailSender($mailinfo['sender']);
        $this->model->setMailDescription($mailinfo['description']);
        $this->model->setMailName($mailinfo['name']);
        $this->model->setMailEmail($mailinfo['email']);
        $this->model->setToken($mailinfo['token']);
        if (isset($mailinfo['imgname'])) {
            $this->model->setFakeImage($mailinfo['imgname']);
        }
        $this->model->setImage($mailinfo['images']);
        $this->model->setDatum($mailinfo['datum']);
        $this->model->setVerified($mailinfo['verified']);

        if (isset($mailinfo['comment']) && $mailinfo['comment'] !== null) {
            $this->model->setMailComment($mailinfo['comment']);
            $this->model->setCommentGroup($mailinfo['commentgroep']);
        }

        if(isset($mailinfo['extracomment']) && $mailinfo['extracomment'] !== null){
            $this->model->setExtraComment($mailinfo['extracomment']);
        }

        if ($result = $this->model->create()) {
            return $result;
        }
        return false;
    }

    /**
     * Update mail information
     * If: Als er een antwoord is (approve.php), dan verstuur je userid, id, answer, token en verified
     * Else: Verstuur alle informatie voor het updaten van de mail
     *
     * @param array $mailinfo
     * @return bool
     */
    public function update(array $mailinfo)
    {
        if (isset($mailinfo['answer'])) {
            $this->model->setMailClientId($mailinfo['clientid']);
            $this->model->setMailId($mailinfo['id']);
            $this->model->setAnswer($mailinfo['answer']);
            $this->model->setToken($mailinfo['key']);
            $this->model->setVerified($mailinfo['verified']);
        } else {
            $this->model->setMailId($mailinfo['id']);
            $this->model->setMailSubject($mailinfo['title']);
            $this->model->setMailSender($mailinfo['sender']);
            $this->model->setMailDescription($mailinfo['description']);
            $this->model->setMailName($mailinfo['name']);
            $this->model->setMailEmail($mailinfo['email']);
            $this->model->setToken($mailinfo['token']);
            if (isset($mailinfo['imgname'])) {
                $this->model->setFakeImage($mailinfo['imgname']);
            }
            if (isset($mailinfo['images'])) {
                $this->model->setImage($mailinfo['images']);
            }
            $this->model->setDatum($mailinfo['datum']);
            $this->model->setVerified($mailinfo['verified']);

            if (isset($mailinfo['comment'])) {
                $this->model->setMailComment($mailinfo['comment']);
                $this->model->setCommentGroup($mailinfo['commentgroep']);
            }
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
     * @param $id , $status
     * @return mixed
     */
    public function CountUserMailbyIdStatus($id, $status)
    {
        return $this->model->CountUserMailbyIdStatus($id, $status);
    }

    /**
     * Haal alle mail van de gebruiker op met een id en een filter
     *
     * @return mixed
     */

    public function getUserMailByUserId($id, $date = null, $verified = null, $clientid = null)
    {
        return $this->model->getUserMailByUserId($id, $date, $verified, $clientid);
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
        return $this->model->searchTable($term, $limit, $offset, $table, $filter, $ids, $status);
    }

    /**
     * Haal usermail op met de meegestuurde mailid variabele
     *
     * @param $MailID
     * @return mixed
     */

    public function getUserMailbyMailID($MailID)
    {
        return $this->model->getUserMailbyMailID($MailID);
    }

    /**
     * Delete item met een (meegegeven) id
     *
     * @param $id
     * @return bool
     */

    public function deleteItemByID($id)
    {
        return $this->model->deleteItemByID($id);
    }

    /**
     * Delete image met een (meegegeven) id
     *
     * @param $id
     * @return bool
     */

    public function deleteItemImageByID($id)
    {
        return $this->model->deleteItemImageByID($id);
    }

    /**
     * Weiger het item (bv als de klant het heeft goedgekeuren, maar het is nog niet helemaal goed)
     *
     * @param $id
     * @return mixed
     */

    public function weigerItemByID($id)
    {
        return $this->model->weigerItemByID($id);
    }

}