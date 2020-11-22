<?php


namespace App\Controller\Admin;


use App\Entity\Config;
use App\Form\ConfigsType;
use App\Form\PictureType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class ConfigController
 * @package App\Controller\Admin
 *
 * @Route("/admin/config")
 */
class ConfigController extends AbstractController
{
    private TranslatorInterface $translator;
    private EntityManagerInterface $entityManager;

    public function __construct(TranslatorInterface $translator, EntityManagerInterface $entityManager)
    {
        $this->translator = $translator;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/index")
     */
    public function index(Request $request): Response
    {
        $form = $this->getForm(ConfigsType::class, $request, $this->entityManager->getRepository(Config::class)->getIndexFormConfig());
        return $this->getRender($form);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/login")
     */
    public function login(Request $request): Response
    {
        $form = $this->getForm(ConfigsType::class, $request, $this->entityManager->getRepository(Config::class)->getLoginFormConfig());
        return $this->getRender($form);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/picture")
     */
    public function picture(Request $request, PictureService $pictureService): Response
    {
        $form = $this->createForm(PictureType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pictureService->execute($form->get('picture')->getData());
        }
        return $this->getRender($form);
    }

    private function getRender($form): Response
    {
        return $this->render(
            'admin/config/edit.html.twig',
            [
                'form' => $form->createView(),
                'actions' => $this->getEasyAdminActions()
            ]
        );
    }

    private function getForm(string $formType, Request $request, $values): FormInterface
    {
        $form = $this->createForm($formType, $values);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $configs = $form->getData();
            foreach ($configs as $config) {
                $this->entityManager->persist($config);
            }
            $this->entityManager->flush();
        }
        return $form;
    }

    private function getEasyAdminActions(): array
    {
        $editAction = Action::new(Action::SAVE_AND_CONTINUE, $this->translator->trans('action.save_and_continue', [], 'EasyAdminBundle'), 'far fa-edit')
            ->addCssClass('btn btn-secondary action-save')
            ->displayAsButton()
            ->setHtmlAttributes(['type' => 'submit', 'name' => 'ea[newForm][btn]', 'value' => 'saveAndContinue'])
            ->linkToCrudAction(Action::EDIT)
            ->getAsDto();
        $editAction->setTemplatePath('@EasyAdmin/crud/action.html.twig');
        $editAction->setLinkUrl($this->generateUrl('app_admin_config_index'));
        return [$editAction];
    }
}