<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\Cropperjs\Form\CropperType;
use Symfony\UX\Cropperjs\Factory\CropperInterface;

class CroppingController extends AbstractController
{

    #[Route('/cropping', name: 'app_cropping')]
    public function index(CropperInterface $cropper, Request $request): Response
    {
        $crop = $cropper->createCrop('/server/path/to/the/image.jpg');
        $crop->setCroppedMaxSize(1500, 1500);

        $form = $this->createFormBuilder(['crop' => $crop])
            ->add('crop', CropperType::class, [
                'public_url' => '/images/Placeholder.svg',
                'cropper_options' => [
                    'aspectRatio' => 1500 / 1500,
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the cropped image data (as a string)
            $crop->getCroppedImage();

            // Create a thumbnail of the cropped image (as a string)
            $crop->getCroppedThumbnail(150, 150);

            // ...
        }

        return $this->render('cropping/cropper.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}