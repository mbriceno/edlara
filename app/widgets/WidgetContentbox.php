<?php

use Teepluss\Theme\Theme;
use Teepluss\Theme\Widget;

class WidgetContentbox extends Widget {

    /**
     * Widget template.
     *
     * @var string
     */
    public $template = 'contentbox';

    /**
     * Watching widget tpl on everywhere.
     *
     * @var boolean
     */
    public $watch = false;

    /**
     * Arrtibutes pass from a widget.
     *
     * @var array
     */
    public $attributes = array(
        'userId' => 9999,
        'label'  => 'Generated Widget',
    );

    /**
     * Code to start this widget.
     *
     * @return void
     */
    public function init(Theme $theme)
    {
        // Initialize widget.

        //$theme->asset()->usePath()->add('widget-name', 'js/widget-execute.js', array('jquery', 'jqueryui'));
        //$this->setAttribute('user', User::find($this->getAttribute('userId')));
    }

    /**
     * Logic given to a widget and pass to widget's view.
     *
     * @return array
     */
    public function run()
    {
        $label = $this->getAttribute('label');

        //$this->setAttribute('label', 'changed');

        $attrs = $this->getAttributes();

        return $attrs;
    }

}