<?php

namespace Nz\TodoBundle\Entity;

/**
 * TodosManager
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TodoManager
{
    private $TodoRepository;

    /*
     */
    public function __construct()
    {
        d(func_get_args());
    }
}
