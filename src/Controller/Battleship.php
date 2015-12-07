<?php

namespace Controller;

use View;
use Model\Game;
use Model\Request;

/**
 * Main controller class which manage all the requests related with battleship game.
 *
 * @package Controller
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Battleship
{
    /**
     * @var Game
     */
    protected $game;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var View\Battleship
     */
    protected $battleshipView;

    /**
     * Main method which manage the html request.
     */
    public function runAction()
    {
        $this->initialize();

        $this->game->setDebugMode($this->request->isDebug());
        $this->game->setCoords($this->request->retrieveCoord());
        $this->game->play();
        $this->game->save();

        $this->battleshipView->render($this->game, $this->request->getForm());
    }

    /**
     * Initialize all the property controller needed.
     */
    protected function initialize()
    {
        $this->game             = new Game();
        $this->request          = new Request();
        $this->battleshipView   = new View\Battleship();

        $this->game->initialize();
        $this->request->createForm('/index.php');
    }
}