<?php

namespace App\Controller;

use App\Repository\InputRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class FormCalculatorController extends AbstractController
{
    #[Route(path: '/api/result')]
    public function index(Request $request, InputRepository $inputRepository): JsonResponse
    {
        $DESC = [
            'paquerette' => 'Cooming soon',
            'Golem' => 'Cooming soon',
            'Simp' => 'Cooming soon',
            'Mage Noir' => 'Cooming soon',
            'Delta Male' => 'Cooming soon',
            'Beta Male' => 'Cooming soon',
            'Alpha Male' => 'Cooming soon',
            'Sigma Male' => 'Cooming soon',
            'Chad Medium' => 'Cooming soon',
            'Giga Chad' => 'Cooming soon',
            'error' => "You're an error"
        ];

        $data = json_decode($request->getContent(), true);
        $points = 0;
        $maxPoints = 0;

        foreach ($data['inputs'] as $inputData) {
            $input = $inputRepository->find($inputData['id']);
            $questionDatas = $inputData['question'];
            $maxPoints += $questionDatas['points'];

            if ($input->isValue() === $inputData['valueUser']) {
                $points += $questionDatas['points'];
            }
        }

        $percentageScore = $points / $maxPoints * 100;
        if ($percentageScore >= 0 && $percentageScore < 10) {
            $status = 'Paquerette';
        }

        if ($percentageScore >= 10 && $percentageScore < 20) {
            $status = 'Golem';
        }

        if ($percentageScore >= 20 && $percentageScore < 30) {
            $status = 'Simp';
        }

        if ($percentageScore >= 30 && $percentageScore < 40) {
            $status = 'Mage Noir';
        }

        if ($percentageScore >= 40 && $percentageScore < 50) {
            $status = 'Delta Male';
        }

        if ($percentageScore >= 50 && $percentageScore < 60) {
            $status = 'Beta Male';
        }

        if ($percentageScore >= 60 && $percentageScore < 70) {
            $status = 'Alpha Male';
        }

        if ($percentageScore >= 70 && $percentageScore < 80) {
            $status = 'Sigma Male';
        }

        if ($percentageScore >= 80 && $percentageScore < 90) {
            $status = 'Medium Chad';
        }

        if ($percentageScore >= 90 && $percentageScore <= 100) {
            $status = 'Giga Chad';
        }

        return $this->json([
            'status' => $status,
            'points' => $points,
            'desc' => $DESC[$status]
        ]);
    }

}