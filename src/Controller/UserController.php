<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    // #[Route('/', name: 'app_user_index', methods: ['GET'])]
    // public function index(): Response
    // {
    //     return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
    // }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/', name: 'app_user_show', methods: ['GET'])]
    public function show(): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $this->getUser('id'),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {

        if ($user == $this->getUser('id')) {
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $userRepository->save($user, true);

                return $this->redirectToRoute('app_user_show', [], Response::HTTP_SEE_OTHER);
            }
            return $this->render('user/edit.html.twig', [
                'user' => $this->getUser('id'),
                'form' => $form,
            ]);
        } else {
            return $this->render('user/show.html.twig', [
                'user' => $this->getUser('id'),
            ]);
        }
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}