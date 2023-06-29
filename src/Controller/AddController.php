<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\Marque;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use App\Service\PriceManager;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class AddController extends AbstractController
{
    #[Route('/add', name: 'app_add_phone')]
    public function index(Request $request, PhoneRepository $phoneRepository, PriceManager $priceManager): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);
        $price = null;
        $modele = null;
        $marque = null;
        $ficheTechnique = null;


        if ($form->isSubmitted() && $form->isValid()) {
            $price = $priceManager->getPrice($phone);
            if ($price !== '0') {
                $phone->setPrix($price);
                $phone->setIsSold(false);
                $now = new DateTimeImmutable();
                $modele = $phone->getModele();
                $marque = $modele->getMarque();
                $ficheTechnique = $modele->getFicheTechnique();
                $phone->setEntryDate($now);
                $phoneRepository->save($phone, true);
                $this->addFlash(
                    'success',
                    'Ce téléphone a été ajouté dans la base, son prix a été estimé à ' . $price . '€'
                );
                return $this->render('add/index.html.twig', [
                    'form' => $form,
                    'price' => $price,
                    'modele' => $modele,
                    'marque' => $marque,
                    'ficheTechnique' => $ficheTechnique,
                ]);
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
