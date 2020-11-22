<?php


namespace App\Controller;


use App\Entity\Config;
use App\Entity\Contact;
use App\Entity\Education;
use App\Entity\Experience;
use App\Entity\Skill;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller\Front
 *
 * @Route("/", name="home_")
 */
class HomeController extends AbstractController
{

    /**
     * @return array
     *
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $experiences = $this->getDoctrine()->getRepository(Experience::class)->findBy(['active' => true], ['start' => 'DESC', 'end' => 'DESC']);
        $educations = $this->getDoctrine()->getRepository(Education::class)->findBy(['active' => true], ['end' => 'DESC', 'start' => 'DESC']);
        $skills = $this->getDoctrine()->getRepository(Skill::class)->findBy(['active' => true], ['rate' => 'ASC']);
        $contactForm = $this->createForm(ContactType::class, new Contact());
        $params = [
            'experiences' => $experiences,
            'educations' => $educations,
            'contactForm' => $contactForm->createView(),
            'skills' => $skills,
            'configs' => $this->getDoctrine()->getRepository(Config::class)->getIndexConfig()
        ];
        return $this->render('/home/index.html.twig', $params);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/contact", name="contact", methods={"POST"}, options={"expose"=true})
     */
    public function contact(Request $request, EntityManagerInterface $entityManager) :Response
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

    /**
     * @return Response
     *
     * @Route("/sitemap.xml", name="sitemap", methods={"GET"})
     */
    public function siteMap(): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('/home/sitemap.xml.twig', [], $response);
    }

    /**
     * @return Response
     *
     * @Route("/robots.txt", name="robots", methods={"GET"})
     */
    public function robots(): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/txt');
        return $this->render('/home/robots.txt.twig', [], $response);
    }

}