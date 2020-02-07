<?php

class Delivery implements Model
{

    private int $id;

    private string $deliveryMethod;

    private string $deliveryCost;

    public function __construct(int $id = 0, string $deliveryMethod = '', string $deliveryCost = '')
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
        $deliveryArray =  DeliveryDaoImpl::readAll();
        $deliveryArrayOfObjects = [];

        foreach ($deliveryArray as $delivery) {
            array_unshift($deliveryArrayOfObjects, new Delivery(
                $delivery['id'],
                $delivery['deliveryMethod'],
                $delivery['deliveryCost']
            ));
        }

        return $deliveryArrayOfObjects;
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