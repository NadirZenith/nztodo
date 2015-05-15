<?php

namespace Nz\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Exclude;

/**
 * Todo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nz\TodoBundle\Entity\TodoRepository")
 * ExclusionPolicy("ALL")
 * 
 */
class Todo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="task", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $task;

    /**
     * @var boolean
     *
     * @ORM\Column(name="complete", type="boolean", nullable=true)
     * @Assert\Type(type="bool", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $complete;
    /**
     * var string
     *
     * ORM\Column(name="complete", type="boolean", nullable=true)
     * Assert\Type(type="bool", message="The value {{ value }} is not a valid {{ type }}.")
     * 
     * Exclude
     */
    private $thing = 'nao mostrar por json(default thing)';

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set task
     *
     * @param string $task
     * @return Todo
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return string 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set complete
     *
     * @param boolean $complete
     * @return Todo
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * Is complete
     *
     * @return boolean 
     */
    public function isComplete()
    {
        return $this->complete;
    }
    /**
     * Set thing
     *
     * @param string $thing
     * @return Todo
     */
    public function setThing($thing)
    {
        $this->thing = $thing;

        return $this;
    }

    /**
     * Is thing
     *
     * @return string 
     */
    public function getThing()
    {
        return $this->thing;
    }

    /**
     * String representation for a todo
     *
     * @return string
     */
    public function __toString()
    {
        return $this->task;
    }
}
