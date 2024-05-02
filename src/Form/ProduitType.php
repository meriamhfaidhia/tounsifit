<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le nom du produit'
                ],
                'invalid_message' => 'Veuillez fournir un nom valide.'
            ])
            ->add('description', null, [
                'label' => 'Description',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez la description du produit'
                ],
                'invalid_message' => 'Veuillez fournir une description valide.'
            ])
            ->add('prix', null, [
                'label' => 'Prix',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le prix du produit'
                ],
                'invalid_message' => 'Veuillez fournir un prix valide.'
            ])
            ->add('quantity', null, [
                'label' => 'Quantité',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez la quantité disponible du produit'
                ],
                'invalid_message' => 'Veuillez fournir une quantité valide.'
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'invalid_message' => 'Veuillez fournir une image valide.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
