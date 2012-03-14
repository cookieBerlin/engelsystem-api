<?php

namespace Engelsystem\ApiResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Engelsystem\ApiResourceBundle\Entity\Room
 */
class Room
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var text $description
     */
    private $description;

    /**
     * @var boolean $visible
     */
    private $visible;


    public function __construct() 
    {
        $this->name = '';
        $this->description = '';
        $this->visible = true;
        $this->order_modifier = 0;
    }

    /**
     * Get Room as JSON
     *
     * @return string
     */
    public function toJSON()
    {
        return sprintf( '{'.
				'"kind": "engelsystem#resource\/room", '.
				'"id": "%s", '.
				'"name": "%s", '.
				'"description": { "": "%s"}, '.
				'"visible": "%s" '.
			'}',
			$this->id,
			$this->name,
			$this->description,
			$this->visible
                        );
    }

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set visible
     *
     * @param booleam $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }
}
