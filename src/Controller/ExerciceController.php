<?php

namespace App\Controller;
use App\Entity\Exercice;
use App\Repository\ExerciceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    //#[Route('/api/exercice/{idExercice}', name: 'exercice.get', methods: ['GET'])]
    //public function getExercice(ExerciceRepository $repository, SerializerInterface $serializer,int $idExercice) : JsonResponse
    //{
    //    $exercice = $repository->find($idExercice);
    //    $JsonExercice = $serializer->serialize($exercice, 'json');
    //    return $exercice ? new JsonResponse($JsonExercice, Response::HTTP_OK,[],true) :
    //        new JsonResponse(null, Response::HTTP_NOT_FOUND,[],false);
    //}

    #[Route('/api/exercice/{idExercice}', name: 'exercice.get', methods: ['GET'])]
    #[ParamConverter("exercice",options: ["id" => "idExercice"])]
    public function getExercice(SerializerInterface $serializer,Exercice $exercice) : JsonResponse
    {
        $jsonExercice = $serializer->serialize($exercice, 'json',["groups => getExercice"]);
        dd($jsonExercice);
        return new JsonResponse($jsonExercice, Response::HTTP_OK,["accept"=>"json"],true);
    }
}