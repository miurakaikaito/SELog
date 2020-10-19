<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $dates = [
        'reporting_time',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'reporting_time',
    ];

    /**
     * 日報検索で月ごとの日報を表示させる。
     *
     * @param $month, int $id
     * @return LengthAwarePaginator
     */
    public function getReports($month)
    {
        return $this->where('user_id', Auth::id())
                    ->when(isset($month), function ($query) use ($month) {
                        $query->where('reporting_time', 'like', $month . '%');
                    })
                    ->orderBy('reporting_time', 'desc')
                    ->paginate(config('const.PAGINATION'));
    }
}
