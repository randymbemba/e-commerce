<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('Description', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('Prix', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('Stock', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('Photo', FileType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
