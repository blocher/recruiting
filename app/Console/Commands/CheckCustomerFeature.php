<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;

use App\Customer;
use App\Feature;
use App\FeatureGroup;

use App\FeatureGroups;

/**
* Command accepts a Feature id or name and a customer id or name and
* evaluates wheter customer has access to this feature
*
*/
class CheckCustomerFeature extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'recruiting:check-customer-feature {--customer=} {--feature=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Customer Feature';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle($input, $output=NULL)
    {
        $customer = Customer::getByUserInput($this->option('customer'));

        $feature = Feature::getByUserInput($this->option('feature'));

        if (empty($customer) || empty($feature)) {
            $this->error('You must enter a valid customer id or name and a valid feature id or name');
            return;
        }

        $res = $customer->hasFeature($feature->id) ? 'The customer has this feature' : 'The customer does NOT have this feature';

        $this->info($res);



    }

}