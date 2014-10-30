<?php

namespace common\helpers;

use Yii;
use common\models\Pages;
use common\models\Articles;

/**
 * Class Sitemap
 * @package common\helpers
 */
class Sitemap
{
    const HEAD = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n\t<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
    const FOOT = "\t</urlset>";
    private $items = array();

    public static function init()
    {
        $host = Yii::$app->request->hostInfo;
        // Создаём класс.
        $sitemap = new Sitemap();

        // Добавим страничку
//        $sitemap->addItem(new SitemapItem(
//            'http://rmcreative.ru/', // URL.
//            time(), // Время в формате timestamp.
//            SitemapItem::daily, //Частота обновления (константы класса SitemapItem).
//            0.7 // Приоритет страницы.
//        ));

        // Страницы сайта
        $pages = Pages::find()->where(['status_id' => Pages::STATUS_PUBLISHED])->all();

        foreach ($pages as $page) {
            $sitemap->addItem(new SitemapItem(
                $host .'/'. $page->alias,
                $page->updated_at,
                SitemapItem::monthly
            ));
        }

        // Статьи
        $articles = Articles::find()->where(['status_id' => Pages::STATUS_PUBLISHED])->all();

        foreach ($articles as $article) {
            $sitemap->addItem(new SitemapItem(
                $host .'/articles/'. $article->alias,
                $article->updated_at,
                SitemapItem::monthly
            ));
        }

        // Сгенерим sitemap в файл sitemap.xml.
        $sitemap->generate();
    }

    /**
     * Adds a new item to sitemap.
     * @param SitemapItem item $item
     * @access public
     */
    function addItem(SitemapItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * Generates sitemap.
     * @param string $fileName (optional) if file name is specified - write map to it, otherwise return it as a string.
     * @access public
     * @return [void|string]
     */
    function generate()
    {
        ob_start();
        echo self::HEAD, "\n";

        foreach ($this->items as $item) {
            echo "\t\t<url>\n\t\t\t<loc>", self::escapeEntites($item->loc), "</loc>\n";

            if (!empty($item->lastmod)) {
                echo "\t\t\t<lastmod>", $item->lastmod, "</lastmod>\n";
            }

            if (!empty($item->changefreq)) {
                echo "\t\t\t<changefreq>", $item->changefreq, "</changefreq>\n";
            }

            if (!empty($item->priority)) {
                echo "\t\t\t<priority>", $item->priority, "</priority>\n";
            }

            echo "\t\t</url>\n";
        }

        echo self::FOOT, "\n";
        $map = ob_get_clean();

        file_put_contents(Yii::getAlias('@frontend/web/sitemap.xml'), $map);
    }

    /**
     * Escapes sitemap entities according to spec.
     *
     * @param String $var
     * @return string
     * @access private
     */
    private static function escapeEntites($var)
    {
        $entities = array(
            '&' => '&amp;',
            "'" => '&apos;',
            '"' => '&quot;',
            '>' => '&gt;',
            '<' => '&lt;'
        );
        return str_replace(array_keys($entities), array_values($entities), $var);
    }
}

/**
 * A class for storing sitemap item.
 */
class SitemapItem
{
    //$changefreq constants
    const always = 'always';
    const hourly = 'hourly';
    const daily = 'daily';
    const weekly = 'weekly';
    const monthly = 'monthly';
    const yearly = 'yearly';
    const never = 'never';

    /**
     * @access public
     * @param string $loc location item URL.
     * @param int $lastmod date (optional). Last modification timestamp.
     * @param string $changefreq (optional). Use one of self:: contants here.
     * @param float $priority (optional) item's priority (0.0-1.0). Default is 0.5.
     */
    function __construct($loc, $lastmod = '', $changefreq = '', $priority = '')
    {
        $this->loc = $loc;
        if ((int)$lastmod) {
            $this->lastmod = date('c', $lastmod);
        } else {
            $this->lastmod = '';
        }
        $this->changefreq = $changefreq;
        $this->priority = $priority;
    }
}

?>
