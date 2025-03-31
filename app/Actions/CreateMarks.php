<?php 

namespace App\Actions;

use App\Models\Mark;
use App\Services\ExcelService;

final class CreateMarks
{
    public static function handle($validatedData)
    {
        try {
            $marksData = ExcelService::readAndProcessMarksFile($validatedData);
            Mark::insert($marksData);
            $responseData = ['status' => 'success', 'message' => 'Marks Upload Successfully.'];

        } catch(Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Failed To Upload Marks.'];
        }
        
        return $responseData;
    }
}