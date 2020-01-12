<?php

namespace App\DataFixtures;

use App\Entity\Story;
use Doctrine\Common\Persistence\ObjectManager;

class StoryFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Story::class, 10, function (Story $story, $count) {
            $story
                ->setName($this->faker->realText($maxNbChars = 10, $indexSize = 2))
                ->setDescription($this->faker->realText($maxNbChars = 100, $indexSize = 2))
                ->setPublished($this->faker->boolean(30));
        });

        $manager->flush();

    }
}
