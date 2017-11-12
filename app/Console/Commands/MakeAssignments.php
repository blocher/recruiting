<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;

use App\Customer;
use App\Feature;
use App\FeatureGroup;

use App\FeatureGroups;

/**
* MakesAssignes loads data from config file and assigns users
* to a Feature Group
*
* This is meant to be run on first use only.  Rerunning will clear the
* database and rassign customers
*
* @TODO Break this into seperate class and functions
*
*/
class MakeAssignments extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'recruiting:make-assignments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize Data and make assignments';

    public function clearDatabase() {

        Customer::truncate();
        Feature::truncate();
        FeatureGroup::truncate();
        DB::table('features_feature_groups')->truncate();

    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle($input, $output=NULL)
    {

        $data = Storage::disk('local')->get('data.json');
        $data = json_decode($data);

        $this->clearDatabase();

        /* Load Features into database */
        foreach ($data->features as $feature) {
            Feature::create(['name'=>$feature]);

        }

        /* Load Feature Groups into database */
        $total_percentage = 0;
        foreach ($data->feature_groups as $feature_group) {
            $model = FeatureGroup::create(['name'=>$feature_group->name, 'percentage'=>$feature_group->percentage]);
            $features = Feature::whereIn('name',$feature_group->features)->pluck('id');
            $model->features()->sync($features);
            $total_percentage += $feature_group->percentage;
        }

        if ($total_percentage != 100) {
            $this->clearDatabase();
            $this->error("Feature group precentage assignments must equal 100%");
            return;
        }

        /* Load Customers into database and assign radnommly to feature group*/

        $featureGroups = new FeatureGroups();
        foreach ($data->customers as $customer) {
            Customer::create(['name'=>$customer, 'feature_group_id' => $featureGroups->assignFeatureGroup()]);
        }

        $this->info('Assignments complete');


    }

}