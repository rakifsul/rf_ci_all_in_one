<?php
namespace App\Helpers;

class G {
    public static function dd($inp) {
        return dd($inp);
    }

    public static function ddp($inp) {
        echo "<pre>";
        var_dump($inp);
        echo "</pre>";
        die;
    }

    public static function pgnPrevious($currentPage) {
        $tmp = (int)$currentPage - 1;
        return 
        $tmp < 0 ? 
        [ 'index' => 0, 'disabled' => true ] : 
        [ 'index' => $tmp, 'disabled' => false ];
    }

    public static function pgnNext($currentPage, $totalPage) {
        $tmp = (int)$currentPage + 1;
        return
        $tmp >= $totalPage ? 
        [ 'index' => $currentPage, 'disabled' => true ] : 
        [ 'index' => $tmp, 'disabled' => false ];
    }
}