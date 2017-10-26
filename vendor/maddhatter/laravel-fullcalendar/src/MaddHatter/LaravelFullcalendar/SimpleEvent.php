<?php namespace MaddHatter\LaravelFullcalendar;

use DateTime;

/**
 * Class SimpleEvent
 *
 * Simple DTO that implements the Event interface
 *
 * @package MaddHatter\LaravelFullcalendar
 */
class SimpleEvent implements IdentifiableEvent
{

    /**
     * @var string|int|null
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var bool
     */
    public $isAllDay;

    /**
     * @var DateTime
     */
    public $start;

    /**
     * @var DateTime
     */
    public $end;

    /**
     * @var array
     */
    private $options;

    /**
     * @param string          $title
     * @param bool            $isAllDay
     * @param string|DateTime $start If string, must be valid datetime format: http://bit.ly/1z7QWbg
     * @param string|DateTime $end   If string, must be valid datetime format: http://bit.ly/1z7QWbg
     * @param int|string|null $id
     * @param array           $options
     */
    public function __construct($title, $isAllDay, $start, $end, $id = null, $options = [])
    {
        $this->title    = $title;
        
        /* De "Int" Para "Bool" (M97) */
        switch ($isAllDay) {
            case 0:
                $this->isAllDay = false;
                break;
                
            case 1:
                $this->isAllDay = true;
                break;
                
            case false:
                $this->isAllDay = false;
                 break; 
                 
            case true:
                $this->isAllDay = true;
                break;               
        }
        $this->start    = $start instanceof DateTime ? $start : new DateTime($start);
        $this->end      = $start instanceof DateTime ? $end : new DateTime($end);
        $this->id       = $id;
        $this->options  = $options;
    }

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return $this->isAllDay;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get the optional event options
     *
     * @return array
     */
    public function getEventOptions()
    {
        return $this->options;
    }
}