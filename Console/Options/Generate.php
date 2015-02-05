<?php
namespace Console\Options;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Generate extends \Console\Output
{
    public function configure()
    {
        $this->setName("generate")
             ->setDescription("文件生成")
             ->addArgument('-r', InputArgument::REQUIRED, 'OPTION')
             ->addArgument('[key]', InputArgument::OPTIONAL, '文件KEY', 'true')
             ->setHelp(
                 <<<EOT
<info>Markdown转换脚本</info>
EOT
             );
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {

        // $ent = $input->getArgument('ent');

        // if ($input->getArgument('deluser') == 'true') {
        //     \Services('ent')->del($ent, true);
        // } else {
        //     \Services('ent')->del($ent, false);
        // }

        // $this->_w_info('ent:del Success!');
    }



}
