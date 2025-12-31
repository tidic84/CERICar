<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the TailwindCSS classes for styling
     */
    public $alertTypes = [
        'error'   => 'bg-red-100 border-red-400 text-red-700',
        'danger'  => 'bg-red-100 border-red-400 text-red-700',
        'success' => 'bg-green-100 border-green-400 text-green-700',
        'info'    => 'bg-blue-100 border-blue-400 text-blue-700',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700'
    ];

    /**
     * @var array the options for rendering the close button tag.
     */
    public $closeButton = [];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;

        foreach (array_keys($this->alertTypes) as $type) {
            $flash = $session->getFlash($type);

            foreach ((array) $flash as $i => $message) {
                echo $this->renderAlert($type, $message, $i);
            }

            $session->removeFlash($type);
        }
    }

    /**
     * Renders a single alert message
     * @param string $type the alert type
     * @param string $message the alert message
     * @param int $index the message index
     * @return string the rendered alert
     */
    protected function renderAlert($type, $message, $index)
    {
        $alertClass = $this->alertTypes[$type];
        $id = $this->getId() . '-' . $type . '-' . $index;

        return <<<HTML
        <div id="{$id}" class="border-l-4 p-4 mb-4 {$alertClass}" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="font-bold">
                        {$message}
                    </p>
                </div>
                <button type="button" class="ml-4 text-2xl leading-none hover:opacity-70" onclick="this.parentElement.parentElement.remove()">
                    &times;
                </button>
            </div>
        </div>
HTML;
    }
}
