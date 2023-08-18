<?php

namespace App\Service;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class PortfolioDirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName(object|array $object, PropertyMapping $mapping): string
    {
        if ($object->getPortfolio()) {
            if ($object->getPortfolio()->getId()) {
                return $object->getPortfolio()->getSlug();
            }

            return self::slugify($object->getPortfolio()->getTitle());
        }

        return 'portfolios';
    }


    private static function slugify(string $text): string
    { // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = mb_strtolower($text);

        return $text ?: 'default-img';
    }
}
