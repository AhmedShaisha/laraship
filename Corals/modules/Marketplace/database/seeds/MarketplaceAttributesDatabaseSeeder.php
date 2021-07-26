<?php
namespace Corals\Modules\Marketplace\database\seeds;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Corals\Modules\Marketplace\Models\Attribute;
class MarketplaceAttributesDatabaseSeeder extends Seeder
{
    public function run()
    {
      // call-> in SettingsTableSeeder
      $colour_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Colour',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);
        $attribute = Attribute::find($colour_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();

     $material_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Material',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);
        $attribute = Attribute::find($material_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();
    $place_of_purchase_id = \DB::table('marketplace_attributes')->insertGetId(
            ['type' => 'radio',
            'label' => 'place of purchase',
            'display_order' => '0',
            'required' => '0',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
       
            ]);
            $attribute = Attribute::find($place_of_purchase_id);
            $attribute->setProperty('key', $attribute->label);   
            $attribute->save();


     $condition_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'radio',
        'label' => 'Condition',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);       
            $attribute = Attribute::find($condition_id);
            $attribute->setProperty('key', $attribute->label);   
            $attribute->save();

     $printed_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Printed',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);
            $attribute = Attribute::find($printed_id);
            $attribute->setProperty('key', $attribute->label);   
            $attribute->save();


     $donation_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Donation',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);               
        $attribute = Attribute::find($donation_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();

     $other_brand_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'text',
        'label' => 'Other Brand',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);                   
        $attribute = Attribute::find($other_brand_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();

     $price_for_you_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'text',
        'label' => 'Price For You',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);                                              
        $attribute = Attribute::find($price_for_you_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();

     $saleprice_for_you_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'text',
        'label' => 'Sale Price For You',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
                               
        ]);                                                                                  
        $attribute = Attribute::find($saleprice_for_you_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();


     $shoes_size_men_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Shoes Size Men',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);                                 
        $attribute = Attribute::find($shoes_size_men_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();


     $shoes_size_women_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Shoes Size Women',
         'display_order' => '0',
         'required' => '0',
         'created_by' => NULL,'updated_by' => NULL,
         'deleted_at' => NULL,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
          ]);                                                                       
        $attribute = Attribute::find($shoes_size_women_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();

     $shoes_size_kids_id = \DB::table('marketplace_attributes')->insertGetId(
        ['type' => 'select',
        'label' => 'Shoes Size Kids',
        'display_order' => '0',
        'required' => '0',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
   
        ]);                                         
        $attribute = Attribute::find($shoes_size_kids_id);
        $attribute->setProperty('key', $attribute->label);   
        $attribute->save();


     $cloth_size_international_value_id = \DB::table('marketplace_attributes')->insertGetId(
            ['type' => 'select',
             'label' => 'cloth Size International',
             'display_order' => '0',
             'required' => '0',
             'created_by' => NULL,'updated_by' => NULL,
             'deleted_at' => NULL,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now(),
        
             ]);                                          
             $attribute = Attribute::find($cloth_size_international_value_id);
             $attribute->setProperty('key', $attribute->label);   
             $attribute->save();

     $depth_id = \DB::table('marketplace_attributes')->insertGetId(
                ['type' => 'number',
                'label' => 'Depth',
                'display_order' => '0',
                'required' => '0',
                'created_by' => NULL,'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
           
                ]);

                $attribute = Attribute::find($depth_id);
                $attribute->setProperty('key', $attribute->label);   
                $attribute->save();
     $height_id = \DB::table('marketplace_attributes')->insertGetId(
            ['type' => 'number',
            'label' => 'Height',
            'display_order' => '0',
            'required' => '0',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
       
            ]);
            $attribute = Attribute::find($height_id);
            $attribute->setProperty('key', $attribute->label);   
            $attribute->save();                                                    
        $width_id = \DB::table('marketplace_attributes')->insertGetId(
            ['type' => 'number',
            'label' => 'Width',
            'display_order' => '0',
            'required' => '0',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
       
            ]);     
                                    
            $attribute = Attribute::find($width_id);
            $attribute->setProperty('key', $attribute->label);   
            $attribute->save(); 

        \DB::table('marketplace_attribute_options')->insert([
            [ 'attribute_id' => $colour_id,
              'option_order' => '1',
              'option_value' => 'beige',
              'option_display' => 'Beige',
              'created_by' => NULL,'updated_by' => NULL,
              'deleted_at' => NULL,
              
            ], 
            [ 'attribute_id' => $colour_id,
            'option_order' => '2',
            'option_value' => 'black',
            'option_display' => 'Black',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            
        ],
          [ 'attribute_id' => $colour_id,
              'option_order' => '3',
              'option_value' => 'blue',
              'option_display' => 'Blue',
              'created_by' => NULL,'updated_by' => NULL,
              'deleted_at' => NULL,
              
            ], 
        [ 'attribute_id' => $colour_id,
            'option_order' => '4',
            'option_value' => 'brown',
            'option_display' => 'Brown',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            
        ],
          [ 'attribute_id' => $colour_id,
              'option_order' => '5',
              'option_value' => 'camel',
              'option_display' => 'Camel',
              'created_by' => NULL,'updated_by' => NULL,
              'deleted_at' => NULL,
              
            ], 
            [ 'attribute_id' => $colour_id,
            'option_order' => '6',
            'option_value' => 'ecru',
            'option_display' => 'Ecru',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            
        ],
          [ 'attribute_id' => $colour_id,
              'option_order' => '7',
              'option_value' => 'gold',
              'option_display' => 'Gold',
              'created_by' => NULL,'updated_by' => NULL,
              'deleted_at' => NULL,
              
            ], 
        [ 'attribute_id' => $colour_id,
            'option_order' => '8',
            'option_value' => 'green',
            'option_display' => 'Green',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            
        ],
          [ 'attribute_id' => $colour_id,
          'option_order' => '9',
          'option_value' => 'grey',
          'option_display' => 'Grey',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
        [ 'attribute_id' => $colour_id,
        'option_order' => '10',
        'option_value' => 'khaki',
        'option_display' => 'Khaki',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
    ],
      [ 'attribute_id' => $colour_id,
          'option_order' => '11',
          'option_value' => 'metallic',
          'option_display' => 'Metallic',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $colour_id,
        'option_order' => '12',
        'option_value' => 'multicolour',
        'option_display' => 'Multicolour',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
    ],
      [ 'attribute_id' => $colour_id,
      'option_order' => '13',
      'option_value' => 'navy',
      'option_display' => 'Navy',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $colour_id,
    'option_order' => '14',
    'option_value' => 'orange',
    'option_display' => 'Orange',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
],
  [ 'attribute_id' => $colour_id,
      'option_order' => '15',
      'option_value' => 'pink',
      'option_display' => 'Pink',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
[ 'attribute_id' => $colour_id,
    'option_order' => '16',
    'option_value' => 'purple',
    'option_display' => 'Purple',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
],
  [ 'attribute_id' => $colour_id,
  'option_order' => '17',
  'option_value' => 'red',
  'option_display' => 'Red',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
], 
[ 'attribute_id' => $colour_id,
'option_order' => '18',
'option_value' => 'silver',
'option_display' => 'Silver',
'created_by' => NULL,'updated_by' => NULL,
'deleted_at' => NULL,

],
[ 'attribute_id' => $colour_id,
  'option_order' => '19',
  'option_value' => 'white',
  'option_display' => 'White',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
], 
[ 'attribute_id' => $colour_id,
'option_order' => '20',
'option_value' => 'yellow',
'option_display' => 'Yellow',
'created_by' => NULL,'updated_by' => NULL,
'deleted_at' => NULL,

] ,
[ 'attribute_id' => $colour_id,
'option_order' => '21',
'option_value' => 'other',
'option_display' => 'Other',
'created_by' => NULL,'updated_by' => NULL,
'deleted_at' => NULL,

] ,
[ 'attribute_id' => $place_of_purchase_id,
'option_order' => '1',
'option_value' => 'shop',
'option_display' => 'Shop',
'created_by' => NULL,'updated_by' => NULL,
'deleted_at' => NULL,

] ,
[ 'attribute_id' => $place_of_purchase_id,
'option_order' => '2',
'option_value' => 'other',
'option_display' => 'Other',
'created_by' => NULL,'updated_by' => NULL,
'deleted_at' => NULL,

] ,

[ 'attribute_id' => $condition_id,
              'option_order' => '1',
              'option_value' => 'new_tag',
              'option_display' => 'New with tag .   (The item is in perfect condition has never been used and still have the tag on it.)',
              'created_by' => NULL,'updated_by' => NULL,
              'deleted_at' => NULL,
              
            ], 
            [ 'attribute_id' => $condition_id,
            'option_order' => '2',
            'option_value' => 'Very_good_condition',
            'option_display' => 'Very Good Condition.  ( An item in very good condition is a second hand article which has been barely used and shows no defects. The article has unseen signs of us)',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            
        ],
            [ 'attribute_id' => $condition_id,
              'option_order' => '3',
              'option_value' => 'good_condition',
              'option_display' => 'Good Condition.  (An item in good condition is a second hand article which has been used but well maintened. The item has minors signs of defects, this signs of imperfection must be mentioned in the description and show in the pictures.)',
              'created_by' => NULL,'updated_by' => NULL,
              'deleted_at' => NULL,
              
            ],
            [ 'attribute_id' => $condition_id,
            'option_order' => '4',
            'option_value' => 'fair_condition',
            'option_display' => 'Fair condition .  (An item in fair condition is an article has been used frequently and may show imperfections. The item has strongly signs of use. Any imperfections must be mentioned in the description and show in the pictures.)',
            'created_by' => NULL,'updated_by' => NULL,
            'deleted_at' => NULL,
            
          ], 
           
          [ 'attribute_id' => $printed_id,
          'option_order' => '1',
          'option_value' => 'gingham',
          'option_display' => 'Gingham',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
        [ 'attribute_id' => $printed_id,
        'option_order' => '2',
        'option_value' => 'leopard',
        'option_display' => 'Leopard',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
    ],
      [ 'attribute_id' => $printed_id,
          'option_order' => '3',
          'option_value' => 'striped',
          'option_display' => 'Striped',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $printed_id,
        'option_order' => '4',
        'option_value' => 'other',
        'option_display' => 'Other',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
    ],
      [ 'attribute_id' => $donation_id,
          'option_order' => '1',
          'option_value' => '05',
          'option_display' => '05%',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $donation_id,
        'option_order' => '2',
        'option_value' => '10',
        'option_display' => '10%',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $donation_id,
      'option_order' => '3',
      'option_value' => '20',
      'option_display' => '20%',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $donation_id,
    'option_order' => '4',
    'option_value' => '30',
    'option_display' => '30%',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $donation_id,
  'option_order' => '5',
  'option_value' => '40',
  'option_display' => '40%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $donation_id,
  'option_order' => '6',
  'option_value' => '50',
  'option_display' => '50%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $donation_id,
  'option_order' => '7',
  'option_value' => '60',
  'option_display' => '60%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $donation_id,
  'option_order' => '8',
  'option_value' => '70',
  'option_display' => '70%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $donation_id,
  'option_order' => '9',
  'option_value' => '80',
  'option_display' => '80%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $donation_id,
  'option_order' => '10',
  'option_value' => '90',
  'option_display' => '90%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $donation_id,
  'option_order' => '11',
  'option_value' => '100',
  'option_display' => '100%',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],

[ 'attribute_id' => $cloth_size_international_value_id,
          'option_order' => '1',
          'option_value' => 'xxs',
          'option_display' => 'XXS',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $cloth_size_international_value_id,
        'option_order' => '2',
        'option_value' => 'xs',
        'option_display' => 'XS',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $cloth_size_international_value_id,
      'option_order' => '3',
      'option_value' => 's',
      'option_display' => 'S',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $cloth_size_international_value_id,
    'option_order' => '4',
    'option_value' => 'm',
    'option_display' => 'M',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $cloth_size_international_value_id,
  'option_order' => '5',
  'option_value' => 'l',
  'option_display' => 'L',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $cloth_size_international_value_id,
  'option_order' => '6',
  'option_value' => 'xl',
  'option_display' => 'XL',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $cloth_size_international_value_id,
  'option_order' => '7',
  'option_value' => 'xxl',
  'option_display' => 'XXL',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $cloth_size_international_value_id,
  'option_order' => '8',
  'option_value' => 'xxxl',
  'option_display' => 'XXXL',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $cloth_size_international_value_id,
  'option_order' => '9',
  'option_value' => 'xxxxl',
  'option_display' => 'XXXXL',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_men_id,
          'option_order' => '1',
          'option_value' => '40',
          'option_display' => '40',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $shoes_size_men_id,
        'option_order' => '2',
        'option_value' => '41',
        'option_display' => '41',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $shoes_size_men_id,
      'option_order' => '3',
      'option_value' => '42',
      'option_display' => '42',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $shoes_size_men_id,
    'option_order' => '4',
    'option_value' => '43',
    'option_display' => '43',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $shoes_size_men_id,
  'option_order' => '5',
  'option_value' => '44',
  'option_display' => '44',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_men_id,
  'option_order' => '6',
  'option_value' => '45',
  'option_display' => '45',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_men_id,
  'option_order' => '7',
  'option_value' => '46',
  'option_display' => '46',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_men_id,
  'option_order' => '8',
  'option_value' => '47',
  'option_display' => '47',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],

[ 'attribute_id' => $shoes_size_women_id,
          'option_order' => '1',
          'option_value' => '35',
          'option_display' => '35',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $shoes_size_women_id,
        'option_order' => '2',
        'option_value' => '36',
        'option_display' => '36',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $shoes_size_women_id,
      'option_order' => '3',
      'option_value' => '37',
      'option_display' => '37',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $shoes_size_women_id,
    'option_order' => '4',
    'option_value' => '38',
    'option_display' => '38',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $shoes_size_women_id,
  'option_order' => '5',
  'option_value' => '39',
  'option_display' => '39',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_women_id,
  'option_order' => '6',
  'option_value' => '40',
  'option_display' => '40',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_women_id,
  'option_order' => '7',
  'option_value' => '41',
  'option_display' => '41',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_women_id,
  'option_order' => '8',
  'option_value' => '42',
  'option_display' => '42',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_women_id,
  'option_order' => '9',
  'option_value' => '43',
  'option_display' => '43',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
          'option_order' => '1',
          'option_value' => '17',
          'option_display' => '17',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $shoes_size_kids_id,
        'option_order' => '2',
        'option_value' => '18',
        'option_display' => '18',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $shoes_size_kids_id,
      'option_order' => '3',
      'option_value' => '19',
      'option_display' => '19',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $shoes_size_kids_id,
    'option_order' => '4',
    'option_value' => '20',
    'option_display' => '20',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '5',
  'option_value' => '21',
  'option_display' => '21',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '6',
  'option_value' => '22',
  'option_display' => '22',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '7',
  'option_value' => '23',
  'option_display' => '23',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '8',
  'option_value' => '24',
  'option_display' => '24',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '9',
  'option_value' => '25',
  'option_display' => '25',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
          'option_order' => '10',
          'option_value' => '26',
          'option_display' => '26',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $shoes_size_kids_id,
        'option_order' => '11',
        'option_value' => '27',
        'option_display' => '27',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $shoes_size_kids_id,
      'option_order' => '12',
      'option_value' => '28',
      'option_display' => '28',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $shoes_size_kids_id,
    'option_order' => '13',
    'option_value' => '29',
    'option_display' => '29',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '14',
  'option_value' => '30',
  'option_display' => '30',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '15',
  'option_value' => '31',
  'option_display' => '31',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '16',
  'option_value' => '32',
  'option_display' => '32',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $shoes_size_kids_id,
  'option_order' => '17',
  'option_value' => '33',
  'option_display' => '33',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],

[ 'attribute_id' => $material_id,
          'option_order' => '1',
          'option_value' => 'denim_eans',
          'option_display' => 'Denim- Jeans',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $material_id,
        'option_order' => '2',
        'option_value' => 'leathers',
        'option_display' => 'Leathers',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $material_id,
      'option_order' => '3',
      'option_value' => 'fake_fur',
      'option_display' => 'Fake Fur',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $material_id,
    'option_order' => '4',
    'option_value' => 'fur',
    'option_display' => 'Fur',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $material_id,
  'option_order' => '5',
  'option_value' => 'glitter',
  'option_display' => 'Glitter',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
  'option_order' => '6',
  'option_value' => 'linen',
  'option_display' => 'Linen',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
  'option_order' => '7',
  'option_value' => 'lizard',
  'option_display' => 'Lizard',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
  'option_order' => '8',
  'option_value' => 'meta',
  'option_display' => 'Meta',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
  'option_order' => '9',
  'option_value' => 'plastic',
  'option_display' => 'Plastic',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
          'option_order' => '10',
          'option_value' => 'polyester',
          'option_display' => 'Polyester',
          'created_by' => NULL,'updated_by' => NULL,
          'deleted_at' => NULL,
          
        ], 
    [ 'attribute_id' => $material_id,
        'option_order' => '11',
        'option_value' => 'silk',
        'option_display' => 'Silk',
        'created_by' => NULL,'updated_by' => NULL,
        'deleted_at' => NULL,
        
      ],
      [ 'attribute_id' => $material_id,
      'option_order' => '12',
      'option_value' => 'suede',
      'option_display' => 'Suede',
      'created_by' => NULL,'updated_by' => NULL,
      'deleted_at' => NULL,
      
    ], 
    [ 'attribute_id' => $material_id,
    'option_order' => '13',
    'option_value' => 'synthetic',
    'option_display' => 'Synthetic',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $material_id,
  'option_order' => '14',
  'option_value' => 'tweed',
  'option_display' => 'Tweed',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
  'option_order' => '15',
  'option_value' => 'velvet',
  'option_display' => 'Velvet',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
    'option_order' => '16',
    'option_value' => 'wicker',
    'option_display' => 'Wicker',
    'created_by' => NULL,'updated_by' => NULL,
    'deleted_at' => NULL,
    
  ],
  [ 'attribute_id' => $material_id,
  'option_order' => '17',
  'option_value' => 'wool',
  'option_display' => 'Wool',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
],
[ 'attribute_id' => $material_id,
  'option_order' => '18',
  'option_value' => 'other',
  'option_display' => 'Other',
  'created_by' => NULL,'updated_by' => NULL,
  'deleted_at' => NULL,
  
]
            
        ]);
    }
}