function Share($container) {
    $container.on('click', '[data-network]', function () {
        var $btn = jQuery(this),
            type = $btn.data('network'),
            appkey = $btn.data('appkey'),
            params = $container.data();

        var url = '';
        params.appkey = appkey;
        switch (type) {
            case 'weibo':
                url = weibo(params);
                _open(url);
                break;
            case 'qzone':
                url = qzone(params);
                _open(url);
                break;
            case 'qq':
                url = qq(params);
                _open(url);
                break;
            case 'twitter':
                url = twitter(params);
                _open(url);
                break;
            case 'facebook':
                url = facebook(params);
                _open(url);
                break;
            case 'google':
                url = google(params);
                _open(url);
                break;
            case 'douban':
                _open(douban(params));
                break;
            case 'renren':
                _open(renren(params));
                break;
            case 'wechat':
                weixin($btn, params);
                break;
        }
    });
}
