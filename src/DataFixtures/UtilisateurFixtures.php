<?php
namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $utilisateur1 = new Utilisateur();
        $utilisateur1->setNom("Pote")
            ->setPrenom("Pomme")
            ->setDateNaissance(new \DateTime("1997-05-19"))
            ->setTelephone("0123456789")
            ->setEmail("pommepote@gmail.com")
            ->setPassword($this->passwordEncoder->encodePassword($utilisateur1, 'compote'));

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setNom("Krem")
            ->setPrenom("Sociéte")
            ->setDateNaissance(new \DateTime("1967-01-24"))
            ->setTelephone("0693809820")
            ->setEmail("societekrem@gmail.com")
            ->setPassword($this->passwordEncoder->encodePassword($utilisateur2, 'fromage'));

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setNom("Whaouh")
            ->setPrenom("Crêpe")
            ->setDateNaissance(new \DateTime("1980-07-07"))
            ->setTelephone("0987654321")
            ->setEmail("crepewhaouh@gmail.com")
            ->setPassword($this->passwordEncoder->encodePassword($utilisateur3, 'whaouh'));

        $utilisateur4 = new Utilisateur();
        $utilisateur4->setNom("Munch")
            ->setPrenom("Monster")
            ->setDateNaissance(new \DateTime("1983-05-05"))
            ->setTelephone("0982168231")
            ->setEmail("monstermunch@gmail.com")
            ->setPassword($this->passwordEncoder->encodePassword($utilisateur4, 'chips'));

        $admin = new Utilisateur();
        $admin->setNom("Admin")
        ->setPrenom("Jean")
        ->setDateNaissance(new \DateTime("1999-05-05"))
        ->setTelephone("0982168231")
        ->setEmail("admin@admin.fr")
        ->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'))
        ->setRoles(['ROLE_ADMIN']);

        $manager->persist($utilisateur1);
        $manager->persist($utilisateur2);
        $manager->persist($utilisateur3);
        $manager->persist($utilisateur4);
        $manager->persist($admin);

        $manager->flush();

        $this->addReference('Utilisateur-1', $utilisateur1);
        $this->addReference('Utilisateur-2', $utilisateur2);
        $this->addReference('Utilisateur-3', $utilisateur3);
        $this->addReference('Utilisateur-4', $utilisateur4);

    }
}
