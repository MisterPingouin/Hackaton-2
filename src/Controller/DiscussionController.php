<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\User;
use App\Form\DiscussionType;
use App\Repository\DiscussionRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/discussion', name: 'discussion_')]
class DiscussionController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(DiscussionRepository $discussionRepository): Response
    {
        return $this->render('discussion/index.html.twig', [
            'discussions' => $discussionRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, DiscussionRepository $discussionRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $discussion = new Discussion();
        $date = new DateTimeImmutable();
        $publicationDate = $date->setDate(intval(date('Y')), intval(date('m')), intval(date('d')));

        $form = $this->createForm(DiscussionType::class, $discussion);

        $form->handleRequest($request);

        $discussion->setAuthor($user);
        $discussion->setPublicationDate($publicationDate);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussionRepository->save($discussion, true);

            return $this->redirectToRoute('forum_index');
        }

        return $this->renderForm('discussion/new.html.twig', [
            'discussion' => $discussion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Discussion $discussion): Response
    {
        return $this->render('discussion/show.html.twig', [
            'discussion' => $discussion,
        ]);
    }


    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Discussion $discussion, DiscussionRepository $discussionRepository): Response
    {
        if ($this->getUser() !== $discussion->getAuthor()) {
            $this->addFlash('danger', 'Seul l\'auteur d\'une idée peut la modifier');
            return $this->redirectToRoute('forum_index');
        }

        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussionRepository->save($discussion, true);

            return $this->redirectToRoute('forum_index');
        }

        return $this->renderForm('discussion/edit.html.twig', [
            'discussion' => $discussion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Discussion $discussion, DiscussionRepository $discussionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $discussion->getId(), $request->request->get('_token'))) {
            $discussionRepository->remove($discussion, true);
        }

        return $this->redirectToRoute('forum_index');
    }
}
