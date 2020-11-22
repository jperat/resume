<?php


namespace App\Form;


use App\Entity\Config;
use App\Form\DataTransformer\ConfigTransformer;
use App\Repository\ConfigRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class ConfigsType extends AbstractType
{

    private ConfigRepository $configRepository;
    private ConfigTransformer $configTransformer;

    public function __construct(ConfigRepository $configRepository, ConfigTransformer $configTransformer)
    {
        $this->configRepository = $configRepository;
        $this->configTransformer = $configTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Config $config */
        foreach ($options['data'] as $config) {
            $builder->add(
                $config->getId(),
                $this->getType($config->getType()),
                [
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => $config->getKey(),
                        'require' => false,
                    ],
                    'label' => $config->getKey(),
                    'data' => $config->getValue(),
                    'required' => false
                ]
            );
        }
        $builder->addModelTransformer($this->configTransformer);
    }

    private function getType($type): string
    {
        switch ($type) {
            case 'string': return TextType::class;
            case 'text': return TextareaType::class;
            case 'link': return UrlType::class;
            case 'email': return EmailType::class;
            case 'password': return PasswordType::class;
            default: return TextType::class;
        }
    }
}