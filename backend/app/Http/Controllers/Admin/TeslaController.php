<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tesla; // Ensure you have the Tesla model imported
use App\Models\Teslabuy;
use App\Models\Adminwallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeslaController extends Controller
{
    //
    // Show form to add a new Tesla car
    public function add_tesla()
    {
        return view('Adminview.add_tesla');
    }

    // Store the Tesla car details in the database
    public function store(Request $request)
    {




        // Validation of the input
        $validated = $request->validate([
            'car_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'car_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|numeric',
            'features' => 'required|string',
        ]);





        // Handle the image upload
        $imagePath = $request->file('car_img')->store('car_images', 'public');

        // Create a new Tesla instance and save it to the database
        $tesla = new Tesla();
        $tesla->car_name = $validated['car_name'];
        $tesla->price = $validated['price'];
        $tesla->year = $validated['year'];
        $tesla->features = $validated['features'];
        $tesla->car_img = $imagePath; // Store the image path in the database
        $tesla->save();

        // Redirect with success message
        return redirect()->route('add_tesla')
            ->with('success', 'Tesla added successfully!');
    }

    public function buy($id)
    {
        $car = Tesla::findOrFail($id);
        // Perform any additional actions (e.g., redirect to a checkout page)
        return view('Userview.TeslaBuyPreview', compact('car'));
    }


    // public function getPaymentDetails(Request $request, $id)

    // {
    //     $validatedData = $request->validate([
    //         'payment_method' => 'required',
    //     ]);
    //     $car = Tesla::findOrFail($id);

    //     $coinType = $validatedData['payment_method'];
    //     $adminWallet = Adminwallet::first();
    //     $walletAddress = '';
    //     $QRcode = '';
    //     $Proof = '';

    //     if ($coinType === 'Bitcoin_bitcoin') {
    //         $walletAddress = $adminWallet->btc_address_bitcoin;
    //         $QRcode = $adminWallet->btc_address_bitcoin_qr;
    //     } elseif ($coinType === 'Bitcoin_bep20') {
    //         $walletAddress = $adminWallet->btc_address_bep20;
    //         $QRcode = $adminWallet->btc_address_bep20_qr;
    //     } elseif ($coinType === 'Ethereum_erc20') {
    //         $walletAddress = $adminWallet->eth_address_erc20;
    //         $QRcode = $adminWallet->eth_address_erc20_qr;
    //     } elseif ($coinType === 'Ethereum_bep20') {
    //         $walletAddress = $adminWallet->eth_address_bep20;
    //         $QRcode = $adminWallet->eth_address_bep20_qr;
    //     } elseif ($coinType === 'USDT_trc20') {
    //         $walletAddress = $adminWallet->usdt_address_trc20;
    //         $QRcode = $adminWallet->usdt_address_trc20_qr;
    //     } elseif ($coinType === 'USDT_bep20') {
    //         $walletAddress = $adminWallet->usdt_address_bep20;
    //         $QRcode = $adminWallet->usdt_address_bep20_qr;
    //     } elseif ($coinType === 'USDT_erc20') {
    //         $walletAddress = $adminWallet->usdt_address_erc20;
    //         $QRcode = $adminWallet->usdt_address_erc20_qr;
    //     }


    //     $rawPaymentMethod = $request->input('payment_method');
    //     $transactionId = Str::uuid()->toString();
    //     $currentDate = Carbon::now();
    //     $Proof = '';

    //     // Save new Teslabuy record
    //     $teslastore = new \App\Models\Teslabuy();
    //     $teslastore->car_name = $car->car_name;
    //     $teslastore->car_year = $car->year;
    //     $teslastore->fullname = Auth::user()->fullname;
    //     $teslastore->email = Auth::user()->email;
    //     $teslastore->price = $car->price;
    //     $teslastore->ptype = $rawPaymentMethod;
    //     $teslastore->transid = $transactionId;
    //     $teslastore->dateadd = $currentDate;
    //     $teslastore->status = 'pending'; // Optional: set default status
    //     $teslastore->save();










    //     return view('Userview.TeslaBuyPay', [

    //         'walletAddress' => $walletAddress, // Pass the wallet address to the view
    //         'qr' => $QRcode,
    //         'car' => $car,
    //         'coinType' => $coinType,
    //         'proof' => $Proof,




    //     ]);

    //     // Assuming $paymentId is available in the controller
    //     // return redirect()->route('show.payment.details', ['id' => $car, 'walletAddress' => $walletAddress, 'QRcode' => $QRcode, 'car' => $car, 'coinType' => $coinType]);
    // }

    public function getPaymentDetails(Request $request, $id)
    {
        $validatedData = $request->validate([
            'payment_method' => 'required',
        ]);

        // Find the car
        $car = Tesla::findOrFail($id);



        // Define the coin type and wallet address
        $coinType = $validatedData['payment_method'];
        $adminWallet = Adminwallet::first();
        $walletAddress = '';
        $QRcode = '';


        // Set default view data
        $viewData = [
            'coinType' => $coinType,
            'car' => $car,
        ];


        // Set wallet details based on payment method
        switch ($coinType) {
            case 'Bitcoin_bitcoin':
                $walletAddress = $adminWallet->btc_address_bitcoin;
                $QRcode = $adminWallet->btc_address_bitcoin_qr;
                break;
            case 'Bitcoin_bep20':
                $walletAddress = $adminWallet->btc_address_bep20;
                $QRcode = $adminWallet->btc_address_bep20_qr;
                break;
            case 'Ethereum_erc20':
                $walletAddress = $adminWallet->eth_address_erc20;
                $QRcode = $adminWallet->eth_address_erc20_qr;
                break;
            case 'Ethereum_bep20':
                $walletAddress = $adminWallet->eth_address_bep20;
                $QRcode = $adminWallet->eth_address_bep20_qr;
                break;
            case 'USDT_trc20':
                $walletAddress = $adminWallet->usdt_address_trc20;
                $QRcode = $adminWallet->usdt_address_trc20_qr;
                break;
            case 'USDT_bep20':
                $walletAddress = $adminWallet->usdt_address_bep20;
                $QRcode = $adminWallet->usdt_address_bep20_qr;
                break;
            case 'USDT_erc20':
                $walletAddress = $adminWallet->usdt_address_erc20;
                $QRcode = $adminWallet->usdt_address_erc20_qr;
                break;
            case 'bank_transfer':
                $viewData['Account_name'] = 'Gordon F Lee';
                $viewData['Bank_name'] = 'Bank of America';
                $viewData['Account_number'] = '#457051507105';
                $viewData['Routing_number'] =  '#026009593';
                $viewData['Bank_address'] = '13780 W Waddel Road, Surprise, AZ.85374';
                break;
        }




        // return view('Userview.TeslaBuyPay', [
        //     'walletAddress' => $walletAddress, // Pass the wallet address to the view
        //     'qr' => $QRcode,
        //     'car' => $car,
        //     'coinType' => $coinType,

        // ]);

        // Add wallet info only if not bank_transfer
        if ($coinType !== 'bank_transfer') {
            $viewData['walletAddress'] = $walletAddress;
            $viewData['qr'] = $QRcode;
        }

        return view('Userview.TeslaBuyPay', $viewData);
    }




    public function payment_upload(Request $request, $id)
    {
        // Validate image
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload the image
        $imagePath = $request->file('proof_image')->store('tesla_proofs', 'public');

        $rawPaymentMethod = $request->input('payment_method');
        $transactionId = Str::uuid()->toString();
        $currentDate = Carbon::now();

        // Save new Teslabuy record if no existing purchase
        $teslastore = new \App\Models\Teslabuy();
        $car = Tesla::findOrFail($id); // Retrieve the car details using the ID
        $teslastore->car_name = $car->car_name;
        $teslastore->car_year = $car->year;
        $teslastore->fullname = Auth::user()->fullname;
        $teslastore->email = Auth::user()->email;
        $teslastore->price = $car->price;
        $teslastore->ptype = $rawPaymentMethod;
        $teslastore->transid = $transactionId;
        $teslastore->dateadd = $currentDate;
        $teslastore->status = 'pending'; // Set default status as 'pending'
        $teslastore->proof = $imagePath; // Save the uploaded image path to the database

        $teslastore->save();



        return redirect()->back()->with([
            'success' => 'Proof of payment uploaded successfully! We will contact you via email to process the shipping after payment confirmation.',
        ]);
    }

    public function showpaymentdetails(Request $request, $id)
    {
        $car = Tesla::findOrFail($id);
        return view('Userview.TeslaBuyPay', compact('car'));
    }
}
