<?php

namespace App\Controller;

use App\Entity\Eqp;
use App\Form\EqpType;
use App\Repository\EqpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eqp')]
class EqpController extends AbstractController
{
    #[Route('/', name: 'app_eqp_index', methods: ['GET'])]
    public function index(EqpRepository $eqpRepository): Response
    {
        return $this->render('eqp/index.html.twig', [
            'eqps' => $eqpRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eqp_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EqpRepository $eqpRepository): Response
    {
        $eqp = new Eqp();
        $form = $this->createForm(EqpType::class, $eqp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpRepository->save($eqp, true);

            return $this->redirectToRoute('app_eqp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eqp/new.html.twig', [
            'eqp' => $eqp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eqp_show', methods: ['GET'])]
    public function show(Eqp $eqp): Response
    {
        return $this->render('eqp/show.html.twig', [
            'eqp' => $eqp,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eqp_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eqp $eqp, EqpRepository $eqpRepository): Response
    {
        $form = $this->createForm(EqpType::class, $eqp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpRepository->save($eqp, true);

            return $this->redirectToRoute('app_eqp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eqp/edit.html.twig', [
            'eqp' => $eqp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eqp_delete', methods: ['POST'])]
    public function delete(Request $request, Eqp $eqp, EqpRepository $eqpRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $eqp->getId(), $request->request->get('_token'))) {
            $eqpRepository->remove($eqp, true);
        }

        return $this->redirectToRoute('app_eqp_index', [], Response::HTTP_SEE_OTHER);
    }
}