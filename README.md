# yii2-share

社交分享

````php
<?= Share::widget([
            'message' => Html::encode($model->title),
            'url' => Url::to(['/live/stream/view', 'uuid' => $model->uuid], true),
            'summary' => $model->description,
            'picture' => Url::to($model->banner, true),
            'items' => [
                'qq', 'weibo', 'wechat', 'facebook', 'google', 'twitter'
            ]
        ]); ?>
````