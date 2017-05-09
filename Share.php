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
    public $items = [];

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $ulOptions = [];

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset ($this->options ['id'])) {
            $this->options ['id'] = $this->getId();
        }
        $this->options ['data'] = [
            'message' => $this->message,
            'summary' => $this->summary,
            'picture' => $this->picture,
            'url' => $this->url,
        ];
    }

    /**
     * run
     */
    public function run()
    {
        echo Html::beginTag('div', $this->options);

        $items = '';
        foreach ($this->items as $key => $value) {
            $a = Html::a($value, 'javascript:void(0);', [
                'class' => "entypo-{$key} icon-sn-{$key} share",
                'data' => ['toggle' => 'tooltip', 'placement' => 'top', 'title' => '', 'original-title' => '分享至' . $value],
            ]);
            $items .= Html::tag('li', $a, ['data' => ['network' => $key]]);
        }
        echo Html::tag('ul',$items);
        echo Html::endTag('div');
        ShareAsset::register($this->view);
        $this->view->registerJs("jQuery('#{$this->options['id']}').share();");
    }
}