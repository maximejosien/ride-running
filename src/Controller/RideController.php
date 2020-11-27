<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Form\RideFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RideController extends AbstractController
{
    /**
     * @Route("/rides/list", name="app_rides_list")
     *
     * @return Response
     */
    public function rides()
    {
        return $this->render('rides/list.html.twig');
    }

    /**
     * @Route("/rides/add", name="app_rides_add")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function add(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $ride = new Ride();

        $form = $this->createForm(RideFormType::class, $ride);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ride);
            $entityManager->flush();

            return $this->render('rides/list.html.twig', [
                'rideForm' => $form->createView(),
            ]);
        }

        return $this->render('rides/add.html.twig', [
            'rideForm' => $form->createView(),
        ]);
    }
}
