<?php
namespace App\Helpers;

class Mailgun{

    private $url;
    private $key;

    public function __construct(){
      $this->url=env('MAILGUN_URL');
      $this->key=env('MAILGUN_KEY');
    }

    public function send($params=[]){

      $mailfromname =isset($params['mailfromname']) ? $params['mailfromname'] : 'ELCOLP';
      $mailfrom     =isset($params['mailfrom']) ? $params['mailfrom'] :'soporte@infoapp.site';
      $toname       =isset($params['toname']) ? $params['toname'] : '';
      $to           =isset($params['to']) ? $params['to'] : '';
      $subject      =isset($params['subject']) ? $params['subject'] : '';
      $html         =isset($params['html']) ? $params['html'] : '';
      $text         =isset($params['text']) ? $params['text'] : '';

      $array_data = array(
        'from'=> $mailfromname .'<'.$mailfrom.'>',
        'to'=>$toname.'<'.$to.'>',
        'subject'=>$subject,
        'html'=>$html,
        'text'=>$text,
        'o:tracking'=>'yes',
        'o:tracking-clicks'=>'yes',
        'o:tracking-opens'=>'yes'
      );
        $session = curl_init($this->url.'/messages');
        curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($session, CURLOPT_USERPWD, 'api:'.$this->key);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($session);
        curl_close($session);
        $results = json_decode($response, true);
        return $results;
    }
}
