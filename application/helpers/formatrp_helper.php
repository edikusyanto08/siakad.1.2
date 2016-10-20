<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('formatRupiah')){
	function formatRupiah($nilaiUang){
		$neg = false;
        if($nilaiUang<0){
            $neg = true;
            $nilaiUang = abs($nilaiUang);
        }
        $nilaiRupiah= number_format($nilaiUang,0,',','.');
        if($neg){
            $nilaiRupiah = '('.$nilaiRupiah.')';
        }
		return "Rp ".$nilaiRupiah;
	}
}
if ( ! function_exists('formatRupiahTabel')){
	function formatRupiahTabel($nilaiUang){
		$neg = false;
        if($nilaiUang<0){
            $neg = true;
            $nilaiUang = abs($nilaiUang);
        }
        $nilaiRupiah= number_format($nilaiUang,0,',','.');
        if($neg){
            $nilaiRupiah = '('.$nilaiRupiah.')';
        }	
		return "<div style='float:left;'>Rp </div><div style='float:right;text-align:right;'>".$nilaiRupiah."</div>";
	
	}
}
