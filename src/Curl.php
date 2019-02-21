<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/2/21
 * Time: 14:21
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

namespace pf\curl;

use pf\curl\build\Base;

class Curl
{
    protected $link;
    //获取实例
    protected function driver() {
        $this->link = new Base();
        return $this;
    }
    public function __call( $method, $params ) {
        if ( ! $this->link ) {
            $this->driver();
        }
        return call_user_func_array( [ $this->link, $method ], $params );
    }
    public static function single() {
        static $link = null;
        if ( is_null( $link ) ) {
            $link = new static();
        }
        return $link;
    }
    public static function __callStatic( $name, $arguments ) {
        return call_user_func_array( [ static::single(), $name ], $arguments );
    }
}