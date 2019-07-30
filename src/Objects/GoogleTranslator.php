<?php
namespace AndyMac\GoogleTranslator\Objects;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Exception;


class GoogleTranslator
{
    public $apiKey;
    public $endpoint;
    public $translateLang;

    public function __construct($key)
    {
        $this->apiKey = $key; 
        $this->endpoint = "https://translation.googleapis.com/language/translate/v2";
    }

    public function setTranslateLang($lang)
    {
      $this->translateLang = $lang;
    }

    public function detectLanguage($text)
    {
      $params = ["q" => $text];
      $url = $this->endpoint."/detect";

      $result = $this->getResponse($params,$url);

      
      $language = $result->data->detections[0][0]->language;
      return $language;
    }
    public function translate($text)
    {

      $sourceLang = $this->detectLanguage($text);

      // detected language is the same as the requested translation jsut return the text back
      if ($this->translateLang == $sourceLang) {
          return $text;
      }
      $params = ["q" => $text,
                 "target" => $this->translateLang,
                 "source" => $sourceLang];


      $result = $this->getResponse($params,$this->endpoint);

       $translation = $result->data->translations[0]->translatedText;

       return $translation;
    }

    private function getResponse($params,$url)
    {
      $baseParams = ["model" =>  "", "key" => $this->apiKey];

      $allParams = array_merge($baseParams,$params);
     
      $client = new Client();
      $args['form_params'] = $allParams;
       
      $response = $client->request("POST",$url,$args);

      $body = $response->getBody();

      $bodyContent = json_decode($body->getContents());

      return $bodyContent; 
    }
}
?>