<?php

namespace App\Twig;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Entity\Gite;
use App\Form\GiteType;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent('new_gite')]
class NewGiteComponent extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    #[LiveProp(fieldName: 'data')]
    public ?Gite $gite = null;

    protected function instantiateForm(): FormInterface
    {

        return $this->createForm(GiteType::class, $this->gite);
    }

    #[LiveAction]
    public function addGiteServices()
    {
        $this->formValues['giteServices'][] = [];
    }

    #[LiveAction]
    public function removegiteServices(#[LiveArg] int $index)
    {
        unset($this->formValues['giteServices'][$index]);
    }
    // #[LiveAction]
    // public function addGiteEqpExts()
    // {
    //     $this->formValues['giteEqpExts'][] = [];
    // }

    // #[LiveAction]
    // public function removeGiteEqpExts(#[LiveArg] int $index)
    // {
    //     unset($this->formValues['giteEqpExts'][$index]);
    // }

    // #[LiveAction]
    // public function addGiteEqpInts()
    // {
    //     $this->formValues['giteEqpInts'][] = [];
    // }

    // #[LiveAction]
    // public function removeGiteInts(#[LiveArg] int $index)
    // {
    //     unset($this->formValues['giteEqpInts'][$index]);
    // }
}