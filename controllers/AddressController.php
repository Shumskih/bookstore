<?php
require_once ROOT . '/models/Address.php';
require_once ROOT . '/controllers/Controller.php';


class AddressController extends Controller
{
    private $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function update($address)
    {
        $this->address->update($address);
    }

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {
        // TODO: Implement readAll() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

}