<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use DateTimeImmutable;
use Symfony\Bundle\SecurityBundle\Security;

#[IsGranted('ROLE_USER')]
#[Route('/phone')]
class PhoneController extends AbstractController
{
    #[Route('/search', name: 'app_phone_search', methods: ['GET'])]
    public function searchResult(PhoneRepository $phoneRepository, Request $request, Security $security): Response
    {
        //on récupère la valeur de la query
        $query = $request->query->get('query');
        if (strlen($query) < 2) {
            $this->addFlash('error', 'Tapez au moins 2 caractères pour la recherche');
            return $this->redirectToRoute('app_phone_index', [], Response::HTTP_SEE_OTHER);
        }
        // on récupère les produits qui correspondent à la recherche
        if ($security->isGranted('ROLE_ADMIN')) {
            $phones = $phoneRepository->findQueryOnAllPhones($query);
        } else {
            $phones = $phoneRepository->findQueryOnNotSoldPhones($query);
        }
        return $this->render('phone/searchresult.html.twig', [
            'query' => $query,
            'phones' => $phones,
        ]);
    }

    #[Route('/', name: 'app_phone_index', methods: ['GET'])]
    public function index(PhoneRepository $phoneRepository): Response
    {
        return $this->render('phone/index.html.twig', [
            'phones' => $phoneRepository->findAll(),
        ]);
    }

    #[Route('/sold/{id}', name: 'app_phone_sold', methods: ['GET'])]
    public function isSold(Phone $phone, PhoneRepository $phoneRepository, Request $request): Response
    {
        if ($request->get('isSold') == 'on') {
            $phone->setIsSold(true);
            $now = new DateTimeImmutable();
            $phone->setExitDate($now);
            $phoneRepository->save($phone, true);
        }
        return $this->redirectToRoute('app_phone_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_phone_show', methods: ['GET'])]
    public function show(Phone $phone, PhoneRepository $phoneRepository, Request $request): Response
    {
        $modele = $phone->getModele();
        $ficheTechnique = $modele->getFicheTechnique();

        if ($request->get('isSold')) {
            $phone->setIsSold(true);
            $phoneRepository->save($phone, true);
        }

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
}
