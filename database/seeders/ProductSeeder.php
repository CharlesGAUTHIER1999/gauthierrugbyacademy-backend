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
        'femmes-pantalons' => [
            'classic' => [
                'main'   => 'femmes/pantalons/classic0.png',
                'hover'  => 'femmes/pantalons/classic1.png',
                'detail' => [
                    'femmes/pantalons/classic2.png',
                    'femmes/pantalons/classic3.png',
                    'femmes/pantalons/classic4.png',
                    'femmes/pantalons/classic5.png',
                    'femmes/pantalons/classic6.png',
                    'femmes/pantalons/classic7.png',
                    'femmes/pantalons/classic8.png',
                    'femmes/pantalons/classic9.png',
                    'femmes/pantalons/classic10.png',
                    'femmes/pantalons/classic11.png',
                ],
            ],
            'training' => [
                'main'   => 'femmes/pantalons/training0.png',
                'hover'  => 'femmes/pantalons/training1.png',
                'detail' => [
                    'femmes/pantalons/training2.png',
                    'femmes/pantalons/training3.png',
                    'femmes/pantalons/training4.png',
                    'femmes/pantalons/training5.png',
                    'femmes/pantalons/training6.png',
                    'femmes/pantalons/training7.png',
                    'femmes/pantalons/training8.png',
                ],
            ],
        ],

        'femmes-sweats' => [
            'classic' => [
                'main'   => 'femmes/sweats/classic0.png',
                'hover'  => 'femmes/sweats/classic1.png',
                'detail' => [
                    'femmes/sweats/classic2.png',
                    'femmes/sweats/classic3.png',
                    'femmes/sweats/classic4.png',
                    'femmes/sweats/classic5.png',
                    'femmes/sweats/classic6.png',
                    'femmes/sweats/classic7.png',
                    'femmes/sweats/classic8.png',
                ],
            ],
            'zippe' => [
                'main'   => 'femmes/sweats/zippe0.png',
                'hover'  => 'femmes/sweats/zippe1.png',
                'detail' => [
                    'femmes/sweats/zippe2.png',
                    'femmes/sweats/zippe3.png',
                    'femmes/sweats/zippe4.png',
                    'femmes/sweats/zippe5.png',
                    'femmes/sweats/zippe6.png',
                    'femmes/sweats/zippe7.png',
                    'femmes/sweats/zippe8.png',
                ],
            ],
        ],

        'femmes-tshirts' => [
            'oversize' => [
                'main'   => 'femmes/tshirts/oversize0.png',
                'hover'  => 'femmes/tshirts/oversize1.png',
                'detail' => [
                    'femmes/tshirts/oversize2.png',
                    'femmes/tshirts/oversize3.png',
                    'femmes/tshirts/oversize4.png',
                    'femmes/tshirts/oversize5.png',
                    'femmes/tshirts/oversize6.png',
                    'femmes/tshirts/oversize7.png',
                    'femmes/tshirts/oversize8.png',
                    'femmes/tshirts/oversize9.png',
                    'femmes/tshirts/oversize10.png',
                    'femmes/tshirts/oversize11.png',
                ],
            ],
            'training' => [
                'main'   => 'femmes/tshirts/training0.png',
                'hover'  => 'femmes/tshirts/training1.png',
                'detail' => [
                    'femmes/tshirts/training2.png',
                    'femmes/tshirts/training3.png',
                    'femmes/tshirts/training4.png',
                    'femmes/tshirts/training5.png',
                    'femmes/tshirts/training6.png',
                    'femmes/tshirts/training7.png',
                    'femmes/tshirts/training8.png',
                    'femmes/tshirts/training9.png',
                    'femmes/tshirts/training10.png',
                    'femmes/tshirts/training11.png',
                ],
            ],
        ],

        'femmes-vestes' => [
            'classic' => [
                'main'   => 'femmes/vestes/classic0.png',
                'hover'  => 'femmes/vestes/classic1.png',
                'detail' => [
                    'femmes/vestes/classic2.png',
                    'femmes/vestes/classic3.png',
                    'femmes/vestes/classic4.png',
                    'femmes/vestes/classic5.png',
                    'femmes/vestes/classic6.png',
                    'femmes/vestes/classic7.png',
                    'femmes/vestes/classic8.png',
                    'femmes/vestes/classic9.png',
                    'femmes/vestes/classic10.png',
                    'femmes/vestes/classic11.png',
                ],
            ],
            'coupevent' => [
                'main'   => 'femmes/vestes/coupevent0.png',
                'hover'  => 'femmes/vestes/coupevent1.png',
                'detail' => [
                    'femmes/vestes/coupevent2.png',
                    'femmes/vestes/coupevent3.png',
                    'femmes/vestes/coupevent4.png',
                    'femmes/vestes/coupevent5.png',
                    'femmes/vestes/coupevent6.png',
                    'femmes/vestes/coupevent7.png',
                    'femmes/vestes/coupevent8.png',
                ],
            ],
        ],
    ];

    private array $hommes_images = [
        'hommes-pantalons' => [
            'classic' => [
                'main'   => 'hommes/pantalons/classic0.png',
                'hover'  => 'hommes/pantalons/classic1.png',
                'detail' => [
                    'hommes/pantalons/classic2.png',
                    'hommes/pantalons/classic3.png',
                    'hommes/pantalons/classic4.png',
                    'hommes/pantalons/classic5.png',
                    'hommes/pantalons/classic6.png',
                    'hommes/pantalons/classic7.png',
                    'hommes/pantalons/classic8.png',
                    'hommes/pantalons/classic9.png',
                    'hommes/pantalons/classic10.png',
                    'hommes/pantalons/classic11.png',
                ],
            ],
            'training' => [
                'main'   => 'hommes/pantalons/training0.png',
                'hover'  => 'hommes/pantalons/training1.png',
                'detail' => [
                    'hommes/pantalons/training2.png',
                    'hommes/pantalons/training3.png',
                    'hommes/pantalons/training4.png',
                    'hommes/pantalons/training5.png',
                    'hommes/pantalons/training6.png',
                    'hommes/pantalons/training7.png',
                    'hommes/pantalons/training8.png',
                ],
            ],
        ],

        'hommes-sweats' => [
            'classic' => [
                'main'   => 'hommes/sweats/classic0.png',
                'hover'  => 'hommes/sweats/classic1.png',
                'detail' => [
                    'hommes/sweats/classic2.png',
                    'hommes/sweats/classic3.png',
                    'hommes/sweats/classic4.png',
                    'hommes/sweats/classic5.png',
                    'hommes/sweats/classic6.png',
                    'hommes/sweats/classic7.png',
                    'hommes/sweats/classic8.png',
                ],
            ],
            'zippe' => [
                'main'   => 'hommes/sweats/zippe0.png',
                'hover'  => 'hommes/sweats/zippe1.png',
                'detail' => [
                    'hommes/sweats/zippe2.png',
                    'hommes/sweats/zippe3.png',
                    'hommes/sweats/zippe4.png',
                    'hommes/sweats/zippe5.png',
                    'hommes/sweats/zippe6.png',
                    'hommes/sweats/zippe7.png',
                    'hommes/sweats/zippe8.png',
                ],
            ],
        ],

        'hommes-tshirts' => [
            'oversize' => [
                'main'   => 'hommes/tshirts/oversize0.png',
                'hover'  => 'hommes/tshirts/oversize1.png',
                'detail' => [
                    'hommes/tshirts/oversize2.png',
                    'hommes/tshirts/oversize3.png',
                    'hommes/tshirts/oversize4.png',
                    'hommes/tshirts/oversize5.png',
                    'hommes/tshirts/oversize6.png',
                    'hommes/tshirts/oversize7.png',
                    'hommes/tshirts/oversize8.png',
                    'hommes/tshirts/oversize9.png',
                    'hommes/tshirts/oversize10.png',
                    'hommes/tshirts/oversize11.png',
                ],
            ],
            'training' => [
                'main'   => 'hommes/tshirts/training0.png',
                'hover'  => 'hommes/tshirts/training1.png',
                'detail' => [
                    'hommes/tshirts/training2.png',
                    'hommes/tshirts/training3.png',
                    'hommes/tshirts/training4.png',
                    'hommes/tshirts/training5.png',
                    'hommes/tshirts/training6.png',
                    'hommes/tshirts/training7.png',
                    'hommes/tshirts/training8.png',
                    'hommes/tshirts/training9.png',
                    'hommes/tshirts/training10.png',
                    'hommes/tshirts/training11.png',
                ],
            ],
        ],

        'hommes-vestes' => [
            'classic' => [
                'main'   => 'hommes/vestes/classic0.png',
                'hover'  => 'hommes/vestes/classic1.png',
                'detail' => [
                    'hommes/vestes/classic2.png',
                    'hommes/vestes/classic3.png',
                    'hommes/vestes/classic4.png',
                    'hommes/vestes/classic5.png',
                    'hommes/vestes/classic6.png',
                    'hommes/vestes/classic7.png',
                    'hommes/vestes/classic8.png',
                    'hommes/vestes/classic9.png',
                    'hommes/vestes/classic10.png',
                    'hommes/vestes/classic11.png',
                ],
            ],
            'coupevent' => [
                'main'   => 'hommes/vestes/coupevent0.png',
                'hover'  => 'hommes/vestes/coupevent1.png',
                'detail' => [
                    'hommes/vestes/coupevent2.png',
                    'hommes/vestes/coupevent3.png',
                    'hommes/vestes/coupevent4.png',
                    'hommes/vestes/coupevent5.png',
                    'hommes/vestes/coupevent6.png',
                    'hommes/vestes/coupevent7.png',
                    'hommes/vestes/coupevent8.png',
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

    private function customizationConfig(string $categorySlug): array
    {
        $isCustomizable =
            str_contains($categorySlug, 'sweats') ||
            str_contains($categorySlug, 'tshirts') ||
            str_contains($categorySlug, 'vestes');

        if ($isCustomizable) {
            return [
                'is_customizable' => true,
                'customization_mode' => '3d',
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

        $catalogue = [
            'femmes' => [
                'femmes-pantalons' => [
                    'Pantalon Classic' => 'classic',
                    'Pantalon Training' => 'training',
                ],
                'femmes-sweats' => [
                    'Sweat Classic' => 'classic',
                    'Sweat Zippe' => 'zippe',
                ],
                'femmes-tshirts' => [
                    'T-shirt Oversize' => 'oversize',
                    'T-shirt Training' => 'training',
                ],
                'femmes-vestes' => [
                    'Veste Classic' => 'classic',
                    'Veste Coupe-Vent' => 'coupevent',
                ],
            ],

            'hommes' => [
                'hommes-pantalons' => [
                    'Pantalon Classic' => 'classic',
                    'Pantalon Training' => 'training',
                ],
                'hommes-sweats' => [
                    'Sweat Classic' => 'classic',
                    'Sweat Zippe' => 'zippe',
                ],
                'hommes-tshirts' => [
                    'T-shirt Oversize' => 'oversize',
                    'T-shirt Training' => 'training',
                ],
                'hommes-vestes' => [
                    'Veste Classic' => 'classic',
                    'Veste Coupe-Vent' => 'coupevent',
                ],
            ],

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

        $meta = [
            'Pantalon Classic' => [
                'price_ttc' => 45.00,
                'description' => "Survêtement confortable, parfait avant/après séance.\nTissu doux, coupe relax et facile à porter.\nUn basique pour sport et lifestyle.",
            ],
            'Pantalon Training' => [
                'price_ttc' => 45.00,
                'description' => "Pantalon polyvalent pour entraînement et échauffement.\nCoupe confortable, tissu agréable et bonne liberté de mouvement.\nIdéal musculation, cardio, et quotidien.",
            ],
            'Sweat Classic' => [
                'price_ttc' => 58.00,
                'description' => "Sweat classique avec un vrai confort au quotidien.\nTissu doux, style casual, facile à associer.\nParfait récup, sorties et chill.",
            ],
            'Sweat Zippe' => [
                'price_ttc' => 40.00,
                'description' => "Sweat zippé pratique, parfait en superposition.\nConfortable et chaud, idéal pour les transitions.\nLook simple et efficace.",
            ],
            'T-shirt Oversize' => [
                'price_ttc' => 28.00,
                'description' => "T-shirt oversize style street/sport.\nConfortable, ample et agréable à porter.\nIdéal training ou tenue casual.",
            ],
            'T-shirt Training' => [
                'price_ttc' => 20.00,
                'description' => "T-shirt respirant, agréable pendant l’effort.\nCoupe simple, séchage rapide.\nParfait muscu, cardio et séances intensives.",
            ],
            'Veste Classic' => [
                'price_ttc' => 40.00,
                'description' => "Veste légère pour s’entraîner sans être gêné.\nBonne liberté de mouvement et confort thermique.\nParfaite échauffement et après séance.",
            ],
            'Veste Coupe-Vent' => [
                'price_ttc' => 70.00,
                'description' => "Coupe-vent léger pour l’extérieur.\nProtège du vent, se porte facilement et sèche vite.\nIdéal running, marche ou échauffement.",
            ],

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
            foreach ($categories as $categorySlug => $products) {
                $category = Category::where('slug', $categorySlug)->first();
                if (!$category) {
                    continue;
                }

                $imagesMap = match ($root) {
                    'equipments' => $this->equipments_images,
                    'femmes' => $this->femmes_images,
                    'hommes' => $this->hommes_images,
                    'nutrition' => $this->nutrition_images,
                    default => [],
                };

                foreach ($products as $name => $productType) {
                    $productMeta = $meta[$name] ?? null;
                    $priceTtc = $productMeta['price_ttc'] ?? (rand(2000, 15000) / 100);
                    $description = $productMeta['description'] ?? "Description détaillée de $name.";
                    $priceHt = round($priceTtc / (1 + $vat / 100), 2);
                    $customization = $this->customizationConfig($categorySlug);

                    $product = Product::create([
                        'supplier_id' => $supplier->id,
                        'name' => $name,
                        'slug' => Str::slug($categorySlug . '-' . $name) . '-' . rand(100, 999),
                        'description' => $description,
                        'price_ht' => $priceHt,
                        'price_ttc' => $priceTtc,
                        'vat' => $vat,
                        'sku' => substr(strtoupper(Str::slug($name)), 0, 70) . '-' . rand(1000, 9999),
                        'attributes' => null,
                        'is_active' => true,
                        'is_customizable' => $customization['is_customizable'],
                        'customization_mode' => $customization['customization_mode'],
                        'allow_text_customization' => $customization['allow_text_customization'],
                        'allow_image_upload' => $customization['allow_image_upload'],
                        'allow_ai_generation' => $customization['allow_ai_generation'],
                    ]);

                    $product->categories()->attach($category->id);

                    $images = $imagesMap[$categorySlug][$productType] ?? null;
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