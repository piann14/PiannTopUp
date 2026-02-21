<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Product;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===================== GAMES =====================
        $games = [
            [
                'name' => 'Mobile Legends',
                'slug' => 'mobile-legends',
                'description' => 'MOBA game terpopuler di Asia Tenggara. Top up Diamond untuk membeli skin dan hero favorit!',
                'category' => 'mobile',
                'publisher' => 'Moonton',
                'is_featured' => true,
                'sort_order' => 1,
                'products' => [
                    ['name' => '14 Diamonds', 'amount' => 14, 'unit' => 'Diamond', 'price' => 3000, 'original_price' => 3500],
                    ['name' => '56 Diamonds', 'amount' => 56, 'unit' => 'Diamond', 'price' => 11000, 'original_price' => 13000],
                    ['name' => '86 Diamonds', 'amount' => 86, 'unit' => 'Diamond', 'price' => 15000, 'original_price' => 18000],
                    ['name' => '172 Diamonds', 'amount' => 172, 'unit' => 'Diamond', 'price' => 29000, 'original_price' => 34000],
                    ['name' => '257 Diamonds', 'amount' => 257, 'unit' => 'Diamond', 'price' => 43000, 'original_price' => 50000, 'is_popular' => true],
                    ['name' => '344 Diamonds', 'amount' => 344, 'unit' => 'Diamond', 'price' => 58000, 'original_price' => 68000],
                    ['name' => '429 Diamonds', 'amount' => 429, 'unit' => 'Diamond', 'price' => 72000, 'original_price' => 85000],
                    ['name' => '514 Diamonds', 'amount' => 514, 'unit' => 'Diamond', 'price' => 85000, 'original_price' => 100000],
                    ['name' => '600 Diamonds', 'amount' => 600, 'unit' => 'Diamond', 'price' => 99000, 'original_price' => 117000, 'is_popular' => true],
                    ['name' => '1000 Diamonds', 'amount' => 1000, 'unit' => 'Diamond', 'price' => 165000, 'original_price' => 195000],
                    ['name' => '2000 Diamonds', 'amount' => 2000, 'unit' => 'Diamond', 'price' => 325000, 'original_price' => 385000],
                    ['name' => '3000 Diamonds', 'amount' => 3000, 'unit' => 'Diamond', 'price' => 480000, 'original_price' => 570000],
                ],
            ],
            [
                'name' => 'PUBG Mobile',
                'slug' => 'pubg-mobile',
                'description' => 'Battle Royale terbaik di mobile. Top up UC untuk membeli Royal Pass dan item eksklusif!',
                'category' => 'mobile',
                'publisher' => 'Krafton',
                'is_featured' => true,
                'sort_order' => 2,
                'products' => [
                    ['name' => '60 UC', 'amount' => 60, 'unit' => 'UC', 'price' => 15000, 'original_price' => 18000],
                    ['name' => '180 UC', 'amount' => 180, 'unit' => 'UC', 'price' => 43000, 'original_price' => 52000],
                    ['name' => '325 UC', 'amount' => 325, 'unit' => 'UC', 'price' => 75000, 'original_price' => 90000, 'is_popular' => true],
                    ['name' => '660 UC', 'amount' => 660, 'unit' => 'UC', 'price' => 150000, 'original_price' => 180000],
                    ['name' => '1800 UC', 'amount' => 1800, 'unit' => 'UC', 'price' => 390000, 'original_price' => 470000, 'is_popular' => true],
                    ['name' => '3850 UC', 'amount' => 3850, 'unit' => 'UC', 'price' => 750000, 'original_price' => 900000],
                ],
            ],
            [
                'name' => 'Free Fire',
                'slug' => 'free-fire',
                'description' => 'Battle Royale #1 di Asia. Top up Diamond untuk karakter, bundle, dan pet terbaru!',
                'category' => 'mobile',
                'publisher' => 'Garena',
                'is_featured' => true,
                'sort_order' => 3,
                'products' => [
                    ['name' => '50 Diamonds', 'amount' => 50, 'unit' => 'Diamond', 'price' => 8000, 'original_price' => 9500],
                    ['name' => '100 Diamonds', 'amount' => 100, 'unit' => 'Diamond', 'price' => 15000, 'original_price' => 18000],
                    ['name' => '200 Diamonds', 'amount' => 200, 'unit' => 'Diamond', 'price' => 28000, 'original_price' => 33000],
                    ['name' => '310 Diamonds', 'amount' => 310, 'unit' => 'Diamond', 'price' => 43000, 'original_price' => 51000, 'is_popular' => true],
                    ['name' => '520 Diamonds', 'amount' => 520, 'unit' => 'Diamond', 'price' => 72000, 'original_price' => 85000],
                    ['name' => '1060 Diamonds', 'amount' => 1060, 'unit' => 'Diamond', 'price' => 145000, 'original_price' => 175000, 'is_popular' => true],
                    ['name' => '2180 Diamonds', 'amount' => 2180, 'unit' => 'Diamond', 'price' => 290000, 'original_price' => 350000],
                ],
            ],
            [
                'name' => 'Genshin Impact',
                'slug' => 'genshin-impact',
                'description' => 'Open-world RPG terbaik. Top up Genesis Crystal untuk mendapatkan karakter dan senjata langka!',
                'category' => 'mobile',
                'publisher' => 'HoYoverse',
                'is_featured' => true,
                'sort_order' => 4,
                'products' => [
                    ['name' => '60 Genesis Crystals', 'amount' => 60, 'unit' => 'Crystal', 'price' => 15000, 'original_price' => 18000],
                    ['name' => '300 Genesis Crystals', 'amount' => 300, 'unit' => 'Crystal', 'price' => 75000, 'original_price' => 90000, 'is_popular' => true],
                    ['name' => '980 Genesis Crystals', 'amount' => 980, 'unit' => 'Crystal', 'price' => 245000, 'original_price' => 295000],
                    ['name' => '1980 Genesis Crystals', 'amount' => 1980, 'unit' => 'Crystal', 'price' => 490000, 'original_price' => 590000, 'is_popular' => true],
                    ['name' => '3280 Genesis Crystals', 'amount' => 3280, 'unit' => 'Crystal', 'price' => 790000, 'original_price' => 950000],
                    ['name' => '6480 Genesis Crystals', 'amount' => 6480, 'unit' => 'Crystal', 'price' => 1575000, 'original_price' => 1900000],
                ],
            ],
            [
                'name' => 'Honkai: Star Rail',
                'slug' => 'honkai-star-rail',
                'description' => 'RPG turn-based terbaru dari HoYoverse. Top up Oneiric Shard untuk gacha karakter terkuat!',
                'category' => 'mobile',
                'publisher' => 'HoYoverse',
                'is_featured' => true,
                'sort_order' => 5,
                'products' => [
                    ['name' => '60 Oneiric Shard', 'amount' => 60, 'unit' => 'Shard', 'price' => 15000, 'original_price' => 18000],
                    ['name' => '300 Oneiric Shard', 'amount' => 300, 'unit' => 'Shard', 'price' => 75000, 'original_price' => 90000, 'is_popular' => true],
                    ['name' => '980 Oneiric Shard', 'amount' => 980, 'unit' => 'Shard', 'price' => 245000, 'original_price' => 295000],
                    ['name' => '1980 Oneiric Shard', 'amount' => 1980, 'unit' => 'Shard', 'price' => 490000, 'original_price' => 590000, 'is_popular' => true],
                    ['name' => '3280 Oneiric Shard', 'amount' => 3280, 'unit' => 'Shard', 'price' => 790000, 'original_price' => 950000],
                ],
            ],
            [
                'name' => 'Valorant',
                'slug' => 'valorant',
                'description' => 'Tactical shooter terbaik dari Riot Games. Top up VP untuk skin senjata dan agent favorit!',
                'category' => 'pc',
                'publisher' => 'Riot Games',
                'is_featured' => true,
                'sort_order' => 6,
                'products' => [
                    ['name' => '475 VP', 'amount' => 475, 'unit' => 'VP', 'price' => 70000, 'original_price' => 85000],
                    ['name' => '1000 VP', 'amount' => 1000, 'unit' => 'VP', 'price' => 140000, 'original_price' => 170000, 'is_popular' => true],
                    ['name' => '2050 VP', 'amount' => 2050, 'unit' => 'VP', 'price' => 280000, 'original_price' => 340000, 'is_popular' => true],
                    ['name' => '3650 VP', 'amount' => 3650, 'unit' => 'VP', 'price' => 490000, 'original_price' => 595000],
                    ['name' => '5350 VP', 'amount' => 5350, 'unit' => 'VP', 'price' => 700000, 'original_price' => 850000],
                    ['name' => '11000 VP', 'amount' => 11000, 'unit' => 'VP', 'price' => 1400000, 'original_price' => 1700000],
                ],
            ],
            [
                'name' => 'Roblox',
                'slug' => 'roblox',
                'description' => 'Platform game terpopuler di dunia. Top up Robux untuk avatar dan akses game premium!',
                'category' => 'pc',
                'publisher' => 'Roblox Corporation',
                'is_featured' => false,
                'sort_order' => 7,
                'products' => [
                    ['name' => '400 Robux', 'amount' => 400, 'unit' => 'Robux', 'price' => 75000, 'original_price' => 90000],
                    ['name' => '800 Robux', 'amount' => 800, 'unit' => 'Robux', 'price' => 145000, 'original_price' => 175000, 'is_popular' => true],
                    ['name' => '1700 Robux', 'amount' => 1700, 'unit' => 'Robux', 'price' => 290000, 'original_price' => 350000],
                    ['name' => '4500 Robux', 'amount' => 4500, 'unit' => 'Robux', 'price' => 750000, 'original_price' => 900000, 'is_popular' => true],
                    ['name' => '10000 Robux', 'amount' => 10000, 'unit' => 'Robux', 'price' => 1500000, 'original_price' => 1800000],
                ],
            ],
            [
                'name' => 'League of Legends',
                'slug' => 'league-of-legends',
                'description' => 'MOBA PC terbaik dunia. Top up RP untuk skin, champion, dan emote favorit!',
                'category' => 'pc',
                'publisher' => 'Riot Games',
                'is_featured' => false,
                'sort_order' => 8,
                'products' => [
                    ['name' => '650 RP', 'amount' => 650, 'unit' => 'RP', 'price' => 75000, 'original_price' => 90000],
                    ['name' => '1380 RP', 'amount' => 1380, 'unit' => 'RP', 'price' => 150000, 'original_price' => 180000],
                    ['name' => '2800 RP', 'amount' => 2800, 'unit' => 'RP', 'price' => 290000, 'original_price' => 350000, 'is_popular' => true],
                    ['name' => '5000 RP', 'amount' => 5000, 'unit' => 'RP', 'price' => 490000, 'original_price' => 590000],
                    ['name' => '11500 RP', 'amount' => 11500, 'unit' => 'RP', 'price' => 1050000, 'original_price' => 1260000, 'is_popular' => true],
                ],
            ],
            [
                'name' => 'Arena of Valor',
                'slug' => 'arena-of-valor',
                'description' => 'MOBA 5v5 dengan grafis memukau. Top up Voucher untuk hero dan skin terbaru!',
                'category' => 'mobile',
                'publisher' => 'TiMi Studio',
                'is_featured' => false,
                'sort_order' => 9,
                'products' => [
                    ['name' => '60 Voucher', 'amount' => 60, 'unit' => 'Voucher', 'price' => 12000, 'original_price' => 14000],
                    ['name' => '300 Voucher', 'amount' => 300, 'unit' => 'Voucher', 'price' => 55000, 'original_price' => 65000, 'is_popular' => true],
                    ['name' => '550 Voucher', 'amount' => 550, 'unit' => 'Voucher', 'price' => 100000, 'original_price' => 120000],
                    ['name' => '1120 Voucher', 'amount' => 1120, 'unit' => 'Voucher', 'price' => 195000, 'original_price' => 235000, 'is_popular' => true],
                ],
            ],
            [
                'name' => 'Minecraft',
                'slug' => 'minecraft',
                'description' => 'Game sandbox legendaris. Beli Minecoins untuk marketplace konten terbaik!',
                'category' => 'pc',
                'publisher' => 'Mojang/Microsoft',
                'is_featured' => false,
                'sort_order' => 10,
                'products' => [
                    ['name' => '320 Minecoins', 'amount' => 320, 'unit' => 'Minecoins', 'price' => 40000, 'original_price' => 48000],
                    ['name' => '840 Minecoins', 'amount' => 840, 'unit' => 'Minecoins', 'price' => 95000, 'original_price' => 115000, 'is_popular' => true],
                    ['name' => '1720 Minecoins', 'amount' => 1720, 'unit' => 'Minecoins', 'price' => 185000, 'original_price' => 225000],
                    ['name' => '3500 Minecoins', 'amount' => 3500, 'unit' => 'Minecoins', 'price' => 360000, 'original_price' => 435000, 'is_popular' => true],
                ],
            ],
        ];

        foreach ($games as $gameData) {
            $products = $gameData['products'];
            unset($gameData['products']);

            $game = Game::create($gameData);

            foreach ($products as $index => $productData) {
                $game->products()->create(array_merge($productData, [
                    'is_popular' => $productData['is_popular'] ?? false,
                    'sort_order' => $index + 1,
                ]));
            }
        }

        // ===================== PAYMENT METHODS =====================
        $paymentMethods = [
            // Bank Transfer
            ['name' => 'BCA Virtual Account', 'code' => 'bca_va', 'category' => 'bank_transfer', 'fee_flat' => 4000, 'sort_order' => 1],
            ['name' => 'BNI Virtual Account', 'code' => 'bni_va', 'category' => 'bank_transfer', 'fee_flat' => 4000, 'sort_order' => 2],
            ['name' => 'Mandiri Virtual Account', 'code' => 'mandiri_va', 'category' => 'bank_transfer', 'fee_flat' => 4000, 'sort_order' => 3],
            ['name' => 'BRI Virtual Account', 'code' => 'bri_va', 'category' => 'bank_transfer', 'fee_flat' => 4000, 'sort_order' => 4],
            ['name' => 'BSI Virtual Account', 'code' => 'bsi_va', 'category' => 'bank_transfer', 'fee_flat' => 4000, 'sort_order' => 5],
            ['name' => 'CIMB Niaga Virtual Account', 'code' => 'cimb_va', 'category' => 'bank_transfer', 'fee_flat' => 4000, 'sort_order' => 6],

            // E-Wallet
            ['name' => 'GoPay', 'code' => 'gopay', 'category' => 'e_wallet', 'fee_percent' => 1.5, 'sort_order' => 1],
            ['name' => 'OVO', 'code' => 'ovo', 'category' => 'e_wallet', 'fee_percent' => 1.5, 'sort_order' => 2],
            ['name' => 'DANA', 'code' => 'dana', 'category' => 'e_wallet', 'fee_percent' => 1.5, 'sort_order' => 3],
            ['name' => 'ShopeePay', 'code' => 'shopeepay', 'category' => 'e_wallet', 'fee_percent' => 2.0, 'sort_order' => 4],
            ['name' => 'LinkAja', 'code' => 'linkaja', 'category' => 'e_wallet', 'fee_percent' => 1.5, 'sort_order' => 5],
            ['name' => 'Jenius Pay', 'code' => 'jenius', 'category' => 'e_wallet', 'fee_percent' => 1.5, 'sort_order' => 6],

            // QRIS
            ['name' => 'QRIS (Semua Bank & E-Wallet)', 'code' => 'qris', 'category' => 'qris', 'fee_percent' => 0.7, 'sort_order' => 1],

            // Retail / Minimarket
            ['name' => 'Indomaret', 'code' => 'indomaret', 'category' => 'retail', 'fee_flat' => 2500, 'sort_order' => 1],
            ['name' => 'Alfamart', 'code' => 'alfamart', 'category' => 'retail', 'fee_flat' => 2500, 'sort_order' => 2],
            ['name' => 'Alfamidi', 'code' => 'alfamidi', 'category' => 'retail', 'fee_flat' => 2500, 'sort_order' => 3],
            ['name' => 'Circle K', 'code' => 'circlek', 'category' => 'retail', 'fee_flat' => 2500, 'sort_order' => 4],

            // Paylater
            ['name' => 'Kredivo', 'code' => 'kredivo', 'category' => 'paylater', 'fee_percent' => 3.0, 'sort_order' => 1],
            ['name' => 'Akulaku', 'code' => 'akulaku', 'category' => 'paylater', 'fee_percent' => 3.0, 'sort_order' => 2],
            ['name' => 'PayLater by Shopee', 'code' => 'spaylater', 'category' => 'paylater', 'fee_percent' => 3.0, 'sort_order' => 3],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create(array_merge($method, [
                'fee_flat' => $method['fee_flat'] ?? 0,
                'fee_percent' => $method['fee_percent'] ?? 0,
            ]));
        }
    }
}
