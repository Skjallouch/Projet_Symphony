<?php

namespace App\Form;

use App\Entity\Hair;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HairType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hairColor', ChoiceType::class, [
                'choices' => [
                    'Noir' => 'noir',
                    'Brun foncé' => 'brun foncé',
                    "Brun moyen" => 'brun moyen',
                    "Brun clair" => 'brun clair',
                    "Blond foncé" => 'blond foncé',
                    "Blond moyen" => 'blond moyen',
                    "Blond clair" => 'blond clair',
                    "Châtain" => 'châtain',
                    "Gris" => "gris",
                    "Blanc" => "blanc",
                ],
                'label' => "Couleur de Cheveux"
            ])
            ->add('hairLength', ChoiceType::class, [
                'choices' => [
                    'Coupe Courte' => 'courte',
                    'Coupe au Carré' => 'carré',
                    "Coupe Carré Bob" => 'carré bob',
                    "Coupe Longueur Épaule" => 'longueur épaule',
                    "Coupe Mi-Longue" => 'mi-longue',
                    "Coupe Longue" => 'longue',
                    "Coupe très Longue" => 'très longue',
                    "Coupe au Rasoir" => 'rasoir',
                ],
                'label' => "Longueur de Cheveux"
            ])
            ->add('cutcut', ChoiceType::class, [
                'choices' => [
                    'Coupe Asymétrique' => 'asymétrique',
                    'Coupe en Dégradé' => 'dégradé',
                    "Coupe Plongeante" => 'plongeante',
                    "Coupe Effilée" => 'effilée',
                    "Coupe en Dégradé Inversé" => 'dégradé inversé',
                    "Coupe en V" => 'v',
                    "Coupe à Frange Droite" => 'frange droite',
                    "Coupe à Frange Arrondie" => 'frange arrondie',
                    "Coupe à Frange Rideaux" => 'frange rideaux',
                    "Coupe à Mèche du Visage Épaisse" => 'mèche du visage épaisse',
                    "Coupe à Mèche du Visage Fin" => 'mèche du visage fine',
                ],
                'label' => "Cut cut"
            ])
            ->add('coloration', ChoiceType::class, [
                'choices' => [
                    'Coloration de Mèches' => 'mèches',
                    'Tye and Die' => 'tye and die',
                    "Ombré hair" => 'ombré hair',
                    "Coloration sur tous les cheveux" => 'tous les cheveux',
                    "Coloration sur les mèches du visage" => 'mèches du visage',
                ],
                'label' => "Coloration"
            ])
            ->add('hairType', ChoiceType::class, [
            'choices' => [
                'Frisé' => 'frisé',
                'Bouclé' => 'bouclé',
                "Raide" => 'raide',
                "Ondulé" => 'ondulé',
                "Crépu" => 'crépu',
            ],
            'label' => "Type de Cheveux"
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hair::class,
        ]);
    }
}
