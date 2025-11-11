<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Listing;
use App\Models\Cron\WeeklyEmailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyEmail;



class SendWeeklyEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-weekly-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly featured listings to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $listings = array();
        $user = new User();
        // $users = $user->getFeatureMailingsUsers(20);
        $users = User::where('emailAddress', 'prateek.goyal@routadigital.com')->get();

        $statusConditions = ['Active'];
        $listings = Listing::where('type', 'Retail')
            ->whereIn('status', $statusConditions)
            ->with('listingPhotos')
            ->with(['user' => function($query) {
                $query->where('premium', 'Yes');
            }])
            ->withCount(['listingPremium as is_premium' => function($q) {
                $q->where('premium_expiration_date', '>', now())
                ->latest('premium_expiration_date');
            }])
            ->orderBy('emailpromoted', 'desc')
            ->take(10)
            ->get();
        foreach ($users as $user) {
            $user->logEmailPromotionSent($user->userID);
            Mail::to("aurangjeb.alam@routadigital.com")->send(new WeeklyEmail($user, $listings));
            exit;
        }
        Listing::whereIn('landID', $listings->pluck('landID'))->update(['emailpromoted' => now()]);

        $this->info('Weekly featured emails sent successfully!');
    }

}
