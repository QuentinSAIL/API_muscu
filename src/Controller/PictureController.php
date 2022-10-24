<?php

namespace App\Controller;

use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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


    #[Route('/api/pictures', name: 'pictures.create', methods: ['POST'], )]
    public function createPicture(Request $request, entityManagerInterface $entityManager) : JsonResponse
    {
        //dd($request);
        $picture = new Picture();
        $files = $request->files->get('files');
        $picture->setFile($files);
        $picture->setMimeType($files->getClientMimeType());
        $picture->setPictureName($files->getClientOriginalName());
        $entityManager->persist($picture);
        $entityManager->flush();
    }
}
