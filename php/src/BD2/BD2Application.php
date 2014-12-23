<?php

namespace BD2;

use Silex\Application;

/**
 * Custom application class for extended use of silex.
 */
class BD2Application extends Application
{
    use Application\TwigTrait;
    use Application\FormTrait;
    use Application\UrlGeneratorTrait;
}
