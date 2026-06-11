<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    /**
     * Create a new repair ticket (appointment) via API.
     */
    public function store(Request $request)
    {
        // Security check for n8n
        if ($request->header('X-N8N-SECRET') !== env('N8N_WEBHOOK_SECRET', 'repairmax_secret_123')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Log::info('Incoming n8n Ticket Request', $request->all());

        try {
            $validated = $request->validate([
                'device_brand' => 'required|string',
                'device_model' => 'required|string',
                'fault_category' => 'required|string',
                'description' => 'required|string',
                'pref_date' => 'required|date',
                'pref_time' => 'required', // HH:MM format
                'user_id' => 'nullable|integer',
            ]);

            // Generate a sequential tracking code (RM-#####) matching the web booking format
            $maxId = Appointment::max('id') ?? 0;
            $trackingCode = 'RM-' . str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);

            $selectedFault = ($validated['fault_category'] && $validated['fault_category'] !== 'Other')
                ? \App\Models\FaultType::where('name', $validated['fault_category'])->first()
                : null;
            $basePrice = $selectedFault ? $selectedFault->base_price : 0;

            $appointment = Appointment::create([
                'user_id' => $validated['user_id'] ?? (\App\Models\User::first()?->id ?? 1), // Default to first user if not provided
                'tracking_code' => $trackingCode,
                'booking_number' => $trackingCode,
                'device_brand' => $validated['device_brand'],
                'device_model' => $validated['device_model'],
                'fault_category' => $validated['fault_category'],
                'description' => $validated['description'],
                'pref_date' => $validated['pref_date'],
                'pref_time' => $validated['pref_time'],
                'status' => 'Pending',
                'quote' => $basePrice,
            ]);

            // Auto-generate invoice number based on appointment ID (INV-#####)
            $appointment->invoice_number = 'INV-' . str_pad($appointment->id, 5, '0', STR_PAD_LEFT);
            $appointment->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'tracking_code' => $appointment->tracking_code,
                'appointment_id' => $appointment->id,
            ], 201);

        } catch (\Exception $e) {
            Log::error('API Ticket Creation Failed', ['error' => $e->getMessage()]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create ticket: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Track a repair ticket (appointment) via API.
     */
    public function track(Request $request)
    {
        // Security check for n8n
        if ($request->header('X-N8N-SECRET') !== env('N8N_WEBHOOK_SECRET', 'repairmax_secret_123')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'booking_reference' => 'required|string',
            'email' => 'required|email',
        ]);

        $ref = $validated['booking_reference'];
        $email = $validated['email'];

        $appointment = Appointment::where(function ($query) use ($ref) {
                $query->where('tracking_code', $ref)
                      ->orWhere('booking_number', $ref);
            })
            ->whereHas('user', function ($query) use ($email) {
                $query->where('email', $email);
            })->first();

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'No active repair booking found matching reference "' . $ref . '" and email "' . $email . '".'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'booking_number' => $appointment->booking_number,
                'tracking_code' => $appointment->tracking_code,
                'device_brand' => $appointment->device_brand,
                'device_model' => $appointment->device_model,
                'fault_category' => $appointment->fault_category,
                'description' => $appointment->description,
                'status' => $appointment->status,
                'pref_date' => $appointment->pref_date,
                'pref_time' => $appointment->pref_time,
                'final_cost' => $appointment->final_cost,
                'created_at' => $appointment->created_at ? $appointment->created_at->toIso8601String() : null,
            ]
        ]);
    }
}
