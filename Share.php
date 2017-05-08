<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace xutl\share;

use Yii;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Class Share
 * @package xutl\share
 */
class Share extends Widget
{
    public $message;
    public $summary;
    public $picture;
    public $url;

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
        ShareAsset::register($this->view);
        $this->view->registerJs("jQuery('{$this->options['id']}').share();");
    }
}