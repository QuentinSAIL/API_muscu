<?php

namespace App\Controller;

use App\Entity\Picture;
use OpenApi\Attributes as OA;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PictureController extends AbstractController
{
    #[Route('/picture', name: 'app_picture')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PictureController.php',
        ]);
    }

    /**
     * /**Retourne la une picture en fonction de la localisation
     * @param PictureRepository $repository
     * @param SerializerInterface $serializer
     * @param UrlGeneratorInterface $urlGenerator
     * @param Request $request 
     * @return JsonResponse
     */
    #[OA\Tag(name: 'Picture')]
    #[OA\Response(response: '200', description: 'OK')]
    #[OA\Response(response: '401', description: 'Unauthorized')]
    #[Route('/api/pictures/{idPicture}', name: 'pictures.get', methods: ['GET'], )]
    public function getPicture(int $idPicture, Request $request, PictureRepository $pictureRepository,SerializerInterface $serializer,UrlGeneratorInterface $urlGenerator) : JsonResponse
    {
        $picture = $pictureRepository->find($idPicture);

        $relativePath = $picture->getPublicPath(). "/" . $picture-> getPictureURL();
        $location = $request->getUriForPath('/');
        $location = $location . str_replace("/assets", "assets",$relativePath);
        if ($picture) {
            return new JsonResponse($serializer->serialize($picture, 'json', [AbstractNormalizer::GROUPS => 'getPicture']), JsonResponse::HTTP_OK,[],true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
    /**
     * /**envoie une seul picture avec l'id passer dans l'URL
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entitymanager
     * @param SerializerInterface $serializer
     * @param Request $request 
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    #[OA\Tag(name: 'Picture')]
    #[OA\Response(response: '200', description: 'OK')]
    #[OA\Response(response: '401', description: 'Unauthorized')]
    #[Route('/api/pictures', name: 'pictures.create', methods: ['POST'], )]
    public function createPicture(ValidatorInterface $validator,
                                  EntityManagerInterface $entityManager,
                                  Request $request,SerializerInterface $serializer,
                                  UrlGeneratorInterface $urlGenerator
                                ) : JsonResponse
    {
        //dd($request);
        $picture = new Picture();
        $files = $request->files->get('file');
        $picture->setFile($files);
        $picture->setMimeType($files->getClientMimeType());
        $picture->setPictureName($files->getClientOriginalName());
        $picture->setPublicPath("/assets");
        $picture->setStatus("on");
        $entityManager->persist($picture);
        $entityManager->flush();

        $location = $urlGenerator->generate("pictures.get", ['idPicture' => $picture->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonPictures = $serializer->serialize($picture, 'json',['groups' => 'getPicture']);
        return new JsonResponse($jsonPictures, Response::HTTP_CREATED,["$location" => $location], true);
    }
}
