<?php

namespace App\Command;

use App\Entity\Question;
use App\Entity\Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:createDB')]
class CreateDBCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $questions = [
            'Vas-tu à la salle de sport 25h/24 8j/7 ?' => rand(1,10),
            'Bois-tu un litre de SP98 tous les jours ?' => rand(1,10),
            'Es-tu capable de faire 1000 pompes par secondes ?' => rand(1,10),
            'Urines-tu sur les machines à la salle pour marquer ton territoire ?' => rand(1,10),
            'Dors-tu plus de 10 secondes par nuit ?' => rand(1,10),
            'Es-tu meilleur que le petit Gregory en apnée ?' => rand(1,10),
            'As-tu l\'expertise de Xavier Dupond De Ligones en BTP ?' => rand(1,10),
            'Manges-tu des cactus ?' => rand(1,10),
            'Piques-tu les moustiques ?' => rand(1,10)
        ];

        foreach ($questions as $questionTitle => $questionPoints) {
            $this->entityManager->persist(
                (new Question())
                    ->setTitle($questionTitle)
                    ->setPoints($questionPoints)
            );
        }

        $this->entityManager->flush();

        return Command::SUCCESS;

    }
}