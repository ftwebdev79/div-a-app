<?php

namespace App\Controller\back;

use App\Entity\Song;
use App\Form\SongType;
use App\Repository\SongRepository;
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
#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class SongController extends AbstractController
{


    public function __construct(
        private SongRepository         $songRepository,
        private EntityManagerInterface $entityManager,
        private ParameterBagInterface  $parameterBag
    )
    {
    }

    #[Route('/song/list', name: 'app_song_list')]
    public function index(): Response
    {
        return $this->render('back/song/index.html.twig', [
            'songs' => $this->songRepository->findAll(),
        ]);
    }

    #[Route('/song/new', name: 'app_song_new')]
    public function newSong(Request $request, SluggerInterface $slugger): Response
    {
        $songsDirectoryPath = $this->parameterBag->get('mp3_directory');
        $song = new Song();
        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);
        dump($request->getContent());
        if ($form->isSubmitted() && $form->isValid()) {
            $audioFile = $form->get('audioFile')->getData();
            /** @var UploadedFile $audioFile */
            if ($audioFile) {

                $originalAudioFileName = pathinfo($audioFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeAudioFileName = $slugger->slug($originalAudioFileName);
                $newAudioFileName = $safeAudioFileName . '-' . uniqid() . '-' . $audioFile->guessExtension();

                try {
                    $audioFile->move(
                        $songsDirectoryPath,
                        $newAudioFileName
                    );
                    $song->setPathName($newAudioFileName);

                    $this->entityManager->persist($song);
                    $this->entityManager->flush();


                } catch (FileException $e) {
//                    $this->addFlash('uploaded', "Echec de l'upload du fichier!");
                }

                $this->addFlash('uploaded', "Le titre". $song->getTitle()." a bien été ajouté !");
            }

        }

        return $this->render('back/song/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
