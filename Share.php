<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace xutl\share;

use Yii;
use yii\helpers\Html;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Class Share
 * @package xutl\share
 */
class Share extends Widget
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $summary;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var string
     */
    public $url;

    /**
     * @var array
     */
    public $items;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset ($this->options ['id'])) {
            $this->options ['id'] = $this->getId();
        }
    }

    public function run()
    {
        echo Html::beginTag('div',$this->options);

        echo Html::ul($this->items);

        echo Html::endTag('div');
            echo Html::activeTextArea($this->model, $this->attribute, $this->options);

        ShareAsset::register($this->view);
        $this->view->registerJs("jQuery('{$this->options['id']}').share();");
    }
}