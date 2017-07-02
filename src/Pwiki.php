<?php
namespace Pwiki;
class Pwiki
{
    public $config = null;

    public function __construct($params)
    {
        Config::initialize(
            function($cfg) use ($params) {
                $cfg->set($params);
            }
        );
        $this->config = Config::instance();
    }

    public function run()
    {
        $runner = new Console\Run();
        $runner->start();
    }

    /**
     * 获取分类列表
     * @return Array
     */
    public function getCategory()
    {
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->getCategory();
    }

    /**
     * 获取所有文章
     * @return Array
     */
    public function getArticles()
    {
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->getArticles();
    }

    /**
     * 根据分类获取文章列表
     * @param  String $category 分类
     * @return Array
     */
    public function getArticleByCategory($category)
    {
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->getArticleByCategory($category);
    }

    /**
     * 获取文章内容
     * @param  String $articleId 文章key
     * @return String
     */
    public function getMarkdownContentByKey($articleId)
    {
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->getMarkdownContentByKey($articleId);
    }

    /**
     * 设置Markdown内容
     * @param  String $category 分类
     * @param  String $title    标题
     * @param  String $content  内容
     * @return Array
     */
    public function newMarkdown($category, $title, $content)
	{
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->newMarkdown($category, $title, $content);
	}

    /**
     * 设置Markdown内容
     * @param  String $key 唯一标识
     * @param  String $title    标题
     * @param  String $content  内容
     * @return Array
     */
	public function putMarkdownContent($articleId, $title, $content)
	{
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->putMarkdownContent($articleId, $title, $content);
	}

    public function delete($articleId)
    {
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->delete($articleId);
    }

	public function mvMarkdownFile($oldTitle, $newTitle)
	{
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->mvMarkdownFile($oldTitle, $newTitle);
	}

	public function delHtmlFile($category, $oldTitle, $newTitle)
	{
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->delHtmlFile($category, $oldTitle, $newTitle);
	}

    private function _getDataByArticleId($articleId)
    {
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->getDataByArticleId($articleId);
    }
}
