<?php

namespace Corals\Modules\Approval\database\seeds;

use Corals\User\Communication\Models\NotificationTemplate;
use Illuminate\Database\Seeder;

class ApprovalNotificationTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //added
        NotificationTemplate::updateOrCreate(['name' => 'notifications.approval.new_request.created'], [
            'friendly_name' => 'New Approve Request Received',
            'title' => 'A new approve request has been added to the requsests',
            'body' => [
                'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> A new approve request has been added to the requsests </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Order Details </h5> </td></tr></table>',
                'database' => '<p>A new approve request has been added to the requsests <a href="{approveRequests_Requests_link}">Here</a></p>'
                
            ],
            'via' => ["database"]
        ]);

      
    
    }
}