<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace xutl\layui;

use yii\helpers\Json;

trait LayuiWidgetTrait
{

    /**
     * @var array the options for the underlying Layui JS plugin.
     * Please refer to the corresponding Layui plugin Web page for possible options.
     * For example, [this page](http://www.layui.com/doc/modules/layer.html) shows
     * how to use the "layer" plugin and the supported options .
     */
    public $clientOptions = [];

    /**
     * Initializes the widget.
     * This method will register the layui asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Registers a specific Layui plugin and the related events
     * @param string $name the name of the Bootstrap plugin
     */
    protected function registerPlugin($name)
    {
        /** @var \yii\web\View $view */
        $view = $this->getView();

        LayuiAsset::register($view);
        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "layui.($options);";
            $view->registerJs($js);
        }
    }
}