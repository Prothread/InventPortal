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
     * @TODO: getting mail by Id and updating that
     *
     * @param array $mailinfo
     * @return bool
     */
    public function update(array $mailinfo)
    {
        if(isset($mailinfo['answer'])){
            $this->model->setMailId($mailinfo['id']);
            $this->model->setMailName($mailinfo['name']);
            $this->model->setAnswer($mailinfo['answer']);
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
            $this->model->setAnswer($mailinfo['answer']);
            $this->model->setDatum($mailinfo['datum']);
            $this->model->setVerified($mailinfo['verified']);
        }
        if ($result = $this->model->update()) {
            echo('Success, de mail is succesvol verstuurd.');
            return $result;
        }
        return false;
    }



}