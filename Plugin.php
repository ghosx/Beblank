<?php

/**
 * typecho 博客的一款可以使超链接在新页面打开的插件
 *
 * @package Beblank
 * @author Heeeepin
 * @version 1.0.0
 * @link http://heeeepin.com
 */
class Beblank_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->footer = array('Beblank_Plugin', 'footer');
        return "插件启动成功";
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
        return "插件禁用成功";
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $config = new Typecho_Widget_Helper_Form_Element_Radio('config', array('1' => '全站所有链接', '2' => '外链链接'), '2', _t('设置'), _t('选择全站所有链接都在新页面打开或者仅外链链接在新页面打开'));
        $form->addInput($config);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public static function header()
    {
    }

    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public static function footer()
    {
        $options = Helper::options()->plugin('Beblank');
        if ($options->config == 1) {
            echo '<script type="text/javascript">window.onload=function(){var a=document.getElementById("body").getElementsByTagName("a");for(let i=0;i<a.length;i++){let url=a[i].href;if(typeof(url)!="undefined"&&url.length!=0&&a[i].getAttribute("target")!="_BLANK"){a[i].setAttribute("target","_BLANK")}}}</script>';
        } else {
            echo '<script type="text/javascript">window.onload=function(){var a=document.getElementById("body").getElementsByTagName("a");for(let i=0;i<a.length;i++){let url=a[i].href;if(typeof(url)!="undefined"&&url.length!=0&&url.match("' . $_SERVER['HTTP_HOST'] . '")==null&&a[i].getAttribute("target")!="_BLANK"){a[i].setAttribute("target","_BLANK")}}}</script>';
        }
    }
}