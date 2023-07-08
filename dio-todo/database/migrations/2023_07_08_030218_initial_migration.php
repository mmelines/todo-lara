<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //        
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_client_address');
            $table->char('street_address_1', 50);
            $table->char('street_address_2', 50)->nullable();
            $table->char('city', 30)->nullable();
            $table->char('state', 2)->nullable();
            $table->char('zip', 10)->nullable();
            $table->timestamps();
        });
        //        
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->char('nickname', 40);
            $table->boolean('is_active');
            $table->date('intake_date')->nullable();
            $table->date('graduation_date')->nullable();
            $table->char('case_number', 20)->nullable();
            $table->timestamps();
        });
        //        
        Schema::create('client_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->boolean('is_active')->nullable();
            $table->date('move_date')->nullable();
            $table->timestamps();
        });
        //        
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->char('name', 60);
            $table->timestamps();
        });
        //        
        Schema::create('facility_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('task_types', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50);
            $table->timestamps();
        });
        //        
        Schema::create('task_subtypes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_type_id')->constrained();
            $table->char('name', 50);
            $table->timestamps();
        });
        //        
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->dateTimeTz('start_datetime');
            $table->dateTimeTz('end_datetime')->nullable();
            $table->char('name', 100);
            $table->boolean('is_all_day')->default(false);
            $table->foreignId('volunteer_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('client_family', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('family_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->char('name', 100);
            $table->char('first_name', 50);
            $table->char('last_name', 50);
            $table->boolean('is_volunteer');
            $table->string('primary_email', 40);
            $table->string('phone', 12)->nullable();
            $table->boolean('is_textable')->default(true);
            $table->timestamps();
        });
        //        
        Schema::create('contact_facility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('facility_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->date('enrollment_date');
            $table->timestamps();
        });
        //        
        Schema::create('family_volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained();
            $table->foreignId('family_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('facility_volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained();
            $table->foreignId('volunteer_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('contact_volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('volunteer_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->boolean('requires_volunteer')->default(true);
            $table->boolean('is_assignable')->default(true);
            $table->boolean('is_upcoming')->default(true);
            $table->foreignId('event_id')->constrained()->nullable();
            $table->foreignId('task_type_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained();
            $table->timestamps();
        });
        //        
        Schema::create('task_organizers', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50);
            $table->foreignId('facility_id')->constrained()->nullable();
            $table->foreignId('contact_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('task_organizers');
        //
        Schema::drop('task_assignments');
        //
        Schema::drop('tasks');
        //
        Schema::drop('contact_volunteer');
        //
        Schema::drop('facility_volunteer');
        //
        Schema::drop('family_volunteer');
        //
        Schema::drop('volunteers');
        //
        Schema::drop('contact_facility');
        //
        Schema::drop('contacts');
        //
        Schema::drop('client_family');
        //
        Schema::drop('families');
        //
        Schema::drop('events');
        //
        Schema::drop('task_subtypes');
        //
        Schema::drop('task_types');
        //
        Schema::drop('facility_location');
        //
        Schema::drop('facilities');
        //
        Schema::drop('client_location');
        //
        Schema::drop('clients');
        //
        Schema::drop('locations');
    }
};
