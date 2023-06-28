<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\Marque;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PhoneRepository $phoneRepository): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phoneRepository->save($phone, true);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/ajax/modele/{id}', name: 'ajax_modele')]
    public function getModelesByMarqueId(EntityManagerInterface $entityManager, int $id): Response
    {
        $marque = $entityManager->getRepository(Marque::class)->find($id);

        if (!$marque) {
            throw $this->createNotFoundException('Marque not found');
        }

        $modeles = $marque->getModeles();

        $responseArray = [];
        foreach ($modeles as $modele) {
            $responseArray[] = [
                'id' => $modele->getId(),
                'name' => $modele->getName()
            ];
        }

        return new JsonResponse($responseArray);
    }
}
