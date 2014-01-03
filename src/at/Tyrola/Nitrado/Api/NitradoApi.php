<?php

namespace at\Tyrola\Nitrado\Api;

use at\Tyrola\Nitrado\Api\Exceptions\ApiException;

class NitradoApi {

    const API_URL = "https://server.nitrado.net/deu/smartphoneapi2/";
    const API_APP = "TYROLA_API";
    const API_VERSION = 2.0;

    const PASSWORD_SALT = "qwejFJiogj4890jg8JGOUIhuio4h80ghUIODHguiowdhgijudhJKG,.-,3.";
    const COOKIE_PATH = "/tmp/nitradoapi.txt";

    private $response = null;

    public function __construct($user, $password) {
        $this->doAuth($user, $password);
    }

    public function __destruct() {
        $this->executeCall("logout");
    }

    /**
     * Returns an array with all service ids
     *
     * @return array
     * @throws ApiException
     */
    public function getServiceIds() {
        if (!$this->executeCall("loadServices")) {
            throw new ApiException("Error while reading service data");
        }

        $response = $this->getResponse();

        $services = array();
        if (count($response["data"]) > 0) {
            foreach ($response["data"] as $service) {
                if (!is_int($service["id"])) {
                    continue;
                }
                $services[] = $service["id"];
            }
        }

        return $services;
    }

    /**
     * Returns a specific service object
     *
     * @param $id
     * @return Service
     * @throws ApiException
     */
    public function getService($id) {
        if (!$this->executeCall("loadServices")) {
            throw new ApiException("Error while reading service data");
        }

        $response = $this->getResponse();
        $serviceData = null;

        if (count($response["data"]) > 0) {
            foreach ($response["data"] as $service) {
                if ($service["id"] != $id) continue;
                $serviceData = $service;
            }
        }

        if ($serviceData == null) {
            throw new ApiException("Service Data for specified service not found");
        }

        return ServiceFactory::getService($this, $serviceData);
    }

    /**
     * Executes an api call
     *
     * @param $url
     * @param array $post
     * @return bool
     * @throws ApiException
     */
    public function executeCall($url, array $post = array()) {
        $ch = curl_init(self::API_URL . $url);

        curl_setopt($ch, CURLOPT_COOKIEJAR, self::COOKIE_PATH);
        curl_setopt($ch, CURLOPT_COOKIEFILE, self::COOKIE_PATH);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);

        if (count($post) > 0) {
            $post_string = "";
            foreach($post as $key=>$value) {
                $post_string .= $key.'='.$value.'&';
            }
            rtrim($post_string, '&');

            curl_setopt($ch, CURLOPT_POST, count($post));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        }

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $header_size);
        $array = json_decode($body, true);

        if (strlen($response) == 0 || json_last_error() != JSON_ERROR_NONE) {
            throw new ApiException("Invalid Response.");
        }

        curl_close($ch);

        $this->response = null;
        if (!isset($array["status"])) {
            return false;
        }

        $this->response = $array;
        if ($array["status"] != "ok") {
            return false;
        }

        return true;
    }

    /**
     * Returns the response of the last api call
     *
     * @return mixed
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Does the user login and sets the session
     *
     * @param $user
     * @param $password
     * @throws ApiException
     */
    private function doAuth($user, $password) {
        $password = sha1(self::PASSWORD_SALT.$password);

        $post = array(
            "username" => $user,
            "password" => $password,
            "version" => self::API_VERSION,
            "app" => self::API_APP
        );

        if (!$this->executeCall("login", $post)) {
            throw new ApiException("Login with user ".$user." has failed");
        }
    }
}
