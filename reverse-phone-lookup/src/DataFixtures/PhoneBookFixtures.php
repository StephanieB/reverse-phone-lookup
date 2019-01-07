<?php

namespace App\DataFixtures;

use App\Entity\UsersPhone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PhoneBookFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'name' => 'bellone',
                'phone' => '0609322191'
            ],
            [
                'name' => 'goulet',
                'phone' => '0709322192'
            ],
            [
                'name' => 'dupond',
                'phone' => '0102030405'
            ],
            [
                'name' => 'martin',
                'phone' => '0101030409'
            ],
            [
                'name' => 'michel',
                'phone' => '0490570409'
            ],
            [
                'name' => 'william',
                'phone' => '0292273056'
            ],
        ];

        foreach ($data as $value) {
            $phoneBook = new UsersPhone();
            $phoneBook->setName($value['name']);
            $phoneBook->setPhone($value['phone']);
            $manager->persist($phoneBook);
        }

        $manager->flush();
    }
}
