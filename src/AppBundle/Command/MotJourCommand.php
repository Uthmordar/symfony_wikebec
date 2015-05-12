<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Run parser torrent services => get torrent data from given sites
 * Run register from parser services => register/update torrent data 
 */
class MotJourCommand extends ContainerAwareCommand{
    protected function configure(){
        $this->setName("mot:jour:new")->setDescription('Command to parse set a new word of the day');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
           
        $container = $this->getContainer();
        
        $motJourManager = $container->get('mot_jour_manager');
        
        try{
            $result=$motJourManager->getNew();
            $result->pushWord();
        }catch(\Exception $e){
            $output->writeln($e->getMessage());
        }
        
        
        //$container->get('doctrine')->getManager()->flush();
        
        $output->writeln('<info>Ok</info>');
    }
}