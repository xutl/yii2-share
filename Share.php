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
    protected $shareMapping = [
        "qq" => 'QQ', // 腾讯QQ
        "qzone" => 'QQ空间', // QQ空间
        "wechat" => 'Wechat', // 微信
        "weibo" => 'Weibo', // 微博
        "renren" => 'Renren', // 人人
        "douban" => 'Douban', // 豆瓣
        "google" => 'Google', // google
        "facebook" => 'Facebook', // facebook
        "twitter" => "Twitter"//twitter
    ];

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
        echo Html::tag('ul', $this->renderWidget());
        echo Html::endTag('div');
        ShareAsset::register($this->view);
        $this->view->registerJs("jQuery('#{$this->options['id']}').share();");
    }

    public function renderWidget()
    {
        $items = [];
        foreach ($this->items as $key => $value) {
            $a = Html::a($value, 'javascript:void(0);', [
                'class' => "entypo-{$key} icon-sn-{$key} share",
                'data' => ['toggle' => 'tooltip', 'placement' => 'top', 'title' => '', 'original-title' => '分享至' . $value],
            ]);
            $items[] = Html::tag('li', $a, ['data' => ['network' => $key]]);
        }
        return implode("\n", $items);
    }
}