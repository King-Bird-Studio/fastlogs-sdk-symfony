<?php

namespace fastlogs\FastlogsBundle;

use fastlogs\FastlogsBundle\DependencyInjection\FastlogsExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FastlogsBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FastlogsExtension();
        }

        return $this->extension;
    }

}