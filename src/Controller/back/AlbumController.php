<?php

namespace App\Controller\back;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class AlbumController extends AbstractController
{


    public function __construct(
        private AlbumRepository       $albumRepository,
        private ParameterBagInterface $parameterBag,
        private ValidatorInterface    $validator
    )
    {
    }

    #[Route('/album/list', name: 'app_admin_album')]
    public function index(Request $request): Response
    {
        $albums = $this->albumRepository->findAll();

        {
            return $this->render('back/album/index.html.twig', [
                'albums' => $albums,
            ]);
        }
    }

    #[Route('/album/add
    ', name: 'app_album_new')]
    public function newArtist(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
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

                $this->addFlash('success', "L'album " . $album . " a bien été ajouté");

                return $this->redirectToRoute('app_admin_album');

            }
        }


        return $this->render('back/album/new.html.twig', ['form' => $form->createView(),]);
    }


    #[Route('/album/{id}/delete', name: 'app_album_delete')]
    public function remove(AlbumRepository $albumRepository, EntityManagerInterface $entityManager, string $id): Response
    {
        $album = $albumRepository->find($id);
        $entityManager->remove($album);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_album');
    }

    #[Route('/album/{id}/edit', name: 'app_album_edit')]
    public function edit(AlbumRepository $albumRepository, Request $request, EntityManagerInterface $entityManager, string $id): Response
    {
        $album = $albumRepository->find($id);
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "L'album" . $album->getTitle() . "a été mis à jour !");

            return $this->redirectToRoute('app_admin_album');
        }

        return $this->render('back/album/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
