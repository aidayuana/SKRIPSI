<?php 

if (!function_exists('responseError')) {
    function responseError(Exception | string $th)
    {
        $message = 'Terjadi kesalahan, silahkan coba beberapa saat lagi';
        if ($th instanceof \Exception) {
            if (config('app.debug')) {
                $message = $th->getMessage();
                $message .= ' in line'. $th->getLine(). ' at '. $th->getFile();
                $data = $th->getTrace();
            }
            
        } else {
            $message = $th;
        }

        return response()->json([
            'status' => 'error', 
            'message' => $message,
            'errors' => $data ?? null 
        ], 500);
    }
}

if (!function_exists('responseSuccess')) {
    function responseSuccess($isEdit = false) 
    {
        return response()->json([
            'status' => 'success', 
            'message' => $isEdit ? 'Update data successfully' : 'Create data successfully'
        ]);
    }
}

?>