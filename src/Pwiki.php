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
        $category = [];
        foreach ($this->config->data as $data) {
            $category[] = $data['category'];
        };
        return array_values(array_unique($category));
    }

    /**
     * 获取所有文章
     * @return Array
     */
    public function getArticles()
    {
        $articles = [];
        foreach ($this->config->data as $data) {
            $articles[] = $data;
        };
        return $articles;
    }

    /**
     * 根据分类获取文章列表
     * @param  String $category 分类
     * @return Array
     */
    public function getArticleByCategory($category)
    {
        $articles = [];
        foreach ($this->config->data as $data) {
            if ($data['category'] === $category) {
                $articles[] = $data;
            }
        };
        return $articles;
    }

    /**
     * 新建Markdown文件
     * @param  String $category 分类
     * @param  String $title    标题
     * @return Array
     */
    public function createMarkdownFile($category, $title)
	{
        $title = $this->_buildTitle($category, $title);
		$markdownFile = $this->config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile, "w");
		fwrite($handle, "");
		fclose($handle);
        return [
            'category' => $category,
            'title' => $title
        ];
	}

    /**
     * 设置Markdown内容
     * @param  String $category 分类
     * @param  String $title    标题
     * @param  String $content  内容
     * @return Array
     */
	public function putMarkdownContent($category, $title, $content)
	{
        $title = $this->_buildTitle($category, $title);
		$markdownFile = $this->config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, $content);
		fclose($handle);
        return [
            'category' => $category,
            'title' => $title,
            'content' => $content
        ];
	}

	public function mvMarkdownFile($oldTitle, $newTitle)
	{
		$oldMarkdownFile = $this->config->markdownPath."/".$oldTitle.".md";
		$newMarkdownFile = $this->config->markdownPath."/".$newTitle.".md";
		unlink($oldMarkdownFile);
	}

	public function delHtmlFile($category, $oldTitle, $newTitle)
	{
		//$newHtmlFile = $config->htmlPath.$category."/".$newTitle.".html";
		$oldHtmlFile = $this->config->htmlPath.$category."/".$oldTitle.".html";
		//unlink($newHtmlFile);
		unlink($oldHtmlFile);
	}

    private function _buildTitle($category, $title)
    {
        return date("YmdHis", time()).'_'.$category.'_'.$title;
    }
}
