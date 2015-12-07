<?php

namespace View;

use View\FlashMessage as ViewFlashMessage;
use View\Form as ViewForm;
use Model\Form\Form as ModelForm;
use View\View as MainView;
use Model\Game;

/**
 * Battleship view class have the mission to manage how to render the game.
 *
 * @package Model
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Battleship
{

    /**
     * Renders a given game with it form.
     *
     * @param Game $game
     * @param ModelForm $form
     */
    public function render(Game $game, ModelForm $form)
    {
        if (false === $game->getBattlefield()->isCompleteGame()) {
            $this->renderGrid($game, $form);
        } else {
            $this->renderGameFinished($game);
        }
    }

    /**
     * Render the grid view.
     *
     * @param Game $game
     * @param ModelForm $form
     */
    protected function renderGrid(Game $game, ModelForm $form)
    {
        $viewFlashMessage   = new ViewFlashMessage();
        $viewGrid           = new Grid();
        $viewForm           = new ViewForm();
        $view               = new MainView();

        $viewGrid->prepare($game->getGrid());
        $viewForm->prepare($form);
        $viewFlashMessage->prepare($game->getFlashMessage());

        $view->addViewObject($viewFlashMessage);
        $view->addViewObject($viewGrid);
        $view->addViewObject($viewForm);

        $view->render();
    }

    /**
     * Render the output view when you finish the game
     *
     * @param Game $game
     */
    protected function renderGameFinished(Game $game)
    {
        $viewFlashMessage   = new ViewFlashMessage();
        $view               = new MainView();
        $flashMessage       = $game->getFlashMessage();

        $message = "Well done! You complete the game in {$game->getShots()} shots";

        $flashMessage->customNotification($message);
        $viewFlashMessage->prepare($flashMessage);
        $view->addViewObject($viewFlashMessage);

        $view->render();
    }
}