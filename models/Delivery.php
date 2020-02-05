<?php

class Delivery implements Model
{

    private $id = NULL;

    private $deliveryMethod = NULL;

    private $deliveryCost = NULL;

    public function __construct($id = NULL, $deliveryMethod = NULL, $deliveryCost = NULL)
    {
        $this->id = $id;
        $this->deliveryMethod = $deliveryMethod;
        $this->deliveryCost = $deliveryCost;
    }

    function create($delivery): int
    {
        return DeliveryDaoImpl::create($delivery);
    }

    function read($id): \Delivery
    {
        return DeliveryDaoImpl::read($id);
    }

    function readAll(): array
    {
        return DeliveryDaoImpl::readAll();
    }

    function update($delivery)
    {
        DeliveryDaoImpl::update($delivery);
    }

    function delete($id)
    {
        DeliveryDaoImpl::delete($id);
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