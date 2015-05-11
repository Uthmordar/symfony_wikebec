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
class CSVCommand extends ContainerAwareCommand{
    protected function configure(){
        $this->setName("mot:parse:csv")->setDescription('Command to parse csv and populate db')
            ->addArgument(
                    'csv',
                    InputArgument::REQUIRED,
                    'csv path'
                );
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $csv = $input->getArgument('csv');     
        $container = $this->getContainer();
        
        $csvParser = $container->get('csv_parser_services');
        $motBuilder = $container->get('mot_builder');
        $definitionBuilder = $container->get('definition_builder');
        $exempleBuilder = $container->get('exemple_builder');
        
        $dataSet = $csvParser->parse($csv);
        
        foreach ($dataSet as $dataEntry) {
            try{
                $mot = $motBuilder->create($dataEntry);
            }catch (\RuntimeException $e){
                $output->writeln($e->getMessage());
            }
        }
        
        $container->get('doctrine')->getManager()->flush();
        
        $output->writeln('<info>Ok</info>');
    }
}