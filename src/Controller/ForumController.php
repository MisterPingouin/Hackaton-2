<?php

namespace App\Controller;

use App\Repository\DiscussionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/forum', name: 'forum_')]
class ForumController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(DiscussionRepository $discussionRepository): Response
    {
        return $this->render('forum/index.html.twig', [
            'discussions' => $discussionRepository->findAll(),
        ]);
    }
}
