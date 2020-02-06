<?php

class DeliveryController extends Controller
{
    private \Delivery $delivery;

    public function __construct()
    {
        $this->delivery = new Delivery();
    }

    public function create($delivery): int
    {
        return $this->delivery->create($delivery);
    }

    public function read($id): \Delivery
    {
        return $this->delivery->read($id);
    }

    public function readAll(): array
    {
        return $this->delivery->readAll();
    }

    public function update($delivery): void
    {
        $this->delivery->update($delivery);
    }

    public function delete($id): void
    {
        $this->delivery->delete($id);
    }

    public function getDeliveryByMethod($deliveryMethod)
    {
        return $this->delivery->getDeliveryByMethod($deliveryMethod);
    }

    /**
     * @return null
     */
    public function getDeliveryMethod()
    {
        return $this->delivery->getDeliveryMethod();
    }

    /**
     * @param null $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod): void
    {
        $this->delivery->setDeliveryMethod($deliveryMethod);
    }

    /**
     * @return null
     */
    public function getDeliveryCost()
    {
        return $this->delivery->getDeliveryCost();
    }

    /**
     * @param null $deliveryCost
     */
    public function setDeliveryCost($deliveryCost): void
    {
        $this->delivery->setDeliveryCost($deliveryCost);
    }
}