<?php

namespace App;
use App\Http\Controllers\date_utils;
use Illuminate\Database\Eloquent\Model;

class Working_hour extends Model
{
    protected $fillable = ['user_id','work_date','time1','time2','time3','time4','worked_time'];
    public function user(){
        return $this->belongsTo(User::class);
      //  return $this->belongsTo(User::class,'usuario_id'); 
    }

    function getBalance() {
      if(!$this->time1 && !isPastWorkday($this->work_date)) return '';
      if($this->worked_time == 28800) return '-';

      $balance = $this->worked_time - 28800;
      $balanceString = date_utils::getTimeStringFromSeconds(abs($balance));
      $sign = $this->worked_time >= 28800 ? '+' : '-';
      return "{$sign}{$balanceString}";
  }

}
