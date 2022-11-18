<?php

namespace App\Controller;
use App\Entity\Exercice;
use App\Repository\ExerciceRepository;
use App\Repository\MuscleRepository;
use App\Repository\RegionRepository;
use JMS\Serializer\SerializationContext;
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
        $context = SerializationContext::create()->setGroups(['getExercice']);
        $jsonExercice = $serializer->serialize($exercice,'json', [$context]);
        return new JsonResponse($jsonExercice, Response::HTTP_OK,["accept"=>"json"],true);
    }

    #[Route('/api/exerciceByMuscle/{idMuscle}', name: 'exerciceByMuscle.get', methods: ['GET'])]
    public function getExerciceByMuscle(SerializerInterface $serializer,int $idMuscle, MuscleRepository $MuscleRepository, ExerciceRepository $ExerciceRepository) : JsonResponse
    {
        $muscle = $MuscleRepository->findOneBy(['id' => $idMuscle]);
        $BDD = new \modele();
        $exerciceMuscle[] = $BDD->getExerciceByMuscle($idMuscle);
        $programme = 'Pour travailler le '.$muscle->getMuscleName().' il faut faire : ';
        $i = 0;
        while (isset($exerciceMuscle[0][$i])) {
            $programme.= rand(2,4).' repetition de '.$exerciceMuscle[0][$i]["name"].', ';
            $i++;
        }
        $programmeJSON = $serializer->serialize($programme,'json');
        return new JsonResponse($programmeJSON, Response::HTTP_OK,["accept"=>"json"],true);
    }

    #[Route('/api/exerciceByRegion/{idRegion}', name: 'exerciceByRegion.get', methods: ['GET'])]
    public function exerciceByRegion(SerializerInterface $serializer,int $idRegion, MuscleRepository $MuscleRepository, RegionRepository $regionRepository) : JsonResponse
    {
        $region = $regionRepository->findOneBy(['id' => $idRegion]);
        $BDD = new \modele();
        $exerciceMuscle[] = $BDD->getExerciceByRegion($idRegion);
        $programme = 'Pour travailler le '.$region->getName().' il faut faire : ';
        $i = 0;
        while (isset($exerciceMuscle[0][$i])) {
            if ($i<>0) {
                $programme.= ', ';
            }
            $programme.= rand(2,4).' repetitions de '.$exerciceMuscle[0][$i]["name"];
            $i++;
        }
        $programmeJSON = $serializer->serialize($programme,'json');
        return new JsonResponse($programmeJSON, Response::HTTP_OK,["accept"=>"json"],true);
    }
}