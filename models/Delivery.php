<?php

class Delivery implements Model
{

    private $id = null;

    private $deliveryMethod = null;

    private $deliveryCost = null;

    public function __construct($id = NULL, $deliveryMethod = NULL, $deliveryCost = NULL)
    {
        $this->id = $id;
        $this->deliveryMethod = $deliveryMethod;
        $this->deliveryCost = $deliveryCost;
    }

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll(): array
    {
        return DeliveryDaoImpl::readAll();
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getDeliveryByMethod($deliveryMethod) : \Delivery
    {
        return DeliveryDaoImpl::getDeliveryByMethod($deliveryMethod);
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $deliveryId
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getDeliveryMethod()
    {
        return $this->deliveryMethod;
    }

    /**
     * @param null $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    /**
     * @return null
     */
    public function getDeliveryCost()
    {
        return $this->deliveryCost;
    }

    /**
     * @param null $deliveryCost
     */
    public function setDeliveryCost($deliveryCost): void
    {
        $this->deliveryCost = $deliveryCost;
    }


}