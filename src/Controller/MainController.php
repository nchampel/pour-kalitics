<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Dealer;
use App\Form\CarType;
use App\Repository\DealerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(DealerRepository $repo)
    {
        $dealers = $repo->findAll();
        return $this->render('main/index.html.twig', [
            'dealers' => $dealers
        ]);
    }

    /**
     * @Route("/dealer/{id}", name="show_dealer")
     */
    public function show(Dealer $dealer)
    {
        return $this->render('main/show.html.twig', [
            'dealer' => $dealer
        ]);
    }

    /**
     * @Route("/car/new/{id}", name="create_car")
     */
    public function create(Request $request, ObjectManager $manager, Dealer $dealer)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car->setDealer($dealer);
            $manager->persist($car);
            $manager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('main/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/car/edit/{id}", name="edit_car")
     */
    public function edit(Car $car, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($car);
            $manager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('main/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/car/delete/{id}", name="delete_car")
     */
    public function delete(Car $car, ObjectManager $manager)
    {
        $manager->remove($car);
        $manager->flush();
        return $this->redirectToRoute('index');
    }
}
