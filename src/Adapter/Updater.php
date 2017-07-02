<?php
namespace Pwiki\Adapter;
class Updater {

    public $config = [];

	public function __construct($config)
	{
        $this->config = $config;
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
     * 获取文章内容
     * @param  String $articleId 文章key
     * @return String
     */
    public function getMarkdownContentByKey($articleId)
    {
        $data = $this->getDataByArticleId($articleId);
        $markdownPath = $this->config->markdownPath;
        $content = file_get_contents(
            $markdownPath.$data['key'].'_'.$data['category'].'_'.$data['title'].'.md'
        );
        return $content;
        $updater = new \Pwiki\Adapter\Updater($this->config);
        return $updater->newMarkdown($articleId);
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


    /**
     * 设置Markdown内容
     * @param  String $key 唯一标识
     * @param  String $title    标题
     * @param  String $content  内容
     * @return Array
     */
	public function putMarkdownContent($articleId, $title, $content)
	{
        $data = $this->getDataByArticleId($articleId);
        $category = $data['category'];
        $title = $articleId.'_'.$category.'_'.$title;
        if ($data['title'] !== $title) {
            $oldTitle = $articleId.'_'.$category.'_'.$data['title'];
            rename(
                $this->config->markdownPath."/".$oldTitle.".md",
                $this->config->markdownPath."/".$title.".md"
            );
        }

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

    public function delete($articleId)
    {
        $data = $this->getDataByArticleId($articleId);
        $htmlTitle = $this->config->htmlPath.$data['category'].'/'.$data['key'].'_'.$data['title'].".html";
        if (file_exists($htmlTitle)) {
            unlink($htmlTitle);
            $currentDir = $this->config->htmlPath.$data['category'];
            $isEmpty = array_diff(scandir($currentDir), array('..', '.'));
            if (empty($isEmpty)) {
                rmdir($currentDir);
            }
            $convert = new Convert($articleId);
            $convert->readyIndexContent();
        }
        $markdownTitle = $this->config->markdownPath."/".$data['key'].'_'.$data['category'].'_'.$data['title'].".md";
		return file_exists($markdownTitle) ? unlink($markdownTitle) : false;
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

    public function getDataByArticleId($articleId)
    {
        return current(
            array_filter(
                $this->config->data,
                function($row) use ($articleId) {
                    return $row['key'] == $articleId;
                }
            )
        );
    }
}
?>
