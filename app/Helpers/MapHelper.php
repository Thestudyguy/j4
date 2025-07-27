<?php
function mapPatientFormInput($input) {
    return [
        'FirstName' => $input['firstname'] ?? null,
        'LastName' => $input['lastname'] ?? null,
        'MiddleName' => $input['middlename'] ?? null,
        'BirthDate' => $input['birthdate'] ?? null,
        'Age' => $input['age'] ?? null,
        'Religion' => $input['religion'] ?? null,
        'Nationality' => $input['nationality'] ?? null,
        'NickName' => $input['nickname'] ?? null,
        'Address' => $input['address'] ?? null,
        'HomeNo' => $input['homeno'] ?? null,
        'Occupation' => $input['occupation'] ?? null,
        'OfficeNo' => $input['officeno'] ?? null,
        'EffectiveDate' => $input['effectivedate'] ?? null,
        'FaxNo' => $input['faxno'] ?? null,
        'Email' => $input['email'] ?? null,
        'MobileNo' => $input['mobileno'] ?? null,
        'Guardian' => $input['guardian'] ?? null,
        'GuardianOccupation' => $input['guardianoccupation'] ?? null,
        'Referal' => $input['referal'] ?? null,
        'ReasonForVisit' => $input['consultationreason'] ?? null,
    ];
}
