<?php
namespace View;

use Model\FlashMessage as ModelFlashMessage;

/**
 * View FlashMessage representation object.
 *
 * @package View
 * @uthor Miguel Florido <miguel5fv@gmail.com>
 */
class FlashMessage implements ViewInterface
{
    /**
     * @var string
     */
    protected $output;

    /**
     * Prepare the flash message to be renderized.
     *
     * @param ModelFlashMessage $form
     */
    public function prepare(ModelFlashMessage $message)
    {
        $this->output   = $message->getMessage();

        if (!empty($this->output))
        {
            $this->output   = "*** {$this->output} ***";
        }
    }

    /**
     * Returns the flash message object in Html representation.
     *
     * @return string
     */
    public function render()
    {
        return $this->output;
    }
}