<?php
namespace Console\Options;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Add extends \Console\Output
{
    public function configure()
    {
        $this->setName("new")
             ->setDescription("新建Markdown")
             ->addArgument('-t', InputArgument::REQUIRED, 'OPTION')
             ->addArgument('-c', InputArgument::OPTIONAL, '文件KEY', 'true')
             ->setHelp(
                 <<<EOT
<info>新建Markdown脚本</info>
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
