<?php

namespace srag\CustomInputGUIs\Loader;

use ILIAS\UI\Component\Component;
use ILIAS\UI\Implementation\DefaultRenderer;
use ILIAS\UI\Implementation\Render\ComponentRenderer;
use ILIAS\UI\Renderer;
use srag\CustomInputGUIs\InputGUIWrapperUIInputComponent\InputGUIWrapperUIInputComponent;
use srag\CustomInputGUIs\InputGUIWrapperUIInputComponent\Renderer as InputGUIWrapperUIInputComponentRenderer;
use srag\DIC\Loader\AbstractLoaderDetector;

/**
 * Class CustomInputGUIsLoaderDetector
 *
 * @package srag\CustomInputGUIs\Loader
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class CustomInputGUIsLoaderDetector extends AbstractLoaderDetector
{

    /**
     * @return callable
     */
    public static function exchangeUIRendererAfterInitialization() : callable
    {
        return function () : Renderer {
            return new DefaultRenderer(new self(self::dic()->rendererLoader()));
        };
    }


    /**
     * @inheritDoc
     */
    public function getRendererFor(Component $component, array $contexts) : ComponentRenderer
    {
        if ($component instanceof InputGUIWrapperUIInputComponent) {
            if (self::version()->is6()) {
                return new InputGUIWrapperUIInputComponentRenderer(self::dic()->ui()->factory(), self::dic()->templateFactory(), self::dic()->language(), self::dic()->javaScriptBinding(),
                    self::dic()->refinery());
            } else {
                return new InputGUIWrapperUIInputComponentRenderer(self::dic()->ui()->factory(), self::dic()->templateFactory(), self::dic()->language(), self::dic()->javaScriptBinding());
            }
        }

        return parent::getRendererFor($component, $contexts);
    }
}
