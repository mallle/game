<?php

namespace App\Controller;

use App\Entity\Attitude;
use App\Form\AttitudeType;
use App\Repository\AttitudeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AttitudeController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/attitudes", name="app_attitudes_list")
     */
    function list(AttitudeRepository $attitudeRepo) {

        $attitudes = $attitudeRepo->findAll();

        return $this->render('Attitude/list.html.twig', [
            'attitudes' => $attitudes,
        ]);
    }

    /**
     * @Route("/attitudes/new", name="app_attitudes_new")
     */
    function new (Request $request) {

        $attitude = new Attitude();

        $form = $this->createForm(AttitudeType::class, $attitude);

        return $this->handleForm($attitude, $form, $request);

    }

    /**
     * @Route("/attitudes/{attitude}/edit", name="app_attitudes_edit")
     */
    public function edit(Attitude $attitude, Request $request)
    {
        $form = $this->createForm(AttitudeType::class, $attitude);

        return $this->handleForm($attitude, $form, $request);
    }

    /**
     * @Route("/attitudes/{attitude}/delete", name="app_attitudes_delete")
     */
    public function delete(Attitude $attitude, Request $request, AttitudeRepository $attitudeRepo)
    {
        $this->em->remove($attitude);
        $this->em->flush();

        $attitudes = $attitudeRepo->findAll();

        return $this->render('Attitude/list.html.twig', [
            'attitudes' => $attitudes,
        ]);
    }

    private function handleForm(Attitude $attitude, FormInterface $formInterface, Request $request)
    {
        // Handle form
        $formInterface->handleRequest($request);

        if ($formInterface->isSubmitted()) {
            if ($formInterface->isValid()) {

                $this->em->persist($attitude);
                $this->em->flush();

                return $this->redirect($this->generateUrl('app_attitudes_edit', ['attitude' => $attitude->getId()]));
            }
            //$this->addFlashMessage('error', '');
        }

        return $this->render('Attitude/edit.html.twig', [
            'form' => $formInterface->createView(),
            'attitude' => $attitude,
        ]);
    }

}
