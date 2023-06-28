<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\User;
use App\Form\DiscussionType;
use App\Repository\DiscussionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/discussion')]
class DiscussionController extends AbstractController
{
    #[Route('/', name: 'discussion_index', methods: ['GET'])]
    public function index(DiscussionRepository $discussionRepository): Response
    {
        return $this->render('discussion/index.html.twig', [
            'discussions' => $discussionRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'discussion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DiscussionRepository $discussionRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $discussion = new Discussion();
        $form = $this->createForm(DiscussionType::class, $discussion);

        $form->handleRequest($request);

        $discussion->setAuthor($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussionRepository->save($discussion, true);

            return $this->redirectToRoute('discussion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discussion/new.html.twig', [
            'discussion' => $discussion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'discussion_show', methods: ['GET'])]
    public function show(Discussion $discussion): Response
    {
        return $this->render('discussion/show.html.twig', [
            'discussion' => $discussion,
        ]);
    }

    #[Route('/{id}/edit', name: 'discussion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Discussion $discussion, DiscussionRepository $discussionRepository): Response
    {
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussionRepository->save($discussion, true);

            return $this->redirectToRoute('discussion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discussion/edit.html.twig', [
            'discussion' => $discussion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'discussion_delete', methods: ['POST'])]
    public function delete(Request $request, Discussion $discussion, DiscussionRepository $discussionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $discussion->getId(), $request->request->get('_token'))) {
            $discussionRepository->remove($discussion, true);
        }

        return $this->redirectToRoute('discussion_index', [], Response::HTTP_SEE_OTHER);
    }
}
