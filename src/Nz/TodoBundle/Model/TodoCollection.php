<?php

namespace Nz\TodoBundle\Model;

/**
 * Description of TodoCollection
 *
 * @author tino
 */
class TodoCollection
{
    /**
     * @var Todo[]
     */
    public $todos;

    /**
     * @var integer
     */
    public $offset;

    /**
     * @var integer
     */
    public $limit;

    /**
     * @param Todo[]  $todos
     * @param integer $offset
     * @param integer $limit
     */
    public function __construct($todos = array(), $offset = null, $limit = null)
    {
        $this->todos = $todos;
        $this->offset = $offset;
        $this->limit = $limit;
    }
}
