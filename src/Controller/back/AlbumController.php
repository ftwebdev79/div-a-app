<?php

namespace App\Controller\back;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin')]

class AlbumController extends AbstractController
{


    public function __construct(
        private AlbumRepository $albumRepository,
        private ParameterBagInterface $parameterBag
    )
    {
    }

    #[Route('/album/list', name: 'app_admin_album')]
    public function index(): Response
    {
        return $this->render('back/album/index.html.twig', [
            'albums' => $this->albumRepository->findAll(),
        ]);
    }

    #[Route('/album/add
    ', name: 'app_album_new')]
    public function newArtist( Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $albumDirectoryPath = $this->parameterBag->get('albumCover_directory');
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('coverFile')->getData();
            /** @var UploadedFile $imageFile */

            if ($imageFile) {
                $originalImageFileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageFileName = $slugger->slug($originalImageFileName);
                $newImageFileName = $safeImageFileName . '-' . uniqid() . '-' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $albumDirectoryPath,
                        $newImageFileName
                    );
                    $album->setCover($newImageFileName);

                    $entityManager->persist($album);
                    $entityManager->flush();
                } catch (FileException $e) {

                }


                $this->addFlash('success', "Le nouvel album a bien été ajouté");

                return $this->redirectToRoute('app_admin_album');
            }
        }


        return $this->render('back/album/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
