<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TemplateController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Design;
use App\Http\Controllers\ProjectController;
use App\Notifications\ReceiptNotification;
class OrderController extends Controller
{
    public function processFoundationOrder(Request $request)
    {
        return true;
        // First, generate the Excel file
        $templateController = new TemplateController();
        $excelResponse = $templateController->generateExcel($request);

        // Check if there was an error generating the Excel file
        if ($excelResponse->status() !== 200) {
            return $excelResponse;
        }

        $excelData = json_decode($excelResponse->getContent(), true);
        $excelUrl = $excelData['download_url'];

        // Load the generated Excel file
        $spreadsheet = IOFactory::load(storage_path('app/public/' . basename($excelUrl)));

        // Generate the foundation smeta
        $smetaUrl = $templateController->generateFoundationSmeta($spreadsheet);

        // Return both URLs
        return response()->json([
            'excel_url' => $excelUrl,
            'smeta_url' => $smetaUrl
        ]);
    }

    public function processProjectSmetaOrder(Request $request)
    {

        //assign or create user

        if (Auth::check() && $request->input('logged_in')) {
            $user = Auth::user();
        } elseif (!$request->input('logged_in')) {
            $registerController = new RegisterController();
            $user = $registerController->create($request, true);
            $request->merge(['user_id' => $user->id]);
        } else {
            return response()->json(['error' => 'Logged in user check failed'], 401);
        }
        $price_type = $request->input('price_type');
        $price_type_label = $price_type === 'material' ? 'Только материалы' : ($price_type === 'total' ? 'Материалы и работы' : 'Материалы, работы и доставка');
        //assign design
        $design = Design::find($request->input('design_id'));
        $designTitle = $design->title;
        $orderDesignTitle = "Смета по проекту ($price_type_label) " . $designTitle;
        
        //create project
        $projectController = new ProjectController();
        $orderId = $projectController->createSmetaOrder($request);
        $project = Project::find($orderId);
        $payment_amount = $request->input('payment_amount');
        
        $description = $orderDesignTitle;
        $payment_reference = (string)(random_int(1000000000, 9999999999));
        $paymentUrl = $this->yandexPayCallback(base64_encode($project->human_ref), $payment_reference, $description, $payment_amount);
        $project->payment_provider = env('PAYMENT_PROVIDER');
        $project->payment_link = $paymentUrl;
        $project->payment_reference = $payment_reference;
        $project->payment_status = 'pending';
        $project->price_type = $price_type;
        $project->save();
        $user->notify(new ReceiptNotification($project, $design, $user->email));
        return response()->json([
            'success' => true,
            'paymentUrl' => $paymentUrl
        ]);
    }

    public function processExampleSmetaOrder(Request $request)
    {
        //assign or create user

        if (Auth::check() && $request->input('logged_in')) {
            $user = Auth::user();
        } elseif (!$request->input('logged_in')) {
            $registerController = new RegisterController();
            $user = $registerController->create($request, true);
            $request->merge(['user_id' => $user->id]);
        } else {
            return response()->json(['error' => 'Logged in user check failed'], 401);
        }
        $price_type = $request->input('price_type');
        $price_type_label = $price_type === 'material' ? 'Только материалы' : ($price_type === 'total' ? 'Материалы и работы' : 'Материалы, работы и доставка');
        //assign design
        $design = Design::find($request->input('design_id'));
        $designTitle = $design->title;
        $orderDesignTitle = "Смета по проекту ($price_type_label) " . $designTitle;
        
        //create project
        $projectController = new ProjectController();
        $orderId = $projectController->createSmetaOrder($request);
        $project = Project::find($orderId);
        $payment_amount = $request->input('payment_amount');
        
        $description = $orderDesignTitle;
        $payment_reference = (string)(random_int(1000000000, 9999999999));
        $paymentUrl = "example";
        $project->payment_provider = "example";
        $project->payment_link = $paymentUrl;
        $project->payment_reference = $payment_reference;
        $project->payment_status = 'error';
        $project->price_type = $price_type;
        $project->is_example = true;
        $project->save();
        return response()->json([
            'success' => true,
            'paymentUrl' => route('payment.set.status', ['payment_status' => 'success', 'order_id' => base64_encode($project->human_ref)])
        ]);
    }

    public function viewFiscalReceipt($id)
    {
        $project = Project::where('payment_reference', $id)->firstOrFail();
        $design = Design::find($project->design_id);
        $user_email = $project->user->email;
        return view('fiscal-receipt', compact('project', 'design', 'user_email'));
    }

    public function viewGeneralReceipt($id)
    {
        $project = Project::where('payment_reference', $id)->firstOrFail();
        $design = Design::find($project->design_id);
        $user_email = $project->user->email;
        return view('general-receipt', compact('project', 'design', 'user_email'));
    }

    public function yandexPayCallback($orderId, $payment_reference, $description, $payment_amount)
    {
        $isSandbox = env('YANDEX_PAY_SANDBOX');
        if ($isSandbox) {
            $baseUrl = 'https://sandbox.pay.yandex.ru';
        } else {
            $baseUrl = 'https://pay.yandex.ru';
        }
        $orderId = $orderId;
        $price = $payment_amount;
        $title = $description;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Api-Key cc08ce31-8375-439d-86f1-1201533f53e7'
        ])->post("{$baseUrl}/api/merchant/v1/orders", [
            'cart' => [
                'items' => [
                    [
                        'productId' => "101",
                        'quantity' => [
                            'count' => 1
                        ],
                        'title' => $title,
                        'unitPrice' => $price,
                        'total' => $price
                    ]
                ],
                'total' => [
                    'amount' => $price
                ]
            ],
            'orderId' => $orderId,
            'currencyCode' => 'RUB',
            'externalOperationId' => $payment_reference,
            'orderAmount' => (double)$price,
            'redirectUrls' => [
                'onSuccess' => route('payment.set.status', ['payment_status' => 'success', 'order_id' => $orderId]),
                'onError' => route('payment.set.status', ['payment_status' => 'error', 'order_id' => $orderId]),
                'onAbort' => route('payment.set.status', ['payment_status' => 'error', 'order_id' => $orderId])
            ]
        ]);
        if ($response->successful()) {
            $data = $response->json();
            try {
                $paymentUrl = $data['data']['paymentUrl'];
                return $paymentUrl;
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Could not find paymentUrl in response'
                ], 500);
            }
        } else {
            $errorMessage = $response->body();
            dd($errorMessage);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Yandex Pay order: ' . $errorMessage
            ], 500);
        }
    }

    public function setPaymentStatus($payment_status, $order_id)
    {
        $project = Project::where('human_ref', base64_decode($order_id))->firstOrFail();
        $project->payment_status = $payment_status;
        $project->is_example ? $project->payment_status = 'error' : $project->payment_status = $payment_status;
        $project->save();
        return redirect()->route('payment.status', ['payment_status' => $payment_status, 'order_id' => $order_id]);
    }
}
