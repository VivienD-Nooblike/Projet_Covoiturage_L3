<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CovoiturageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('trajet',EntityType::class, [
                'class' => Trajet::class,
                'multiple' => false,
                'choice_label' => 'itineraire',
            ])
            ->add('date_depart', DateType::class)
            ->add('date_arrivee', DateType::class)
            ->add ('passager', EntityType::class, [
                'class' => Utilisateur::class,
                'multiple' => true,
                'choice_label' => 'prenom',
            ])
            ->add('description', TextareaType::class)
            ->add('nb_place', IntegerType::class, [
                'label' => 'Nombre de place disponible'
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix pour un passager'
            ])
            ->add('disponibilite',ChoiceType::class, [
                'choices' => [
                    'Oui' => true,'Non' => false, ],
                'label' => 'Disponible ?'])

            ->add('conducteur',EntityType::class, [
                'class' => Utilisateur::class,
                'multiple' => true,
                'choice_label' => 'nom',
            ])
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
