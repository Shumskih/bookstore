<?php


class StatusController extends Controller
{
    private $status = null;

    public function __construct()
    {
        $this->status = new Status();
    }

    public function create($status)
    {
        $this->status->create($status);
    }

    public function read($id)
    {
        return $this->status->read($id);
    }

    public function readAll()
    {
        return $this->status->readAll();
    }

    public function update($status)
    {
        $this->status->update($status);
    }

    public function delete($id)
    {
        $this->status->delete($id);
    }
}