<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Show the template editor for a specific template type
     */
    public function edit($templateType)
    {
        // Decode the template type from URL
        $templateType = urldecode($templateType);
        
        // Define default template content for different certificate types
        $defaultTemplates = [
            'Barangay Clearance' => [
                'title' => 'BARANGAY CLEARANCE',
                'content' => 'This is to certify that [RESIDENT_NAME], [AGE] years old, [CIVIL_STATUS], is a bonafide resident of Barangay San Pedro Apartado, Alcala, Pangasinan.\n\nThis certification is issued upon the request of the above-mentioned person for whatever legal purpose it may serve.\n\nGiven this [DATE] day of [MONTH], [YEAR].',
                'fee' => 50.00
            ],
            'Certificate of Indigency' => [
                'title' => 'CERTIFICATE OF INDIGENCY',
                'content' => 'This is to certify that [RESIDENT_NAME], [AGE] years old, [CIVIL_STATUS], is a bonafide resident of Barangay San Pedro Apartado, Alcala, Pangasinan and that he/she belongs to an INDIGENT FAMILY in this barangay.\n\nThis certification is issued upon the request of the above-mentioned person for whatever legal purpose it may serve.\n\nGiven this [DATE] day of [MONTH], [YEAR].',
                'fee' => 0.00
            ],
            'Business Permit' => [
                'title' => 'BARANGAY BUSINESS PERMIT',
                'content' => 'This is to certify that [RESIDENT_NAME] is hereby permitted to operate [BUSINESS_TYPE] business at [BUSINESS_ADDRESS], Barangay San Pedro Apartado, Alcala, Pangasinan.\n\nThis permit is valid for the calendar year [YEAR] and is subject to the rules and regulations of this barangay.\n\nGiven this [DATE] day of [MONTH], [YEAR].',
                'fee' => 200.00
            ],
            'Certificate of Residency' => [
                'title' => 'CERTIFICATE OF RESIDENCY',
                'content' => 'This is to certify that [RESIDENT_NAME], [AGE] years old, [CIVIL_STATUS], is a bonafide resident of Barangay San Pedro Apartado, Alcala, Pangasinan since [RESIDENCY_DATE].\n\nThis certification is issued upon the request of the above-mentioned person for whatever legal purpose it may serve.\n\nGiven this [DATE] day of [MONTH], [YEAR].',
                'fee' => 30.00
            ],
            'Barangay ID' => [
                'title' => 'BARANGAY IDENTIFICATION CARD',
                'content' => 'This serves as the official identification card of [RESIDENT_NAME], a bonafide resident of Barangay San Pedro Apartado, Alcala, Pangasinan.\n\nValid until: [EXPIRY_DATE]\n\nIssued this [DATE] day of [MONTH], [YEAR].',
                'fee' => 25.00
            ]
        ];

        // Get template data or use default
        $template = $defaultTemplates[$templateType] ?? [
            'title' => strtoupper($templateType),
            'content' => 'Default template content for ' . $templateType,
            'fee' => 0.00
        ];

        return view('admin.templates.edit', compact('templateType', 'template'));
    }

    /**
     * Update the template
     */
    public function update(Request $request, $templateType)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'fee' => 'required|numeric|min:0'
        ]);

        // Here you would save the template to database
        // For now, we'll just redirect back with success message
        
        return redirect()
            ->route('admin.templates.edit', $templateType)
            ->with('success', 'Template updated successfully!');
    }
}