<?php

namespace App\Controller;

use App\Entity\Desinformacion;
use App\Form\DesinformacionType;
use App\Repository\DesinformacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/desinformacion')]
final class DesinformacionController extends AbstractController
{
    #[Route(name: 'app_desinformacion_index', methods: ['GET'])]
    public function index(DesinformacionRepository $desinformacionRepository): Response
    {
        return $this->render('desinformacion/index.html.twig', [
            'desinformacions' => $desinformacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_desinformacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $desinformacion = new Desinformacion();
        $form = $this->createForm(DesinformacionType::class, $desinformacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Obtenemos  el archivo multimedia del formulario
            $file = $form->get('multimedia')->getData();

            // Si hay un archivo, se procede a moverlo al directorio de subida
            if ($file) {
                $newFilename = uniqid().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('uploads_directory'), // Parámetro que configuramos dentro de los services
                        $newFilename
                    );
                    $desinformacion->setMultimedia($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'No se pudo subir el archivo: ' . $e->getMessage());
                }
            }


            $entityManager->persist($desinformacion);
            $entityManager->flush();

            return $this->redirectToRoute('app_desinformacion_index', [], Response::HTTP_SEE_OTHER);
        }

        

        return $this->render('desinformacion/new.html.twig', [
            'desinformacion' => $desinformacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_desinformacion_show', methods: ['GET'])]
    public function show(Desinformacion $desinformacion): Response
    {
        return $this->render('desinformacion/show.html.twig', [
            'desinformacion' => $desinformacion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_desinformacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Desinformacion $desinformacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DesinformacionType::class, $desinformacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_desinformacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('desinformacion/edit.html.twig', [
            'desinformacion' => $desinformacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_desinformacion_delete', methods: ['POST'])]
    public function delete(Request $request, Desinformacion $desinformacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$desinformacion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($desinformacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_desinformacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
