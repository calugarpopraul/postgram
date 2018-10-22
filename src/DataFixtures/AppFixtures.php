<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 10/20/18
 * Time: 9:05 AM
 */

namespace App\DataFixtures;


use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $microPost = new MicroPost();
            $microPost->setText('Some random text '.rand(0,100));
            $microPost->setTime(new \DateTime('2018-10-20'));
            $manager->persist($microPost);
        }

        $manager->flush();
    }
}