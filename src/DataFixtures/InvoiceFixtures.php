<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CustomerFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i =0 ; $i < 50; $i++){
            $invoice = new Invoice;
            $invoice
                    ->setAmount($faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL))
                    ->setEndingAt($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null))
                    ->setCreatedAt(new DateTime())
                    ->setStatut($faker->randomElement(['SENT', 'PAID', 'CANCEL']));


            $customer = $this->getReference("customer_" . rand(0,9));
            $invoice->setCustomer($customer);
            
            $manager->persist($invoice);

        }

        $manager->flush();
    }
}
