<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LessonStudent;
use Illuminate\Support\Facades\DB;

class LessonStudentSeeder extends Seeder
{
    public function run(): void
    {
        $desiredPairs = 20000;
        $chunkSize = 1000; // How many potential pairs to generate and try to insert at once
        $createdCount = 0; // How many pairs successfully inserted

        $this->command->info("Attempting to seed up to {$desiredPairs} LessonStudent pairs in chunks of {$chunkSize}...");

        // Determine valid ID ranges to reduce generating non-existent IDs
        // If your IDs are not dense, rand() will often pick non-existent ones.
        // For truly random selection from existing IDs, you'd fetch them first,
        // but for simplicity, we'll use max ID here.
        $maxLessonId = DB::table('lessons')->max('id');
        $maxStudentId = DB::table('students')->max('id');

        if (!$maxLessonId || !$maxStudentId) {
            $this->command->error("Lessons or Students table is empty or has no IDs. Cannot seed pairs.");
            return;
        }

        // Outer loop to keep trying to add pairs until desired count or we can't generate more
        while ($createdCount < $desiredPairs) {
            $dataToInsert = [];

            // Build a chunk of potential pairs
            // We build a full chunk before attempting insert to minimize DB interactions
            // but this chunk *might* contain duplicates within itself or with existing DB data
            for ($i = 0; $i < $chunkSize && ($createdCount + count($dataToInsert)) < $desiredPairs; $i++) {
                $lessonId = rand(1, $maxLessonId);
                $studentId = rand(1, $maxStudentId);

                $dataToInsert[] = [
                    'lesson_id'  => $lessonId,
                    'student_id' => $studentId,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }

            if (empty($dataToInsert)) {
                // This can happen if desiredPairs is less than chunkSize and already met
                // or if the previous loop iteration exactly met desiredPairs
                break; // No more data to generate for this iteration
            }

            try {
                // Attempt to insert the chunk
                DB::table('lesson_student')->insert($dataToInsert);
                $insertedThisChunk = count($dataToInsert); // Assume all were inserted if no error
                $createdCount += $insertedThisChunk;
                $this->command->info("Successfully inserted a chunk of {$insertedThisChunk}. Total created: {$createdCount}/{$desiredPairs}");
            } catch (QueryException $e) {
                // MySQL duplicate entry error code is 1062
                // PostgreSQL duplicate key value violates unique constraint is 23505
                $sqlErrorCode = $e->errorInfo[1] ?? null;
                if ($sqlErrorCode == 1062 || $sqlErrorCode == 23505) {
                    $this->command->warn("Chunk insertion failed due to duplicate entry violation. Seeding will stop here to prevent further errors. Some items in the last attempted chunk were not inserted.");
                    $this->command->warn("Consider a smaller chunk size or a different strategy if this happens too early.");
                    break; // Exit the main while loop
                } else {
                    $this->command->error("An unexpected database error occurred: " . $e->getMessage());
                    throw $e; // Re-throw other errors
                }
            }

            // If we successfully insert a chunk, but it was smaller than desired
            // (because desiredPairs was almost met), we might be done.
            if ($createdCount >= $desiredPairs) {
                break;
            }
        }

        $this->command->info("Finished seeding. Total pairs created: {$createdCount}");
        if ($createdCount < $desiredPairs) {
            $this->command->warn("Target of {$desiredPairs} pairs was not reached. This is likely due to encountering duplicate pairs when trying to insert a chunk.");
        }
        
        
    }
}
