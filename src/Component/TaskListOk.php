<?php

namespace App\Component;

use App\Entity\Task;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent('task_list_ok')]
class TaskListOk extends AbstractController
{
    use DefaultActionTrait;

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function getOwner(): User
    {
        return $this->entityManager->getRepository(User::class)->findAll()[0];
    }

    #[LiveAction]
    public function refresh(): void
    {
    }

    #[LiveAction]
    public function moveUp(#[LiveArg] Task $task): void
    {
        $task->decrementPosition();
        $this->entityManager->flush();
    }

    #[LiveAction]
    public function moveDown(#[LiveArg] Task $task): void
    {
        $task->incrementPosition();
        $this->entityManager->flush();
    }
}
