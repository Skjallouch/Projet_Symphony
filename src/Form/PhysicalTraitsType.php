<?php

namespace App\Form;

use App\Entity\PhysicalTraits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhysicalTraitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('faceShape', ChoiceType::class, [
                'choices' => [
                    'Ovale' => 'ovale',
                    'Rond' => 'rond',
                    'Carré' => 'carré',
                    'Rectangulaire/long' => 'rectangulaire/long',
                    'Coeur' => 'coeur',
                    'Losange' => 'losange',
                    'Triangle' => 'triangle',
                    'Triangle inversé' => 'triangle inversé',
                    'Diamant' => 'diamant'
                ],
                'label' => 'Forme du Visage'
            ])
            ->add('hair', HairType::class, [
                'label' => false
            ])
            ->add('eyeColor', ChoiceType::class, [
                'choices' => [
                    'Vert' => 'Vert',
                    'Bleu foncé' => 'bleu foncé',
                    "Bleu vert" => 'bleu vert',
                    "Bleu clair" => 'bleu clair',
                    "Bleu gris" => 'bleu gris',
                    "Marron" => 'marron',
                    "Marron Vert" => 'marron vert',
                    "Noir" => "noir",
                    "Gris" => "gris",
                    "Noisette" => "noisette",
                ],
                'label' => "Couleur de Yeux"
            ])
            ->add('skinColor', ChoiceType::class, [
                'choices' => [
                    "Très Claire" => "très clair",
                    "Claire" => "clair",
                    "Clair à Moyenne" => "clair à moyenne",
                    "Moyenne" => "moyenne",
                    "Moyenne à Foncé" => "moyenne à foncé",
                    "Foncé" => "foncé",
                    "Très Foncé" => "très foncé",
                ]
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
