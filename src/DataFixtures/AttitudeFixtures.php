<?php

namespace App\DataFixtures;

use App\Entity\Attitude;
use Doctrine\Common\Persistence\ObjectManager;

class AttitudeFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        foreach (Attitude::getTypes() as $type)
        {
            $attitude = new Attitude();
            $attitude->setType($type);
            $manager->persist($attitude);

        }
        $manager->flush();

    }
}
