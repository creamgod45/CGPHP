<?php

namespace Order;

class Seats
{
    public $seat_id;
    public $table_size;
    public $floor_number;
    public $dining_time_minutes;

    /**
     * @param $seat_id
     * @param $table_size
     * @param $floor_number
     * @param $dining_time_minutes
     */
    public function __construct($seat_id, $table_size, $floor_number, $dining_time_minutes)
    {
        $this->seat_id = $seat_id;
        $this->table_size = $table_size;
        $this->floor_number = $floor_number;
        $this->dining_time_minutes = $dining_time_minutes;
    }

}