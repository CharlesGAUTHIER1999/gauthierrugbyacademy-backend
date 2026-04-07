<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    private array $equipments_images = [
        'equipments-barres' => [
            'barre-curl' => [
                'main' => 'equipments/barres/barrecurl1.jpg',
                'hover' => 'equipments/barres/barrecurl2.jpg',
                'detail' => [
                    'equipments/barres/barrecurl3.jpg',
                ],
            ],
            'barre-olympique-15kg' => [
                'main' => 'equipments/barres/barreolymp15kg1.jpg',
                'hover' => 'equipments/barres/barreolymp15kg2.jpg',
                'detail' => [
                    'equipments/barres/barreolymp15kg3.jpg',
                ],
            ],
            'barre-olympique-20kg' => [
                'main' => 'equipments/barres/barreolymp20kg1.jpg',
                'hover' => 'equipments/barres/barreolymp20kg2.jpg',
                'detail' => [
                    'equipments/barres/barreolymp20kg3.jpg',
                ],
            ],
        ],

        'equipments-calisthenie' => [
            'anneaux-gym' => [
                'main' => 'equipments/calisthenie/anneaux1.png',
                'hover' => 'equipments/calisthenie/anneaux2.png',
                'detail' => [
                    'equipments/calisthenie/anneaux3.jpg',
                ],
            ],
            'parallettes' => [
                'main' => 'equipments/calisthenie/parallettes1.jpg',
                'hover' => 'equipments/calisthenie/parallettes2.jpg',
                'detail' => [
                    'equipments/calisthenie/parallettes3.jpg',
                ],
            ],
            'traction-murale' => [
                'main' => 'equipments/calisthenie/tractions1.jpg',
                'hover' => 'equipments/calisthenie/tractions2.jpg',
                'detail' => [
                    'equipments/calisthenie/tractions3.jpg',
                ],
            ],
        ],

        'equipments-musculation' => [
            'banc' => [
                'main' => 'equipments/musculation/banc1.jpg',
                'hover' => 'equipments/musculation/banc2.jpg',
                'detail' => [
                    'equipments/musculation/banc3.jpg',
                    'equipments/musculation/banc4.jpg',
                ],
            ],
            'disques' => [
                'main' => 'equipments/musculation/disques1.jpg',
                'hover' => 'equipments/musculation/disques2.jpg',
                'detail' => [
                    'equipments/musculation/disques3.jpg',
                ],
            ],
            'hack-squat' => [
                'main' => 'equipments/musculation/hacksquat1.jpg',
                'hover' => 'equipments/musculation/hacksquat2.jpg',
                'detail' => [
                    'equipments/musculation/hacksquat3.jpg',
                    'equipments/musculation/hacksquat4.jpg',
                ],
            ],
            'presse' => [
                'main' => 'equipments/musculation/presse1.jpg',
                'hover' => 'equipments/musculation/presse2.jpg',
                'detail' => [
                    'equipments/musculation/presse3.jpg',
                ],
            ],
        ],

        'equipments-prepa' => [
            'air-bike' => [
                'main' => 'equipments/prepa/airbike1.jpg',
                'hover' => 'equipments/prepa/airbike2.jpg',
                'detail' => [
                    'equipments/prepa/airbike3.jpg',
                    'equipments/prepa/airbike4.jpg',
                ],
            ],
            'rameur' => [
                'main' => 'equipments/prepa/rameur1.jpg',
                'hover' => 'equipments/prepa/rameur2.jpg',
                'detail' => [],
            ],
        ],

        'equipments-mobilite' => [
            'gym-ball' => [
                'main' => 'equipments/mobilite/gymball1.jpg',
                'hover' => 'equipments/mobilite/gymball2.jpg',
                'detail' => [
                    'equipments/mobilite/gymball3.jpg',
                    'equipments/mobilite/gymball4.jpg',
                    'equipments/mobilite/gymball5.jpg',
                    'equipments/mobilite/gymball6.jpg',
                ],
            ],
            'rouleau-massage' => [
                'main' => 'equipments/mobilite/rouleaumassage1.jpg',
                'hover' => 'equipments/mobilite/rouleaumassage2.jpg',
                'detail' => [
                    'equipments/mobilite/rouleaumassage3.jpg',
                    'equipments/mobilite/rouleaumassage4.jpg',
                ],
            ],
            'tapis' => [
                'main' => 'equipments/mobilite/tapis1.jpg',
                'hover' => 'equipments/mobilite/tapis2.jpg',
                'detail' => [
                    'equipments/mobilite/tapis3.jpg',
                    'equipments/mobilite/tapis4.jpg',
                    'equipments/mobilite/tapis5.jpg',
                    'equipments/mobilite/tapis6.jpg',
                ],
            ],
        ],
    ];

    private array $femmes_images = [
        'femmes-accessoires' => [
            'bandeau' => [
                'main'   => 'femmes/accessoires/bandeau1.jpg',
                'hover'  => 'femmes/accessoires/bandeau2.jpg',
                'detail' => [
                    'femmes/accessoires/bandeau3.jpg',
                    'femmes/accessoires/bandeau4.jpg',
                    'femmes/accessoires/bandeau5.jpg',
                ],
            ],
            'gourde' => [
                'main'   => 'femmes/accessoires/gourde1.jpg',
                'hover'  => 'femmes/accessoires/gourde2.jpg',
                'detail' => [
                    'femmes/accessoires/gourde3.jpg',
                    'femmes/accessoires/gourde4.jpg',
                ],
            ],
            'sac' => [
                'main'   => 'femmes/accessoires/sac1.jpg',
                'hover'  => 'femmes/accessoires/sac2.jpg',
                'detail' => [
                    'femmes/accessoires/sac3.jpg',
                    'femmes/accessoires/sac4.jpg',
                    'femmes/accessoires/sac5.jpg',
                    'femmes/accessoires/sac6.jpg',
                    'femmes/accessoires/sac7.jpg',
                    'femmes/accessoires/sac8.jpg',
                    'femmes/accessoires/sac9.jpg',
                ],
            ],
        ],

        'femmes-brassieres' => [
            'confort' => [
                'main'   => 'femmes/brassieres/confort1.jpg',
                'hover'  => 'femmes/brassieres/confort2.jpg',
                'detail' => [
                    'femmes/brassieres/confort3.jpg',
                    'femmes/brassieres/confort4.jpg',
                    'femmes/brassieres/confort5.jpg',
                    'femmes/brassieres/confort6.jpg',
                    'femmes/brassieres/confort7.jpg',
                    'femmes/brassieres/confort8.jpg',
                    'femmes/brassieres/confort9.jpg',
                ],
            ],
            'impact' => [
                'main'   => 'femmes/brassieres/impact1.jpg',
                'hover'  => 'femmes/brassieres/impact2.jpg',
                'detail' => [
                    'femmes/brassieres/impact3.jpg',
                    'femmes/brassieres/impact4.jpg',
                    'femmes/brassieres/impact5.jpg',
                    'femmes/brassieres/impact6.jpg',
                ],
            ],
        ],

        'femmes-joggings' => [
            'confort' => [
                'main'   => 'femmes/joggings/confort1.jpg',
                'hover'  => 'femmes/joggings/confort2.jpg',
                'detail' => [
                    'femmes/joggings/confort3.jpg',
                    'femmes/joggings/confort4.jpg',
                    'femmes/joggings/confort5.jpg',
                    'femmes/joggings/confort6.jpg',
                    'femmes/joggings/confort7.jpg',
                    'femmes/joggings/confort8.jpg',
                    'femmes/joggings/confort9.jpg',
                    'femmes/joggings/confort10.jpg',
                    'femmes/joggings/confort11.jpg',
                    'femmes/joggings/confort12.jpg',
                ],
            ],
            'performance' => [
                'main'   => 'femmes/joggings/performance1.jpg',
                'hover'  => 'femmes/joggings/performance2.jpg',
                'detail' => [
                    'femmes/joggings/performance3.jpg',
                    'femmes/joggings/performance4.jpg',
                    'femmes/joggings/performance5.jpg',
                    'femmes/joggings/performance6.jpg',
                    'femmes/joggings/performance7.jpg',
                    'femmes/joggings/performance8.jpg',
                ],
            ],
            'training' => [
                'main'   => 'femmes/joggings/training1.jpg',
                'hover'  => 'femmes/joggings/training2.jpg',
                'detail' => [
                    'femmes/joggings/training3.jpg',
                    'femmes/joggings/training4.jpg',
                    'femmes/joggings/training5.jpg',
                    'femmes/joggings/training6.jpg',
                    'femmes/joggings/training7.jpg',
                    'femmes/joggings/training8.jpg',
                    'femmes/joggings/training9.jpg',
                    'femmes/joggings/training10.jpg',
                    'femmes/joggings/training11.jpg',
                    'femmes/joggings/training12.jpg',
                    'femmes/joggings/training13.jpg',
                    'femmes/joggings/training14.jpg',
                    'femmes/joggings/training15.jpg',
                    'femmes/joggings/training16.jpg',
                ],
            ],
        ],

        'femmes-leggings' => [
            'performance' => [
                'main'   => 'femmes/leggings/performance1.jpg',
                'hover'  => 'femmes/leggings/performance2.jpg',
                'detail' => [
                    'femmes/leggings/performance3.jpg',
                    'femmes/leggings/performance4.jpg',
                    'femmes/leggings/performance5.jpg',
                    'femmes/leggings/performance6.jpg',
                    'femmes/leggings/performance7.jpg',
                    'femmes/leggings/performance8.jpg',
                    'femmes/leggings/performance9.jpg',
                ],
            ],
            'sculpt' => [
                'main'   => 'femmes/leggings/sculpt1.jpg',
                'hover'  => 'femmes/leggings/sculpt2.jpg',
                'detail' => [
                    'femmes/leggings/sculpt3.jpg',
                    'femmes/leggings/sculpt4.jpg',
                    'femmes/leggings/sculpt5.jpg',
                    'femmes/leggings/sculpt6.jpg',
                    'femmes/leggings/sculpt7.jpg',
                    'femmes/leggings/sculpt8.jpg',
                    'femmes/leggings/sculpt9.jpg',
                    'femmes/leggings/sculpt10.jpg',
                    'femmes/leggings/sculpt11.jpg',
                    'femmes/leggings/sculpt12.jpg',
                ],
            ],
            'seamless' => [
                'main'   => 'femmes/leggings/seamless1.jpg',
                'hover'  => 'femmes/leggings/seamless2.jpg',
                'detail' => [
                    'femmes/leggings/seamless3.jpg',
                    'femmes/leggings/seamless4.jpg',
                    'femmes/leggings/seamless5.jpg',
                    'femmes/leggings/seamless6.jpg',
                    'femmes/leggings/seamless7.jpg',
                    'femmes/leggings/seamless8.jpg',
                    'femmes/leggings/seamless9.jpg',
                    'femmes/leggings/seamless10.jpg',
                    'femmes/leggings/seamless11.jpg',
                    'femmes/leggings/seamless12.jpg',
                    'femmes/leggings/seamless13.jpg',
                    'femmes/leggings/seamless14.jpg',
                    'femmes/leggings/seamless15.jpg',
                ],
            ],
        ],

        'femmes-shorts' => [
            'seamless' => [
                'main'   => 'femmes/shorts/seamless1.jpg',
                'hover'  => 'femmes/shorts/seamless2.jpg',
                'detail' => [
                    'femmes/shorts/seamless3.jpg',
                    'femmes/shorts/seamless4.jpg',
                    'femmes/shorts/seamless5.jpg',
                    'femmes/shorts/seamless6.jpg',
                    'femmes/shorts/seamless7.jpg',
                    'femmes/shorts/seamless8.jpg',
                    'femmes/shorts/seamless9.jpg',
                ],
            ],
            'training' => [
                'main'   => 'femmes/shorts/training1.jpg',
                'hover'  => 'femmes/shorts/training2.jpg',
                'detail' => [
                    'femmes/shorts/training3.jpg',
                    'femmes/shorts/training4.jpg',
                    'femmes/shorts/training5.jpg',
                    'femmes/shorts/training6.jpg',
                    'femmes/shorts/training7.jpg',
                    'femmes/shorts/training8.jpg',
                    'femmes/shorts/training9.jpg',
                ],
            ],
        ],

        'femmes-sweats' => [
            'oversize' => [
                'main'   => 'femmes/sweats/oversize1.jpg',
                'hover'  => 'femmes/sweats/oversize2.jpg',
                'detail' => [
                    'femmes/sweats/oversize3.jpg',
                    'femmes/sweats/oversize4.jpg',
                    'femmes/sweats/oversize5.jpg',
                    'femmes/sweats/oversize6.jpg',
                    'femmes/sweats/oversize7.jpg',
                    'femmes/sweats/oversize8.jpg',
                    'femmes/sweats/oversize9.jpg',
                    'femmes/sweats/oversize10.jpg',
                    'femmes/sweats/oversize11.jpg',
                    'femmes/sweats/oversize12.jpg',
                ],
            ],
            'zippe' => [
                'main'   => 'femmes/sweats/zippe1.jpg',
                'hover'  => 'femmes/sweats/zippe2.jpg',
                'detail' => [
                    'femmes/sweats/zippe3.jpg',
                    'femmes/sweats/zippe4.jpg',
                    'femmes/sweats/zippe5.jpg',
                    'femmes/sweats/zippe6.jpg',
                    'femmes/sweats/zippe7.jpg',
                    'femmes/sweats/zippe8.jpg',
                    'femmes/sweats/zippe9.jpg',
                ],
            ],
        ],

        'femmes-tshirts' => [
            'oversize' => [
                'main'   => 'femmes/tshirts/oversize1.jpg',
                'hover'  => 'femmes/tshirts/oversize2.jpg',
                'detail' => [
                    'femmes/tshirts/oversize3.jpg',
                    'femmes/tshirts/oversize4.jpg',
                    'femmes/tshirts/oversize5.jpg',
                    'femmes/tshirts/oversize6.jpg',
                    'femmes/tshirts/oversize7.jpg',
                    'femmes/tshirts/oversize8.jpg',
                    'femmes/tshirts/oversize9.jpg',
                ],
            ],
            'training' => [
                'main'   => 'femmes/tshirts/training1.jpg',
                'hover'  => 'femmes/tshirts/training2.jpg',
                'detail' => [
                    'femmes/tshirts/training3.jpg',
                    'femmes/tshirts/training4.jpg',
                    'femmes/tshirts/training5.jpg',
                    'femmes/tshirts/training6.jpg',
                ],
            ],
        ],

        'femmes-vestes' => [
            'coupevent' => [
                'main'   => 'femmes/vestes/coupevent1.jpg',
                'hover'  => 'femmes/vestes/coupevent2.jpg',
                'detail' => [
                    'femmes/vestes/coupevent3.jpg',
                    'femmes/vestes/coupevent4.jpg',
                    'femmes/vestes/coupevent5.jpg',
                    'femmes/vestes/coupevent6.jpg',
                ],
            ],
            'training' => [
                'main'   => 'femmes/vestes/training1.jpg',
                'hover'  => 'femmes/vestes/training2.jpg',
                'detail' => [
                    'femmes/vestes/training3.jpg',
                    'femmes/vestes/training4.jpg',
                    'femmes/vestes/training5.jpg',
                    'femmes/vestes/training6.jpg',
                ],
            ],
        ],
    ];

    private array $hommes_images = [
        'hommes-accessoires' => [
            'ceinture' => [
                'main'   => 'hommes/accessoires/ceinture1.jpg',
                'hover'  => 'hommes/accessoires/ceinture2.jpg',
                'detail' => [
                    'hommes/accessoires/ceinture3.jpg',
                ],
            ],
            'gants' => [
                'main'   => 'hommes/accessoires/gants1.jpg',
                'hover'  => 'hommes/accessoires/gants2.jpg',
                'detail' => [],
            ],
            'sac' => [
                'main'   => 'hommes/accessoires/sac1.jpg',
                'hover'  => 'hommes/accessoires/sac2.jpg',
                'detail' => [
                    'hommes/accessoires/sac3.jpg',
                    'hommes/accessoires/sac4.jpg',
                ],
            ],
        ],

        'hommes-pantalons' => [
            'jogging' => [
                'main'   => 'hommes/pantalons/jogging1.jpg',
                'hover'  => 'hommes/pantalons/jogging2.jpg',
                'detail' => [
                    'hommes/pantalons/jogging3.jpg',
                    'hommes/pantalons/jogging4.jpg',
                    'hommes/pantalons/jogging5.jpg',
                    'hommes/pantalons/jogging6.jpg',
                    'hommes/pantalons/jogging7.jpg',
                    'hommes/pantalons/jogging8.jpg',
                    'hommes/pantalons/jogging9.jpg',
                ],
            ],
            'training' => [
                'main'   => 'hommes/pantalons/training1.jpg',
                'hover'  => 'hommes/pantalons/training2.jpg',
                'detail' => [
                    'hommes/pantalons/training3.jpg',
                    'hommes/pantalons/training4.jpg',
                    'hommes/pantalons/training5.jpg',
                    'hommes/pantalons/training6.jpg',
                ],
            ],
        ],

        'hommes-shorts' => [
            'confort' => [
                'main'   => 'hommes/shorts/confort1.jpg',
                'hover'  => 'hommes/shorts/confort2.jpg',
                'detail' => [
                    'hommes/shorts/confort3.jpg',
                    'hommes/shorts/confort4.jpg',
                    'hommes/shorts/confort5.jpg',
                    'hommes/shorts/confort6.jpg',
                    'hommes/shorts/confort7.jpg',
                    'hommes/shorts/confort8.jpg',
                    'hommes/shorts/confort9.jpg',
                ],
            ],
            'training' => [
                'main'   => 'hommes/shorts/training1.jpg',
                'hover'  => 'hommes/shorts/training2.jpg',
                'detail' => [
                    'hommes/shorts/training3.jpg',
                    'hommes/shorts/training4.jpg',
                    'hommes/shorts/training5.jpg',
                    'hommes/shorts/training6.jpg',
                    'hommes/shorts/training7.jpg',
                    'hommes/shorts/training8.jpg',
                    'hommes/shorts/training9.jpg',
                ],
            ],
        ],

        'hommes-sweats' => [
            'oversize' => [
                'main'   => 'hommes/sweats/oversize1.jpg',
                'hover'  => 'hommes/sweats/oversize2.jpg',
                'detail' => [
                    'hommes/sweats/oversize3.jpg',
                    'hommes/sweats/oversize4.jpg',
                    'hommes/sweats/oversize5.jpg',
                    'hommes/sweats/oversize6.jpg',
                    'hommes/sweats/oversize7.jpg',
                    'hommes/sweats/oversize8.jpg',
                    'hommes/sweats/oversize9.jpg',
                ],
            ],
            'zippe' => [
                'main'   => 'hommes/sweats/zippe1.jpg',
                'hover'  => 'hommes/sweats/zippe2.jpg',
                'detail' => [
                    'hommes/sweats/zippe3.jpg',
                    'hommes/sweats/zippe4.jpg',
                    'hommes/sweats/zippe5.jpg',
                    'hommes/sweats/zippe6.jpg',
                    'hommes/sweats/zippe7.jpg',
                    'hommes/sweats/zippe8.jpg',
                    'hommes/sweats/zippe9.jpg',
                ],
            ],
        ],

        'hommes-tshirts' => [
            'oversize' => [
                'main'   => 'hommes/tshirts/noir1.png',
                'hover'  => 'hommes/tshirts/noir2.png',
                'detail' => [
                    'hommes/tshirts/noir3.png',
                ],
            ],
            'training' => [
                'main'   => 'hommes/tshirts/blanc1.png',
                'hover'  => 'hommes/tshirts/blanc2.png',
                'detail' => [
                    'hommes/tshirts/blanc3.png',
                ],
            ],
        ],

        'hommes-vestes' => [
            'coupevent' => [
                'main'   => 'hommes/vestes/coupevent1.jpg',
                'hover'  => 'hommes/vestes/coupevent2.jpg',
                'detail' => [
                    'hommes/vestes/coupevent3.jpg',
                    'hommes/vestes/coupevent4.jpg',
                ],
            ],
            'training' => [
                'main'   => 'hommes/vestes/training1.jpg',
                'hover'  => 'hommes/vestes/training2.jpg',
                'detail' => [
                    'hommes/vestes/training3.jpg',
                    'hommes/vestes/training4.jpg',
                    'hommes/vestes/training5.jpg',
                    'hommes/vestes/training6.jpg',
                    'hommes/vestes/training7.jpg',
                    'hommes/vestes/training8.jpg',
                ],
            ],
        ],
    ];

    private array $nutrition_images = [
        'nutrition-barres' => [
            'hydro' => [
                'main'   => 'nutrition/barres/hydro1.jpg',
                'hover'  => 'nutrition/barres/hydro2.jpg',
                'detail' => [
                    'nutrition/barres/hydro3.jpg',
                ],
            ],
            'iso' => [
                'main'   => 'nutrition/barres/iso1.jpg',
                'hover'  => 'nutrition/barres/iso2.jpg',
                'detail' => [
                    'nutrition/barres/iso3.jpg',
                ],
            ],
        ],
        'nutrition-boissons' => [
            'gel' => [
                'main'   => 'nutrition/boissons/gel1.jpg',
                'hover'  => 'nutrition/boissons/gel2.jpg',
                'detail' => [],
            ],
            'hydra' => [
                'main'   => 'nutrition/boissons/hydra1.jpg',
                'hover'  => 'nutrition/boissons/hydra2.jpg',
                'detail' => [],
            ],
            'vit' => [
                'main'   => 'nutrition/boissons/vit1.jpg',
                'hover'  => 'nutrition/boissons/vit2.jpg',
                'detail' => [],
            ],
        ],
        'nutrition-creatine' => [
            'creaclon250' => [
                'main'   => 'nutrition/creatine/creaclon1.jpg',
                'hover'  => 'nutrition/creatine/creaclon1.jpg',
                'detail' => [],
            ],
            'creaclon500' => [
                'main'   => 'nutrition/creatine/creaclon2.jpg',
                'hover'  => 'nutrition/creatine/creaclon2.jpg',
                'detail' => [],
            ],
            'micropure250' => [
                'main'   => 'nutrition/creatine/micropure250-1.jpg',
                'hover'  => 'nutrition/creatine/micropure250-2.jpg',
                'detail' => [],
            ],
            'micropure500' => [
                'main'   => 'nutrition/creatine/micropure500-1.jpg',
                'hover'  => 'nutrition/creatine/micropure500-2.jpg',
                'detail' => [],
            ],
        ],
        'nutrition-isolats' => [
            'iso2kg' => [
                'main'   => 'nutrition/isolats/iso2kg-1.jpg',
                'hover'  => 'nutrition/isolats/iso2kg-2.jpg',
                'detail' => [
                    'nutrition/isolats/iso2kg-3.jpg',
                ],
            ],
            'iso500' => [
                'main'   => 'nutrition/isolats/iso500-1.jpg',
                'hover'  => 'nutrition/isolats/iso500-2.jpg',
                'detail' => [
                    'nutrition/isolats/iso500-3.jpg',
                ],
            ],
            'iso900' => [
                'main'   => 'nutrition/isolats/iso900-1.jpg',
                'hover'  => 'nutrition/isolats/iso900-2.jpg',
                'detail' => [
                    'nutrition/isolats/iso900-3.jpg',
                ],
            ],
        ],
        'nutrition-proteines-poudre' => [
            'whey2kg' => [
                'main'   => 'nutrition/proteines-poudre/whey2kg-1.jpg',
                'hover'  => 'nutrition/proteines-poudre/whey2kg-2.jpg',
                'detail' => [
                    'nutrition/proteines-poudre/whey2kg-3.jpg',
                ],
            ],
            'whey500' => [
                'main'   => 'nutrition/proteines-poudre/whey500-1.jpg',
                'hover'  => 'nutrition/proteines-poudre/whey500-2.jpg',
                'detail' => [
                    'nutrition/proteines-poudre/whey500-3.jpg',
                ],
            ],
            'whey900' => [
                'main'   => 'nutrition/proteines-poudre/whey900-1.jpg',
                'hover'  => 'nutrition/proteines-poudre/whey900-2.jpg',
                'detail' => [
                    'nutrition/proteines-poudre/whey900-3.jpg',
                ],
            ],
        ],
    ];


    private function customizationConfig(string $name, string $categorySlug): array
    {
        $isCustomizable =
            str_contains($categorySlug, 'tshirts') ||
            str_contains($categorySlug, 'sweats') ||
            str_contains($categorySlug, 'shorts') ||
            str_contains($categorySlug, 'pantalons') ||
            $name === 'Bandeau Training';

        if ($isCustomizable) {
            return [
                'is_customizable' => true,
                'customization_mode' => 'hybrid',
                'allow_text_customization' => true,
                'allow_image_upload' => true,
                'allow_ai_generation' => true,
            ];
        }

        return [
            'is_customizable' => false,
            'customization_mode' => null,
            'allow_text_customization' => false,
            'allow_image_upload' => false,
            'allow_ai_generation' => false,
        ];
    }

    public function run(): void
    {
        $supplier = Supplier::inRandomOrder()->first();
        $vat = 20.0;

        /**
         * Catalogue avec type explicite
         * Format:
         *  $catalogue[root][category_slug] = [ 'Nom Produit' => 'type_key_images' ]
         */
        $catalogue = [
            // ================= FEMMES =================
            'femmes' => [
                'femmes-leggings' => [
                    'Legging Sculpt' => 'sculpt',
                    'Legging Seamless' => 'seamless',
                    'Legging Performance' => 'performance',
                ],
                'femmes-joggings' => [
                    'Jogging Training' => 'training',
                    'Jogging Comfort' => 'confort',
                    'Jogging Performance' => 'performance',
                ],
                'femmes-sweats' => [
                    'Sweat Femme Zippé' => 'zippe',
                    'Sweat Femme Oversize' => 'oversize',
                ],
                'femmes-vestes' => [
                    'Veste Training Femme' => 'training',
                    'Veste Coupe-Vent Femme' => 'coupevent',
                ],
                'femmes-shorts' => [
                    'Short Femme Training' => 'training',
                    'Short Femme Seamless' => 'seamless',
                ],
                'femmes-brassieres' => [
                    'Brassière Impact' => 'impact',
                    'Brassière Confort' => 'confort',
                ],
                'femmes-tshirts' => [
                    'T-shirt Training Femme' => 'training',
                    'T-shirt Oversize Femme' => 'oversize',
                ],
                'femmes-accessoires' => [
                    'Sac de sport Femme' => 'sac',
                    'Gourde Fitness' => 'gourde',
                    'Bandeau Training' => 'bandeau',
                ],
            ],

            // ================= HOMMES =================
            'hommes' => [
                'hommes-pantalons' => [
                    'Pantalon Training' => 'training',
                    'Pantalon Jogging' => 'jogging',
                ],
                'hommes-sweats' => [
                    'Sweat Homme Zippé' => 'zippe',
                    'Sweat Homme Oversize' => 'oversize',
                ],
                'hommes-vestes' => [
                    'Veste Training Homme' => 'training',
                    'Veste Coupe-Vent Homme' => 'coupevent',
                ],
                'hommes-shorts' => [
                    'Short Homme Training' => 'training',
                    'Short Homme Confort' => 'confort',
                ],
                'hommes-tshirts' => [
                    'T-shirt Training Homme' => 'training',
                    'T-shirt Oversize Homme' => 'oversize',
                ],
                'hommes-accessoires' => [
                    'Sac de sport Homme' => 'sac',
                    'Ceinture de musculation' => 'ceinture',
                    'Gants Training' => 'gants',
                ],
            ],

            // ================= NUTRITION =================
            'nutrition' => [
                'nutrition-proteines-poudre' => [
                    'Whey Pure Professionnal 500g' => 'whey500',
                    'Whey Pure Professionnal 900g' => 'whey900',
                    'Whey Pure Professionnal 2 kg' => 'whey2kg',
                ],
                'nutrition-isolats' => [
                    'Isolate Pure Professionnal 500g' => 'iso500',
                    'Isolate Pure Professionnal 900g' => 'iso900',
                    'Isolate Pure Professionnal 2 kg' => 'iso2kg',
                ],
                'nutrition-barres' => [
                    'Hydro Purebar 55g' => 'hydro',
                    'Isolate Purebar 50g' => 'iso',
                ],
                'nutrition-creatine' => [
                    'Creatine Micro Pure Zero Carb 250g' => 'micropure250',
                    'Creatine Micro Pure Zero Carb 500g' => 'micropure500',
                    'Creaclon Micro Pure Pro 250g' => 'creaclon250',
                    'Creaclon Micro Pure Pro 500g' => 'creaclon500',
                ],
                'nutrition-boissons' => [
                    'Hydra Power Gel 60 ml' => 'gel',
                    'Hydra+ Recovery 600g' => 'hydra',
                    'Vitamin Greens & Fruits 300g' => 'vit',
                ],
            ],

            // ================= ÉQUIPEMENTS =================
            'equipments' => [
                'equipments-barres' => [
                    'Barre Olympique 20kg' => 'barre-olympique-20kg',
                    'Barre Olympique 15kg' => 'barre-olympique-15kg',
                    'Barre Curl' => 'barre-curl',
                ],
                'equipments-musculation' => [
                    'Banc de musculation réglable' => 'banc',
                    'Hack Squat Pro' => 'hack-squat',
                    'Presse à jambes' => 'presse',
                    'Disques' => 'disques',
                ],
                'equipments-prepa' => [
                    'Rameur Indoor' => 'rameur',
                    'Air Bike' => 'air-bike',
                ],
                'equipments-calisthenie' => [
                    'Anneaux Gym' => 'anneaux-gym',
                    'Barre de traction murale' => 'traction-murale',
                    'Parallettes' => 'parallettes',
                ],
                'equipments-mobilite' => [
                    'Tapis de sol' => 'tapis',
                    'Rouleau de massage' => 'rouleau-massage',
                    'Gym Ball' => 'gym-ball',
                ],
            ],
        ];

        /**
         * Meta produits: prix TTC + description (simple)
         * (Si un produit manque ici, on tombera sur un fallback.)
         */
        $meta = [
            // ================= FEMMES =================
            'Legging Sculpt' => [
                'price_ttc' => 58.00,
                'description' => "Legging gainant et confortable, conçu pour bien maintenir la taille.\nTissu stretch qui suit tes mouvements et reste en place.\nIdéal pour musculation, fitness et séances du quotidien.",
            ],
            'Legging Seamless' => [
                'price_ttc' => 40.00,
                'description' => "Legging seamless (sans coutures marquées) pour un rendu plus lisse.\nTrès agréable sur la peau, avec une bonne liberté de mouvement.\nParfait pour entraînements et usage quotidien.",
            ],
            'Legging Performance' => [
                'price_ttc' => 55.00,
                'description' => "Legging orienté performance, respirant et résistant.\nMaintien solide pour les séances intenses (jambes, HIIT, cardio).\nCoupe pensée pour bouger sans gêne.",
            ],
            'Jogging Training' => [
                'price_ttc' => 42.00,
                'description' => "Jogging léger pour l’échauffement et les entraînements.\nCoupe confortable, facile à porter, intérieur doux.\nIdéal avant/après séance ou pour chiller.",
            ],
            'Jogging Comfort' => [
                'price_ttc' => 55.00,
                'description' => "Jogging épais et doux, conçu pour un max de confort.\nTaille ajustable et coupe relax pour bouger sans contrainte.\nParfait pour la récup et le quotidien.",
            ],
            'Jogging Performance' => [
                'price_ttc' => 55.00,
                'description' => "Jogging plus technique, pensé pour l’entraînement.\nTissu agréable, bonne tenue et liberté de mouvement.\nParfait pour échauffements, sorties et lifestyle sportif.",
            ],
            'Sweat Femme Zippé' => [
                'price_ttc' => 55.00,
                'description' => "Sweat zippé pratique à enfiler, idéal en superposition.\nChaud mais respirant, parfait avant/après entraînement.\nCoupe confortable pour tous les jours.",
            ],
            'Sweat Femme Oversize' => [
                'price_ttc' => 40.00,
                'description' => "Sweat oversize ultra confortable, style casual.\nTissu doux, parfait pour se réchauffer ou chiller.\nLook ample et moderne, facile à associer.",
            ],
            'Veste Training Femme' => [
                'price_ttc' => 22.00,
                'description' => "Veste légère pour t’entraîner sans surchauffe.\nFacile à porter, protège un peu du vent et du frais.\nParfaite pour l’échauffement ou les sorties rapides.",
            ],
            'Veste Coupe-Vent Femme' => [
                'price_ttc' => 65.00,
                'description' => "Coupe-vent léger pour les séances en extérieur.\nProtège du vent, se transporte facilement et sèche vite.\nIdéal running, marche ou échauffement dehors.",
            ],
            'Short Femme Training' => [
                'price_ttc' => 30.00,
                'description' => "Short simple et efficace pour bouger librement.\nTissu confortable, parfait pour musculation ou cardio.\nBonne tenue, sans gêner les mouvements.",
            ],
            'Short Femme Seamless' => [
                'price_ttc' => 42.00,
                'description' => "Short seamless pour un rendu plus lisse et confortable.\nStretch, agréable sur la peau, idéal pour l’entraînement.\nParfait pour l’été et les séances intenses.",
            ],
            'Brassière Impact' => [
                'price_ttc' => 32.00,
                'description' => "Brassière avec maintien renforcé pour entraînements dynamiques.\nConfortable et stable, idéale cardio/HIIT.\nBon maintien sans trop comprimer.",
            ],
            'Brassière Confort' => [
                'price_ttc' => 32.00,
                'description' => "Brassière douce avec maintien modéré.\nParfaite musculation, fitness, et usage quotidien.\nConfort et liberté de mouvement au centre.",
            ],
            'T-shirt Training Femme' => [
                'price_ttc' => 20.00,
                'description' => "T-shirt léger et respirant pour l’entraînement.\nCoupe simple, agréable à porter, sèche vite.\nParfait pour toutes les séances.",
            ],
            'T-shirt Oversize Femme' => [
                'price_ttc' => 22.00,
                'description' => "T-shirt oversize confortable, style street/sport.\nCoupe ample qui laisse respirer pendant l’effort.\nIdéal training ou look casual.",
            ],
            'Sac de sport Femme' => [
                'price_ttc' => 40.00,
                'description' => "Sac de sport pratique avec assez de place pour tenue et accessoires.\nCompartiments utiles pour t’organiser facilement.\nParfait pour salle, weekend, ou déplacements.",
            ],
            'Gourde Fitness' => [
                'price_ttc' => 16.00,
                'description' => "Gourde simple et pratique pour rester hydratée.\nFacile à transporter et à nettoyer.\nIdéale sport et quotidien.",
            ],
            'Bandeau Training' => [
                'price_ttc' => 17.99,
                'description' => "Bandeau confortable pour garder les cheveux en place.\nAbsorbe la transpiration et améliore le confort.\nParfait pour toutes les séances.",
            ],

            // ================= HOMMES =================
            'Pantalon Training' => [
                'price_ttc' => 45.00,
                'description' => "Pantalon polyvalent pour entraînement et échauffement.\nCoupe confortable, tissu agréable et bonne liberté de mouvement.\nIdéal musculation, cardio, et quotidien.",
            ],
            'Pantalon Jogging' => [
                'price_ttc' => 45.00,
                'description' => "Jogging confortable, parfait avant/après séance.\nTissu doux, coupe relax et facile à porter.\nUn basique pour sport et lifestyle.",
            ],
            'Sweat Homme Zippé' => [
                'price_ttc' => 40.00,
                'description' => "Sweat zippé pratique, parfait en superposition.\nConfortable et chaud, idéal pour les transitions.\nLook simple et efficace.",
            ],
            'Sweat Homme Oversize' => [
                'price_ttc' => 58.00,
                'description' => "Sweat oversize avec un vrai confort au quotidien.\nTissu doux, style casual, facile à associer.\nParfait récup, sorties et chill.",
            ],
            'Veste Training Homme' => [
                'price_ttc' => 40.00,
                'description' => "Veste légère pour s’entraîner sans être gêné.\nBonne liberté de mouvement et confort thermique.\nParfaite échauffement et après séance.",
            ],
            'Veste Coupe-Vent Homme' => [
                'price_ttc' => 70.00,
                'description' => "Coupe-vent léger pour l’extérieur.\nProtège du vent, se porte facilement et sèche vite.\nIdéal running, marche ou échauffement.",
            ],
            'Short Homme Training' => [
                'price_ttc' => 22.00,
                'description' => "Short léger et confortable pour toutes tes séances.\nBonne amplitude pour squats, fentes et cardio.\nBasique efficace pour l’entraînement.",
            ],
            'Short Homme Confort' => [
                'price_ttc' => 40.00,
                'description' => "Short plus épais et doux, axé confort.\nIdéal pour le quotidien, la récup ou training léger.\nCoupe relax et agréable à porter.",
            ],
            'T-shirt Training Homme' => [
                'price_ttc' => 20.00,
                'description' => "T-shirt respirant, agréable pendant l’effort.\nCoupe simple, séchage rapide.\nParfait muscu, cardio et séances intensives.",
            ],
            'T-shirt Oversize Homme' => [
                'price_ttc' => 28.00,
                'description' => "T-shirt oversize style street/sport.\nConfortable, ample et agréable à porter.\nIdéal training ou tenue casual.",
            ],
            'Sac de sport Homme' => [
                'price_ttc' => 40.00,
                'description' => "Sac de sport solide avec bonne capacité.\nPratique pour ranger tenue, chaussures et accessoires.\nParfait salle, weekend et déplacements.",
            ],
            'Ceinture de musculation' => [
                'price_ttc' => 40.00,
                'description' => "Ceinture de maintien pour exercices lourds.\nAide à stabiliser le tronc sur squat, deadlift, etc.\nConfortable et facile à ajuster.",
            ],
            'Gants Training' => [
                'price_ttc' => 30.00,
                'description' => "Gants pour améliorer le grip et protéger les mains.\nRéduit les frottements et la formation de callosités.\nIdéal musculation et tirages.",
            ],

            // ================= NUTRITION =================
            'Whey Pure Professionnal 500g' => [
                'price_ttc' => 49.80,
                'description' => "Protéine whey pour compléter tes apports au quotidien.\nIdéale après l’entraînement ou en collation.\nSe mélange facilement et aide à la récupération.",
            ],
            'Whey Pure Professionnal 900g' => [
                'price_ttc' => 89.80,
                'description' => "Format 900g de whey pour un usage régulier.\nParfaite pour soutenir la prise de muscle et la récupération.\nSimple à intégrer dans ta routine.",
            ],
            'Whey Pure Professionnal 2 kg' => [
                'price_ttc' => 169.80,
                'description' => "Grand format 2 kg pour une utilisation longue durée.\nIdéal si tu consommes de la whey plusieurs fois par semaine.\nPratique et économique à l’usage.",
            ],
            'Isolate Pure Professionnal 500g' => [
                'price_ttc' => 69.80,
                'description' => "Isolate : une whey plus filtrée, plus légère à digérer.\nTrès pratique si tu veux limiter sucres/lipides.\nIdéal après séance ou en collation.",
            ],
            'Isolate Pure Professionnal 900g' => [
                'price_ttc' => 129.80,
                'description' => "Isolate en format 900g pour un usage fréquent.\nProtéine plus “clean” pour optimiser tes apports.\nParfait en sèche ou en maintien.",
            ],
            'Isolate Pure Professionnal 2 kg' => [
                'price_ttc' => 219.80,
                'description' => "Isolate 2 kg pour une routine longue durée.\nIdéal pour les gros consommateurs ou objectifs exigeants.\nPratique et simple à doser au quotidien.",
            ],
            'Hydro Purebar 55g' => [
                'price_ttc' => 5.01,
                'description' => "Barre protéinée pratique à emporter.\nIdéale en collation ou après l’entraînement.\nUn snack simple pour compléter tes apports.",
            ],
            'Isolate Purebar 50g' => [
                'price_ttc' => 4.55,
                'description' => "Barre protéinée légère et pratique.\nParfaite quand tu veux une collation rapide.\nIdéale au bureau, en déplacement ou après séance.",
            ],
            'Creatine Micro Pure Zero Carb 250g' => [
                'price_ttc' => 43.80,
                'description' => "Créatine pour améliorer performance et force sur efforts courts.\nAide à progresser sur séries lourdes et explosivité.\nÀ prendre régulièrement pour de meilleurs résultats.",
            ],
            'Creatine Micro Pure Zero Carb 500g' => [
                'price_ttc' => 79.01,
                'description' => "Créatine en plus grand format, idéale sur la durée.\nSoutient la performance, la force et la progression.\nSimple à intégrer dans ta routine quotidienne.",
            ],
            'Creaclon Micro Pure Pro 250g' => [
                'price_ttc' => 55.80,
                'description' => "Formule créatine pour soutenir puissance et intensité.\nAide à pousser plus fort et à mieux récupérer entre séries.\nIdéal musculation et sports explosifs.",
            ],
            'Creaclon Micro Pure Pro 500g' => [
                'price_ttc' => 99.80,
                'description' => "Format 500g pour une utilisation régulière.\nPensé pour soutenir la performance et la progression.\nParfait si tu t’entraînes plusieurs fois par semaine.",
            ],
            'Hydra Power Gel 60 ml' => [
                'price_ttc' => 3.80,
                'description' => "Gel pratique pour un coup de boost rapide.\nIdéal avant ou pendant un effort intense.\nFacile à emporter et à consommer.",
            ],
            'Hydra+ Recovery 600g' => [
                'price_ttc' => 65.80,
                'description' => "Boisson de récupération pour après l’effort.\nAide à se réhydrater et à mieux repartir.\nIdéal après séances intenses ou longues.",
            ],
            'Vitamin Greens & Fruits 300g' => [
                'price_ttc' => 59.80,
                'description' => "Mix “greens & fruits” pour compléter ton alimentation.\nPratique si tu veux ajouter vitamines/nutriments au quotidien.\nSimple à prendre dans un shaker ou un smoothie.",
            ],

            // ================= ÉQUIPEMENTS =================
            'Barre Olympique 20kg' => [
                'price_ttc' => 99.00,
                'description' => "Barre standard 20 kg pour haltérophilie et force.\nBonne prise en main et stabilité pour les charges lourdes.\nIdéale squat, deadlift et développé couché.",
            ],
            'Barre Olympique 15kg' => [
                'price_ttc' => 99.00,
                'description' => "Version 15 kg plus légère, idéale pour progresser.\nRotation fluide pour mouvements dynamiques.\nParfaite technique, WOD et gabarits plus légers.",
            ],
            'Barre Curl' => [
                'price_ttc' => 95.00,
                'description' => "Barre EZ pour réduire la tension sur les poignets.\nParfaite pour curls biceps, triceps et rowing bras.\nTrès bon contrôle pour l’isolation.",
            ],
            'Banc de musculation réglable' => [
                'price_ttc' => 219.99,
                'description' => "Banc stable avec dossier réglable (plat/incliné/décliné).\nIdéal pour développé, haltères et exercices accessoires.\nUn indispensable polyvalent pour home-gym.",
            ],
            'Hack Squat Pro' => [
                'price_ttc' => 1499.00,
                'description' => "Machine guidée pour travailler les jambes en sécurité.\nCible surtout quadriceps et fessiers avec trajectoire contrôlée.\nParfaite pour charger lourd sans trop de stress lombaire.",
            ],
            'Presse à jambes' => [
                'price_ttc' => 1499.00,
                'description' => "Presse robuste pour un gros travail des jambes.\nPermet volume et intensité avec stabilité maximale.\nExcellent pour quadriceps, ischios et fessiers.",
            ],
            'Disques' => [
                'price_ttc' => 256.00,
                'description' => "Disques de musculation pour progresser en charge.\nSolides et pratiques pour home-gym.\nParfaits force et hypertrophie.",
            ],
            'Rameur Indoor' => [
                'price_ttc' => 1015.00,
                'description' => "Cardio complet (jambes, dos, bras) et gros travail d’endurance.\nIdéal HIIT ou sessions longues.\nExcellent pour brûler des calories efficacement.",
            ],
            'Air Bike' => [
                'price_ttc' => 899.99,
                'description' => "Cardio très intense : plus tu pousses, plus ça résiste.\nParfait pour intervalles, conditioning et WOD.\nZéro impact, efficacité maximale.",
            ],
            'Anneaux Gym' => [
                'price_ttc' => 57.99,
                'description' => "Anneaux pour dips, rows, holds et travail de contrôle.\nInstabilité = gainage et force.\nProgressif et ultra complet au poids du corps.",
            ],
            'Barre de traction murale' => [
                'price_ttc' => 59.90,
                'description' => "Barre murale robuste pour tractions et variantes.\nPermet aussi exercices d’abdos suspendus.\nIndispensable pour le calisthenics.",
            ],
            'Parallettes' => [
                'price_ttc' => 59.99,
                'description' => "Parallettes pour pompes, L-sit et handstand.\nMeilleure amplitude et plus de confort aux poignets.\nParfait pour technique et renforcement.",
            ],
            'Tapis de sol' => [
                'price_ttc' => 29.99,
                'description' => "Tapis confortable avec bon grip.\nIdéal stretching, abdos, mobilité et yoga.\nProtège le sol et se roule facilement.",
            ],
            'Rouleau de massage' => [
                'price_ttc' => 14.99,
                'description' => "Rouleau simple pour relâcher les tensions musculaires.\nAide la récupération et la mobilité.\nParfait après jambes, dos ou séances intenses.",
            ],
            'Gym Ball' => [
                'price_ttc' => 31.99,
                'description' => "Gym ball pour renfo core, posture et mobilité.\nSuper pour gainage instable et exercices doux.\nPolyvalente et facile à intégrer à tes séances.",
            ],
        ];

        foreach ($catalogue as $root => $categories) {
            foreach ($categories as $category_slug => $products) {

                $category = Category::where('slug', $category_slug)->first();
                if (!$category) continue;

                $images_map = match ($root) {
                    'equipments' => $this->equipments_images,
                    'femmes'     => $this->femmes_images,
                    'hommes'     => $this->hommes_images,
                    'nutrition'  => $this->nutrition_images,
                    default      => [],
                };

                foreach ($products as $name => $product_type) {

                    $productMeta = $meta[$name] ?? null;
                    $priceTtc = $productMeta['price_ttc'] ?? (rand(2000, 15000) / 100);
                    $description = $productMeta['description'] ?? "Description détaillée de $name.";

                    $priceHt = round($priceTtc / (1 + $vat / 100), 2);
                    $customization = $this->customizationConfig($name, $category_slug);
                    $product = Product::create([
                        'supplier_id' => $supplier->id,
                        'name' => $name,
                        'slug' => Str::slug($name) . '-' . rand(100, 999),
                        'description' => $description,
                        'price_ht' => $priceHt,
                        'price_ttc' => $priceTtc,
                        'vat' => $vat,
                        'sku' => strtoupper(Str::slug($name)) . '-' . rand(1000, 9999),
                        'attributes' => null,
                        'is_active' => true,
                        'is_customizable' => $customization['is_customizable'],
                        'customization_mode' => $customization['customization_mode'],
                        'allow_text_customization' => $customization['allow_text_customization'],
                        'allow_image_upload' => $customization['allow_image_upload'],
                        'allow_ai_generation' => $customization['allow_ai_generation'],
                    ]);

                    $product->categories()->attach($category->id);

                    $images = $images_map[$category_slug][$product_type] ?? null;
                    if (!$images) {
                        continue;
                    }

                    $gallery = array_values(array_unique(array_filter(array_merge(
                        [$images['main'] ?? null, $images['hover'] ?? null],
                        $images['detail'] ?? []
                    ))));

                    foreach ($gallery as $i => $path) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'url'        => 'products/' . $path,
                            'is_main'    => $i === 0,
                            'position'   => $i,
                        ]);
                    }
                }
            }
        }
    }
}
