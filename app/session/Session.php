<?php

class Session
{

    /**
     * Check of de session met de meegegeven naam bestaat
     *
     * @param $name
     * @return bool
     */

    public function exists($name)
    {
        if (isset($_SESSION[$name]) && !empty($_SESSION[$name])) {
            return true;
        }

        return false;
    }

    /**
     * DELETE Session
     *
     * Delete de sessie
     *
     */

    public function delete()
    {
        session_destroy();
        $_SESSION = null;
    }

    /**
     * Flash functie voor een bericht door te geven (bv een error)
     *
     * @param $type
     * @param $message
     */

    static function flash($type, $message)
    {
        $_SESSION['flash'][] = [
            'type' => $type,
            'message' => $message
        ];
    }

    /**
     * Checkt of het een geldige email is
     *
     * @param $address
     * @return bool
     */

    function isValidEmail($address) {
        if (filter_var($address,FILTER_VALIDATE_EMAIL)==FALSE) {
            return false;
        }
        /* explode out local and domain */
        list($local,$domain)=explode('@',$address);

        $localLength=strlen($local);
        $domainLength=strlen($domain);

        return (
            /* check for proper lengths */
            ($localLength>0 && $localLength<65) &&
            ($domainLength>3 && $domainLength<256) &&
            (
                checkdnsrr($domain,'MX') ||
                checkdnsrr($domain,'A')
            )
        );
    }

    /**
     * Haalt alle tekens eruit, behalve alle alphabet letters en cijfers van 0 tot 9
     *
     * @param $string
     * @return mixed
     */

    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    /**
     * SET MailID
     *
     * Creer een sessie voor je mail id
     *
     * @param $id
     */

    public function setMailId($id){
        $_SESSION['id'] = $id;
    }

    /**
     * GET MailID
     *
     * Haal de mail id op
     *
     * @return mixed
     */

    public function getMailId(){
        return $_SESSION['id'];
    }

    /**
     * SET UserID
     *
     * User id set voor de accordering van de klant
     *
     * @param $id
     */

    public function setUserId($id){
        $_SESSION['userid'] = $id;
    }

    /**
     * GET UserID
     *
     * Haal de userid op
     *
     * @return mixed
     */

    public function getUserId(){
        return $_SESSION['userid'];
    }

    /**
     * Geef je image een sessie en een waarde om aan te tonen of de image goedgekuerd/afgekuerd of niet beoordeeld is
     *
     * @param $imageid
     * @param $verify
     */

    public function ImageVerify($imageid, $verify){
        $img_id = 'img' . $imageid;
        $_SESSION[$img_id] = $verify;
    }

    /**
     * GET ImageVerify
     *
     * Kijk of de image goedgekeurd/afgekeurd of niet beoordeeld
     *
     * @param $imageid
     * @return mixed
     */

    public function getImageVerify($imageid){
        $img_id = 'img' . $imageid;
        return $_SESSION[$img_id];
    }

}