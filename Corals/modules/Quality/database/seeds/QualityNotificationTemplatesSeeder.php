<?php

namespace Corals\Modules\Quality\database\seeds;

use Corals\User\Communication\Models\NotificationTemplate;
use Illuminate\Database\Seeder;

class QualityNotificationTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //added
        NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.qualityTest_created'], [
            'friendly_name' => 'New Quality Test created',
            'title' => 'A new quality test has been created',
            'body' => [
                'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> A new quality test request has been added to the requsests </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> quality test Details </h5> </td></tr></table>',
                'database' => '<p>A new quality test has been created <a href="{qualityTest_link}">Here</a></p>'
              
                
            ],
            'via' => ["database"]
        ]);

        NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.buyer_apology'], [
            'friendly_name' => 'Apology Message To The Buyer',
            'title' => 'Apology Message To The Buyer',
            'body' => [
                'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
               'database' => '<p>Your Order#{order_number} has been canceled, check it out <a href="{order_link}">Here</a></p>'
            ],
            'via' => ["database"]
        ]);

        NotificationTemplate::updateOrCreate(['name' => '	notifications.qualityTest.warning_seller'], [
            'friendly_name' => 'Warning Message To The Seller',
            'title' => 'Warning Message To The Seller',
            'body' => [
               'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
               'database' => '<p>Warning Message To The Seller...</p>'
            ],
            'via' => ["database"]
        ]);

        NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.Buyer_FormAgreement'], [
            'friendly_name' => 'Buyer Form Agreement',
            'title' => 'Buyer Form Agreement',
            'body' => [
               'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
               'database' =>
               '<p>order item update</p></br><iframe src="{order_item_link}"></iframe>',
            ],
            'via' => ["database"]
        ]);

        NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.responsible_qualityTest'], [
            'friendly_name' => 'Responsible Quality Test ',
            'title' => 'A new quality test has been requested',
            'body' => [
                'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> A new quality test request has been added to the requsests </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
                'database' => '<p>Hi <b id="shortcode_responsible_name">{responsible_name}</b></p>\r\n\r\n<p>A new quality test has been created <a href="{qualityTest_link}">Here</a></p>'
              
                
            ],
            'via' => ["database"]
            ]);
            
      /*  NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.shipping_address.quality'], [
                'friendly_name' => 'Quality Test Shipping Address   ',
                'title' => 'Please ship the product to the folloing address',
                'body' => [
                    'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
                    'database' => '<p>Please ship the product to the folloing address</p>\r\n\r\n<p>Hi <b id="shortcode_shipping_address">{shipping_address}</b></p>'
                  
                    
                ],
                'via' => ["database"]
                ]);*/

           NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.shipping_Buyer'], [
                    'friendly_name' => 'Shipping Order To Buyer ',
                    'title' => 'Shipping Order To Buyer ',
                    'body' => [
                        'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
                        'database' => '<p>Please ship the<a href="{order_link}">order </a>to the buyer </p>'
                      
                        
                    ],
                    'via' => ["database"]
                    ]);  
                    
     NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.product_accept.qualityTest'], [
                        'friendly_name' => 'Quality Test Product Accepted   ',
                        'title' => 'your product quality test accepted ',
                        'body' => [
                            'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
                            'database' => '<p>your <a href="{product_link}">product </a>quality test is accepted </p>'
                            
                            
                        ],
                        'via' => ["database"]
                        ]);  
                        
                        NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.seller_response'], [
                            'friendly_name' => 'Seller Response Notification ',
                            'title' => 'Seller Response',
                            'body' => [
                                'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
                                'database' => '<p>Seller Response for the discount offer on the <a href="{product_link}">product </a>is <b id="shortcode_seller_response">{seller_response} </b></p>'
                                
                            ],
                            'via' => ["database"]
                            ]); 
                            
                            NotificationTemplate::updateOrCreate(['name' => 'notifications.qualityTest.buyer_response'], [
                                'friendly_name' => 'Buyer Response Notification ',
                                'title' => 'Buyer Response',
                                'body' => [
                                    'mail' => '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"> <tr> <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Write Here! </h2> </td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;"> <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. </p></td></tr><tr> <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <h5 style="font-size: 15px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">  Details </h5> </td></tr></table>',
                                    'database' => '<p>Buyer Response for the discount offer on the <a href="{product_link}">product </a>is <b id="shortcode_buyer_response">{buyer_response} </b></p>'
                                    
                                ],
                                'via' => ["database"]
                                ]);                    
                
    }
}  