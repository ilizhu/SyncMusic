<?php
/**************************************************
 * MKOnlinePlayer v2.4
 * 后台音乐数据抓取模块
 * 编写：mengkun(https://mkblog.cn)
 * 时间：2018-3-11
 * 特别感谢 @metowolf 提供的 Meting.php
 *************************************************/

/************ ↓↓↓↓↓ 如果网易云音乐歌曲获取失效，请将你的 COOKIE 放到这儿 ↓↓↓↓↓ ***************/
/*小号*/
$netease_cookie = 'JSESSIONID-WYYY=BPaPIEwvIHuYu7WUKOagUaFD2HRigg6p%2F1GPqC9ONkhY4y2P8on%5CHerc5VQbUxnlQzfilQqwPW2NiuOhuAwswgqg1fr6ogP9XkrkVJQw2MKpiKIqZR1W%5C9PeHI8YubjJDzoFS%5ChmxQWbNhZ4yylz962spz820aWpO%2BMsU%5CEa8tr%2BhWKS%3A1575451917256; _iuqxldmzr_=32; _ntes_nnid=7c82cf75ab926652da8529ab4228cfff,1575450117463; _ntes_nuid=7c82cf75ab926652da8529ab4228cfff; WM_TID=j4Y6gPSek5xEVUVVFUM9vPJRCCJZJFat; WM_NI=SK4m%2FXl%2Bm%2BPKIOw8QdX7ZpW1kfvefKY3i32FyOGNgR9P%2BIxRi%2Beh%2FxQCSA24BW4PvJRaqgdbIOHssHjQIv5PDEXs4PWEjY5O9t0xFzTwT1w04j9VXpWFIRXj2hg8BoyFZlA%3D; WM_NIKE=9ca17ae2e6ffcda170e2e6ee83ed45fcb881bafb7ff6a88fb6c54a878a8aafbc2189968bb5c64794a79882d62af0fea7c3b92a9195fc8eae54b0f5a3ccd3418b91b9d9d4709ce99691d63ba9baba86e5419beda7d4b14ebb9189afe65afb90e5aafb5aabf5ab89ae74939d9da2b1408289fcb1f54292bfbf88e76a8b918894f244aa8f8797b85c889b9894b75c959ba6bab845fbac0099c57298a99cd2f63cf8b6f7b7db7c959a87b3db62f2b8a9d9c165bb9a968dc437e2a3; MUSIC_U=b290f4dce6ebae24e1dbdbf126a5b1b5a144571172f6725baa1cf863d3ae1ebcc53afd384b0fdaa61931457bed35c6b8a820a4821076cc1bde39c620ce8469a8; __remember_me=true; __csrf=c07418c316bae413ffbf7c2d6052adc7; ntes_kaola_ad=1';

/*大号*/
$netease_cookie = '_iuqxldmzr_=32; _ntes_nnid=e1380b1b15e08515d4052e210b652092,1575967950026; _ntes_nuid=e1380b1b15e08515d4052e210b652092; WM_TID=yXr1wexuIqFBAUEEVAM8%2BPy%2BQEjAZcej; P_INFO=tmsdy0404@126.com|1576040373|0|mail126|11&15|gud&1575975847&mail126#gud&440100#10#0#0|&0|cloudmusic&mail126|tmsdy0404@126.com; NNSSPID=6ff98fc4be6840f483a1a9846ddfa2e9; UM_distinctid=16ef9111d235bf-0dc8edf48f5247-32365f08-1fa400-16ef9111d248f0; vinfo_n_f_l_n3=7dafd7f408dbcb02.1.0.1576136677742.0.1576136690636; JSESSIONID-WYYY=Fh9g6WTI3GMbuVeHUTu6q7Xqcp9zKlzArN1puEcYwWer71JHrkNoXFwID6GjUgU72RnZ2kYQJ%5CWRMk0VoeDCc%2BYS1QMsjWFVNHv%5C%2BevbV9mOA%2BRmub0VEE8GYr%5CrA%2BpGdUzQUKqIJQgulRIoSTwA7QSKxAhRXWOVlSrVQJX3pjQeMKM%5C%3A1576231619873; WM_NI=lYk4lmH5hJ9xPJsmQpVTp7e9Lf0kvHsl2ZXg2k5RmT4Pae3N%2Btfdh2oHuBxmaTiGWqqFCdbILIQNcYKukEDfnAOO3GFeCdFGqv5BGJ%2B6i7lvpm95xih1bJLKvcEBbOLTTVk%3D; WM_NIKE=9ca17ae2e6ffcda170e2e6eed6dc80a295a3bbcc6bb7868eb6d44f878f9faabc3ea7eaa1d2f174ace7aa92d12af0fea7c3b92ab087a5d5ef678ceba8abbc749496bd8ed47c968cc0d8e83390ba008cf544b1b4febbdb6df2b5fbb3f060f890af86b246e9acaa85eb3aad98bba3fb67a38ca7a8d67bb39a8d85e14390979fafe25389aba5a6c76eae9f81b0b24d86bb8d85c54db3aafba3c642e9eaa7d8ef7eb4b3f7d6fb63acefaeabcf41b6bd8ba3e145908c9cb7ea37e2a3; MUSIC_U=b290f4dce6ebae240bc674529b09d8e8353e3700e3e80b02decdc07455496aeffbd36776ca47bf7d4daad4b234ae68461f4160a002447cc822ca0c6302c03fda; __remember_me=true; __csrf=b37c80d9678fca317f9041a7808ef395; ntes_kaola_ad=1';



/************ ↑↑↑↑↑ 如果网易云音乐歌曲获取失效，请将你的 COOKIE 放到这儿 ↑↑↑↑↑ ***************/
/**
* cookie 获取及使用方法见 
* https://github.com/mengkunsoft/MKOnlineMusicPlayer/wiki/%E7%BD%91%E6%98%93%E4%BA%91%E9%9F%B3%E4%B9%90%E9%97%AE%E9%A2%98
* 
* 更多相关问题可以查阅项目 wiki 
* https://github.com/mengkunsoft/MKOnlineMusicPlayer/wiki
* 
* 如果还有问题，可以提交 issues
* https://github.com/mengkunsoft/MKOnlineMusicPlayer/issues
**/


define('HTTPS', false);    // 如果您的网站启用了https，请将此项置为“true”，如果你的网站未启用 https，建议将此项设置为“false”
define('DEBUG', false);      // 是否开启调试模式，正常使用时请将此项置为“false”
define('CACHE_PATH', 'cache/');     // 文件缓存目录,请确保该目录存在且有读写权限。如无需缓存，可将此行注释掉

/*
 如果遇到程序不能正常运行，请开启调试模式，然后访问 http://你的网站/音乐播放器地址/api.php ，进入服务器运行环境检测。
 此外，开启调试模式后，程序将输出详细的运行错误信息，方便定位错误原因。
 
 因为调试模式下程序会输出服务器环境信息，为了您的服务器安全，正常使用时请务必关闭调试。
*/



/*****************************************************************************************************/
if(!defined('DEBUG') || DEBUG !== true) error_reporting(0); // 屏蔽服务器错误

require_once('plugns/Meting.php');

use Metowolf\Meting;

$source = getParam('source', 'migu');  // 歌曲源
$API = new Meting($source);

$API->format(true); // 启用格式化功能

if($source == 'kugou' || $source == 'baidu') {
    define('NO_HTTPS', true);        // 酷狗和百度音乐源暂不支持 https
} elseif(($source == 'migu') && $netease_cookie) {
    $API->cookie($netease_cookie);    // 解决网易云 Cookie 失效
}

// 没有缓存文件夹则创建
if(defined('CACHE_PATH') && !is_dir(CACHE_PATH)) createFolders(CACHE_PATH);

$types = getParam('types');
switch($types)   // 根据请求的 Api，执行相应操作
{
    case 'url':   // 获取歌曲链接
        $id = getParam('id');  // 歌曲ID
        
        $data = $API->url($id);
        
        echojson($data);
        break;
        
    case 'pic':   // 获取歌曲链接
        $id = getParam('id');  // 歌曲ID
        
        $data = $API->pic($id);
        
        echojson($data);
        break;

    case 'song':   // 获取歌曲链接
        $id = getParam('id');  // 歌曲ID
        
        $data = $API->song($id);
        
        echojson($data);
        break;
    
    case 'lyric':       // 获取歌词
        $id = getParam('id');  // 歌曲ID
        
        if(($source == 'netease') && defined('CACHE_PATH')) {
            $cache = CACHE_PATH.$source.'_'.$types.'_'.$id.'.json';
            
            if(file_exists($cache)) {   // 缓存存在，则读取缓存
                $data = file_get_contents($cache);
            } else {
                $data = $API->lyric($id);
                
                // 只缓存链接获取成功的歌曲
                if(json_decode($data)->lyric !== '') {
                    file_put_contents($cache, $data);
                }
            }
        } else {
            $data = $API->lyric($id);
        }
        
        echojson($data);
        break;
        
    case 'download':    // 下载歌曲(弃用)
        $fileurl = getParam('url');  // 链接
        
        header('location:$fileurl');
        exit();
        break;
    
    case 'userlist':    // 获取用户歌单列表
        $uid = getParam('uid');  // 用户ID
        
        $url= 'http://music.163.com/api/user/playlist/?offset=0&limit=1001&uid='.$uid;
        $data = file_get_contents($url);
        
        echojson($data);
        break;
        
    case 'playlist':    // 获取歌单中的歌曲
        $id = getParam('id');  // 歌单ID
        
        if(($source == 'netease') && defined('CACHE_PATH')) {
            $cache = CACHE_PATH.$source.'_'.$types.'_'.$id.'.json';
            
            if(file_exists($cache) && (date("Ymd", filemtime($cache)) == date("Ymd"))) {   // 缓存存在，则读取缓存
                $data = file_get_contents($cache);
            } else {
                $data = $API->format(false)->playlist($id);
                
                // 只缓存链接获取成功的歌曲
                if(isset(json_decode($data)->playlist->tracks)) {
                    file_put_contents($cache, $data);
                }
            }
        } else {
            $data = $API->format(false)->playlist($id);
        }
        
        echojson($data);
        break;
     
    case 'search':  // 搜索歌曲
        $s = getParam('name');  // 歌名
        $limit = getParam('count', 20);  // 每页显示数量
        $pages = getParam('pages', 1);  // 页码
        
        $data = $API->search($s, [
            'page' => $pages, 
            'limit' => $limit
        ]);
        
        echojson($data);
        break;
        
    default:
        echo '<!doctype html><html><head><meta charset="utf-8"><title>信息</title><style>* {font-family: microsoft yahei}</style></head><body> <h2>MKOnlinePlayer</h2><h3>Github: https://github.com/mengkunsoft/MKOnlineMusicPlayer</h3><br>';
        if(!defined('DEBUG') || DEBUG !== true) {   // 非调试模式
            echo '<p>Api 调试模式已关闭</p>';
        } else {
            echo '<p><font color="red">您已开启 Api 调试功能，正常使用时请在 api.php 中关闭该选项！</font></p><br>';
            
            echo '<p>PHP 版本：'.phpversion().' （本程序要求 PHP 5.4+）</p><br>';
            
            echo '<p>服务器函数检查</p>';
            echo '<p>curl_exec: '.checkfunc('curl_exec',true).' （用于获取音乐数据）</p>';
            echo '<p>file_get_contents: '.checkfunc('file_get_contents',true).' （用于获取音乐数据）</p>';
            echo '<p>json_decode: '.checkfunc('json_decode',true).' （用于后台数据格式化）</p>';
            echo '<p>hex2bin: '.checkfunc('hex2bin',true).' （用于数据解析）</p>';
            echo '<p>openssl_encrypt: '.checkfunc('openssl_encrypt',true).' （用于数据解析）</p>';
        }
        
        echo '</body></html>';
}

/**
 * 创建多层文件夹 
 * @param $dir 路径
 */
function createFolders($dir) {
    return is_dir($dir) or (createFolders(dirname($dir)) and mkdir($dir, 0755));
}

/**
 * 检测服务器函数支持情况
 * @param $f 函数名
 * @param $m 是否为必须函数
 * @return 
 */
function checkfunc($f,$m = false) {
	if (function_exists($f)) {
		return '<font color="green">可用</font>';
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}

/**
 * 获取GET或POST过来的参数
 * @param $key 键值
 * @param $default 默认值
 * @return 获取到的内容（没有则为默认值）
 */
function getParam($key, $default='')
{
    return trim($key && is_string($key) ? (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default)) : $default);
}

/**
 * 输出一个json或jsonp格式的内容
 * @param $data 数组内容
 */
function echojson($data)    //json和jsonp通用
{
    header('Content-type: application/json');
    $callback = getParam('callback');
    
    if(defined('HTTPS') && HTTPS === true && !defined('NO_HTTPS')) {    // 替换链接为 https
        $data = str_replace('http:\/\/', 'https:\/\/', $data);
        $data = str_replace('http://', 'https://', $data);
    }
    
    if($callback) //输出jsonp格式
    {
        die(htmlspecialchars($callback).'('.$data.')');
    } else {
        die($data);
    }
}