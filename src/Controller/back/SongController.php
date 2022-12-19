<?php

namespace App\Controller\back;

use App\Entity\Song;
use App\Form\SongType;
use App\Repository\SongRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class SongController extends AbstractController
{


    public function __construct(
        private SongRepository$songRepository,
        private EntityManagerInterface $entityManager,
        private ParameterBagInterface $parameterBag
    )
    {
    }

    #[Route('/song', name: 'app_song')]
    public function index(): Response
    {
        return $this->render('back/song/index.html.twig', [
            'songs' => $this->songRepository->findAll(),
        ]);
    }

    #[Route('/song/new', name: 'app_song_new')]
    public function newSong(Request $request): Response
    {
        $song = new Song();
        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);

//        if($form->isSubmitted() && $form->isValid()){
//
//        }

        return $this->render('back/song/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
