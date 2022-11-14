<?php

namespace App\Controller;
use App\Entity\Exercice;
use App\Entity\Muscle;
use App\Repository\ExerciceRepository;
use App\Repository\MuscleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    #[Route('/exercice', name: 'app_exercice')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your exercice controller!',
            'path' => 'src/Controller/ExerciceController.php',
        ]);
    }

    #[Route('/api/exercices', name: 'exercices.getAll')]
    public function getAllExercice(ExerciceRepository $repository, SerializerInterface $serializer) : JsonResponse
    {
        $exercices = $repository->findAll();
        $JsonExercices = $serializer->serialize($exercices, 'json');
        return new JsonResponse($JsonExercices, Response::HTTP_OK,[],true);
    }

    #[Route('/api/exercice/{idExercice}', name: 'exercice.get', methods: ['GET'])]
    #[ParamConverter("exercice",options: ["id" => "idExercice"])]
    public function getExercice(SerializerInterface $serializer,Exercice $exercice) : JsonResponse
    {
        $jsonExercice = $serializer->serialize($exercice, 'json',[AbstractNormalizer::GROUPS => 'getExercice']);
        return new JsonResponse($jsonExercice, Response::HTTP_OK,["accept"=>"json"],true);
    }

    #[Route('/api/exerciceByMuscle/{muscleID}', name: 'exercice.get', methods: ['GET'])]
    public function getExerciceByMuscle(SerializerInterface $serializer,int $muscleID) : JsonResponse
    {
        $BDD = new \modele();
        $exerciceMuscle = $BDD->getExerciceByMuscle($muscleID);
        $jsonExercice = $serializer->serialize($exerciceMuscle, 'json',[AbstractNormalizer::GROUPS => 'getExercice']);
        return new JsonResponse($jsonExercice, Response::HTTP_OK,["accept"=>"json"],true);
    }

}
