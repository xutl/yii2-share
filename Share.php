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
use yii\helpers\ArrayHelper;

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
        "qzone" => 'QZone', // QQ空间
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
    public $itemOptions = [];

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'share'];

    public $icon_size = 'lg';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
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
     * 注册语言包
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['xutl/share/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@xutl/share/messages',
            'fileMap' => [
                'xutl/share/share' => 'share.php',
            ],
        ];
    }

    /**
     * 获取语言包
     * @param string $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($message, $params = [])
    {
        return Yii::t('xutl/share/share', $message, $params);
    }

    /**
     * run
     */
    public function run()
    {
        echo Html::tag('div', $this->renderWidget(), $this->options);
        ShareAsset::register($this->view);
        $this->view->registerJs("jQuery('#{$this->options['id']}').share();");
    }

    /**
     * 渲染UL
     * @return string
     */
    public function renderWidget()
    {
        $items = [];
        foreach ($this->items as $item) {
            $name = self::t(ArrayHelper::getValue($this->shareMapping, $item));
            $icon = Html::tag('i', '', ['class' => "fa fa-{$this->icon_size} fa-{$item} share-{$item}", 'aria-hidden' => 'true']);
            $link = Html::a($icon, 'javascript:void(0);', [
                'data' => ['toggle' => 'tooltip', 'placement' => 'top', 'original-title' => self::t('Share to {name}', ['name' => $name])]
            ]);
            $items[] = Html::tag('li', $link, ['data' => ['network' => $item]]);
        }
        return Html::tag('ul', implode("\n", $items), $this->itemOptions);
    }
}