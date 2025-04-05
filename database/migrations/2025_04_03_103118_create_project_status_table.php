<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProjectStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $projectStatuses = [
            ['name' => 'Planned'],
            ['name' => 'In Progress'],
            ['name' => 'Completed'],
        ];

        foreach($projectStatuses as $projectStatus) {
            ProjectStatus::create($projectStatus);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_statuses');
    }
};
