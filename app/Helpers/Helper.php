<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Exchange;

class Helper
{
    public static function shout($string)
    {
        return strtoupper($string);
    }
    public static function getPrice($price){
    	$value = session('currency');

    	if(!$value){
    		$value='USD';

    	}
    	$exchange=Exchange::where('name',$value)->first();
    	if(!$exchange){
    		$rate=1;
    		$symbol='$';
    	}
    	else{
    		$rate=$exchange->rate;
    		$symbol=$exchange->symbol;
    	}
    	
    	
    	return $symbol.$price*$rate;
    }

    public static function getPriceonly($price){
        $value = session('currency');

        if(!$value){
            $value='USD';

        }
        $exchange=Exchange::where('name',$value)->first();
        if(!$exchange){
            $rate=1;
            $symbol='$';
        }
        else{
            $rate=$exchange->rate;
            $symbol=$exchange->symbol;
        }
        
        
        return $price*$rate;
    }

    public static function exchangeToUSD($price){
        $value = session('currency');

        if(!$value){
            $value='USD';

        }
        $exchange=Exchange::where('name',$value)->first();
        if(!$exchange){
            $rate=1;
            $symbol='$';
        }
        else{
            $rate=$exchange->rate;
            $symbol=$exchange->symbol;
        }
        
        
        return $price/$rate;
    }

    public static function getPricesymbol(){
        $value = session('currency');

        if(!$value){
            $value='USD';

        }
        $exchange=Exchange::where('name',$value)->first();
        if(!$exchange){
            $rate=1;
            $symbol='$';
        }
        else{
            $rate=$exchange->rate;
            $symbol=$exchange->symbol;
        }
        
        
        return $symbol;
    }
}