<?php 

namespace App\Actions;

use App\Models\Result;
use App\Services\ExcelService;

final class CreateResult
{
    public static function handle($validatedData)
    {
        try {
            $resultsData = ExcelService::readAndProcessResultsFile($validatedData);
            Result::insert($resultsData);
            $responseData = ['status' => 'success', 'message' => 'Results Upload Successfully.'];

        } catch(Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Failed To Upload Results.'];
        }
        
        return $responseData;
    }
}