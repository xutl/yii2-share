/**
* share.js - Share to social
* @version v1.0.0
* @link https://github.com/lichunqiang/share.js
* @license MIT
* @author lichunqiang
*/;(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    define([], factory);
  } else if (typeof exports === 'object') {
    module.exports = factory();
  } else {
    root.Share = factory();
  }
}(this, function() {
//build the query string
function buildUrlQuery(query) {
  var queryItems = [];
  for (var q in query) {
    queryItems.push(q + '=' + encodeURIComponent(query[q] || ''));
  }
  return queryItems.join('&');
}
//Open a new windows
function _open(url) {
  window.open(url, "_blank", "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=500");
}

function weixin($btn, params) {
  if ($('.weixin-share-modal').length === 0) {
    $('body').append(makeWeixinModal(params));
    var $modal = $('.weixin-share-modal');
    $modal.on('show.bs.modal', function() {
      $modal.find('.weixin-share-qrcode').empty();
      $modal.find('.weixin-share-loading').show();
      $modal.find('.weixin-share-qrcode').html('<img src="http://qr.liantu.com/api.php?w=250&text=' + encodeURIComponent(params.url) + '">');
      $modal.find('.weixin-share-qrcode img').load(function() {
        $modal.find('.weixin-share-loading').hide();
      });
    });
  }

  $('.weixin-share-modal').modal('show');
}

function makeWeixinModal(params) {
  var html = '';
  html += '<div class="modal fade weixin-share-modal" tabindex="-1" role="dialog" aria-hidden="true">';
  html += '  <div class="modal-dialog modal-sm">';
  html += '    <div class="modal-content">';
  html += '      <div class="modal-header">';
  html += '        <button type="button" class="close" data-dismiss="modal" aria-label="关闭"><span aria-hidden="true">×</span></button>';
  html += '        <h4 class="modal-title">分享到微信朋友圈</h4>';
  html += '      </div>';
  html += '      <div class="modal-body">';
  html += '        <p class="weixin-share-loading" style="text-align:center;">正在加载二维码...</p>';
  html += '        <p class="weixin-share-qrcode"></p>';
  html += '        <p class="text-muted"><small>打开微信，点击底部的“发现”，</small><br><small>使用 “扫一扫” 即可将网页分享到我的朋友圈。</small></p>';
  html += '      </div>';
  html += '    </div>';
  html += '  </div>';
  html += '</div>';
  return html;
}


function weibo(params) {
  var query = {};
  query.url = params.url;
  query.title = params.message;
  query.pic = params.picture;
  query.appkey = params.appkey;
  return 'http://service.weibo.com/share/share.php?' + buildUrlQuery(query);
}

function qzone(params) {
  var query = {};
  query.url = params.url;
  query.title = params.title;
  query.summary = params.summary;
  query.desc = params.message;
  query.pics = params.picture;
  query.appkey = params.appkey;
  return 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?' + buildUrlQuery(query);
}

function qq(params) {
  var query = {};

  query.url = params.url;
  query.title = params.title;
  query.summary = params.summary;
  query.desc = params.message;
  query.pics = params.picture;
  query.appkey = params.appkey;
  return 'http://connect.qq.com/widget/shareqq/index.html?' + buildUrlQuery(query);
}

function douban(params) {
  var query = {};
  query.href = params.url;
  query.name = params.message;
  query.text = params.summary;
  query.image = params.picture;
  query.appkey = params.appkey;
  return 'http://www.douban.com/share/service?' + buildUrlQuery(query);
}

function renren(params) {
  var query = {};
  query.resourceUrl = params.picture;
  query.pic = params.picture;
  query.srcUrl = params.url;
  query.title = params.title;
  query.description = params.message;
  query.comment = params.summary;
  query.appkey = params.appkey;
  return 'http://widget.renren.com/dialog/share?' + buildUrlQuery(query);
}

function Share($container) {
  $container.on('click', '[data-network]', function() {
    var $btn = $(this),
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

$.fn.share = function () {
  return this.each(function() {
    var $container = $(this),
      instance;
    //initialize the Share.js
    instance = new Share($container);
    $container.data('share.js', instance);
  });
}

return Share;
}));
