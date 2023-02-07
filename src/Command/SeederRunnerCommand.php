<?php

namespace CFM\Command;

use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;
use Persistence\Seeder\SeederInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class SeederRunnerCommand extends Command
{

    public function __construct(private readonly EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('seeder:run')
            ->setDescription('Run database seeder to inject some data into')
            ->setDefinition([
                new InputArgument('seeder', InputArgument::REQUIRED, 'The seeder class to run')
            ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io   = new SymfonyStyle($input, $output);
        $seederClassName = $input->getArgument('seeder');

        if( '' === $seederClassName )
        {
            $io->error("Missing seeder class name option");
            return 1;
        }

        if( !class_exists($seederClassName) )
        {
            $io->error("Seeder with class name $seederClassName does not exists");
            return 1;
        }

        /** @var SeederInterface $seeder */
        $seeder = new $seederClassName($this->manager);
        $seeder->run();

        $io->success('Database successfully updated');

        return 0;
    }
}