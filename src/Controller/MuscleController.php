<?php

namespace App\Controller;
use App\Entity\Muscle;
use App\Repository\MuscleRepository;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContextAwareInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validation;

class MuscleController extends AbstractController
{
    #[Route('/muscle', name: 'app_muscle')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MuscleController.php',
        ]);
    }


    #[Route('/api/muscles', name: 'muscles.getAll', methods: ['GET'], )]
    public function getAllMuscle(MuscleRepository $repository,SerializerInterface $serializer, Request $request) : JsonResponse
    {
        //$muscles = $repository->findAll();
        $page = $request->get('page',1);
        $limit = $request->get('limit',5);
        $limit = $limit > 20 ? 20 : $limit;
        $muscles = $repository->findWithPagination($page, $limit);

        $JsonMuscles = $serializer->serialize($muscles, 'json', [AbstractNormalizer::GROUPS => 'getMuscleAll']);
        return new JsonResponse($JsonMuscles, Response::HTTP_OK,[],true);
    }


    #[Route('/api/muscle/{idMuscle}', name: 'muscle.get', methods: ['GET'])]
    #[ParamConverter("muscle",options: ["id" => "idMuscle"])]
    public function getMuscle(SerializerInterface $serializer,Muscle $muscle) : JsonResponse
    {
        $jsonMuscle = $serializer->serialize($muscle, 'json', [AbstractNormalizer::GROUPS => 'getMuscle']);
        return new JsonResponse($jsonMuscle, Response::HTTP_OK,["accept"=>"json"],true);
    }


    #[Route('/api/muscle/{idMuscle}', name: 'muscle.delete', methods: ['DELETE'])]
    #[ParamConverter("muscle",options: ["id" => "idMuscle"])]
    public function deleteMuscle(SerializerInterface $serializer,Muscle $muscle, EntityManagerInterface $entityManager) : JsonResponse
    {
        $entityManager->remove($muscle);
        $entityManager->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }


    #[Route('/api/muscle', name: 'muscle.create', methods: ['POST'])]
    #[ParamConverter("muscle",options: ["id" => "idMuscle"])]
    public function createMuscle(RegionRepository $regionRepository, EntityManagerInterface $entityManager,Request $request,SerializerInterface $serializer,UrlGeneratorInterface $urlGenerator) : JsonResponse
    {
        $muscle = $serializer->deserialize($request->getContent(),Muscle::class, 'json', [AbstractNormalizer::GROUPS => 'createMuscle']);
        $muscle->setStatus('on');

        $content = $request->toArray();
        $regionID = $content["region_id"];
        $muscle->setRegionID($regionRepository->find($regionID));

        $validator = Validation::createValidator();

        $errors = $validator->validate($muscle);
        if ($errors -> count() > 0){
            return new JsonResponse($serializer->serialize($errors,'json', [AbstractNormalizer::GROUPS => 'createMuscle']), Response::HTTP_BAD_REQUEST, [],true);
        }

        $entityManager->persist($muscle);
        $entityManager->flush();

        $location = $urlGenerator->generate("muscle.get",['idMuscle' => $muscle->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonMuscle = $serializer->serialize($muscle,"json", [AbstractNormalizer::GROUPS => 'createMuscle']);
        return new JsonResponse($jsonMuscle, Response::HTTP_CREATED, ["location" => $location],true);
    }
}