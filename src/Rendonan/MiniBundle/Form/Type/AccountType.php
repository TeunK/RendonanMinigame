<?php
// src/Acme/TaskBundle/Form/Type/TaskType.php
namespace Rendonan\MiniBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("username", "text", array("label" => "Username"))
            ->add("password", "password", array("label" => "Password"))
            ->add("confirm", "submit");
    }

    public function getName()
    {
        return 'account';
    }
}