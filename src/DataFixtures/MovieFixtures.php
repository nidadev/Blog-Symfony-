<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $movie = new Movie();
       $movie->setTitle('the  inception');
       $movie->setReleaseYear(2005);
       $movie->setDescription('this is the description');
       $movie->setImagePath('https://tse1.mm.bing.net/th?id=OIP.3Zgn-7AZnNIGlHOdVMNG2AHaK-&pid=Api&P=0&h=180');
       $movie->addActor($this->getReference('actor_1'));
       $movie->addActor($this->getReference('actor_2'));

       $manager->persist($movie);

       $movie2 = new Movie();
       $movie2->setTitle('the  titanic');
       $movie2->setReleaseYear(2005);
       $movie2->setDescription('this is the description');
       $movie2->setImagePath('https://tse1.mm.bing.net/th?id=OIP.3Zgn-7AZnNIGlHOdVMNG2AHaK-&pid=Api&P=0&h=180');
       $movie2->addActor($this->getReference('actor_3'));
       $movie2->addActor($this->getReference('actor_4'));

       $manager->persist($movie2);

        $manager->flush();
    }
}
