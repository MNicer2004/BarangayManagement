<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Resident;
use App\Models\Blotter;
use App\Models\Purok;
use App\Models\Precinct;
use App\Models\Revenue;
use App\Models\User;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (assuming there's at least one user)
        $user = User::first();
        
        if (!$user) {
            // Create a default user if none exists
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@barangay.local',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'approval_status' => 'approved'
            ]);
        }

        // Create sample precincts
        $precincts = [
            ['precinct_number' => '001', 'location' => 'Barangay Hall', 'total_voters' => 150, 'active_voters' => 140, 'created_by' => $user->id],
            ['precinct_number' => '002', 'location' => 'Elementary School', 'total_voters' => 200, 'active_voters' => 180, 'created_by' => $user->id],
            ['precinct_number' => '003', 'location' => 'Community Center', 'total_voters' => 175, 'active_voters' => 165, 'created_by' => $user->id],
        ];

        foreach ($precincts as $precinct) {
            Precinct::create($precinct);
        }

        // Create sample puroks
        $puroks = [
            ['name' => 'Purok 1', 'description' => 'Northern area', 'total_households' => 45, 'created_by' => $user->id],
            ['name' => 'Purok 2', 'description' => 'Central area', 'total_households' => 52, 'created_by' => $user->id],
            ['name' => 'Purok 3', 'description' => 'Southern area', 'total_households' => 38, 'created_by' => $user->id],
            ['name' => 'Purok 4', 'description' => 'Eastern area', 'total_households' => 41, 'created_by' => $user->id],
            ['name' => 'Purok 5', 'description' => 'Western area', 'total_households' => 47, 'created_by' => $user->id],
            ['name' => 'Purok 6', 'description' => 'Northeast area', 'total_households' => 33, 'created_by' => $user->id],
            ['name' => 'Purok 7', 'description' => 'Southwest area', 'total_households' => 29, 'created_by' => $user->id],
        ];

        foreach ($puroks as $purok) {
            Purok::create($purok);
        }

        // Create sample residents
        $residents = [
            ['name' => 'Juan Dela Cruz', 'national_id' => '1234567890123', 'age' => 35, 'birthday' => '1989-05-15', 'civil_status' => 'Married', 'gender' => 'Male', 'purok' => 'Purok 1', 'precinct_id' => 1, 'religion' => 'Catholic', 'occupation' => 'Farmer', 'voter_status' => true, 'contact_number' => '09123456789', 'created_by' => $user->id],
            ['name' => 'Maria Santos', 'national_id' => '2345678901234', 'age' => 28, 'birthday' => '1996-08-22', 'civil_status' => 'Single', 'gender' => 'Female', 'purok' => 'Purok 2', 'precinct_id' => 1, 'religion' => 'Catholic', 'occupation' => 'Teacher', 'voter_status' => true, 'contact_number' => '09234567890', 'created_by' => $user->id],
            ['name' => 'Pedro Garcia', 'national_id' => '3456789012345', 'age' => 42, 'birthday' => '1982-12-10', 'civil_status' => 'Married', 'gender' => 'Male', 'purok' => 'Purok 3', 'precinct_id' => 2, 'religion' => 'Catholic', 'occupation' => 'Tricycle Driver', 'voter_status' => true, 'contact_number' => '09345678901', 'created_by' => $user->id],
            ['name' => 'Ana Reyes', 'national_id' => '4567890123456', 'age' => 19, 'birthday' => '2005-03-18', 'civil_status' => 'Single', 'gender' => 'Female', 'purok' => 'Purok 4', 'precinct_id' => 2, 'religion' => 'Catholic', 'occupation' => 'Student', 'voter_status' => true, 'contact_number' => '09456789012', 'created_by' => $user->id],
            ['name' => 'Carlos Mendoza', 'national_id' => '5678901234567', 'age' => 55, 'birthday' => '1969-11-05', 'civil_status' => 'Married', 'gender' => 'Male', 'purok' => 'Purok 5', 'precinct_id' => 3, 'religion' => 'Catholic', 'occupation' => 'Store Owner', 'voter_status' => true, 'contact_number' => '09567890123', 'created_by' => $user->id],
            ['name' => 'Luz Fernandez', 'national_id' => '6789012345678', 'age' => 16, 'birthday' => '2008-07-12', 'civil_status' => 'Single', 'gender' => 'Female', 'purok' => 'Purok 6', 'religion' => 'Catholic', 'occupation' => 'Student', 'voter_status' => false, 'contact_number' => '09678901234', 'created_by' => $user->id],
            ['name' => 'Roberto Cruz', 'national_id' => '7890123456789', 'age' => 25, 'birthday' => '1999-01-30', 'civil_status' => 'Single', 'gender' => 'Male', 'purok' => 'Purok 7', 'precinct_id' => 1, 'religion' => 'Catholic', 'occupation' => 'Construction Worker', 'voter_status' => true, 'contact_number' => '09789012345', 'created_by' => $user->id],
            ['name' => 'Sofia Ramirez', 'national_id' => '8901234567890', 'age' => 33, 'birthday' => '1991-09-14', 'civil_status' => 'Married', 'gender' => 'Female', 'purok' => 'Purok 1', 'precinct_id' => 2, 'religion' => 'Catholic', 'occupation' => 'Nurse', 'voter_status' => true, 'contact_number' => '09890123456', 'created_by' => $user->id],
        ];

        foreach ($residents as $resident) {
            Resident::create($resident);
        }

        // Create sample blotter records
        $blotters = [
            [
                'complainant_name' => 'Juan Dela Cruz', 
                'complainant_contact' => '09123456789', 
                'complainant_address' => 'Purok 1, Barangay Sample',
                'respondent_name' => 'Unknown', 
                'respondent_contact' => null,
                'respondent_address' => null,
                'victims' => 'Juan Dela Cruz',
                'crime_type' => 'Theft', 
                'incident_date' => '2024-10-01', 
                'incident_time' => '14:30:00', 
                'incident_location' => 'Purok 1', 
                'incident_description' => 'Motorcycle theft reported', 
                'case_status' => 'Active',
                'date_reported' => '2024-10-01',
                'action_taken' => 'Investigation ongoing',
                'created_by' => $user->id
            ],
            [
                'complainant_name' => 'Maria Santos', 
                'complainant_contact' => '09234567890', 
                'complainant_address' => 'Purok 2, Barangay Sample',
                'respondent_name' => 'Pedro Unknown', 
                'respondent_contact' => null,
                'respondent_address' => 'Purok 3, Barangay Sample',
                'victims' => 'Maria Santos',
                'crime_type' => 'Noise Complaint', 
                'incident_date' => '2024-10-03', 
                'incident_time' => '22:00:00', 
                'incident_location' => 'Purok 2', 
                'incident_description' => 'Loud music complaint', 
                'case_status' => 'Settled',
                'date_reported' => '2024-10-03',
                'action_taken' => 'Warning issued, resolved amicably',
                'created_by' => $user->id
            ],
            [
                'complainant_name' => 'Carlos Mendoza', 
                'complainant_contact' => '09567890123', 
                'complainant_address' => 'Purok 5, Barangay Sample',
                'respondent_name' => 'Ana Rivera', 
                'respondent_contact' => '09111222333',
                'respondent_address' => 'Purok 5, Barangay Sample',
                'victims' => 'Carlos Mendoza',
                'crime_type' => 'Property Dispute', 
                'incident_date' => '2024-10-05', 
                'incident_time' => '16:45:00', 
                'incident_location' => 'Purok 5', 
                'incident_description' => 'Boundary dispute between neighbors', 
                'case_status' => 'Scheduled',
                'date_reported' => '2024-10-05',
                'action_taken' => 'Mediation scheduled for next week',
                'created_by' => $user->id
            ],
        ];

        foreach ($blotters as $blotter) {
            Blotter::create($blotter);
        }

        // Create sample revenue records
        $revenues = [
            ['transaction_type' => 'certificate_fee', 'description' => 'Barangay Clearance for Juan Dela Cruz', 'amount' => 50.00, 'payer_name' => 'Juan Dela Cruz', 'payer_contact' => '09123456789', 'transaction_date' => '2024-10-01', 'status' => 'completed', 'received_by' => $user->id],
            ['transaction_type' => 'certificate_fee', 'description' => 'Certificate of Residency for Maria Santos', 'amount' => 30.00, 'payer_name' => 'Maria Santos', 'payer_contact' => '09234567890', 'transaction_date' => '2024-10-02', 'status' => 'completed', 'received_by' => $user->id],
            ['transaction_type' => 'permit_fee', 'description' => 'Business Permit for Sari-sari Store', 'amount' => 500.00, 'payer_name' => 'Carlos Mendoza', 'payer_contact' => '09567890123', 'transaction_date' => '2024-10-03', 'status' => 'completed', 'received_by' => $user->id],
            ['transaction_type' => 'certificate_fee', 'description' => 'Certificate of Indigency for Ana Reyes', 'amount' => 0.00, 'payer_name' => 'Ana Reyes', 'payer_contact' => '09456789012', 'transaction_date' => '2024-10-04', 'status' => 'completed', 'received_by' => $user->id],
            ['transaction_type' => 'penalty', 'description' => 'Late business permit penalty', 'amount' => 100.00, 'payer_name' => 'Roberto Cruz', 'payer_contact' => '09789012345', 'transaction_date' => '2024-10-05', 'status' => 'completed', 'received_by' => $user->id],
        ];

        foreach ($revenues as $revenue) {
            Revenue::create($revenue);
        }
    }
}
