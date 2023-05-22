<?php

class ItemSearchService {

    const API_BASE = 'https://latency-dsn.algolia.net/1/indexes/';

    private $ch;
    private $endpoint;
    private $prepared;
    private $headers;
    private $indexName;

    public function __construct($indexName = 'ikea')
    {
        $this->prepared = [];
        $this->prepared['requests'] = [];
        $this->headers = [
            'x-algolia-api-key: ' . ITEM_SEARCH_API_KEY,
            'x-algolia-application-id: ' . ITEM_SEARCH_APPLICATION_ID
        ];
        $this->endpoint = self::API_BASE;
        $this->indexName = $indexName;
    }

    public function appendSearchRequest($params) {
        array_push($this->prepared['requests'],[
            'indexName' => $this->indexName,
            'params' => http_build_query($params)
        ]) ;

        return $this;
    }

    private function setCurlHandle() {
        $this->ch = curl_init($this->endpoint);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);

        if($this->prepared['requests'])
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->prepared));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function getSearchResults() {
        $this->endpoint .= "*/queries";
        $this->setCurlHandle();

        $response = curl_exec($this->ch);
        curl_close($this->ch);
        
        return json_decode($response, true);
    }

    public function getItem($id) {
        $this->endpoint .= "$this->indexName/$id";
        $this->setCurlHandle();

        $response = curl_exec($this->ch);
        return json_decode($response, true);
    }
}