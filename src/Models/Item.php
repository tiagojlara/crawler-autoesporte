<?php

namespace TestGlobo\Models;

class Item implements \JsonSerializable {

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var array
     */
    protected $description;

    /**
     * @param array $description
     *
     * @return Item
     */
    public function setDescription( array $description ): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $link
     *
     * @return Item
     */
    public function setLink( string $link ): Item
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @param string $title
     *
     * @return Item
     */
    public function setTitle( string $title ): Item
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->description;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}