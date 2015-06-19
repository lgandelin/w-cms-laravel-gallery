<?php

namespace Webaccess\CMS\Entities;

use CMS\Entities\Entity;

class Gallery extends Entity
{
    private $ID;
    private $identifier;
    private $name;
    private $mediaformatID;
    private $langID;

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMediaformatID($mediaformatID)
    {
        $this->mediaformatID = $mediaformatID;
    }

    public function getMediaformatID()
    {
        return $this->mediaformatID;
    }

    public function setLangID($langID)
    {
        $this->langID = $langID;
    }

    public function getLangID()
    {
        return $this->langID;
    }

    public function valid()
    {
        if (!$this->getIdentifier()) {
            throw new \InvalidArgumentException('You must provide an identifier for a gallery');
        }

        return true;
    }
}
