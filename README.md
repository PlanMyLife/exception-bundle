# Exception Bundle

The exception bundle was created for the planmylife.io to manage all exceptions.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9ff50606-e5af-481d-9ed0-10f54c742d84/mini.png)](https://insight.sensiolabs.com/projects/9ff50606-e5af-481d-9ed0-10f54c742d84)

## Installation

### Step 1: Download the Bundle

    composer require planmylife/exception-bundle

This command requires you to have Composer installed globally, as explained in the Composer documentation.

### Step 2: Enable the Bundle

``` php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new PlanMyLife\ExceptionBundle\PlanMyLifeExceptionBundle(),
        );
    }

    // ...
    }
```

### Step 3: Configure factory and builder


``` yaml
# app/config/routing.yml
pml_exception:
    class: PlanMyLife\MainBundle\Exception\ExceptionListener
    layout: 'PlanMyLifeMainBundle:Error:%s.html.twig'
```

### Step 4 : Override view

Create an Error folder :

```
    Error
        error.html.twig
```

### Optionnal step : Override ExceptionListener

You have just create an other file which extends ExceptionListener ;-)
