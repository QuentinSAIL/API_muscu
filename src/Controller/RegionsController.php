<?php

namespace App\Controller;

use App\Entity\Region;
use App\Entity\Muscle;
use OpenApi\Attributes as OA;
use App\Repository\RegionRepository;
use App\Repository\MuscleRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContextAwareInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class RegionsController extends AbstractController
{
    
    #[Route('/regions', name: 'app_regions')]
    public function index(): JsonResponse
    {
        return $this->render('regions/index.html.twig', [
            'message' => 'Welcome to your new controller!',
            'controller_name' => 'RegionsController',
            'path' => 'src/Controller/RegionsController.php',
        ]);
    }

    /**
     * /**Retourne la liste des regions
     * @param RegionRepository $repository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[OA\Tag(name: 'Region')]
    #[OA\Response(response: '200', description: 'OK')]
    #[OA\Response(response: '401', description: 'Unauthorized')]
    #[Route('/api/regions', name: 'regions.getAll', methods: ['GET'],)]
    #[IsGranted('ROLE_ADMIN', message: 'il faut être administrateur')]
    public function getAllRegion(RegionRepository $repository,
                                 SerializerInterface $serializer,
    ): JsonResponse
    {
        $region = $repository->findAll();
        $context = SerializationContext::create()->setGroups(['getRegion']);
        $JsonRegion = $serializer->serialize($region, 'json', $context);
        return new JsonResponse($JsonRegion, Response::HTTP_OK, [], true);

    }
    /**
     * /**Retourne d'une region en foncton de l'id de la region 
     * @param RegionRepository $repository
     * @param SerializerInterface $serializer
     * @param Request $request à besoin de paramétrer $limit et $page
     * @return JsonResponse
     */
    #[OA\Tag(name: 'Region')]
    #[OA\Response(response: '200', description: 'OK')]
    #[OA\Response(response: '401', description: 'Unauthorized')]
    #[Route('/api/region/{idRegion}', name: 'region.get', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN', message: 'il faut être administrateur')]
    public function getRegion(
        SerializerInterface $serializer,
        RegionRepository $repository,
        int $idRegion
    ): JsonResponse
    {
        $region = $repository->findOneBy(['id' => $idRegion]);
        $context = SerializationContext::create()->setGroups(['getRegion']);
        $regionJSON = $serializer->serialize($region, 'json', $context);
        return new JsonResponse($regionJSON, Response::HTTP_OK, [], true);
    }
    /**
     * /**envoie une seul region avec l'id passer dans l'URL
     * @param Region $region
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $manager
     * @param SerializerInterface $serializer
     * @param Request $request à besoin de paramétrer $limit et $page
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */

    #[OA\Tag(name: 'Region')]
    #[OA\Response(response: '200', description: 'OK')]
    #[OA\Response(response: '401', description: 'Unauthorized')]
    #[Route('/api/regionUpdate/{idRegion}', name: 'region.update', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'il faut être administrateur')]
    #[ParamConverter("region", options: ["id" => "idRegion"])]
    public function updateRegion(RegionRepository $regionRepository,
                                 ValidatorInterface $validator,
                                 EntityManagerInterface $entityManager,
                                 Request $request,
                                 SerializerInterface $serializer,
                                 UrlGeneratorInterface $urlGenerator,
                                 Region $region
    ): JsonResponse
    {
//      $region = $serializer->deserialize($request->getContent(), Region::class, 'json', [AbstractNormalizer::GROUPS => 'createRegion']);
        $regionUpdated = $serializer->deserialize($request->getContent(),Region::class,'json');
        $region->setName($regionUpdated->getRegionsName() ? $regionUpdated->getMuscleName : $regionUpdated->getName);
        $region->setStatus($regionUpdated->setRegionID() ? $regionUpdated->setRegionID : $regionUpdated->setRegionID);
        $region->setStatus('on');

        $content = $request->toArray();
        $regionID = $content[".region_id"];
        $context = SerializationContext::create()->setGroups(['createRegion']);
        $errors = $validator->validate($region);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json', $context), Response::HTTP_BAD_REQUEST, [], true);
        }

        $entityManager->persist($region);
        $entityManager->flush();
        $location = $urlGenerator->generate("region.get", ['idRegion' => $region->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonRegion = $serializer->serialize($region, "json", [AbstractNormalizer::GROUPS => 'createRegion']);
        return new JsonResponse($jsonRegion, Response::HTTP_CREATED, ["location" => $location], true);
    }

}
