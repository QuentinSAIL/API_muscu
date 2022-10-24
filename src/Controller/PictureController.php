<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
    public function getPicture(int $idPicture, PictureRepository $pictureRepository,SerializerInterface $serializer,UrlGeneratorInterface $urlGenerator) : JsonResponse
    {

    }

    #[Route('/api/pictures', name: 'pictures.create', methods: ['POST'], )]
    public function createPicture(ValidatorInterface $validator, EntityManagerInterface $entityManager,Request $request,SerializerInterface $serializer,UrlGeneratorInterface $urlGenerator) : JsonResponse
    {
        //dd($request);
        $picture = new Picture();
        $files = $request->files->get('files');
        $picture->setFile($files);
        $picture->setMimeType($files->getClientMimeType());
        $picture->setPictureName($files->getClientOriginalName());
        $picture->setPublicPath("fefefe");
        $picture->setStatus("on");
        $entityManager->persist($picture);
        $entityManager->flush();

        $location = $urlGenerator->generate("pictures.get", ['idPicture' => $picture->getId()])
            $jsonPictures = $serializer->serialize($picture)
    }
}
