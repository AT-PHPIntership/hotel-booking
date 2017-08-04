<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GuestsTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(HotelsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(FeedbacksTableSeeder::class);
        $this->call(RatingCommentTableSeeder::class);
        $this->call(HotelServicesTableSeeder::class);
        $this->call(StaticPagesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
    }
}
