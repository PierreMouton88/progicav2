<?php

namespace App\Controller;

use App\Entity\Eqp;
use App\Entity\Gite;
use App\Entity\GiteEqpExt;
use App\Entity\GiteEqpInt;
use App\Entity\GiteService;
use App\Entity\User;
use App\Form\GiteType;
use App\Form\SearchType;
use App\Repository\EqpRepository;
use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

use function PHPSTORM_META\type;

#[Route('/gite')]
class GiteController extends AbstractController
{
    #[Route('/', name: 'app_gite_index', methods: ['GET', 'POST'])]
    public function index(GiteRepository $giteRepository, EqpRepository $eqpRepository, Request $request): Response
    {
        $gite = new Gite;
        $formsearch = $this->createForm(SearchType::class, $gite);
        $formsearch->handleRequest($request);
        if ($formsearch->isSubmitted() && $formsearch->isValid()) {
            return $this->render('gite/index.html.twig', [
                'gites' => $giteRepository->findAll(),
                'formSearch' => $formsearch
            ]);
        }

        return $this->render('gite/index.html.twig', [
            'gites' => $giteRepository->findAll(),
            // 'eqpexts' => $eqpRepository->findBy(['type' => 'extérieur']),
            'formSearch' => $formsearch
        ]);
    }
    #[Route('/api/equipement/{type}', name: 'app_gite_api_equipement', methods: ['GET'])]
    public function equipement(EqpRepository $eqpRepository, SerializerInterface $serializer, Request $request, string $type)
    {
        $term = $request->query->get('term');

        if (!$term) {
            return $this->json(null);
        }
        $equipement = $serializer->serialize($eqpRepository->findByText($term, $type), 'json', [
            'groups' => [
                'eqp'
            ]
        ]);

        return $this->json(
            $equipement
        );
    }
    #[Route('/search', name: 'app_gite_search', methods: ['GET', 'POST'])]
    public function search_gite(GiteRepository $giteRepository, EqpRepository $eqpRepository, Request $request): Response
    {


        // $value->handleRequest($request);
        // dd($id);
        // $gite = new Gite;
        $formsearch = $this->createForm(SearchType::class);
        $formsearch->handleRequest($request);


        if ($formsearch->isSubmitted() && $formsearch->isValid()) {
            $value = $formsearch->get('eqpInt')->getData();
            // dd($value);
            return $this->render('gite/search.html.twig', [
                'gitesSearch' => $eqpRepository->findBygite($value),

                'formSearch' => $formsearch
            ]);
        }
        return $this->render('gite/search.html.twig', [
            'formSearch' => $formsearch
        ]);
    }


    #[Route('/owner', name: 'app_gite_index_owner', methods: ['GET'])]
    public function index_public(GiteRepository $giteRepository): Response
    {
        $user = $this->getUser();

        return $this->render('gite/index_owner.html.twig', [
            'gites' => $giteRepository->findBy(['user' => $user])
        ]);
    }

    #[Route('/new', name: 'app_gite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GiteRepository $giteRepository): Response
    {
        $gite = new Gite();

        $giteservice = new GiteService();
        $gite->addGiteService($giteservice);

        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpExt = $form->get('eqpExt')->getData();
            $eqpInt = $form->get('eqpInt')->getData();
            $eqps = array_merge(
                $eqpInt->toArray(),
                $eqpExt->toArray()
            );
            foreach ($eqps as $eqp) {
                $gite->addEqp($eqp);
            }
            $gite->setUser(($this->getUser()));
            $giteRepository->save($gite, true);
            $this->addFlash('success', "Votre bien a bien été ajouté");
            return $this->redirectToRoute('app_gite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gite/new.html.twig', [
            'gite' => $gite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_show', methods: ['GET'])]
    public function show(Gite $gite): Response
    {
        if ($gite) {
            return $this->render('gite/show.html.twig', [
                'gite' => $gite,
            ]);
        } else {
            $this->addFlash('error', "Cet ID n'appartient à aucun gîte.");
        }
    }

    #[Route('/owner/{id}', name: 'app_gite_owner_show', methods: ['GET'])]
    public function show_public(Gite $gite): Response
    {
        if ($gite) {
            return $this->render('gite/show_owner.html.twig', [
                'gite' => $gite,
            ]);
        } else {
            $this->addFlash('error', "Cet ID n'appartient à aucun gîte.");
        }
    }

    #[Route('/{id}/edit', name: 'app_gite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gite $gite, GiteRepository $giteRepository): Response
    {
        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpExt = $form->get('eqpExt')->getData();
            $eqpInt = $form->get('eqpInt')->getData();
            $eqps = array_merge(
                $eqpInt->toArray(),
                $eqpExt->toArray()
            );
            foreach ($eqps as $eqp) {
                $gite->addEqp($eqp);
            }
            $giteRepository->save($gite, true);
            $this->addFlash('success', "Votre bien a bien été modifié");
            return $this->redirectToRoute('app_gite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gite/edit.html.twig', [
            'gite' => $gite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_delete', methods: ['POST'])]
    public function delete(Request $request, Gite $gite, GiteRepository $giteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $gite->getId(), $request->request->get('_token'))) {
            $giteRepository->remove($gite, true);
        }

        return $this->redirectToRoute('app_gite_index', [], Response::HTTP_SEE_OTHER);
    }
}