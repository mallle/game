<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Common\Persistence\ObjectManager;

class PersonFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Person::class, 10, function (Person $person, $count) {
            $person
                ->setName($this->faker->name())
                ->setGender($this->faker->boolean(50) ? 'm' : 'w')
                ->setDescription($this->faker->realText($maxNbChars = 100, $indexSize = 2))
                ->setAge($this->faker->numberBetween(10, 80))
                ->setImg('https://robohash.org/' . $this->faker->word() . '.png?size=50x50');
        });

        $manager->flush();

    }
}
