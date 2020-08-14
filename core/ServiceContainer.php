<?php


namespace Core;


class ServiceContainer
{
    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function get($id)
    {
        $services = (new \Config\Services($this))->getServices();
        if (isset($services[$id])) {
            $func = $services[$id];
            return $func();
        } else {
            throw new \Exception("Service not found!");
        }
    }

}