<?php

namespace App\Controller;

use App\Entity\Muscle;
use App\Repository\MuscleRepository;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class MuscleController extends AbstractController
{
    #[Route('/muscle', name: 'app_muscle')]
    public function index(): Response
    {
        return $this->render('muscle/index.html.twig', [
            'controller_name' => 'MuscleController',
        ]);
    }

    /**
     * Retourne la liste des muscles
     * @param MuscleRepository $repository
     * @param SerializerInterface $serializer
     * @param Request $request à besoin de paramétrer $limit et $page
     * @return JsonResponse
     */
    #[Route('/api/muscles', name: 'muscles.getAll', methods: ['GET'],)]
    #[IsGranted('ROLE_ADMIN', message: 'y faut être admin')]
    public function getAllMuscle(MuscleRepository $repository, SerializerInterface $serializer, Request $request): JsonResponse
    {
        //$muscles = $repository->findAll();
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 5);
        $limit = $limit > 20 ? 20 : $limit;
        $muscles = $repository->findWithPagination($page, $limit);
        $JsonMuscles = $serializer->serialize($muscles, 'json');
//        dd($JsonMuscles);
        return new JsonResponse($JsonMuscles, Response::HTTP_OK, [], true);
    }


    #[Route('/api/muscle/{idMuscle}', name: 'muscle.get', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN', message: 'y faut être admin')]
    #[ParamConverter("muscle", options: ["id" => "idMuscle"])]
    public function getMuscle(SerializerInterface $serializer, Muscle $muscle, TagAwareCacheInterface $cache): JsonResponse
    {
        $idCache = 'getMuscle' . $muscle->getId();
        $data = $cache->get($idCache, function (ItemInterface $item) use ($muscle, $serializer) {
            echo 'Cache saved';
            $item->tag('muscleCache');
            $context = SerializationContext::create()->setGroups(['getMuscle,getMuscleAll']);
            return $serializer->serialize($muscle, 'json', $context);
        });
//        dd($data);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


    #[Route('/api/restaurant/{idRestaurant}', name: 'restaurant.getOne', methods: ['GET'])]
    #[ParamConverter('restaurant', options: ['id' => 'idRestaurant'])]
    public function getOneRestaurant(Restaurant $restaurant, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse
    {
        $idCache = 'getOneRestaurant' . $restaurant->getId();
        $data = $cache->get($idCache, function (ItemInterface $item) use ($restaurant, $serializer) {
            echo 'Cache saved 🧙‍♂️';
            $item->tag('restaurantCache');
            $context = SerializationContext::create()->setGroups(['showRestaurant']);
            return $serializer->serialize($restaurant, 'json', $context);
        });
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


    #[Route('/api/muscle/{idMuscle}', name: 'muscle.delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN', message: 'y faut être admin')]
    #[ParamConverter("muscle", options: ["id" => "idMuscle"])]
    public function deleteMuscle(SerializerInterface $serializer, Muscle $muscle, EntityManagerInterface $entityManager, TagAwareCacheInterface $cache): JsonResponse
    {
        $muscle->setStatus("off");
        $cache->invalidateTags(["MuscleCache"]);
        $entityManager->remove($muscle);
        $entityManager->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/api/muscle', name: 'muscle.create', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'y faut être admin')]
    #[ParamConverter("muscle", options: ["id" => "idMuscle"])]
    public function createMuscle(RegionRepository $regionRepository, ValidatorInterface $validator, EntityManagerInterface $entityManager, Request $request, SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $muscle = $serializer->deserialize($request->getContent(), Muscle::class, 'json', [AbstractNormalizer::GROUPS => 'createMuscle']);
        $muscle->setStatus('on');

        $content = $request->toArray();
        $regionID = $content[".region_id"];
        $muscle->setRegionID($regionRepository->find($regionID));

        $errors = $validator->validate($muscle);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json', [AbstractNormalizer::GROUPS => 'createMuscle']), Response::HTTP_BAD_REQUEST, [], true);
        }

        $entityManager->persist($muscle);
        $entityManager->flush();
        $location = $urlGenerator->generate("muscle.get", ['idMuscle' => $muscle->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonMuscle = $serializer->serialize($muscle, "json", [AbstractNormalizer::GROUPS => 'createMuscle']);
        return new JsonResponse($jsonMuscle, Response::HTTP_CREATED, ["location" => $location], true);
    }

    #[Route('/api/leCache', name: 'muscle.cache', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN', message: 'y faut être admin')]
    public function jcp(TagAwareCacheInterface $cache, Request $request, SerializerInterface $serializer,MuscleRepository $repository): JsonResponse
    {
        $idCache = 'getAllMuscle';
        $jsonMuscles = $cache->get($idCache, function (ItemInterface $item) use($repository,$serializer){
            echo "Mise en cache";
            $item->tag("MuscleCache");
            $muscles = $repository->findAll();
            return $serializer->serialize($muscles, 'json', [AbstractNormalizer::GROUPS => 'getMuscle']);
        });
        return new JsonResponse($jsonMuscles, Response::HTTP_OK, [], true);
    }

    #[Route('/api/muscleUpdate/{idMuscle}', name: 'muscle.update', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'y faut être admin')]
    #[ParamConverter("muscle", options: ["id" => "idMuscle"])]
    public function updateMuscle(RegionRepository $regionRepository, ValidatorInterface $validator, EntityManagerInterface $entityManager, Request $request, SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator, Muscle $muscle): JsonResponse
    {
//        $muscle = $serializer->deserialize($request->getContent(), Muscle::class, 'json', [AbstractNormalizer::GROUPS => 'createMuscle']);
        $muscleUpdated = $serializer->deserialize($request->getContent(),Muscle::class,'json');
        $muscle->setMuscleName($muscleUpdated->getStudentName() ? $muscleUpdated->getMuscleName : $muscleUpdated->getName);
        $muscle->setRegionID($muscleUpdated->setRegionID() ? $muscleUpdated->setRegionID : $muscleUpdated->setRegionID);
        $muscle->setStatus('on');

        $content = $request->toArray();
        $regionID = $content[".region_id"];
        $muscle->setRegionID($regionRepository->find($regionID));

        $errors = $validator->validate($muscle);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json', [AbstractNormalizer::GROUPS => 'createMuscle']), Response::HTTP_BAD_REQUEST, [], true);
        }

        $entityManager->persist($muscle);
        $entityManager->flush();
        $location = $urlGenerator->generate("muscle.get", ['idMuscle' => $muscle->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonMuscle = $serializer->serialize($muscle, "json", [AbstractNormalizer::GROUPS => 'createMuscle']);
        return new JsonResponse($jsonMuscle, Response::HTTP_CREATED, ["location" => $location], true);
    }
}
