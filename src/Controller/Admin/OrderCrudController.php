<?php

namespace App\Controller\Admin;

use App\Classe\Mail;
use App\Entity\Order;
use PhpParser\Node\Stmt\Label;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    private $entityManager;
    private $crudUrlGeneration;
    private $adminUrlGenerator;

    public function __construct(EntityManagerInterface $entityManager, CrudUrlGenerator $crudUrlGenerator, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->crudUrlGeneration = $crudUrlGenerator;
        $this->adminUrlGenerator = $adminUrlGenerator;

    }

    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addCssFile('assets/css/easyadmin.css');

    }

    public function configureActions(Actions $actions): Actions
    {
        $updatePreparation = Action::new('updatePreparation', 'Préparation en cours', 'fas fa-box-open')->linkToCrudAction('updatePreparation');
        $updateDelivery = Action::new('updateDelivery', 'Livraison en cours', 'fas fa-shipping-fast')->linkToCrudAction('updateDelivery');
        $updateComplete = Action::new('updateComplete', 'Complete', 'fas fa-check-square')->linkToCrudAction('updateComplete');
        $updateCancel = Action::new('updateCancel', 'Annulée', 'fas fa-window-close')->linkToCrudAction('updateCancel');

        return $actions
            ->add('detail', $updatePreparation)
            ->add('detail', $updateDelivery)
            ->add('detail', $updateComplete)
            ->add('detail', $updateCancel)
            ->add('index', 'detail');
    }

    public function updatePreparation(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(2);
        $this->entityManager->flush();

        $this->addFlash('notice', "<span style='color:blue;'><b>La commande n°" . $order->getReference() . " est bien <u>en cours de préparation</u></b></span>");
        
        $url = $this->adminUrlGenerator
                    ->setController(OrderCrudController::class)
                    ->setAction('index')
                    ->generateUrl();

        return $this->redirect($url);
    }

    public function updateDelivery(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(3);
        $this->entityManager->flush();

        $this->addFlash('notice', "<span style='color:orange;'><b>La commande n°" . $order->getReference() . " est bien <u>en cours de livraison</u></b></span>");
        
        $url = $this->adminUrlGenerator
                    ->setController(OrderCrudController::class)
                    ->setAction('index')
                    ->generateUrl();

        return $this->redirect($url);
    }

    public function updateComplete(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(4);
        $this->entityManager->flush();

        $this->addFlash('notice', "<span style='color:green;'><b>La commande n°" . $order->getReference() . " est bien <u>complete</u></b></span>");
        
        $url = $this->adminUrlGenerator
                    ->setController(OrderCrudController::class)
                    ->setAction('index')
                    ->generateUrl();

        return $this->redirect($url);
    }

    public function updateCancel(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(5);
        $this->entityManager->flush();

        $this->addFlash('notice', "<span style='color:red;'><b>La commande n°" . $order->getReference() . " est bien <u>annulée</u></b></span>");
        
        $url = $this->adminUrlGenerator
                    ->setController(OrderCrudController::class)
                    ->setAction('index')
                    ->generateUrl();

        return $this->redirect($url);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setFormTypeOption('disabled','disabled'),
            DateTimeField::new('createdAt', 'Passée le')->setFormat('hh:mm:ss dd-MM-yyyy'),
            TextField::new('reference', 'Commande n°'),
            TextField::new('user.fullname', 'Client'),
            TextEditorField::new('delivery', 'Adresse de livraison')->onlyOnDetail(),
            MoneyField::new('total', 'Total')->setCurrency('EUR')->setFormTypeOption('disabled','disabled'),
            TextField::new('carrierName', 'Transporteur'),
            MoneyField::new('carrierPrice', 'Frais de port')->setCurrency('EUR'),
            ChoiceField::new('state')->setChoices([
                'Non payée' => 0,
                'Payée' => 1,
                'Préparation en cours' => 2,
                'Livraison en cours' => 3,
                'Complete' => 4,
                'Annulée' => 5
            ]),
            ArrayField::new('orderDetails', 'Produits achetés')->hideOnIndex()->setFormTypeOption('disabled','disabled')
        ];
    }
}

