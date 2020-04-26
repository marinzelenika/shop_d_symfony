<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Naziv:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('email', EmailType::class, array('label' => 'Email:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false, 'label' => 'Slažem se sa zahtjevima korištenja  ',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Trebate se složiti sa zahtjevima korištenja kako bi ste nastavili', 
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false, 'label' => 'Lozinka:  ', 'attr'=>array('class'=>'form-control mb-5'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Molimo unesite lozinku',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Lozinka bi trebala imati bar {{ limit }} znakova',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
