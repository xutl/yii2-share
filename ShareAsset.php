<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace xutl\share;

use Yii;
use yii\web\AssetBundle;

/**
 * Class LayuiAsset
 * @package xutl\bootstrap\datetimepicker
 */
class LayuiAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@vendor/xutl/yii2-share-widget/assets';

    /**
     * @inherit
     */
    public $js = [
        'dist/share.js',
    ];

    /**
     * @var array 定义依赖
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}