<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\DailyReportRequest;

class DailyReportController extends Controller
{
    public $report;

    public function __construct(DailyReport $dailyReport)
    {
        $this->middleware('auth');
        $this->report = $dailyReport;
    }

    /**
     * 日報一覧画面表示
     *
     * @param RequestInstance $request
     * @return View
     */
    public function index(Request $request)
    {
        $month = $request->search_month;
        $reports = $this->report->getReports($month);
        return view('user.daily_report.index', compact('reports'));
    }

    /**
     * 日報新規作成画面表示
     *
     * @return View
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * 日報登録処理を行い、一覧画面へ遷移させる。
     *
     * @param DailyReportRequest $request
     * @return RedirectResponse
     */
    public function store(DailyReportRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->report->fill($inputs)->save();
        return redirect()->route('report.index');
    }

    /**
     * 日報詳細画面表示
     *
     * @param int $reportId
     * @return View
     */
    public function show($reportId)
    {
        $report = $this->report->find($reportId);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * 日報編集画面表示
     *
     * @param int $reportId
     * @return View
     */
    public function edit($reportId)
    {
        $report = $this->report->find($reportId);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * 日報更新処理を行い、一覧画面へ遷移させる。
     *
     * @param DailyReportRequest $request
     * @param int $reportId
     * @return RedirectResponse
     */
    public function update(DailyReportRequest $request, $reportId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->report->find($reportId)->fill($inputs)->save();
        return redirect()->route('report.index');
    }

    /**
     *日報の削除を行い、一覧画面へ遷移させる。
    *
    * @param int $reportId
    * @return RedirectResponse
    */
    public function destroy($reportId)
    {
        $this->report->find($reportId)->delete();
        return redirect()->route('report.index');
    }
}
