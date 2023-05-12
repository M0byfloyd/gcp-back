<?php

namespace App\Command;

use App\Entity\Question;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:createDB')]
class CreateDBCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $questions = [
            'Vas-tu à la salle de sport 25h/24 8j/7 ?' => 10,
            'Bois-tu un litre de SP98 tous les jours ?' => 10,
            'Es-tu capable de faire 1000 pompes par secondes ?' => 10,
            'Urines-tu sur les machines à la salle pour marquer ton territoire ?' => 10,
            'Dors-tu plus de 10 secondes par nuit ?' => -10,
            'Es-tu meilleur que le petit Gregory en apnée ?' => 10,
            'As-tu l\'expertise de Xavier Dupond De Ligones en BTP ?' => 10,
            'Manges-tu des cactus ?' => 10,
            'Piques-tu les moustiques ?' => 10

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