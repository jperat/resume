<?php

namespace App\EventSubscriber;

use App\Repository\ConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Translation\LocaleSwitcher;

class LocaleSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private string $defaultLocale,
        private LocaleSwitcher $localeSwitcher,
        private ConfigRepository $configRepository
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $this->localeSwitcher->setLocale(
            (string) $this->configRepository->getValueConfig('locale', $this->defaultLocale)
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
