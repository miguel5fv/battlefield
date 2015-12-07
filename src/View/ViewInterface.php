<?php
namespace View;

/**
 * Interface that represent a View object page.
 *
 * @package View
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface ViewInterface
{
    /**
     * Transform the object into a html representation.
     *
     * @return mixed
     */
    public function render();
}