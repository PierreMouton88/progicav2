<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

#[Route('/admin')]
class AdminController extends AbstractController
{

#[Route('/', name: 'app_admin')]
public function usersList(UserRepository $users)
{
    return $this->render('admin/users.html.twig', [
        'users' => $users->findAll(),
    ]);
}
#[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
public function edit(User $user, Request $request, UserRepository $userRepository, PersistenceManagerRegistry  $doctrine)
{
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur modifié avec succès');
        return $this->redirectToRoute('app_admin');
    }
    
    return $this->render('user/edit.html.twig', [
        'userForm' => $form->createView(),
    ]);
}
}
