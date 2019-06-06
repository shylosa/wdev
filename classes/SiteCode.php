<?php

require_once 'phpQuery/phpQuery/phpQuery.php';

class SiteCode
{
    private $address;

    public function __construct()
    {
        $this->address = '';
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $url): void
    {
        $validator = (bool)filter_var($url, FILTER_VALIDATE_URL);
        if ($validator) {
            $this->address = $url;
        } else {
            echo "Такого сайта не существует";
            die();
        }
    }

    public function getWrappedCode(string $tag): string
    {
        $site = file_get_contents($this->address);
        $pq = phpQuery::newDocument($site);
        $pq->find($tag)->wrap("<$tag>");

        return $pq->html();
    }

}