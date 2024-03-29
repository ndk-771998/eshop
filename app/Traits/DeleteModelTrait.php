<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


trait DeleteModelTrait
{
    public function deleteModelTrait($id, $model)
    {
        try{
            $model->find($id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
            
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
