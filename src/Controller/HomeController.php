<?php

namespace App\Controller;

use App\Entity\Config;
use App\Entity\Contact;
use App\Entity\Education;
use App\Entity\Experience;
use App\Entity\Skill;
use App\Form\ContactType;
use App\Repository\ConfigRepository;
use App\Repository\EducationRepository;
use App\Repository\ExperienceRepository;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller\Front
 */
#[Route('/', name:'home_')]
class HomeController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(
        ExperienceRepository $experienceRepository,
        EducationRepository $educationRepository,
        SkillRepository $skillRepository,
        ConfigRepository $configRepository
    ): Response {
        $experiences = $experienceRepository
            ->findBy(['active' => true], ['start' => 'DESC', 'end' => 'DESC']);
        $educations = $educationRepository
            ->findBy(['active' => true], ['end' => 'DESC', 'start' => 'DESC']);
        $skills = $skillRepository->findBy(['active' => true], ['rate' => 'DESC']);
        $contactForm = $this->createForm(ContactType::class, new Contact());
        $params = [
            'experiences' => $experiences,
            'educations' => $educations,
            'contactForm' => $contactForm->createView(),
            'skills' => $skills,
            'configs' => $configRepository->getIndexConfig()
        ];
        return $this->render('/home/index.html.twig', $params);
    }

    #[Route('/contact', name:'contact', methods:['POST'], options:['expose' => 'true'])]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $params = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
            $params['success'] = true;
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
        }
        $params['form'] = $form->createView();
        return $this->render('/home/contact_form.html.twig', $params);
    }

    #[Route('/sitemap.xml', name:'sitemap', methods:['GET'])]
    public function siteMap(): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('/home/sitemap.xml.twig', [], $response);
    }

    #[Route('/robots.txt', name:'robots', methods:['GET'])]
    public function robots(): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/txt');
        return $this->render('/home/robots.txt.twig', [], $response);
    }
}
