# Reward plugin for sylius #

## About ##
Reward plugin for *sylius* is used to give reward points to loyal customers under certain conditions.
Customers can spend their earned points to have discount on future orders.

## Use case ##

Reward plugin is customizable to satisfy the majority of e-commerce requirments.
However, it's developed in a manner to make it easy to customise it.

### The reward program target which customer? ###
Per default, any customer is part of reward program.
However, it's possible to restrict target customers to a specific list of customer groups.
   

### When a customer earn reward points? ###
A customer will earn reward points if he satisfy certain rules, bellow a list of v1 rules.

* Give customers **[X]** reward points on every **[Y]** euro spent.
* Give customers **[X]** reward points on every order having a total higher than **[Y]** euro. 
* Give customers **[X]** reward points on every product bought from **[L]** products list.

Also, an administrator can manually give any customer a number of reward points. 

### How a customer can spend his earned reward points ###

Per default, reward points can be used to apply discounts on any product.
However, it's possible to black-list certain products.

## Setting up the plugin ##

### 1) Download the plugin ### 
```bash
$ composer require snake-tn/reward-plugin

```
### 2) Enable the plugin ###
Enable the plugin by adding the following line in the app/AppKernel.php file of your sylius project:

```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new \SnakeTn\Reward\RewardPlugin(),
        ];

        // ...
    }
}
```

### 3) Update routing configuration ###
 // TODO
### 4) Update DB schema ###
```bash
$ bin/console doctrine:schema:update --force

```

### 5) Cleare cache ###
```bash
$ bin/console cache:clear

```
## User guide ##

//TODO
