# Recruiting Madness

## Requirements
* PHP >= 7.0 (with OpenSSL PHP Extension, PDO PHP Extension, Mbstring PHP Extension)
* composer (https://getcomposer.org/)
* git

## Installation
* `git clone https://github.com/blocher/recruiting.git`
* `composer install`

## Configuration
* You may edit `demo.json` in `storage\app\` folder to add or modify features, feature groups, and customers

## Seeding database and assigning customers to feature groups
* `php artisan recruiting:make-assignments`
* No options or arguments
* Loads features, feature groups, and customers from `storage\app\demo.json` file into sqllite database
* Assigns customers randomly to feature groups based on percentage likelihood of being assigned to a feature group

## Determining if a customer has access to a feature
* `recruiting:check-customer-feature --customer={ID OR NAME} --feature={ID OR NAME}`
* Customer option is required and accepts integer ID or string name
* Feature option is required and accepts integer ID or string name
* Outputs string result

### Relevant Files
* `app\Console\Commands\CheckCustomerFeature.php` contains the command to check if a customer has access to a feature
* `app\Console\Commands\MakeAssignments.php` contains the command to load data and assign users to feature groups
* `app\Customer.php` is the Customer model, the `hasFeature` function allows checking to see if Custer has access to a feature
* `app\Feature.php` is the Feature model
* `app\FeatureGroup.php` is the FeatureGroup model
* `app\FeatureGroups.php` allows you to work with the complete collection of FeatureGroups and manages chance of assignment to a particular group


### Notes
* Data is stored in a sqllite database that is committed to the repo for convenience of this demo only
* .env is committed to the repo for this demo only
