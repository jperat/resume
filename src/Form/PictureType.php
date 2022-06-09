<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;

/**
 * Class PictureType
 * @package App\Form
 */
class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'picture',
            FileType::class,
            [
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new Image([
                        'minWidth' => '310',
                        'minHeight' => '310',
                        'allowPortrait' => false,
                        'allowLandscape' => false,
                        'allowSquare' => true,
                        'mimeTypes' => [
                            'image/jpeg'
                        ],
                        'maxRatio' => 1,
                        'minRatio' => 1,
                    ])
                ]
            ]
        );
    }
}
