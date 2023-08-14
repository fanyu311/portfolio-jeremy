<?php

namespace App\Listener;

use Exception;
use App\Entity\Portfolio;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Portfolio::class)]
#[AsEntityListener(event: Events::postRemove, method: 'postRemove', entity: Portfolio::class)]
class PortfolioImageListener
{
    public function __construct(
        private KernelInterface $kernel
    ) {
    }

    public function preUpdate(Portfolio $portfolio, PreUpdateEventArgs $event): void
    {
        if ($event->hasChangedField('title')) {
            foreach ($portfolio->getImages() as $image) {
                if (!$image->getImage()) {
                    $path = $this->kernel->getProjectDir()
                        . '/public/images/portfolios/'
                        . $event->getEntityChangeSet()['slug'][0]
                        . '/' . $image->getImageName();

                    if (is_file($path)) {
                        $image = new File($path);

                        $image->move(
                            $this->kernel->getProjectDir() . '/public/images/articles/' . $portfolio->getSlug()
                        );
                    } else {
                        throw new Exception("Image: $path not found");
                    }
                }
            }

            $dir = substr($path, 0, strrpos($path, '/'));
            $restFiles = glob("$dir/*");

            foreach ($restFiles as $file) {
                unlink($file);
            }

            rmdir($dir);
        }
    }

    public function postRemove(Portfolio $portfolio): void
    {
        $dir = $this->kernel->getProjectDir()
            . '/public/images/portfolios/'
            . $portfolio->getSlug();

        $files = glob("$dir/*");

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        if (is_dir($dir)) {
            rmdir($dir);
        }
    }
}
