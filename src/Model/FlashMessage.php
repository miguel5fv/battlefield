<?php

namespace Model;

/**
 * FlashMessage class keeps the app feedback after data submitted.
 *
 * @package Model
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class FlashMessage
{
    /**
     * @var string
     */
    protected $message = '';

    /**
     * Sets the message when hits.
     */
    public function notifyHit()
    {
        $this->message  = 'Hit';
    }

    /**
     * Sets the message when error.
     */
    public function notifyError()
    {
        $this->message  = 'Error';
    }

    /**
     * Sets the message when miss.
     */
    public function notifyMiss()
    {
        $this->message  = 'Miss';
    }

    /**
     * Sets the message when sunk.
     */
    public function notifySunk()
    {
        $this->message  = 'Sunk';
    }

    /**
     * Sets a customized notification.
     *
     * @param $message
     */
    public function customNotification($message)
    {
        $this->message  = $message;
    }

    /**
     * Retrieve the setted message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}