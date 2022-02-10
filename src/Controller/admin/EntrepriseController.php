<?php

namespace App\Controller\admin;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\DescriptionRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\ReseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entreprise')]
class EntrepriseController extends AbstractController
{
    #[Route('/{id}/edit', name: 'entreprise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entreprise $entreprise, EntityManagerInterface $entityManager, DescriptionRepository $descriptionRepository, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        $old_name_image = $entreprise->getImage();
        $path = $this->getParameter('upload_dir') . $old_name_image;

        $old_name_logo = $entreprise->getLogo();
        $path2 = $this->getParameter('upload_dir') . $old_name_logo;

        $old_name_banniere = $entreprise->getBanniere();
        $path3 = $this->getParameter('upload_dir') . $old_name_banniere;

        $old_name_favicon = $entreprise->getFavicon();
        $path4 = $this->getParameter('upload_dir') . $old_name_banniere;

        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                if (file_exists($path)) {
                    unlink($path);
                }

                $image_new_name = uniqid() . '.' . $image->guessExtension();
                $image->move($this->getParameter('upload_dir'), $image_new_name);
                $entreprise->setImage($image_new_name);
            } else {
                $entreprise->setImage($old_name_image);
            }

            $logo = $form->get('logo')->getData();
            if ($logo) {
                if (file_exists($path2)) {
                    unlink($path2);
                }

                $logo_new_name = uniqid() . '.' . $logo->guessExtension();
                $logo->move($this->getParameter('upload_dir'), $logo_new_name);
                $entreprise->setLogo($logo_new_name);
            } else {
                $entreprise->setLogo($old_name_logo);
            }

            $banniere = $form->get('banniere')->getData();
            if ($banniere) {
                if (file_exists($path3)) {
                    unlink($path3);
                }
                $banniere_new_name = uniqid() . '.' . $banniere->guessExtension();
                $banniere->move($this->getParameter('upload_dir'), $banniere_new_name);
                $entreprise->setBanniere($banniere_new_name);
            } else {
                $entreprise->setBanniere($old_name_banniere);
            }

            $favicon = $form->get('favicon')->getData();
            if ($favicon) {
                if (file_exists($path4)) {
                    unlink($path4);
                }
                $favicon_new_name = uniqid() . '.' . $favicon->guessExtension();
                $favicon->move($this->getParameter('upload_dir'), $favicon_new_name);
                $entreprise->setFavicon($favicon_new_name);
            } else {
                $entreprise->setFavicon($old_name_favicon);
            }


            $entityManager->flush();

            return $this->redirectToRoute('entreprise_edit', ['id' => 1], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entreprise/edit.html.twig', [
            'entreprise' => $entrepriseRepository->find(1),
            'form' => $form,
            'descriptions' => $descriptionRepository->triPosition(),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }
}
