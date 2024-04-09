<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mefps;
use App\Models\Structural;
use App\Models\Directory;
use App\Models\Form;
use App\Models\Meeting;
use App\Models\Report;

class CombinedDataController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        // Fetch data from each table and map it to desired format
        $mefpsData = Mefps::all()->map(function ($item) {
            return [
                'id' => $item->mefps_id,
                'title' => $item->mefps_title,
                'code' => $item->mefps_code,
                'location' => $item->mefps_location,
                'created_at' => $item->created_at,
            ];
        });

        $structuralData = Structural::all()->map(function ($item) {
            return [
                'id' => $item->sructural_id,
                'title' => $item->structural_title,
                'code' => $item->structural_code,
                'location' => $item->location,
                'created_at' => $item->created_at,
            ];
        });

   

        $formData = Form::all()->map(function ($item) {
            return [
                'id' => $item->form_id,
                'title' => $item->form_title,
                'code' => $item->form_type,
                'location' => $item->description,
                'created_at' => $item->created_at,
            ];
        });

        $meetingData = Meeting::all()->map(function ($item) {
            return [
                'id' => $item->meeting_id,
                'title' => $item->meeting_title,
                'code' => $item->meeting_overview,
                'location' => $item->meeting_location,
                'created_at' => $item->created_at,
            ];
        });

        $reportData = Report::all()->map(function ($item) {
            return [
                'id' => $item->report_id,
                'title' => $item->report_title,
                'code' => $item->report_type,
                'location' => $item->description,
                'created_at' => $item->created_at,
            ];
        });

        // Fetch total counts for each category
        $mefpsCount = Mefps::count();
        $structuralCount = Structural::count();
        $formCount = Form::count();
        $meetingCount = Meeting::count();
        $reportCount = Report::count();



        // Combine the collections from all tables
        $combinedData = $mefpsData->concat($structuralData)
                                  ->concat($formData)
                                  ->concat($meetingData)
                                  ->concat($reportData);

        // Fetch the top 10 latest added entries from the combined data
        $combinedData = $combinedData->sortByDesc('created_at')->take(10);

        // Filter data based on search query
        if ($searchQuery !== null && $searchQuery !== '') {
            $searchResults = $combinedData->filter(function ($item) use ($searchQuery) {
                return stripos($item['title'], $searchQuery) !== false ||
                       stripos($item['code'], $searchQuery) !== false ||
                       stripos($item['location'], $searchQuery) !== false;
            });
        } else {
            // If search query is empty, show all data
            $searchResults = $combinedData;
        }

        return view('combined-data', [
            'combinedData' => $combinedData,
            'searchQuery' => $searchQuery,
            'searchResults' => $searchResults,
            'mefpsCount' => $mefpsCount,
            'structuralCount' => $structuralCount,
            'formCount' => $formCount,
            'meetingCount' => $meetingCount,
            'reportCount' => $reportCount,
            

        ]);
    }
}
