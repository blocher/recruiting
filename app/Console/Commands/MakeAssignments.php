<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;

use App\Customer;
use App\Feature;
use App\FeatureGroup;

use App\FeatureGroups;

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

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle($input, $output=NULL)
    {


        $data = Storage::disk('local')->get('data.json');
        $data = json_decode($data);

        Customer::truncate();
        Feature::truncate();
        FeatureGroup::truncate();
        DB::table('features_feature_groups')->truncate();



        foreach ($data->features as $feature) {
            Feature::create(['name'=>$feature]);
        }

        foreach ($data->feature_groups as $feature_group) {
            $model = FeatureGroup::create(['name'=>$feature_group->name, 'percentage'=>$feature_group->percentage]);
            $features = Feature::whereIn('name',$feature_group->features)->pluck('id');
            $model->features()->sync($features);
        }

        $featureGroups = new FeatureGroups();
        foreach ($data->customers as $customer) {
            Customer::create(['name'=>$customer, 'feature_group_id' => $featureGroups->assignFeatureGroup()]);
        }


    }

}