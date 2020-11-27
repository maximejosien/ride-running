<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Form\RideFormType;
use App\Service\RideService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class RideController extends AbstractController
{
    /**
     * @Route("/rides/list", name="app_rides_list")
     *
     * @param RideService $rideService
     *
     * @return Response
     */
    public function rides(RideService $rideService): Response
    {
        return $this->render('rides/list.html.twig', [
            'rides' => $rideService->getRidesFromAPI(),
        ]);
    }

    /**
     * @Route("/rides/list/user/{userId}", name="app_rides_list_user")
     *
     * @param int $userId
     * @param RideService $rideService
     *
     * @return Response
     */
    public function ridesOfUser(
        int $userId,
        RideService $rideService
    ): Response {
        return $this->render('rides/list.html.twig', [
            'rides' => $rideService->getRidesOfUserFromAPI($userId),
        ]);
    }

    /**
     * @Route("/rides/add", name="app_rides_add")
     *
     * @param Request $request
     * @param Security $security
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function add(
        Request $request,
        Security $security,
        EntityManagerInterface $entityManager
    ): Response {
        $ride = new Ride();

        $form = $this->createForm(RideFormType::class, $ride);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ride->setAuthor($security->getUser());
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
