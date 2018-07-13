<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/07/18
 * Time: 17:33
 */

namespace Anaxago\CoreBundle\DataFixtures\ORM;

use Anaxago\CoreBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Stephane')
            ->setLastName('Frenchie')
            ->setUsername('Nephaste')
            ->setRoles(['ROLE_USER'])
            ->setSalt('toto')
            ->setPlainPassword('azerty');

        $manager->persist($user);

        $user = new User();
        $user->setFirstName('Nicolas')
            ->setLastName('Picard')
            ->setUsername('Ricolas')
            ->setRoles(['ROLE_USER'])
            ->setSalt('toto')
            ->setPlainPassword('azerty');

        $manager->persist($user);

        $user = new User();
        $user->setFirstName('Amine')
            ->setLastName('DeMarrakech')
            ->setUsername('Belotte')
            ->setRoles(['ROLE_USER'])
            ->setSalt('toto')
            ->setPlainPassword('azerty');

        $manager->persist($user);

        $manager->flush();
    }
}