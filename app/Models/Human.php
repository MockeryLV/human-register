<?php

class Human{

    private string $name;
    private string $surname;
    private string $id;
    private string $info;

    public function __construct(string $name, string $surname, string $id, string $info)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInfo(): string
    {
        return $this->info;
    }
}