<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User(tasks: new ArrayCollection([
            new Task(title: 'Task A', position: 1),
            new Task(title: 'Task B', position: 2),
            new Task(title: 'Task C', position: 3),
            new Task(title: 'Task D', position: 4),
        ]));

        $manager->persist($user);
        $manager->flush();
    }
}
