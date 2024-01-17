<?php

namespace App\Form;

use App\Entity\Ressouce;
use App\Entity\Dossier;
use App\Form\DossierType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessouceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [ 'label' => "Nom de la ressource" ])
            ->add('url', null, [ 'label' => 'Lien'])
            ->add('pinned', null, [ 'label' => 'Epinglé ?'])
            ->add('dossier', EntityType::class, [
                'class' => Dossier::class,
                'choice_label' => 'name',
                'label' => 'Dossier lié'
                ])
            ->add('save', SubmitType::class, ['label' => 'Publier'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressouce::class,
        ]);
    }
}
