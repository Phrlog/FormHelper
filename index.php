<?php
require_once 'vendor/autoload.php';

$phone_helper = new \FormHelper\PhoneHelper();
$passport_helper = new \FormHelper\PassportHelper();
$name_helper = new \FormHelper\FullNameHelper();

$phone = $phone_helper->set('+7(985)829-00-42')
                ->removePhoneSpecifications()
                ->formatPhoneLength(10)
                ->get();

$ua_passport = $passport_helper->set('АК654321')
                ->setLanguage('ua')
                ->explodePassport()
                ->get();

$name = $name_helper->set('Балабанов Максим Григорьевич')
                ->isLatin()
                ->explodeName()
                ->get();
