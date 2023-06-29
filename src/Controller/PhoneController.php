<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/phone')]
class PhoneController extends AbstractController
{
    #[Route('/', name: 'app_phone_index', methods: ['GET'])]
    public function index(PhoneRepository $phoneRepository): Response
    {
        return $this->render('phone/index.html.twig', [
            'phones' => $phoneRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_phone_show', methods: ['GET'])]
    public function show(Phone $phone): Response
    {
        $modele = $phone->getModele();
        $ficheTechnique = $modele->getFicheTechnique();

        return $this->render('phone/show.html.twig', [
            'phone' => $phone,
            'ficheTechnique' => $ficheTechnique,
        ]);
    }

    #[Route('/{id}', name: 'app_phone_delete', methods: ['POST'])]
    public function delete(Request $request, Phone $phone, PhoneRepository $phoneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $phone->getId(), $request->request->get('_token'))) {
            $phoneRepository->remove($phone, true);
        }

        return $this->redirectToRoute('app_phone_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_phone_search', methods: ['GET'])]
    public function searchResult(PhoneRepository $phoneRepository, Request $request): Response
    {
        //on récupère la valeur de la query
        $query = $request->query->get('query');

        if (strlen($query) < 2) {
            $this->addFlash('error', 'Tapez au moins 2 caractères pour la recherche');
            return $this->redirectToRoute('app_phone_index', [], Response::HTTP_SEE_OTHER);
        }
        // on récupère les produits qui correspondent à la recherche
        $phones = $phoneRepository->findSearchQuery(
            $query
        );

        return $this->render('phone/searchresult.html.twig', [
            'phones' => $phones,
        ]);
    }
}
