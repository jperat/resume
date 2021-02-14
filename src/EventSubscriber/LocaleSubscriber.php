<?php

namespace App\EventSubscriber;

use App\Repository\ConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class LocaleSubscriber implements EventSubscriberInterface
{

    /** @var TranslatorInterface  */
    private $translator;

    /** @var ConfigRepository */
    private $configRepository;

    /** @var string $defaultLocale */
    private $defaultLocale;

    public function __construct(
        string $defaultLocale,
        TranslatorInterface $translator,
        ConfigRepository $configRepository
    ){
        $this->defaultLocale = $defaultLocale;
        $this->translator = $translator;
        $this->configRepository = $configRepository;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $this->translator->setLocale(
            $this->configRepository->getValueConfig('locale', $this->defaultLocale ?? 'en')
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
