<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\Marque;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use App\Service\PriceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

class AddController extends AbstractController
{
    #[Route('/add', name: 'app_add_phone')]
    public function index(Request $request, PhoneRepository $phoneRepository, PriceManager $priceManager): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $price = $priceManager->getPrice($phone);
            if ($price !== '0') {
                $phone->setPrix($price);
                $phoneRepository->save($phone, true);
                $this->addFlash(
                    'success',
                    'Ce téléphone a été ajouté dans la base, son prix a été estimé à ' . $price . '€'
                );
                return $this->redirectToRoute('app_phone_index');
            }
            $this->addFlash(
                'danger',
                'Ce téléphone est déféctueux, il ne peut pas être vendu et ne sera donc pas ajouté à la base'
            );
        }

        return $this->render('add/index.html.twig', [
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
