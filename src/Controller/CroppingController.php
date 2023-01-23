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
        $crop = $cropper->createCrop('/images/our_images/first_slide2.jpg');
        $crop->setCroppedMaxSize(1300, 1000);

        $form = $this->createFormBuilder(['crop' => $crop])
            ->add('crop', CropperType::class, [
                'public_url' => '/images/our_images/first_slide.jpg',
                'cropper_options' => [
                    'aspectRatio' => 1300 / 1000,
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the cropped image data (as a string)
            $crop->getCroppedImage();
            dd($crop);
            // Create a thumbnail of the cropped image (as a string)
            $crop->getCroppedThumbnail(130, 100);

            // ...
        }

        return $this->render('cropping/cropper.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}