<?php

namespace App\Controller\back;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
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
class ArtistController extends AbstractController
{


    public function __construct(
        private ParameterBagInterface $parameterBag,
    )
    {
    }

    #[Route('/artist/list', name: 'app_artist_list')]
    public function displayAllArtists(ArtistRepository $artistRepository): Response
    {
        return $this->render('back/artist/index.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }


    #[Route('/artist/add
    ', name: 'app_artist_new')]
    public function newArtist(ArtistRepository $artistRepository, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $artistDirectoryPath = $this->parameterBag->get('artistImage_directory');
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('imageFile')->getData();
            /** @var UploadedFile $imageFile */

            if ($imageFile) {
                $originalImageFileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageFileName = $slugger->slug($originalImageFileName);
                $newImageFileName = $safeImageFileName . '-' . uniqid() . '-' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $artistDirectoryPath,
                        $newImageFileName
                    );
                    $artist->setImage($newImageFileName);

                    $entityManager->persist($artist);
                    $entityManager->flush();
                } catch (FileException $e) {

                }


                $this->addFlash('success', "Le nouvel artiste a bien été ajouté");

                return $this->redirectToRoute('app_artist');
            }
        }


        return $this->render('back/artist/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/artist/{id}
    ', name: 'app_artist_edit')]
    public function editArtist(ArtistRepository $artistRepository, Request $request, EntityManagerInterface $entityManager, string $id): Response
    {
        $artist = $artistRepository->find($id);
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
        }


        return $this->render('back/artist/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/artist/{id}
    ', name: 'app_artist_delete')]
    public function deleteArtist(ArtistRepository $artistRepository, Request $request, EntityManagerInterface $entityManager, string $id): Response
    {
        $artist = $artistRepository->find($id);
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
        }


        return $this->render('back/artist/delete.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
