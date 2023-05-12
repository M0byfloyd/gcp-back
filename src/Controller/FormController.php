<?php

namespace App\Controller;

use App\Entity\Form;
use App\Entity\Input;
use App\Entity\User;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[AsController]
class FormController extends AbstractController
{
    public function __invoke(QuestionRepository $questionRepository, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $jsonParameters = json_decode($request->getContent(), true);

        if (!isset($jsonParameters['firstname']) || !isset($jsonParameters['lastname'])) {
            throw new HttpException(500, "T'as oublié un truc enculé");
        }

        $badAnswer = ['Dors-tu plus de 10 secondes par nuit ?'];

        $owner = (new User())
            ->setTitle('Aspirant')
            ->setFirstname($jsonParameters['firstname'])
            ->setLastname($jsonParameters['lastname']);

        $form = new Form();
        $form->setOwner($owner);

        $questions = $questionRepository->findAll();
        shuffle($questions);

        $questions = array_slice($questions, 0, 5);

        foreach ($questions as $question) {
            $form->addInput(
                (new Input())
                    ->setQuestion($question)
                    ->setValue(!isset($badAnswer[$question->getTitle()]))
            );
        }

        $entityManager->persist($form);
        $entityManager->flush();

        return $this->json($form);
    }
}
