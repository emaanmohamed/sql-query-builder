steps to test query1 :- 
1- php artisan migrate
2- php artisan tinker
   *User::factory()->count(10)->create() 
   *Product::factory()->count(10)->create() 
   *Order::factory()->count(10)->create() 

Then:
Call this route yourLocalHost/query1 to get results
=========================
steps to test query2 :- 
