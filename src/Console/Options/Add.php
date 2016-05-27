<?php
namespace Pwiki\Console\Options;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pwiki\Adapter\FileData;
use Pwiki\Adapter\Markdown;

class Add extends \Pwiki\Console\AbstractOption
{
    public function configure()
    {
        $this->setName("new")
             ->setDescription("新建Markdown文件")
             ->addArgument('title', InputArgument::REQUIRED, '文件名')
             ->addArgument('category', InputArgument::REQUIRED, '目录')
             ->setHelp(
                 <<<EOT
<info>新建Markdown脚本</info>
EOT
             );
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {

        $title = $input->getArgument('title');

        $category = $input->getArgument('category');

        $time = date("YmdHis", time());

        $data = array(
            'key' => $time,
            'title' => $title,
            'category' => $category
        );

        FileData::setData($data);
        Markdown::setFile($time."_".$title);
        $this->_w_info('新建成功！');
    }



}
