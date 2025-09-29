<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BlotterController extends Controller
{
    public function index()
    {
        // Sample blotter data - replace with actual database queries when models are ready
        $blotterData = [
            'active' => [
                [
                    'id' => 1,
                    'complainant' => 'Juan Dela Cruz',
                    'respondent' => 'Pedro Santos',
                    'victims' => 'Maria Garcia',
                    'blotter_crime' => 'Theft',
                    'status' => 'Active',
                    'date_reported' => '2025-09-20',
                    'action' => 'Under Investigation'
                ],
                [
                    'id' => 2,
                    'complainant' => 'Ana Rodriguez',
                    'respondent' => 'Carlos Lopez',
                    'victims' => 'Ana Rodriguez',
                    'blotter_crime' => 'Harassment',
                    'status' => 'Active',
                    'date_reported' => '2025-09-21',
                    'action' => 'Mediation Scheduled'
                ],
                [
                    'id' => 3,
                    'complainant' => 'Roberto Fernandez',
                    'respondent' => 'Miguel Torres',
                    'victims' => 'Community Property',
                    'blotter_crime' => 'Vandalism',
                    'status' => 'Active',
                    'date_reported' => '2025-09-22',
                    'action' => 'Evidence Collection'
                ]
            ],
            'settled' => [
                [
                    'id' => 4,
                    'complainant' => 'Sofia Martinez',
                    'respondent' => 'Diego Hernandez',
                    'victims' => 'Sofia Martinez',
                    'blotter_crime' => 'Property Dispute',
                    'status' => 'Settled',
                    'date_reported' => '2025-09-15',
                    'action' => 'Agreement Reached'
                ],
                [
                    'id' => 5,
                    'complainant' => 'Carmen Reyes',
                    'respondent' => 'Luis Morales',
                    'victims' => 'Carmen Reyes',
                    'blotter_crime' => 'Noise Complaint',
                    'status' => 'Settled',
                    'date_reported' => '2025-09-10',
                    'action' => 'Warning Issued'
                ]
            ],
            'scheduled' => [
                [
                    'id' => 6,
                    'complainant' => 'Elena Vargas',
                    'respondent' => 'Fernando Castro',
                    'victims' => 'Multiple Residents',
                    'blotter_crime' => 'Public Disturbance',
                    'status' => 'Scheduled',
                    'date_reported' => '2025-09-22',
                    'action' => 'Hearing on 2025-09-25'
                ],
                [
                    'id' => 7,
                    'complainant' => 'Pablo Jimenez',
                    'respondent' => 'Isabella Cruz',
                    'victims' => 'Pablo Jimenez',
                    'blotter_crime' => 'Verbal Threat',
                    'status' => 'Scheduled',
                    'date_reported' => '2025-09-21',
                    'action' => 'Mediation on 2025-09-24'
                ],
                [
                    'id' => 8,
                    'complainant' => 'Andrea Silva',
                    'respondent' => 'Gabriel Ramirez',
                    'victims' => 'Andrea Silva',
                    'blotter_crime' => 'Trespassing',
                    'status' => 'Scheduled',
                    'date_reported' => '2025-09-20',
                    'action' => 'Investigation on 2025-09-23'
                ],
                [
                    'id' => 9,
                    'complainant' => 'Marcos Gutierrez',
                    'respondent' => 'Valeria Mendez',
                    'victims' => 'Store Property',
                    'blotter_crime' => 'Shoplifting',
                    'status' => 'Scheduled',
                    'date_reported' => '2025-09-19',
                    'action' => 'Court Referral on 2025-09-26'
                ],
                [
                    'id' => 10,
                    'complainant' => 'Ricardo Peña',
                    'respondent' => 'Camila Flores',
                    'victims' => 'Ricardo Peña',
                    'blotter_crime' => 'Assault',
                    'status' => 'Scheduled',
                    'date_reported' => '2025-09-18',
                    'action' => 'Hearing on 2025-09-27'
                ],
                [
                    'id' => 11,
                    'complainant' => 'Lucia Ortega',
                    'respondent' => 'Alejandro Ruiz',
                    'victims' => 'Lucia Ortega',
                    'blotter_crime' => 'Fraud',
                    'status' => 'Scheduled',
                    'date_reported' => '2025-09-17',
                    'action' => 'Document Review on 2025-09-28'
                ]
            ]
        ];

        $stats = [
            'active_count' => count($blotterData['active']),
            'settled_count' => count($blotterData['settled']),
            'scheduled_count' => count($blotterData['scheduled']),
            'total_count' => count($blotterData['active']) + count($blotterData['settled']) + count($blotterData['scheduled'])
        ];

        return view('admin.blotter.index', compact('blotterData', 'stats'));
    }
}