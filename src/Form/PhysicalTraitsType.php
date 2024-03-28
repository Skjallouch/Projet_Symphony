<?php

namespace App\Form;

use App\Entity\Hair;
use App\Entity\PhysicalTraits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhysicalTraitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('faceShape')
            ->add('eyeColor')
            ->add('skinColor')
            ->add('idHair', EntityType::class, [
                'class' => Hair::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PhysicalTraits::class,
        ]);
    }
}
