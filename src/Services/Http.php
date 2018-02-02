<?php

namespace TestGlobo\Services;

use SimpleXMLElement;

class Http {

    /**
     * @param $url
     *
     * @return SimpleXMLElement
     */
    public function get( $url ) : SimpleXMLElement
    {
        return $this->request($url, 'GET');
    }

    /**
     * @param        $url
     * @param string $method
     * @param array  $data
     *
     * @return SimpleXMLElement
     */
    protected function request( $url, $method='GET', $data=[] ) : SimpleXMLElement
    {
        $ch = $this->prepare($url, $method, $data);
        return simplexml_load_string(curl_exec($ch));
    }

    protected function prepare( $url, $method='GET', $data=[] )
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);

        $data = http_build_query($data);

        if ($method == 'POST' || $method == 'PUT') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt( $ch, CURLOPT_URL, $url );

        return $ch;
    }

}

