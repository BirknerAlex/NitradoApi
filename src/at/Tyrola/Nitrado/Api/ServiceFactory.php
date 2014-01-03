<?php

namespace at\Tyrola\Nitrado\Api;

use at\Tyrola\Nitrado\Api\NitradoApi;
use at\Tyrola\Nitrado\Api\Services\Service;
use at\Tyrola\Nitrado\Api\Services\GameserverService;
use at\Tyrola\Nitrado\Api\Exceptions\ApiException;

class ServiceFactory {

    /**
     * @param array $serviceData
     * @return Service
     */
    public static function getService(NitradoApi $api, array $serviceData) {

        //TODO implement other product types
        if ($serviceData["type"] != Service::SERVICE_TYPE_GAMESERVER) {
            throw new ApiException("Unsupported product type found. Exiting...");
        }

        $service = new GameserverService($api);
        $service->setId($serviceData["id"]);
        $service->setType($serviceData["type"]);
        $service->setEndDate($serviceData["end"]);
        $service->setProduct($serviceData["product"]);
        $service->setDeleteDate($serviceData["delete"]);

        switch($serviceData["type"]) {
            case Service::SERVICE_TYPE_GAMESERVER:
                $service->setIp($serviceData["ip"]);
                $service->setStatus($serviceData["status"]);
                $service->setCpuUsage($serviceData["cpu"]);
                $service->setCurrentMap($serviceData["map"]);
                $service->setCurrentPlayers($serviceData["currentplayer"]);
                $service->setMaxPlayers($serviceData["maxplayer"]);
                $service->setServerName($serviceData["servername"]);
                break;
        }

        return $service;
    }
}