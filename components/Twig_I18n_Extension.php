<?php

namespace app\components;

use Twig_Extension;
use Twig_Extensions_TokenParser_Trans;
use Twig_SimpleFilter;

/**
 * Twig extension.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class Twig_I18n_Extension extends Twig_Extension {

    /** @var string Translation message context */
    public $category = 'app';

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('trans', array($this, 'trans')),
        );
    }

    /**
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $arguments
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     * @return string
     */
    public function trans($message, $category = null, $language = null)
    {
        if (!$category) {
            $category = $this->category;
        }

        return \Yii::t($category, $message, [], $language);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'i18n';
    }
}
