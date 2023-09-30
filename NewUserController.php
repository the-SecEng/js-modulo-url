<?php

namespace App\Http\Controllers\Web\Authenticated\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // For generating UUID

class NewUserController extends Controller
{
    public function verifyAndCreateUser(Request $request)
{
    try {
        $empID = $request->input('uuid');
        $password = $request->input('password'); // New password from the request

        // Get employee data
        $employeeData = DB::table('employee')
            ->where('uuid', $empID)
            ->first();

        // Check if a user with the same email_address exists
        $existingUser = DB::table('users')
            ->where('email_address', $employeeData->email_address)
            ->first();

        if ($existingUser) {
            // User with the same email or phone number already exists
            return response()->json(['message' => 'User with the same email or phone number already exists'], 400);
        }

        $generatedUuid = $this->generateUuid();
        echo $generatedUuid;
        // Create a new user record in the users table
        $userId = DB::table('users')->insert([
            'uuid' => $generatedUuid,
                'company_id' => $employeeData->company_id,
                'company_department_id' => $employeeData->company_department_id,
                'email_address' => $employeeData->email_address,
                'internal_id' => null,
                'gender' => null,
                'language' => null,
                'time_zone' => null,
                'is_send_remainder' => null,
                'complete_name' => $employeeData->first_name . ' ' . $employeeData->second_name . ' ' . $employeeData->last_name,
                'email_verified_at' => now(),
                'marital_status' => null,
                'nationality' => null,
                'job_position' => null,
                'curp' => null,
                'rfc' => null,
                'social_number' => null,
                'contract_type' => null,
                'ingress_date' => null,
                'sdi' => null,
                'bonus' => null,
                'total_ingress' => null,
                'address' => null,
                'peridiocity' => null,
                'turn' => null,
                'password' => md5($password), // Hash the password using MD5
                'fb_id' => null,
                'google_id' => ' ',
                'apple_id' => null,
                'one_signal_id' => ' ',
                'image' => ' ',
                'user_name' => ' ',
                // 'personal_phone' => $employeeData->phone_number ?? null,
                'personal_phone' => $employeeData->phone_number ?? '',
                'company_deparment_id' => $employeeData->company_department_id,
                'company_department_id' => $employeeData->company_department_id,
                'birthdate' => null,
                'cover_image' => null,
                'fmc_token' => null,
                'password_reset_code' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
        ]);

        // Actualiza user_id en employee
        $updateEmployeeData = DB::table('employee')
        ->where('email_address', $employeeData->email_address)
        ->update(['user_id' => $generatedUuid]);

        return response()->json(['message' => 'User created successfully', 'user_id' => $userId, 'employee_data_updated' => $updateEmployeeData]);
    } catch (\Exception $e) {
        // Handle any exceptions here, log them, and return an appropriate response
        return response()->json([
            'error' => 'An error occurred: ' . $e->getMessage(),
        ], 500);
    }
}
    private function generateUuid()
    {
        return Str::uuid()->toString();
    }
}
