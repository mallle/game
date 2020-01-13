<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Common\Persistence\ObjectManager;

class QuestionFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Question::class, 10, function (Question $question, $count) {
            $question
                ->setQuestion($this->faker->realText($maxNbChars = 100, $indexSize = 2));
        });

        $manager->flush();

    }
}
