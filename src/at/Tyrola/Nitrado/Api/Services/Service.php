<?php

namespace at\Tyrola\Nitrado\Api\Services;

use at\Tyrola\Nitrado\Api\NitradoApi;

abstract class Service {

    const SERVICE_TYPE_GAMESERVER = "gameserver";

    protected  $api;

    protected $id;
    protected $type;
    protected $product;
    protected $endDate;
    protected $deleteDate;

    public function __construct(NitradoApi $api) {
        $this->api = $api;
    }

    /**
     * @param integer $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param integer $deleteDate
     */
    public function setDeleteDate($deleteDate) {
        $this->deleteDate = $deleteDate;
    }

    /**
     * @return integer
     */
    public function getDeleteDate() {
        return $this->deleteDate;
    }

    /**
     * @param integer $endDate
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    /**
     * @return integer
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * @param string $product
     */
    public function setProduct($product) {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }
}