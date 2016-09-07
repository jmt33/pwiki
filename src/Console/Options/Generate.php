<?php
namespace Pwiki\Console\Options;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pwiki\Adapter\Convert;
use Pwiki\Adapter\FileData;
use Pwiki\Adapter\Helper;

class Generate extends \Pwiki\Console\AbstractOption
{
    public function configure()
    {
        $this->setName("generate")
             ->setDescription("文件生成")
             ->addArgument('type', InputArgument::REQUIRED, 'all one')
             ->addArgument('key', InputArgument::OPTIONAL, 'KEY')
             ->addArgument('ignore', InputArgument::OPTIONAL, '是否忽略已有的文件', false)
             ->setHelp(
                 <<<EOT
<info>Markdown转换脚本</info>
EOT
             );
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        $ignore = $input->getArgument('ignore');

        if ($type === 'all') {
            $keys = empty($data) ? [] : array_keys($data);
        } else {
            $key = $input->getArgument('key');
            if ($key) {
                $keys[] = $input->getArgument('key');
            } else {
                $this->_w_error('参数错误');
            }
        }

        if (!empty($keys)) {
            foreach ($keys as $key) {
                $convert = new Convert($key);
                $convert->setOverFlow($ignore);
                $convert->run();
            }
        }

        $this->_w_info('生成成功！');
    }
}
