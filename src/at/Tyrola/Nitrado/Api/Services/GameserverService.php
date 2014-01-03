<?php

namespace at\Tyrola\Nitrado\Api\Services;

class GameserverService extends Service {

    private $status;
    private $maxPlayers;
    private $currentPlayers;
    private $currentMap;
    private $serverName;
    private $ip;
    private $cpuUsage;

    /**
     * @param integer $cpuUsage
     */
    public function setCpuUsage($cpuUsage) {
        $this->cpuUsage = $cpuUsage;
    }

    /**
     * @return integer
     */
    public function getCpuUsage() {
        return $this->cpuUsage;
    }

    /**
     * @param string $currentMap
     */
    public function setCurrentMap($currentMap) {
        $this->currentMap = $currentMap;
    }

    /**
     * @return string
     */
    public function getCurrentMap() {
        return $this->currentMap;
    }

    /**
     * @param integer $currentPlayers
     */
    public function setCurrentPlayers($currentPlayers) {
        $this->currentPlayers = $currentPlayers;
    }

    /**
     * @return integer
     */
    public function getCurrentPlayers() {
        return $this->currentPlayers;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip) {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     * @param integer $maxPlayers
     */
    public function setMaxPlayers($maxPlayers) {
        $this->maxPlayers = $maxPlayers;
    }

    /**
     * @return integer
     */
    public function getMaxPlayers() {
        return $this->maxPlayers;
    }

    /**
     * @param string $serverName
     */
    public function setServerName($serverName) {
        $this->serverName = $serverName;
    }

    /**
     * @return string
     */
    public function getServerName() {
        return $this->serverName;
    }

    /**
     * @param string $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Restarts the gameserver
     *
     * @return bool
     */
    public function doRestart() {
        return $this->api->executeCall("restartService", array("serviceId" => $this->getId()));
    }

    /**
     * Stopps the gameserver
     *
     * @return bool
     */
    public function doStop() {
        return $this->api->executeCall("stopService", array("serviceId" => $this->getId()));
    }

    /**
     * Starts the gameserver
     *
     * @return bool
     */
    public function doStart() {
        return $this->doRestart();
    }

}