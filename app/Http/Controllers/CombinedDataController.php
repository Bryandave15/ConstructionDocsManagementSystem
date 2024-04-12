<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mefps;
use App\Models\Structural;
use App\Models\Architectural;
use App\Models\Asbuilt;
use App\Models\Directory;
use App\Models\Form;
use App\Models\Meeting;
use App\Models\Report;
use App\Models\Inspection;

class CombinedDataController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        // Fetch data from each table and map it to desired format
        $mefpsData = Mefps::all()->map(function ($item) {
            return [
                // 'id' => $item->mefps_id,
                'title' => $item->mefps_title,
                'code' => $item->mefps_code,
                'location' => $item->mefps_location,
                'created_at' => $item->created_at,
            ];
        });

        $structuralData = Structural::all()->map(function ($item) {
            return [
                // 'id' => $item->sructural_id,
                'title' => $item->structural_title,
                'code' => $item->structural_code,
                'location' => $item->location,
                'created_at' => $item->created_at,
            ];
        });

        $asbuiltData = Asbuilt::all()->map(function ($item) {
            return [
                // 'id' => $item->sructural_id,
                'title' => $item->asbuilt_title,
                'code' => $item->asbuilt_code,
                'location' => $item->location,
                'created_at' => $item->created_at,
            ];
        });

        $architecturalData = Architectural::all()->map(function ($item) {
            return [
                // 'id' => $item->sructural_id,
                'title' => $item->architectural_title,
                'code' => $item->architectural_code,
                'location' => $item->location,
                'created_at' => $item->created_at,
            ];
        });

   

        $formData = Form::all()->map(function ($item) {
            return [
                // 'id' => $item->form_id,
                'title' => $item->form_title,
                'code' => $item->form_type,
                'location' => $item->description,
                'created_at' => $item->created_at,
            ];
        });

        $meetingData = Meeting::all()->map(function ($item) {
            return [
                // 'id' => $item->meeting_id,
                'title' => $item->meeting_title,
                'code' => $item->meeting_overview,
                'location' => $item->meeting_location,
                'created_at' => $item->meeting_date,
            ];
        });

        

        $reportData = Report::all()->map(function ($item) {
            return [
                // 'id' => $item->report_id,
                'title' => $item->report_title,
                'code' => $item->report_type,
                'location' => $item->description,
                'created_at' => $item->created_at,
            ];
        });

        $inspectionData = Inspection::all()->map(function ($item) {
            return [
                // 'id' => $item->report_id,
                'title' => $item->inspection_title,
                'code' => $item->inspection_code,
                'location' => $item->description,
                'created_at' => $item->created_at,
            ];
        });

    // Combine the collections from all tables
              $combinedData = $mefpsData->concat($structuralData)
                                        ->concat($formData)
                                        ->concat($meetingData)
                                        ->concat($reportData)
                                        ->concat($architecturalData)
                                        ->concat($asbuiltData)
                                        ->concat($inspectionData);

               // Fetch the top 10 latest added entries from the combined data
        $combinedData = $combinedData->sortByDesc('created_at')->take(10);

        // Fetch total counts for each category
        $mefpsCount = Mefps::count();
        $structuralCount = Structural::count();
        $formCount = Form::count();
        $meetingCount = Meeting::count();
        $reportCount = Report::count();
        $inspectionCount = Inspection::count();
        $asbuiltCount = Asbuilt::count();
        $architecturalCount = Architectural::count();
        $directoryCount = Directory::count();


        // Fetch the latest date added for each type of data and format it
        $latestDates = [
            'mefps' => Carbon::parse(Mefps::max('created_at'))->format('F j, Y h:i A '),
            'structural' => Carbon::parse(Structural::max('created_at'))->format('F j, Y h:i A '),
            'asbuilt' => Carbon::parse(Asbuilt::max('created_at'))->format('F j, Y h:i A '),
            'architectural' => Carbon::parse(Architectural::max('created_at'))->format('F j, Y h:i A '),
            'form' => Carbon::parse(Form::max('created_at'))->format('F j, Y h:i A '),
            'meeting' => Carbon::parse(Meeting::max('created_at'))->format('F j, Y h:i A '),
            'report' => Carbon::parse(Report::max('created_at'))->format('F j, Y h:i A '),
            'inspection' => Carbon::parse(Inspection::max('created_at'))->format('F j, Y h:i A '),
            'directory' => Carbon::parse(Directory::max('created_at'))->format('F j, Y h:i A '),
        ];


 

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
            'asbuiltCount' => $asbuiltCount,
            'inspectionCount' => $inspectionCount,
            'architecturalCount' => $architecturalCount,
            'directoryCount' => $directoryCount,
            'latestDates' => $latestDates,


            

        ]);
    }
}
