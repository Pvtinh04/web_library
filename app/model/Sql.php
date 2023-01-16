<?php

class Sql
{
    private static $instance = null;

    /**
     * Query
     */
    public static function query()
    {
        self::$instance = new self();

        return self::$instance;
    }

    /**
     * Get
     */
    public function get()
    {
        $array = ( array )$this;
        return implode(' ', $array);
    }

    // From
    public function from(string $options)
    {
        $query_part = 'FROM ' . $options;
        $this->from = $query_part;

        return $this;
    }

    // On
    public function on(string $options)
    {
        $query_part = 'ON ' . $options;
        $this->on = $query_part;

        return $this;
    }

    // Inner Join
    public function innerJoin(string $options)
    {
        $query_part = 'INNER JOIN ' . $options;
        $this->innerJoin = $query_part;

        return $this;
    }

    // Select
    public function select(string $options = '*')
    {
        $query_part = 'SELECT ' . $options;
        $this->select = $query_part;

        return $this;
    }

    public function insertInto(string $options)
    {
        $query_part = 'INSERT INTO ' . $options;
        $this->insertInto = $query_part;

        return $this;
    }

    // Update
    public function update(string $options)
    {
        $query_part = 'UPDATE ' . $options;
        $this->update = $query_part;

        return $this;
    }

    public function values(string $options)
    {
        $query_part = 'VALUES ' . $options;
        $this->values = $query_part;

        return $this;
    }

    // Where
    public function where(string $options)
    {
        $query_part = 'WHERE ' . $options;
        $this->where = $query_part;

        return $this;
    }

    // Delete
    public function delete()
    {
        $query_part = 'DELETE';
        $this->delete = $query_part;

        return $this;
    }
}