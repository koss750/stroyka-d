<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Auth;
use App\Jobs\GenerateOrderFileJob;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function createSmetaOrder(Request $request)
    {
        $designId = $request->input('design_id');
        $selectedOptions = json_decode($request->input('selected_configuration'));
        $configurationDescriptions = json_decode($request->input('configuration_descriptions'));
        $paymentAmount = $request->input('payment_amount');
        $orderType = $request->input('order_type') ?? 'smeta';
        $ipAddress = $request->ip();
        $project = Project::create([
            'user_id' => Auth::id(),
            'human_ref' => $this->generateHumanReference($designId),
            'order_type' => $orderType,
            'ip_address' => $ipAddress,
            'payment_reference' => 'test',
            'payment_amount' => $paymentAmount,
            'design_id' => $designId,
            'selected_configuration' => $selectedOptions,
            'configuration_descriptions' => $configurationDescriptions,
        ]);

        dispatch(new GenerateOrderFileJob($project->id));

        return response()->json([
            'orderId' => $project->human_ref
        ]);

        
    }

    public function generateHumanReference($designId)
    {
        // create an alphanumeric code starting with project ID and using some base of selectedOptions
        $letters = ['А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х', '2', '4', '5', '6', '7', '8', '9'];
        $randomLetters = '';
        for ($i = 0; $i < 5; $i++) {
            $randomLetters .= $letters[array_rand($letters)];
        }
        $humanReference = "С" . $designId . "-" . $randomLetters;
        return $humanReference;
    }

    public function createOrder(Request $request)
    {
        $validatedData = $request->validate([
            'design_id' => 'required|exists:designs,id',
            'selected_configuration' => 'required|array',
            'payment_amount' => 'required|numeric',
            'ip_address' => 'required|ip',
        ]);

        $project = Project::create([
            'user_id' => auth()->id(),
            'design_id' => $validatedData['design_id'],
            'selected_configuration' => $validatedData['selected_configuration'],
            'payment_amount' => $validatedData['payment_amount'],
            'ip_address' => $validatedData['ip_address'],
            'payment_reference' => 'test', // You might want to generate this dynamically
        ]);

        GenerateOrderFileJob::dispatch($project->id);

        return response()->json([
            'message' => 'Order created successfully',
            'project_id' => $project->id,
            'excel_file' => $excelFile,
        ]);
    }

    private function generateExcelFile(Project $project)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Project ID: ' . $project->id);
        $sheet->setCellValue('A2', 'Design ID: ' . $project->design_id);

        $row = 4;
        foreach ($project->selected_configuration as $key => $value) {
            $sheet->setCellValue('A' . $row, $key);
            $sheet->setCellValue('B' . $row, $value);
            $row++;
        }

        $fileName = 'project_' . $project->id . '_smeta.xlsx';
        $filePath = storage_path('app/public/' . $fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return asset('storage/' . $fileName);
    }

    public function assignExecutors(Project $project, Request $request)
    {
        $validatedData = $request->validate([
            'executor_ids' => 'required|array',
            'executor_ids.*' => 'exists:users,id',
        ]);

        $executors = User::whereIn('id', $validatedData['executor_ids'])->where('role', 'executor')->get();
        $project->executors()->syncWithoutDetaching($executors);

        return response()->json(['message' => 'Executors assigned successfully']);
    }

    public function reviewProject(Project $project)
    {
        // Ensure the authenticated user is an executor assigned to this project
        if (!$project->executors->contains(auth()->id())) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $projectData = [
            'id' => $project->id,
            'selected_configuration' => $project->selected_configuration,
            'excel_file' => $project->filepath ? Storage::url($project->filepath) : null,
        ];

        return response()->json($projectData);
    }

    public function submitOffer(Project $project, Request $request)
    {
        // Ensure the authenticated user is an executor assigned to this project
        if (!$project->executors->contains(auth()->id())) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'status' => 'required|in:accepted,rejected',
            'price' => 'required_if:status,accepted|numeric|nullable',
            'comment' => 'nullable|string',
        ]);

        $project->executors()->updateExistingPivot(auth()->id(), $validatedData);

        return response()->json(['message' => 'Offer submitted successfully']);
    }

    public function getAvailableExecutors(Project $project)
    {
        $executors = User::whereHas('roles', function($query) {
            $query->where('roles', 'like', '%executor%');
        })
        ->whereDoesntHave('projects', function($query) use ($project) {
            $query->where('project_id', $project->id);
        })
        ->with('companyProfile')
        ->get(['id', 'name']);

        return response()->json(['executors' => $executors]);
    }
}