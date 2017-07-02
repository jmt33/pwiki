<?php
namespace Pwiki\Console\Options;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pwiki\Config;

class Delete extends \Pwiki\Console\AbstractOption
{
    public function configure()
    {
        $this->setName("delete")
             ->setDescription("删除Markdown")
             ->addArgument('key', InputArgument::REQUIRED, '文件名')
             ->setHelp(
                 <<<EOT
<info>删除Markdown脚本</info>
EOT
             );
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getArgument('key');
        $updater = new \Pwiki\Adapter\Updater(Config::instance());
        if ($updater->delete($key)) {
            $this->_w_info('删除成功！');
        } else {
            $this->_w_info('删除失败！');
        }
    }
}
