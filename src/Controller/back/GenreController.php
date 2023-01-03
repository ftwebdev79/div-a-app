<?php

namespace App\Controller\back;

use App\Entity\Style;
use App\Form\StyleType;
use App\Repository\StyleRepository;
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
class GenreController extends AbstractController
{


    public function __construct(
        private StyleRepository        $styleRepository,
        private EntityManagerInterface $entityManager,
        private ParameterBagInterface  $parameterBag
    )
    {
    }

    #[Route('/genre/list', name: 'app_genre')]
    public function index(): Response
    {
        return $this->render('back/genre/index.html.twig', [
            'styles' => $this->styleRepository->findAll(),
        ]);
    }

    #[Route('/genre/add
    ', name: 'app_genre_new')]
    public function newStyle(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $albumDirectoryPath = $this->parameterBag->get('styleImage_directory');
        $style = new Style();
        $form = $this->createForm(StyleType::class, $style);
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
                        $albumDirectoryPath,
                        $newImageFileName
                    );
                    $style->setImage($newImageFileName);

                    $this->entityManager->persist($style);
                      $this->entityManager->flush();
                } catch (FileException $e) {

                }


                $this->addFlash('success', "Le nouvel album a bien été ajouté");

                return $this->redirectToRoute('app_genre');
            }
        }


        return $this->render('back/genre/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
