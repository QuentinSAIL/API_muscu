<?php

namespace App\Controller;

use App\Entity\Picture;
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

    #[Route('/api/pictures/{idPicture}', name: 'pictures.get', methods: ['GET'], )]
    public function getPicture(int $idPicture, Request $request, PictureRepository $pictureRepository,SerializerInterface $serializer,UrlGeneratorInterface $urlGenerator) : JsonResponse
    {
        $picture = $pictureRepository->find($idPicture);

        $relativePath = $picture->getPublicPath(). "/" . $picture->getPictureURL();
        $location = $request->getUriForPath('/');
        $location = $location . str_replace("/assets", "assets",$relativePath);
        if ($picture) {
            return new JsonResponse($serializer->serialize($picture, 'json', [AbstractNormalizer::GROUPS => 'getPicture']), JsonResponse::HTTP_OK,[],true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

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
        $picture->setPublicPath("/assets/pictures");
        $picture->setStatus("on");
        $entityManager->persist($picture);
        $entityManager->flush();

        $location = $urlGenerator->generate("pictures.get", ['idPicture' => $picture->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $jsonPictures = $serializer->serialize($picture, 'json',['groups' => 'getPicture']);
        return new JsonResponse($jsonPictures, Response::HTTP_CREATED,["$location" => $location], true);
    }
}
