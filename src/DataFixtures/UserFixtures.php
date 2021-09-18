<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UserFixtures extends Fixture
{
  private $encoder;

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
    $this->encoder = $encoder;
  }

  public function load(ObjectManager $manager)
  {
    $user = new User();
    $user->setFirstname("seppeo");
    $user->setLastname("admin");
    $user->setEmail('admin@seppeo.com');
    $user->setPassword($this->encoder->encodePassword($user, '123456'));
    $user->setRoles(array('ROLE_ADMIN'));
    $manager->persist($user);

    $manager->flush();
  }
}

?>