<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class Communication
{
    private $log;
    private $request = [];
    private $client;

    protected $url;
    protected $options = [];
    protected $logEnabled = false;
    protected $thirdPartiesId;
    protected $headers = [];
    protected $formParams = [];
    protected $queryParams = [];
    protected $body = [];
    /**
     * @param Client $client
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * 
     */
    public function get()
    {
        $this->formRequest();
        try {
            $result = $this->client->request('GET', $this->url);
            return json_decode((string) $result->getBody(), true);
        } catch (GuzzleException $e) {
            \Log::error($this->thirdPartiesId . " - " . $e->getMessage());
            return false;
        }
    }

    /**
     * 
     */
    public function post()
    {
        $this->formRequest();
        try {
            if(!empty($this->options)){
                $result = $this->client->request('POST', $this->url, $this->request);
            } else {
                $result = $this->client->request('POST', $this->url, $this->request);
            }
            return json_decode((string) $result->getBody(), true);
        } catch (GuzzleException $e) {
            \Log::error($this->thirdPartiesId . " - " . $e->getMessage());
            return false;
        }
    }

    public function put(){
        $this->formRequest();
        try {
        } catch  (GuzzleException $e) {
        }
    }
    public function reset()
    {
        $this->formParams = $this->body = $this->headers = $this->json = [];
    }

    private function formRequest()
    {
        $this->request = [];
        if(sizeof($this->headers) > 0) {
            $this->request[RequestOptions::HEADERS] = $this->headers;
        }
        if(sizeof($this->body) > 0) {
            $this->request[RequestOptions::BODY] = json_encode($this->body);
        }
        if(sizeof($this->formParams) > 0) {
            $this->request[RequestOptions::FORM_PARAMS] = $this->formParams;
        }
        if(sizeof($this->queryParams) > 0) {
            $this->request[RequestOptions::QUERY] = $this->queryParams;
        }
    }

}
