<?php
namespace App\Models\Common;
use Illuminate\Database\Eloquent\Model;

class GenerateVoucherNo extends Model{
    
    protected $table = 'GenerateVoucherNo';
    protected $primaryKey = 'VoucherNo';
    public $timestamps = false;
} 