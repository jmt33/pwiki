<?php
namespace Pwiki\Console\Options;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pwiki\Config;

class Status extends \Pwiki\Console\AbstractOption
{
    public function configure()
    {
        $this->setName("status")
             ->setDescription("文件生成状态")
             ->setHelp(
                <<<EOT
<info>文件生成状态脚本</info>
EOT
            );
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $updater = new \Pwiki\Adapter\Updater(Config::instance());
        print_r($updater->getArticles());
    }
}
